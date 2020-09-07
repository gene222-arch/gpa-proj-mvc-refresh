<?php 

namespace app\core\controller;

use app\core\Application;
use app\core\middlewares\Basemiddlewares;

abstract class Controller 
{

	public string $layOut = 'main.blade';
	public array $actions = [];
	public array $middleware = [];

	public function set_lay_out(string $layOut): void
	{

		$this->layOut = $layOut;
	}


	public function render(string $view, $data = []): string
	{

		return Application::$app->view->renderView($view, $data);
	}


	public function set_middleware( Basemiddlewares $middlewares ) {

		$this->middleware[] = $middlewares;
	}


	public function get_middleware() {

		return $this->middleware;
	}


}