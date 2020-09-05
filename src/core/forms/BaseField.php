<?php

namespace app\core\forms;

class BaseField
{

	/**
	 * @param $name = input tag name attribute
	 * @param $model = app/core/Model -> baseClass of app/models
	 */
	public function __construct(string $name, Model $model)
	{
			
	}


	public function renderField()
	{

		return sprintf(format);
	}

}
