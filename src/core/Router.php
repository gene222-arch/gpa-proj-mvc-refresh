<?php 

namespace app\core;

use app\core\exceptions\NotFoundException;

class Router 
{

	public Request $request;
	public array $routes = [];

	/**
	 * Class Constructor
	 */
	public function __construct( Request $request )
	{

		$this->request = $request;
	}


	public function get( string $path, $callback )
	{

		$this->routes['get'][$path] = $callback;
	}


	public function post( string $path, $callback ) 
	{	

		$this->routes['post'][$path] = $callback;
	}


	public function resolve() 
	{

		$path = $this->request->path();
		$method = $this->request->method();
		$callback = $this->routes[ $method ][ $path ] ?? false;


		if(!$callback) {

			throw new NotFoundException;
		}

		if ( is_string($callback) ) {

			return Application::$app->controller->render($callback);
		} 

		if ( is_array($callback) ) {

			$callback[0] = new $callback[0]();
		}

		return call_user_func($callback);

	}




}