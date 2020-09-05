<?php 

namespace app\core;


class Application 
{

	public static string $ROOT_DIR;
	public static Application $app;
	public Router $router;
	public Request $request;
	public ?Controller $controller;
	public View $view;

	/**
	 * Class Constructor
	 */
	public function __construct( string $ROOT_DIR )
	{
			
		self::$ROOT_DIR = $ROOT_DIR;
		self::$app = $this;
		$this->request = new Request();
		$this->router = new Router($this->request);
		$this->controller = new Controller();
		$this->view = new View();

	}


	public function run() {

		try {
			
			echo $this->router->resolve();

		} catch (\Exception $e) {
			
			echo $this->view->renderView('error', [
				'err' => $e
			]);
		}

	}



}