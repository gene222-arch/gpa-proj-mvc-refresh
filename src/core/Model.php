<?php 

namespace app\core\models;

use app\core\Application;
use app\core\Request;

/**
  * app/core/models/Model === handles data validation 
  */

abstract class Model 
{

	public const RULE_REQUIRED = 'required';
	public const RULE_EMAIL = 'email';
	public const RULE_MIN = 'min';
	public const RULE_MAX = 'max';
	public const RULE_MATCH = 'match';
	public const RULE_UNIQUE = 'unique';
	public array $errors = [];


	public abstract function rules(): array;

	public abstract function setLabels(): array;

	public abstract function getLabel( string $labelName ): string;


	public function load_data(array $data = []): void {

		foreach ($data as $property => $value) {
			
			if ( property_exists($this, $property)) {

				$this->{$property} = $value;
			}
		}

	}
	

	public function validate_data(): bool {


		foreach ($this->rules() as $fieldName => $rules) {
			
			$property = $this->{$fieldName};

			foreach ($rules as $rule) {
					
				$ruleName = $rule;

				if( is_array($rule) ) {

					$ruleName = $rule[0];
				}

				if ($ruleName === self::RULE_REQUIRED && empty($property)) {

					$this->set_error_message($fieldName, self::RULE_REQUIRED);
				} 

				if( $ruleName === self::RULE_EMAIL && !filter_var($property, FILTER_VALIDATE_EMAIL)) {

					$this->set_error_message($fieldName, self::RULE_EMAIL);					
				}

				if( $ruleName === self::RULE_MIN && strlen($property) < $rule['min']) {

					$this->set_error_message($fieldName, self::RULE_MIN, $rule);					
				}

				if( $ruleName === self::RULE_MAX && strlen($property) > $rule['max']) {

					$this->set_error_message($fieldName, self::RULE_MAX, $rule);					
				}

				// if( $ruleName === self::RULE_UNIQUE ) {

				// 	$instance = new $rule['className']();

				// 	$instance->find([$fieldName => $property]);

				// 	if ($instance->{$fieldName}) {

				// 		$this->set_error_message($fieldName, self::RULE_UNIQUE, ['field' => $fieldName]);
				// 	}				
				// }				
			}
		}

		return empty($this->errors);
	}


	public function set_error_message(string $fieldName, string $ruleName, array $rules = [] ): void {

		$errorMessage = $this->error_message()[$ruleName];

		foreach ($rules as $key => $value) {

			$errorMessage = str_replace("{{$key}}", $value, $errorMessage);
		}

		$this->errors[$fieldName][] = $errorMessage;
	}


	public function get_error_message( string $fieldName ): string {

		return $this->errors[$fieldName][0] ?? '';
	}


	public function has_error_message( string $fieldName ): bool {

		return !empty($this->errors[$fieldName]);
	}


	public function error_message(): array {

		return [

			self::RULE_REQUIRED => 'This field is required',
			self::RULE_EMAIL => 'This is not a valid email',
			self::RULE_MIN => 'The minimum length of this field {min}',
			self::RULE_MAX => 'The maximum length of this field is {max}',
			self::RULE_UNIQUE => 'This {field} already exists'
		];
	}


}