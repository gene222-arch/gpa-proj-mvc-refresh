<?php

namespace app\models;

use app\core\db\DatabaseModel;

class ContactForm extends DatabaseModel
{


	public string $email = '';
	public string $recipient = '';
	public string $message = '';


	public function table_name(): string {

		return 'table_name';
	}


	public function primary_key(): string {

		return 'contact_id';
	}


	public function field_names(): array {

		return [ 'email', 'subject', 'message'];
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


	public function send() {

		return parent::save();
	}

}