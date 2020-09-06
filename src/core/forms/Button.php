<?php 

namespace app\core\forms;

/**
 * 
 */
class Button
{

	private string $btnType = '';	
	private string $btnColor = '';
	private string $btnName = '';

	function __construct( string $btnType, string $btnColor, string $btnName )
	{

		$this->btnType = $btnType;	
		$this->btnColor = $btnColor;
		$this->btnName = $btnName;

	}


	public function __toString() {

		return sprintf('<button type="%s" class="btn btn-%s px-5 my-2" name="%s">%s</button>',
			$this->btnType,
			$this->btnColor,
			$this->btnName,
			ucfirst($this->btnName));
	
	}


}