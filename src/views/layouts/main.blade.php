<?php 
	
	/**
      *  $this app/core/Application
	  */
  use app\core\Application;

 ?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->page_title; ?></title>
<!-- bootstrap -->	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>


	<nav class="navbar navbar-expand-lg bg-dark">

	  <a class="navbar-brand" href="/">Navbar</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navBar">

	    <ul class="navbar-nav ml-auto">

	      <li class="nav-item active">
	        <a class="nav-link" href="/"> Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="/contact">Contact Us</a>
	      </li>
	      <?php if (!Application::$app->user): ?>

		      <li class="nav-item">
		        <a class="nav-link" href="/register"> Signup </a>
		      </li>	
		      <li class="nav-item">
		        <a class="nav-link" href="/login"> Login </a>
		      </li>	    

	      <?php else: ?>

		      <li class="nav-item">
		        <a class="nav-link" href="/profile"> 
		        	<?php echo Application::$app->user->display_user(); ?> 
		        </a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="/userprofile"> Profile </a>
		      </li>	
		      <li class="nav-item">
		        <a class="nav-link" href="/logout"> Logout </a>
		      </li>			      	 

		 <?php endif; ?>
	    </ul>

	  </div>

	</nav>


	<div class="container">

		<?php if ( Application::$app->session->get_flash_message("login") ): ?>

			<div class="alert alert-success" role="alert">
			  <?php echo Application::$app->session->get_flash_message("login") ?>
			</div>

		<?php endif; ?>

		{{content}}
	</div>





















<!-- js links -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<!-- contact validation script -->
	<script type="module" src="./assets/js/index.js"></script>	

</body>
</html>