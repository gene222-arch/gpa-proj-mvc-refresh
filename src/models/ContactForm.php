<?php

namespace app\models;

use app\core\db\DatabaseORM;

class ContactForm extends DatabaseORM
{


	public string $email = '';
	public string $recipient = '';
	public string $message = '';


	public static function table_name(): string {

		return 'contact';
	}


	public static function primary_key(): string {

		return 'contact_id';
	}


	public static function field_names(): array {

		return [ 'user_contact_id', 'email', 'recipient', 'message'];
	}


	public function send() {

		return parent::save();
	}


	public function setLabels(): array {

		return [

			'email' => 'Email',
			'recipient' => 'Recipient',
			'message' => 'Your Message'
		];
	}


	public function getLabel( string $lblName ): string {

		return $this->setLabels()[$lblName];
	}


	public function rules(): array {

		return [

			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'className' => static::class]],
			'recipient' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 255] ],
			'message' => [self::RULE_REQUIRED]

		];
	}


}