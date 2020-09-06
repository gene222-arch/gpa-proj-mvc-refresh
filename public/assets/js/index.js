import {contactValidate} from './modules/validations/contact.js';


(function(){

	document.querySelector('.email').addEventListener('keyup', contactValidate.email);
	document.querySelector('.recipient').addEventListener('keyup', contactValidate.recipient);
	
}())