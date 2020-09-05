<?php 

namespace app\core;


class Controller 
{

	public string $layOut = 'main.blade';


	public function set_lay_out(string $layOut)
	{

		$this->layOut = $layOut;
	}


	public function render(string $view, $data = [])
	{

		return Application::$app->view->renderView($view, $data);
	}


}