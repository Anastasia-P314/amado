<?php  
namespace App\Models;
use Aura\SqlQuery\QueryFactory;
use PDO;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;

class User 
{	private $pdo;
	private $queryFactory;
	private $auth;

	public function __construct(PDO $pdo, QueryFactory $queryFactory, Auth $auth, Flash $flash){
		$this->pdo = $pdo;
		$this->queryFactory = $queryFactory;
		$this->auth = $auth;
		$this->flash = $flash;
	}

	public function createUser(){
		try {
		    $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username']);

			$this->flash->success('Successful registration!');
		    header('Location: '.'/');
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    $this->flash->error('Invalid email address');
		    header('Location: '.'/register');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    $this->flash->error('Invalid password');
		    header('Location: '.'/register');
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    $this->flash->error('User already exists');
		    header('Location: '.'/register');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    $this->flash->error('Too many requests');
		    header('Location: '.'/register');
		};
	}

	public function login_check(){
		try {
		    $this->auth->login($_POST['email'], $_POST['password']);
		    $this->flash->success('Successful login!');
		    header('Location: '.'/');
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    $this->flash->error('Wrong email address');
		    header('Location: '.'/login');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    $this->flash->error('Wrong password');
		    header('Location: '.'/login');
		}
		catch (\Delight\Auth\EmailNotVerifiedException $e) {
		    $this->flash->error('Email not verified');
		    header('Location: '.'/login');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    $this->flash->error('Too many requests');
		    header('Location: '.'/login');
		}
	}

	public function logout(){
		try {
		    $this->auth->logOutEverywhere();
		    unset($_SESSION);

		    header('Location: '.'/');
		}
		catch (\Delight\Auth\NotLoggedInException $e) {
			unset($_SESSION);
		    die('Not logged in');
		}
	}

	public function getUsernameById($id){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('users')
			->where('id = :id')
			->bindValue('id', $id);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$user = $sth->fetch(PDO::FETCH_ASSOC);   
		return $user;
	}

	public function delete_user(){
        $delete = $this->queryFactory->newDelete();

        $delete
            ->from('users')                   // FROM this table
            ->where('id = :id')           // AND WHERE these conditions
            ->bindValue('id', $_GET['id']);   // bind one value to a placeholder

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());

        header("Location: "."/");  
    }

	public function deleteReviewsWithUser(){
		 $delete = $this->queryFactory->newDelete();

        $delete
        	->from('reviews') 
        	->where('author=:author')
        	->bindValue('author', $_GET['id']);

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
	}

	public function deleteProductsWithUser(){
		 $delete = $this->queryFactory->newDelete();

        $delete
        	->from('products') 
        	->where('user=:user')
        	->bindValue('user', $_GET['id']);

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
	}

	public function getAll(){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('users');
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $result;
	}
}

?>