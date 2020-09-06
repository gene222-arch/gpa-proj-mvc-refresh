<?php 

namespace app\core\forms;

class TextArea extends BaseField
{


	public function renderField(): string {

		return sprintf(
		'  
			<div class="input-group %s">
			    <div class="input-group-prepend">
			    </div>
			    <textarea class="form-control %s" name="%s" value="%s" rows="10" placeholder="%s" required></textarea>
				<div class="feedback invalid-feedback">
						%s
				</div>	    
		  	</div> 
		'
		,
		$this->attrName,
		$this->model->has_error_message($this->attrName) ? 'is-invalid' : '',
		$this->attrName,
		$this->model->{$this->attrName},
		$this->model->getLabel($this->attrName),
		$this->model->get_error_message($this->attrName));

	}


}