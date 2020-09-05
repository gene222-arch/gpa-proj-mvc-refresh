<?php 

namespace app\core\forms;


class Form 
{

	public static function begin() {

		return "<form></form>";
	}


	public static function end() {

		return "<form></form>";
	}


	public static function field( string $name, Model $model ) {

		return new Input($name, $model);
	}

}