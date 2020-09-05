<?php 

namespace app\core;


class View 
{

	public string $page_title = '';
	public string $layOut = 'main.blade';


	public function renderView(string $view, $data = [])
	{

		$render_view = $this->view($view, $data);
		$layOut = $this->layout();

		return str_replace('{{content}}', $render_view, $layOut);
	}


	private function view( string $view, $data = [])
	{

		foreach ($data as $attr => $value) {
			
			$$attr = $value;
		}

		ob_start();
		require_once( Application::$ROOT_DIR . "/src/views/$view.php" );
		return ob_get_clean();
	}


	private function layout()
	{
		$layout = $this->layOut;

		if (Application::$app->controller)	{
			
			$layout = Application::$app->controller->layOut;
		}

		ob_start();
		require_once( Application::$ROOT_DIR . "/src/views/layouts/$layout.php" );
		return ob_get_clean();		
	}

}