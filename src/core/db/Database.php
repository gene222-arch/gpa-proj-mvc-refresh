<?php

namespace app\core\db;

use \PDO;
use app\core\Application;

class Database 
{


	public $pdo;
	/**
	 * Class Constructor
	 */
	public function __construct(array $config = [])
	{
			
		$dsn = $config['dsn'] ?? '';
		$user = $config['user'] ?? '';
		$password = $config['password'] ?? '';

		$this->pdo = new PDO($dsn, $user, $password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}


	public function apply_migration() {

		$this->create_database();
		$this->create_migrations_table();

		$appliedMigrations = $this->fetch_applied_migrations();
		$migrationFiles = scandir(Application::$ROOT_DIR . '/src/migrations');

		$toApplyMigrations = array_diff( $migrationFiles, $appliedMigrations );

		$newMigrations = [];

		foreach ($toApplyMigrations as $fileName) {
			
			if ($fileName === '.' || $fileName === '..') {

				continue;

			} else {

				require_once Application::$ROOT_DIR . '/src/migrations/' . $fileName;

				$className = pathinfo($fileName, PATHINFO_FILENAME);
				$instance = new $className();

				echo "<pre>";
				$this->log(' Applying migration <br>' . $fileName);
				$instance->up();
				$this->log(' Applied migration <br>' . $fileName);	
				echo "</pre>";
							
				$newMigrations[] = $fileName;
			}				
		}


		if ( !empty($newMigrations) ) {

			$this->save_migration( $newMigrations );

		} else

			echo "All migrations are applied";
		
	}


	public function create_database() {

		$this->exec("CREATE DATABASE IF NOT EXISTS mvc_refresh");
	}


	public function create_migrations_table() {

		$this->exec(' CREATE TABLE IF NOT EXISTS migrations (
			migration_id INT(11) AUTO_INCREMENT PRIMARY KEY,
			migration_name VARCHAR(255) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) 
			ENGINE=INNODB;');
	}


	public function save_migration( array $migrations = [] ) {

		$sqlStatement = "INSERT INTO 
							`migrations` (migration_name) 
						VALUES " 
						. implode(", ", array_map(fn($m) => "('$m')" , $migrations) );

		$statement = $this->prepare($sqlStatement);
		$statement->execute();
	}


	public function fetch_applied_migrations() {

		$statement = $this->prepare("SELECT migration_name FROM migrations");
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_COLUMN);
	}


	public function prepare( string $sqlStatement ) {

		return $this->pdo->prepare( $sqlStatement );
	}


	public function log( $message ) {

		echo date('Y m d h:i:s A') . ' ' . $message . PHP_EOL;
	}


	public function exec( $ddlStatement ) {

		$this->pdo->exec( $ddlStatement );
	}

	
}	