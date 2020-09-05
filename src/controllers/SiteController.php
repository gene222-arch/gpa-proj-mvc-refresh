<?php 

namespace app\controllers;

use app\core\controller\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

class SiteController extends Controller
{

	public function home() : string {

		return $this->render('home');
	}


	public function contact( Request $request ) {

		$contact = new ContactForm();

		if ( $request->is_post() ) {

			$contact->load_data($request->get_request_data());

			if ($contact->validate_data() && $contact->send()) {
		
				return $this->render('contact', ['model' => $contact]);
			}

		return $this->render('contact', ['model' => $contact]);

		}

		return $this->render('contact');	
	}


}