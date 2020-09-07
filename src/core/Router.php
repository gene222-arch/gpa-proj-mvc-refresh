<?php 

namespace app\core;

use app\core\exceptions\NotFoundException;

class Router 
{


	public static Request $request;
	public static Response $response;
	public static array $routes = [];

	/**
	 * Class Constructor
	 */
	public function __construct( Request $request, Response $response )
	{

		self::$request = $request;
		self::$response = $response;
	}


	public static function get( string $path, $callback )
	{

		self::$routes['get'][$path] = $callback;
	}


	public static function post( string $path, $callback ) 
	{	

		self::$routes['post'][$path] = $callback;
	}


	public static function resolve() 
	{

		$path = self::$request->path();
		$method = self::$request->method();
		$callback = self::$routes[ $method ][ $path ] ?? false;


		if ( !$callback ) {

			self::$response->responseCode(404);
			throw new NotFoundException;
		}

		if ( is_string($callback) ) {

			return Application::$app->controller->render($callback);
		} 

/*Before view renders, set controller first*/
		if ( is_array($callback) ) {

			$callback[0] = new $callback[0]();
			Application::$app->controller = $callback[0];
			$callback[0]->actions[] = $callback[1];

			foreach ( Application::$app->controller->get_middleware() as $middlewares ) {
				$middlewares->execute_middleware();
			}

		}

		return call_user_func($callback, self::$request, self::$response);

	}


}