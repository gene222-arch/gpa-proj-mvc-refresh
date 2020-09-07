<?php 

namespace app\models;

use app\core\models\Model;
use app\models\User;
use app\core\Application;

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


	public function login(): bool {

		$user = User::find(["email" => $this->email]);	

		if ( empty($user) ) {

			$rule = ["field" => "user", "rule" => self::RULE_NOT_EXISTS ];
			$this->set_error_message_on_select("email", $rule );

			return false;
		}

		if ( !password_verify( $this->password, $user->password )) {

			$rule = ["field" => "password", "rule" => self::RULE_NOT_MATCH ];
			$this->set_error_message_on_select("password", $rule);

			return false;
		}

		return Application::$app->login($user);

	}


	public function rules(): array {

		return [
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
			'password' => [self::RULE_REQUIRED]
		];

	}
	
}