<?php 

namespace app\core;

use app\core\db\Database;
use app\core\models\UserModel;

use app\core\controller\Controller;

class Application 
{

	public static string $ROOT_DIR;
	public static Application $app;
	public Router $router;
	public Request $request;
	public Response $response;
	public Database $db;
	public ?Controller $controller = null;
	public View $view;
	public ?UserModel $user = null;
	public string $userClass;
	/**
	 * Class Constructor
	 */
	public function __construct(array $config = [])	{
//Main

		self::$ROOT_DIR = dirname(dirname(__DIR__));
		self::$app = $this;
//Core
		$this->request  = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request, $this->response);
		$this->controller = new Controller;
		$this->view = new View();
//Model
		$this->userClass = $config['userClass'];

//Db
		$this->db = new Database($config['db']);
	}

	public function run() {

		try {
			
			echo Router::resolve();

		} catch (\Exception $e) {
			
			echo $this->view->renderView('error', [
				'err' => $e
			]);
		}

	}


}