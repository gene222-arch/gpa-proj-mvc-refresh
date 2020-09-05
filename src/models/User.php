<?php

namespace app\models;

use app\core\db\DatabaseModel;

class User extends DatabaseModel
{	

	protected string $email = '';
	protected string $password = '';
	protected string $confirmPassword = '';


	public function table_name(): string {

		return 'table name';
	}


	public function primary_key(): string {

		return 'id';
	}


	public function field_names(): array {

		return [];
	}


	public function setLabels(): array {

		return [];
	}


	public function getLabel(): string {

		return '';
	}


	public function rules(): array {

		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'className' => static::class]],
			'password' => [self::RULE_REQUIRED],
			'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
		];
	}
	
}