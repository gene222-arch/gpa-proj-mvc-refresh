<?php 

namespace app\models;

use app\core\db\Model;


class LoginForm extends Model
{	

	protected string $email = '';
	protected string $password = '';


	public function setLabels(): array {

		return [];
	}


	public function getLabel(): string {

		return '';
	}


	public function rules(): array {

		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'className' => static::class]],
			'password' => [self::RULE_REQUIRED]
		];

	}
	
}