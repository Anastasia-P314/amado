<?php  
namespace App\Models;
use Aura\SqlQuery\QueryFactory;
use PDO;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;

class Review 
{	private $pdo;
	private $queryFactory;
	private $auth;

	public function __construct(PDO $pdo, QueryFactory $queryFactory, Auth $auth, Flash $flash){
		$this->pdo = $pdo;
		$this->queryFactory = $queryFactory;
		$this->auth = $auth;
		$this->flash = $flash;
	}


	public function getAllReviews(){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('reviews')
			->where("status = 'Show'");
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $result;
	}


	public function getOne($review_id){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('reviews')
			->where('review_id = :review_id')
			->bindValue('review_id', $review_id);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$review = $sth->fetch(PDO::FETCH_ASSOC);   
		return $review;
	}


	public function getReviewsByProductid($product_id){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('reviews')
			->join(
				'LEFT',
				'users as u',
				'reviews.author = u.id'
			)
			->where('product_id = :product_id')
			->where('reviews.status = "Show"')
			->bindValue('product_id', $product_id);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$reviews = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $reviews;
	}


	public function save_review(){
	try {
	        $insert = $this->queryFactory->newInsert();

	        $insert
	            ->into('reviews')                   // INTO this table
	            ->cols([
	            	'product_id' => $_POST['id'],
	            	'text' => $_POST['description'],
	            	'author' => $_SESSION["auth_user_id"]
	            ]);

	        $sth = $this->pdo->prepare($insert->getStatement());
	        $sth->execute($insert->getBindValues());
		
		    header('Location: '.'/product_details'.'?id='.$_POST['id']);
		}
		catch (\Delight\Auth\InvalidEmailException $e) {

		}
	}

    public function update($review_id){

    	$update = $this->queryFactory->newUpdate();

        $update
            ->table('reviews')                  // update this table
            ->cols([
            	'text' => $_POST['description'],
            	'status' => $_POST['status']
            ])
            ->where('review_id = :review_id')
            ->bindValue('review_id', $review_id); 

        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues()); 
        header("Location: "."/product_details"."?id=".$_POST['product_id']);       
    }

   
    public function delete_review($product_id){

        $delete = $this->queryFactory->newDelete();

        $delete
            ->from('reviews')                   // FROM this table
            ->where('review_id = :review_id')           // AND WHERE these conditions
            ->bindValue('review_id', $_GET['id']);   // bind one value to a placeholder

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());

        header("Location: "."/product_details"."?id=".$product_id);  
    }
}

?>