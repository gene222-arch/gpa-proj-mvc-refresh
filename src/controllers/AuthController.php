<?php 

namespace app\controllers;

use app\core\controller\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Application;
use app\core\middlewares\AuthMiddlewares;

use app\models\User;
use app\models\LoginForm;


class AuthController extends Controller
{

	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		$this->set_middleware(new AuthMiddlewares($this->auth_middlewares()));
	}


	public function register(Request $request, Response $response): string {

		$this->set_lay_out('auth.blade');

		$register = new User();

		if ( $request->is_post() ) {

			$register->load_data($request->get_request_data());

			if ($register->validate_data() && $register->register()) {
				
				return $this->render('register', ['model' => $register]);
			}

		return $this->render('register', ['model' => $register]);
		}		
		
		return $this->render('register', ['model' => $register]);
	}


	public function login(Request $request, Response $response): string {

		$this->set_lay_out('auth.blade');

		$login = new LoginForm();

		if ( $request->is_post() ) {

			$login->load_data($request->get_request_data());

			if ($login->validate_data() && $login->login()) {
				
				Application::$app->session->set_flash_message("login", "Login Successful");
				Application::$app->response->redirect('/');
			}

		return $this->render('login', ['model' => $login]);

		}		
		
		return $this->render('login', ['model' => $login]);
	}


	public function logout(Request $request, Response $response): void {

		Application::$app->logout();
		$response->redirect('/');
	}	


	public function user_profile(): string {
		
		return $this->render('user_profile');
	}


	public function auth_middlewares(): array {

		return ['user_profile'];
	}

}