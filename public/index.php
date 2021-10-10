<?php  
session_start();

require '../vendor/autoload.php';
use Aura\SqlQuery\QueryFactory;
use League\Plates\Engine;
use DI\ContainerBuilder;
use Delight\Auth\Auth;

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions([
    PDO::class => function(){
        $driver = "mysql";
        $host = "localhost";
        $dbname = "diploma";
        $username = "root";
        $password = "";

        return new PDO("$driver:host=$host;dbname=$dbname",$username,$password);
    },

    QueryFactory::class => function(){
    	return new QueryFactory('mysql');
    },

    Engine::class => function(){
    	return new Engine('../views');
    },

    Auth::class => function($containerBuilder){
    	return new Auth($containerBuilder->get('PDO'));
    }
]);

$container = $containerBuilder->build();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
	$r->addRoute('GET', '/', ['App\Controllers\HomeController','index']);
	$r->addRoute('GET', '/index.php', ['App\Controllers\HomeController','index']);
	$r->addRoute('GET', '/index', ['App\Controllers\HomeController','index']);
	$r->addRoute('GET', '/product_details', ['App\Controllers\HomeController','product_details']);
	$r->addRoute('GET', '/home', ['App\Controllers\HomeController','category']);
	$r->addRoute('GET', '/register', ['App\Controllers\HomeController','register']);
	$r->addRoute('POST', '/create_user', ['App\Controllers\HomeController','create_user']);
	$r->addRoute('GET', '/login', ['App\Controllers\HomeController','login']);
	$r->addRoute('POST', '/login_check', ['App\Controllers\HomeController','login_check']);
	$r->addRoute('GET', '/logout', ['App\Controllers\HomeController','logout']);
    $r->addRoute('GET', '/addnew', ['App\Controllers\HomeController','addnew']);
    $r->addRoute('POST', '/new_product', ['App\Controllers\HomeController','new_product']);
    $r->addRoute('GET', '/edit', ['App\Controllers\HomeController','edit']);
    $r->addRoute('POST', '/update', ['App\Controllers\HomeController','update']);
    $r->addRoute('GET', '/delete', ['App\Controllers\HomeController','delete']);
    $r->addRoute('GET', '/new_review', ['App\Controllers\HomeController','new_review']);
    $r->addRoute('POST', '/save_review', ['App\Controllers\HomeController','save_review']);
    $r->addRoute('GET', '/edit_review', ['App\Controllers\HomeController','edit_review']);
    $r->addRoute('POST', '/update_review', ['App\Controllers\HomeController','update_review']);
    $r->addRoute('GET', '/delete_review', ['App\Controllers\HomeController','delete_review']);
    $r->addRoute('GET', '/all_users', ['App\Controllers\HomeController','all_users']);
    $r->addRoute('GET', '/delete_user', ['App\Controllers\HomeController','delete_user']);
    $r->addRoute('GET', '/deleteCategory', ['App\Controllers\HomeController','deleteCategory']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        $controller = $container->call($handler, $vars);
        break;
}


?>