<?php 
	
	/**
 	  * @var $this app/core/View
    * @var $model app\models\ContactForm
    * @var $form app\core\forms\Form
	  */
  use app\core\forms\Form;
	$this->page_title = 'Contact';

 ?>

<center><h2 class="mb-4"><?php echo $message ?? 'Contact'; ?></h2></center>


<?php $form = Form::begin( "POST" ) ?>
  
  <?php echo $form::input_field('email', $model)->email() ?>
  <?php echo $form::input_field('recipient', $model) ?>
  <?php echo $form::textarea_field('message', $model) ?>
  <?php echo $form::button('submit', 'primary', 'send', 'Send') ?>

<?php Form::end() ?>
