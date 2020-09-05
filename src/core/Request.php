<?php 

namespace app\core;


class Request 
{


	public function path(): string 
	{

		$path = $_SERVER['REQUEST_URI'];
		$pos = strpos($path, "?") ?? false;

		if (!$pos) {

			return $path;
		}

		return substr($path, 0, $pos);
	}


	public function method(): string
	{

		return strtolower($_SERVER['REQUEST_METHOD']);
	}


}



