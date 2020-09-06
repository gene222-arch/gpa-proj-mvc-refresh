<?php 

namespace app\core\forms;

use app\core\models\Model;

class Form 
{

	public static function begin( string $method ) {

		echo sprintf("<form method='%s'>", $method);

		return new Form();
	}


	public static function end() {

		echo "</form>";
	}


	public static function input_field( string $attrName, Model $model ) {

		return new Input($attrName, $model);
	}


	public static function textarea_field( string $attrName, Model $model) {

		return new TextArea($attrName, $model);
	}


	public static function button( string $btnType, string $btnColor, string $btnName ) {

		return new Button($btnType, $btnColor, $btnName);
	}


}