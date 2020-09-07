<?php 

namespace app\core;

class Session {


	private const FLASH_KEY = 'flash_message';
	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		session_start();

		$flashMessage = $_SESSION[self::FLASH_KEY] ?? [];

		foreach ($flashMessage as $key => &$value) {
				
			$value['status'] = true;
		}

		$_SESSION[self::FLASH_KEY] = $flashMessage;
	}

	/**
	 * Class Destructor --- call constructor -> refresh page -> call destructor
	 * $_SESSION --- all its values either a literal/array can be unset individually
	 */
	public function __destruct() 
	{

		$flashMessage = $_SESSION[self::FLASH_KEY] ?? "";

		foreach ($flashMessage as $key => &$value) {
				
			if ( $value['status'] ) {
				
				unset($flashMessage[$key]);
			}
		}

		$_SESSION[self::FLASH_KEY] = $flashMessage;

	}


	public function set_flash_message( string $key, string $message ): void {

		$_SESSION[self::FLASH_KEY][$key] = [

			'status' => false,
			'message' => $message
		];
	}


	public function get_flash_message( string $key ): string {

		return $_SESSION[self::FLASH_KEY][$key]['message'] ?? "";
	}


	public function set_user( string $key, string $user ) {

		$_SESSION[$key] = $user;
	}


	public function get_user( string $key ) {

		return $_SESSION[$key] ?? "";
	}


	public function delete_user( string $key ) {

		unset($_SESSION[$key]);
	}


}