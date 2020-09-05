<?php

namespace app\core\db;

use app\core\models\Model;
use app\core\Application;

abstract class DatabaseModel extends Model
{

	public abstract function table_name(): string;

	public abstract function primary_key(): string;

	public abstract function field_names(): array;

	public function save(): bool {

		return true;
	}


	public function find( array $where = [] ) {

		$tableName = $this->table_name();
		$fieldName = array_keys($where);

		$conditionalStatements = implode(" AND ", array_map(fn($field)=> "$field = :$field", $fieldName));	
		$statement = self::prepare('SELECT * FROM ' . $tableName . 'WHERE' . $conditionalStatements);

		foreach ($where as $fieldName => $value) {
			
			$statement->bindValue(':$fieldName', $value);
		}

		$statement->execute();

		return $statement->fetchObject($this);

	}


	public static function prepare( $sqlStatement ) {

		return Application::$app->db->prepare($sqlStatement);
	}
	
}