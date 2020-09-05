<?php 

namespace app\core;


class Response 
{


	public function responseCode( int $code ) {

		http_response_code($code);
	}


	public function redirect( string $location ) {

		header("Location: " . $location);
	}


}