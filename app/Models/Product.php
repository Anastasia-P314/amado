<?php  
namespace App\Models;
use Aura\SqlQuery\QueryFactory; 
use PDO;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;

class Product 
{	private $pdo;
	private $queryFactory;
	private $auth;

	public function __construct(PDO $pdo, QueryFactory $queryFactory, Auth $auth, Flash $flash){
		$this->pdo = $pdo;
		$this->queryFactory = $queryFactory;
		$this->auth = $auth;
		$this->flash = $flash;
	}


	public function getAll(){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('products')
			->where("status = 'Show'");
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $result;
	}

	public function getProductsPerPage($itemsPerPage, $currentPage){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('products')
			->where("status = 'Show'")
			->orWhere("status = ''")
			->offset(($currentPage-1)*$itemsPerPage)
			->limit($itemsPerPage);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$result_per_page = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $result_per_page;
	}

	public function getOne($id){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('products')
			->where('id = :id')
			->bindValue('id', $id);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$product = $sth->fetch(PDO::FETCH_ASSOC);   
		return $product;
	}

	public function getProductByName($name){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('products')
			->where('name = :name')
			->bindValue('name', $name);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$product = $sth->fetch(PDO::FETCH_ASSOC);   
		return $product;
	}

	public function getProductsByCategory($category){
		$select = $this->queryFactory->newSelect();
		$select->cols(['*'])
			->from('products')
			->join(
				'INNER',
				'categories',
				'products.category = categories.category_id'
			)
			->where('category = :category')
			->where('status = "Show"')
			->orWhere("status = ''")
			->bindValue('category', $category);
		
		$sth = $this->pdo->prepare($select->getStatement());
		$sth->execute($select->getBindValues());
		$products = $sth->fetchAll(PDO::FETCH_ASSOC);   
		return $products;
	}


	public function new_product(){
		if(empty($this->getProductByName($_POST['name']))){
			try {
				$filename = strtolower(md5(uniqid(pathinfo($_FILES['image']['name'])['filename'])));
				$ext = pathinfo($_FILES['image']['name'])['extension'];

				move_uploaded_file($_FILES['image']['tmp_name'], 'img/product-img/'.$filename.'.'.$ext);

		        $insert = $this->queryFactory->newInsert();

		        $insert
		            ->into('products')                   // INTO this table
		            ->cols([
		            	'name' => $_POST['name'],
		            	'description' => $_POST['description'],
		            	'price' => $_POST['price'],
		            	'image' => 'img/product-img/'.$filename.'.'.$ext,
		            	'category' => $_POST['category'],
		            	'status' => $_POST['status'],
		            	'user' => $_SESSION["auth_user_id"]
		            ]);

		        $sth = $this->pdo->prepare($insert->getStatement());
		        $sth->execute($insert->getBindValues());
			
			    header('Location: '.'/');
			}
			catch (\Delight\Auth\InvalidEmailException $e) {
			}
		} else {
			$this->flash->error('The product name is not unique');
			header('Location: '.'/addnew');
		}
	}

    public function update($id){

    	$update = $this->queryFactory->newUpdate();

		if($_FILES['image']['name']!=""){
			$filename = strtolower(md5(uniqid(pathinfo($_FILES['image']['name'])['filename'])));
			$ext = pathinfo($_FILES['image']['name'])['extension'];

			move_uploaded_file($_FILES['image']['tmp_name'], 'img/product-img/'.$filename.'.'.$ext);

			$update
            ->table('products')                  // update this table
            ->cols([
            	'image' => 'img/product-img/'.$filename.'.'.$ext,
            	'product_img' => $_FILES['product_img']['name']
            ])
            ->where('id = :id')
            ->bindValue('id', $id); 
		}

        $update
            ->table('products')                  // update this table
            ->cols([
    		    'name' => $_POST['name'],
            	'description' => $_POST['description'],
            	'price' => $_POST['price'],
            	'category' => $_POST['category'],
            	'status' => $_POST['status']
            ])
            ->where('id = :id')
            ->bindValue('id', $id); 

        $sth = $this->pdo->prepare($update->getStatement());
        $sth->execute($update->getBindValues());

        header("Location: "."/product_details"."?id=".$_GET['id']);       
    }


    public function delete(){

        $delete = $this->queryFactory->newDelete();

        $delete
            ->from('products')                   // FROM this table
            ->where('id = :id')           // AND WHERE these conditions
            ->bindValue('id', $_GET['id']);   // bind one value to a placeholder

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());
    }

	public function deleteReviewsWithProduct(){
		 $delete = $this->queryFactory->newDelete();

        $delete
        	->from('reviews') 
        	->where('product_id=:product_id')
        	->bindValue('product_id', $_GET['id']);

        $sth = $this->pdo->prepare($delete->getStatement());
        $sth->execute($delete->getBindValues());

        header("Location: "."/");  
	}
	

}




?>