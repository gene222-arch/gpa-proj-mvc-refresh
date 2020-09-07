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
	public Session $session;
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
		$this->session = new Session();
		$this->view = new View();
//Model
		$this->userClass = $config['userClass'];


//Db
		$this->db = new Database($config['db']);
		$user_id = $this->session->get_user("user");

		if ( $user_id ) {

			$userPrimaryKey = $this->userClass::primary_key();
			$this->user = $this->userClass::find([$userPrimaryKey => $user_id]);
		}

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


/**
  * @param $user app\models\User --- after --- app\models\LoginForm::login()
  */
	public function login( UserModel $user ) {

		try {

			$this->user = $user;

			$primaryKey = $this->user->primary_key();
			$pkValue = $this->user->{$primaryKey};
			$this->session->set_user("user", $pkValue);

			return true;

		} catch (\Exception $e) {
			

		}
	}


	public function isGuest() {

		return empty($this->user);
	}


	public function logout() {

		$this->session->delete_user("user");
		$this->user = null;
	}

}