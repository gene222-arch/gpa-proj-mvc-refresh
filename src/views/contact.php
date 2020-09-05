<?php 
	
	/**
 	  * @var $this app/core/View
	  */

	$this->page_title = 'Contact';

 ?>

<center><h2 class="mb-4"><?php echo $message ?? 'Contact'; ?></h2></center>

<form action="" method="POST">

   <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">@</span>
    </div>
    <input type="text" class="form-control" name="email" placeholder="Your Email" aria-label="Email" aria-describedby="basic-addon1">
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" name="recipient" placeholder="Recipient" aria-label="Recipient's username" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2">@gmail.com</span>
    </div>
  </div>

  <div class="input-group">
    <div class="input-group-prepend">
    </div>
    <textarea class="form-control" name="message" aria-label="With textarea" rows="10" placeholder="Your Message"></textarea>
  </div>  

  <button type="submit" class="btn btn-primary px-5 my-2">Send</button>

</form>