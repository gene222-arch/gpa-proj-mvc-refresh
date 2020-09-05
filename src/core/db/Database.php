<?php

namespace app\core\db;

use \PDO;

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
		$migrationFiles = scandir(Application::ROOT_DIR . '/src/migrations');

		$toApplyMigrations = array_diff($appliedMigrations, $onHoldMigrations);

		$newMigrations = [];

		foreach ($toApplyMigrations as $fileName) {
			
			if ($fileName === '.' || $fileName === '..') {

				continue;
			}

			require_once Application::$ROOT_DIR . '/src/core/migrations/' . $fileName;

			$className = pathinfo($fileName, PATHINFO_FILENAME);
			$instance = new $className();

			$this->log('Applying migration' . $fileName);
			$instance->up();
			$this->log('Applied migration' . $fileName);	
						
			$newMigrations[] = $fileName;	
					
		}

		if ( !empty($newMigrations) ) {

			$this->save_migration( $newMigrations );
		}


		echo "All migrations are applied";

	}


	public function fetch_applied_migrations() {

		$statement = "SELECT * FROM migrations";
		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_COLUMN);
	}


	public function save_migration( array $migrations ) {

		$sqlStatement = implode(", ", array_map(fn($migration) => "('$migration')" , $migrations));
		$statement = $this->prepare($sqlStatement);

		return $statement->execute();
	}


	public function create_database() {

		$this->pdo->exec("CREATE DATABASE IF NOT EXISTS mvc_refresh");
	}


	public function create_migrations_table() {

		$this->pdo->exec(' CREATE TABLE IF NOT EXISTS migrations (
			migration_id INT(11) AUTO_INCREMENT PRIMARY KEY,
			migration_name VARCHAR(255) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) 
			ENGINE=INNODB;');
	}


	public function prepare( string $sqlStatement) {

		return $this->pdo->prepare( $sqlStatement);
	}


	public function log( $message ) {

		echo date('Y m d h:i:s A') . ' ' . $message . PHP_EOL;
	}

	
}	