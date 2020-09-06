<?php 

require_once('./vendor/autoload.php');

use Dotenv\Dotenv;
use app\core\Application;

$dotenv = Dotenv::createImmutable(__DIR__. '/config')->load();


$config = [

	"userClass" => app\models\User::class,
	"db" => [

		"dsn" => $_ENV['DB_DSN'],
		"user" => $_ENV['DB_USER'],
		"password" => $_ENV['DB_PASSWORD']
	]
];

$app = new Application($config);

$app->db->apply_migration();