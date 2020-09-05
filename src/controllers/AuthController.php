<?php 

namespace app\controllers;

use app\core\controller\Controller;
use app\core\Request;
use app\core\Response;


class AuthController extends Controller
{


	public function register(Request $request, Response $response): string {

		$this->set_lay_out('auth.blade');

		$register = new User();

		if ( $request->is_post() ) {

			$register->load_data($request->get_request_data());

			if ($register->validate_data() && $register->send()) {
		
				return $this->render('/', ['model' => $register]);
			}

		return $this->render('register', ['model' => $register]);

		}		
		
		return $this->render('register');
	}


	public function login(Request $request, Response $response): string {


		$this->set_lay_out('auth.blade');

		$login = new LoginForm();

		if ( $request->is_post() ) {

			$login->load_data($request->get_request_data());

			if ($login->validate_data() && $login->send()) {
		
				return $this->render('/', ['model' => $login]);
			}

		return $this->render('login', ['model' => $login]);

		}		
		
		return $this->render('login');
	}


	public function logout(Request $request, Response $response): void {

		$response->redirect('/');
	}	


}