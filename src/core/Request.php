<?php 

namespace app\core;


class Request 
{


	public function path(): string {

		$path = $_SERVER['REQUEST_URI'];
		$pos = strpos($path, "?") ?? false;

		if (!$pos) {

			return $path;
		}

		return substr($path, 0, $pos);
	}


	public function method(): string {

		return strtolower($_SERVER['REQUEST_METHOD']);
	}


	public function is_get(): bool {

		return $this->method() === 'get';
	}


	public function is_post(): bool {

		return $this->method() === 'post';
	}


	public function get_request_data(): array {

		$data = [];

		if ( $this->is_get()) {

			foreach ($_GET as $name => $value) {
				
				/* Convert HTML coded data to plain TEXT*/
				$data[$name] = filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
			}			
		}

		foreach ($_POST as $name => $value) {
			
			/* Convert HTML coded data to plain TEXT*/
			$data[$name] = filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
		}				
			
		return $data;
	}

}



