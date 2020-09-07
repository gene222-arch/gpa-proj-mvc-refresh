<?php

namespace app\core\db;

use app\core\models\Model;
use app\core\Application;

abstract class DatabaseORM extends Model
{

	public static abstract function table_name(): string;

	public static abstract function primary_key(): string;

	public static abstract function field_names(): array;


	public function save(): bool {

		$tableName = static::table_name();
		$fieldNames = static::field_names();

		$tableArgs = implode(", ", $fieldNames);
		$tableNamedParams = implode(", ", array_map( function($fn) {

			if ( $fn === 'contact_id' || $fn === 'user_contact_id' ) {

				return "auto_increments()";
			}

			return ":$fn";

		} , $fieldNames ));

		$sqlStatement = "INSERT INTO " . $tableName . "( " . $tableArgs . " ) VALUES( " . $tableNamedParams . " )";
		$statement = self::prepare($sqlStatement);

		foreach ( $fieldNames as $fieldName ) {
			
			if ( $fieldName !== 'contact_id' && $fieldName !== 'user_contact_id' ) {

				$statement->bindValue("$fieldName", $this->{$fieldName});
			}

		}

		return $statement->execute();

	}


	public static function find( array $conditionalStatements = [] ) {

		$tableName = static::table_name();
		$fieldNames = array_keys($conditionalStatements);

		$whereClause = implode(" AND ", array_map(fn($field)=> "$field = :$field", $fieldNames));	
		$statement = static::prepare("SELECT * FROM " . $tableName . " WHERE " . $whereClause);

		foreach ($conditionalStatements as $fieldName => $value) {
			
			$statement->bindValue(":" . $fieldName, $value);
		}

		if ( $statement->execute() ):

			return $statement->fetchObject(static::class);

		else :

			return false;
		endif;
	}


	public static function prepare( $sqlStatement ) {

		return Application::$app->db->prepare($sqlStatement);
	}
	

}

/**

PDO::fetchObject() with the class as the Param returns both the Class` properties and the fetched data from the database, if Class property name is the same as the table`s fieldname then the tables fieldname will overwrite the Class` property value

*/