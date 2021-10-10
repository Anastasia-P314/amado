<?php  
namespace App\Models;
use Aura\SqlQuery\QueryFactory;
use PDO;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;

class Category
{	private $pdo;
	private $queryFactory;
	private $auth;


	public function __construct(PDO $pdo, QueryFactory $queryFactory, Auth $auth, Flash $flash){
		$this->pdo = $pdo;
		$this->queryFactory = $queryFactory;
		$this->auth = $auth;
		$this->flash = $flash;
	}


	public function getAllCategories(){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('categories');
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $result;
	}

	public function getCategoryByTitle($category_title){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('categories')
			->where('category_title = :category_title')
			->bindValue('category_title', $category_title);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$category = $sth->fetch(PDO::FETCH_ASSOC);   
		return $category['category_id'];
	}

	public function getCategoryById($category_id){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('categories')
			->where('category_id = :category_id')
			->bindValue('category_id', $category_id);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$category = $sth->fetch(PDO::FETCH_ASSOC);   
		return $category['category_title'];
	}

	public function updateCategory($id){

    	$update = $this->queryFactory->newUpdate();

        $update
            ->table('products')                  // update this table
            ->cols([
            	'category' => 'no category'
            ])
            ->where('id = :id')
            ->bindValue('id', $id); 

        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());      
    }

	public function deleteCategory($category_title){

        $delete = $this->queryFactory->newDelete();

        $delete
            ->from('categories')                   // FROM this table
            ->where('category_title = :category_title')           // AND WHERE these conditions
            ->bindValue('category_title', $category_title);   // bind one value to a placeholder


        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());

        header("Location: "."/");  
    }
    

}




?>