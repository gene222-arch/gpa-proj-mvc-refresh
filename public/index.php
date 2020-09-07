<?php 

require_once('../vendor/autoload.php');

use Dotenv\Dotenv;
use app\core\Application;
use app\core\Router;
use app\controllers\SiteController;
use app\controllers\AuthController;


$dotenvDir = dirname(__DIR__). '/config';
$dotenv = Dotenv::createImmutable($dotenvDir);
$dotenv->load();

$config = [

	"userClass" => app\models\User::class,
	"db" => [

		"dsn" => $_ENV['DB_DSN'],
		"user" => $_ENV['DB_USER'],
		"password" => $_ENV['DB_PASSWORD']
	]
];

$app = new Application($config);

Router::get('/', 
	[SiteController::class, 'home'] );

Router::get('/contact', 
	[SiteController::class, 'contact']);
Router::post('/contact', 
	[SiteController::class, 'contact']);

Router::get('/register', [AuthController::class, 'register']);
Router::post('/register', [AuthController::class, 'register']);

Router::get('/login', [AuthController::class, 'login']);
Router::post('/login', [AuthController::class, 'login']);

Router::get('/logout', [AuthController::class, 'logout']);

Router::get('/userprofile', [AuthController::class, 'user_profile']);

$app->run();

