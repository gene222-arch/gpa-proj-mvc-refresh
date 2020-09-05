<?php 

namespace app\core\controller;

use app\core\Application;

class Controller 
{

	public string $layOut = 'main.blade';


	public function set_lay_out(string $layOut): void
	{

		$this->layOut = $layOut;
	}


	public function render(string $view, $data = []): string
	{

		return Application::$app->view->renderView($view, $data);
	}


}