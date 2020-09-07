<?php

namespace app\models;

use app\core\models\UserModel;

/**
  * Purpose: Registration
  */


class User extends UserModel
{	

	public string $email = '';
	public string $password = '';
	public string $confirmPassword = '';


	public static function table_name(): string {

		return 'users';
	}


	public static function primary_key(): string {

		return 'user_id';
	}


	public static function field_names(): array {

		return [ 'email', 'password', 'contact_id'];
	}


	public function register() {

		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		parent::save();
	}


	public function setLabels(): array {

		return [ 'email' => 'Email', 'password' => 'Password', 'confirmPassword' => 'Confirm Password'];
	}


	public function getLabel( string $labelName ): string {

		return $this->setLabels()[$labelName];
	}


	public function display_user(): string {

		return $this->email;
	}

	public function rules(): array {

		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'className' => static::class]],
			'password' => [self::RULE_REQUIRED],
			'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
		];
	}
	
}