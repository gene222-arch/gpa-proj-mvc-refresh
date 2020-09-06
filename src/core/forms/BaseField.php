<?php

namespace app\core\forms;
use app\core\models\Model;

abstract class BaseField
{

	/**
	 * @param $name = input tag name attribute
	 * @param $model = app/core/Model -> baseClass of app/models
	 */
	protected ?Model $model = null;
	protected string $attrName = '';


	public function __construct( string $attrName, Model $model )
	{
		$this->attrName = $attrName;
		$this->model = $model;
	}


	public function __toString() {

		return sprintf('   
			<div class="input-group mb-3">
				%s
		  	</div>',			
			$this->renderField());

	}


	public abstract function renderField(): string;



}
