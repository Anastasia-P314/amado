<?php  
namespace App\Controllers;

use League\Plates\Engine;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Review;
use JasonGrimes\Paginator;



class HomeController 
{
	private $product;
	private $engine;

	public function __construct(User $user, Product $product, Category $category, Review $review, Engine $engine){
		$this->user = $user;
		$this->product = $product;
		$this->category = $category;
		$this->review = $review;
		$this->engine = $engine;
	}

	public function index(){
		$templates = $this->engine;

		if(isset($_GET['category'])){
			$result = $this->product->getProductsByCategory($_GET['category']); //d($result);
		} else {
			$result = $this->product->getAll(); 
		};
		
		$totalItems = count($result);
		$itemsPerPage = 2;
		if(isset($_GET['page'])){$currentPage = $_GET['page'];} else {$currentPage = 1;};
		$urlPattern = '?page=(:num)';
		$result_per_page = $this->product->getProductsPerPage($itemsPerPage, $currentPage);

		$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

		// Render a template
		echo $templates->render('shop', [
			'result' => $result,
			'result_per_page' => $result_per_page,
			'paginator' => $paginator
		]);
	}

	public function product_details(){
		$templates = $this->engine;

		$product = $this->product->getOne($_GET['id']);
		$category_title = $this->category->getCategoryById($product['category']);

		$reviews = $this->review->getReviewsByProductid($_GET['id']);
		$username = $this->user->getUsernameById($_GET['id']);

		echo $templates->render('product_details',[
			'product' => $product,
			'category_title' => $category_title,
			'reviews' => $reviews,
			'username' => $username
		]);
	}

	public function category(){
		$templates = $this->engine;

		$result = $this->product->getProductsByCategory($this->category->getCategoryByTitle($_GET['category']));
		
		$totalItems = count($result);
		$itemsPerPage = 1000;
		if(isset($_GET['page'])){$currentPage = $_GET['page'];} else {$currentPage = 1;};
		$urlPattern = '?page=(:num)';
		$result_per_page = $result;

		$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

		// Render a template
		echo $templates->render('shop', [
			'result' => $result,
			'result_per_page' => $result_per_page,
			'paginator' => $paginator
		]);
	}

	public function deleteCategory(){
		$products = $this->product->getProductsByCategory('6');
		foreach($products as $product){
			$this->product->updateCategory($product['id']);
		}
		$this->category->deleteCategory('del');
	}

	public function addnew(){
		$categories = $this->category->getAllCategories();

		$templates = $this->engine;

		// Render a template
		echo $templates->render('page_addnew', [
			'categories' => $categories
		]);
	}

	public function new_product(){
		$this->product->new_product();
	}

	public function edit(){
		$categories = $this->category->getAllCategories();

		$templates = $this->engine;

		$product = $this->product->getOne($_GET['id']);

		echo $templates->render('page_edit',[
			'product' => $product,
			'categories' => $categories
		]);
	}

	public function update(){
		$this->product->update($_GET['id']);
	}	

	public function delete(){
		$product = $this->product->getOne($_GET['id']);
		if(file_exists($product['image'])){unlink($product['image']);};

		$this->product->delete();
		$this->product->deleteReviewsWithProduct();
	}


	//REVIEWS
	public function new_review(){
		$templates = $this->engine;

		// Render a template
		echo $templates->render('page_review');
	}

	public function save_review(){
		$this->review->save_review();
	}

	public function edit_review(){

		$templates = $this->engine;

		$review = $this->review->getOne($_GET['id']);

		echo $templates->render('page_edit_review',[
			'review' => $review
		]);
	}

	public function update_review(){
		$this->review->update($_GET['id']);

	}	

	public function delete_review(){
		$review = $this->review->getOne($_GET['id']);
		$product_id = $review['product_id'];

		$this->review->delete_review($product_id);
	}




	//USER
	public function register(){
		$templates = $this->engine;

		// Render a template
		echo $templates->render('page_register');
	}

	public function create_user(){
		$this->user->createUser();
	}

	public function login(){
		$templates = $this->engine;

		// Render a template
		echo $templates->render('page_login');
	}

	public function login_check(){
		$this->user->login_check();
	}

	public function logout(){
		$this->user->logout();
		unset($_SESSION);
	}

	public function delete_user(){
		$this->user->deleteReviewsWithUser();
		$this->user->deleteProductsWithUser();
		$this->user->delete_user();
	}

	public function all_users(){
		$users = $this->user->getAll();

		$templates = $this->engine;

		// Render a template
		echo $templates->render('page_users',[
			'users' => $users
		]);
	}



}

?>