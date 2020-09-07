import {contactValidate} from './modules/validations/contact.js';


(function(){

		document.querySelector('.email').addEventListener('keyup', contactValidate.email);
		document.querySelector('button').addEventListener('submit', function() {
			document.querySelector('form').reset();
		});


		if (document.querySelector('.recipient')) {

			document.querySelector('.recipient').addEventListener('keyup', contactValidate.recipient);
		}
		
}())

	
