<?php 

namespace app\core\forms;

use app\core\models\Model;

class Input extends BaseField
{

	/*Input Type*/
	private const TYPE_TEXT = 'text';
	private const TYPE_NUMBER = 'number';
	private const TYPE_EMAIL = 'email';	
	private const TYPE_PASSWORD = 'password';

	public string $inputType = '';
	/**
	 * Class Constructor
	 */
	public function __construct(string $attrName, Model $model)
	{	
		$this->inputType = self::TYPE_TEXT;
		parent::__construct($attrName, $model);
	}	


	public function renderField(): string {

		return sprintf('	    
			<div class="input-group-prepend">
		    	<span class="input-group-text" name="%s">%s</span>
		    </div>
		    <input type="%s" class="form-control %s %s" name="%s" value="%s" required>
			<div class="feedback-%s invalid-feedback">
				%s
			</div>
	    ',

		$this->attrName,		
		$this->model->getLabel($this->attrName),	
		$this->inputType,
		$this->attrName,
		$this->model->has_error_message($this->attrName) ? 'is-invalid' : '',
		$this->attrName,
		$this->model->{$this->attrName},		
		$this->attrName,
		$this->model->get_error_message($this->attrName));

	}


	public function password(): string {

		$this->inputType = self::TYPE_PASSWORD;
		return $this;
	}


	public function email(): string {

		$this->inputType = self::TYPE_EMAIL;
		return $this;
	}


	public function number(): string {

		$this->inputType = self::TYPE_NUMBER;
		return $this;
	}



}