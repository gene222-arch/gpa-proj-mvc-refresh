<?php

namespace app\models;

use app\core\db\DatabaseModel;

class User extends DatabaseModel
{	

	public string $email = '';
	public string $password = '';
	public string $confirmPassword = '';


	public function table_name(): string {

		return 'table name';
	}


	public function primary_key(): string {

		return 'id';
	}


	public function field_names(): array {

		return [ 'email', 'password' ];
	}


	public function setLabels(): array {

		return [ 'email' => 'Email', 'password' => 'Password', 'confirmPassword' => 'Confirm Password'];
	}


	public function getLabel( string $labelName ): string {

		return $this->setLabels()[$labelName];
	}


	public function rules(): array {

		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'className' => static::class]],
			'password' => [self::RULE_REQUIRED],
			'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
		];
	}
	
}