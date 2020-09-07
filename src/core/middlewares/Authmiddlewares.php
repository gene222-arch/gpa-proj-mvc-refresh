<?php 

namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbiddenException;

class AuthMiddlewares extends Basemiddlewares
{

	public array $actions = [];

	public function __construct(array $actions = [])
	{
		$this->actions = $actions;
	}
	
	public function execute_middleware() {

		if (Application::$app->isGuest()) {

			foreach (Application::$app->controller->actions as $action) {

				if (in_array($action, $this->actions)) {

					throw new ForbiddenException;
				}

			}
		}

	}

}