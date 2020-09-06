<?php 

namespace app\models;

use app\core\models\Model;


class LoginForm extends Model
{	

	public string $email = '';
	public string $password = '';


	public function setLabels(): array {

		return [
			'email' => 'Email',
			'password' => 'Password'

		];
	}


	public function getLabel( string $labelName ): string {

		return $this->setLabels()[$labelName];
	}


	public function rules(): array {

		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'className' => static::class]],
			'password' => [self::RULE_REQUIRED]
		];

	}
	
}