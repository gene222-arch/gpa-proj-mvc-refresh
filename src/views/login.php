<?php 
  
  /**
    * @var $this app/core/View
    * @var $model app\models\ContactForm
    * @var $form app\core\forms\Form
    */
  use app\core\forms\Form;
  $this->page_title = 'Login';  ?>

 <center><h1 class="mb-5">Login</h1></center>

 <?php $form = Form::begin("POST"); ?>

 <?php echo $form::input_field('email', $model ) ?>
 <?php echo $form::input_field('password', $model)->password() ?>
 <?php echo $form::button('submit', 'primary', 'login', 'login') ?>

 <?php Form::end() ?>

