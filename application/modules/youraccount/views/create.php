<?php
$form_location = base_url().'youraccount/submit';
?>
<h1>Create Account</h1>

<div class="container">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-1">
      <div class="login-form"><!--login form-->
      <h2>Login to your account</h2>
        If you already have an account with us, please login at the login page.
      </div><!--/login form-->
    </div>

    <div class="col-sm-1">
      <h2 class="or">OR</h2>
    </div>

    <div class="col-sm-4">
      <div class="signup-form"><!--sign up form-->
      <h2>New User Signup!</h2>
      <form action="<?= $form_location ?>" method="post">
        <input id="textinput" type="text" name="username" placeholder="Username" value="<?= $username ?>"/>
      <?php echo form_error('username','<p style="color:red; display:inline-block;">','</p>'); ?>      <input id="textinput" type="email" name="email" placeholder="Email Address" value="<?= $email ?>"/>
        <?php echo form_error('email','<p style="color:red; display:inline-block;">','</p>'); ?>
        <input type="password" name="pword" placeholder="Password" value="<?= $pword ?>"/>
        <?php echo form_error('pword','<p style="color:red; display:inline-block;">','</p>'); ?>
        <input type="password" name="repeat_pword" placeholder="Rpeat Password" value="<?= $repeat_pword ?>"/>
        <?php echo form_error('repeat_pword','<p style="color:red; display:inline-block;">','</p>'); ?>
        <button type="submit" class="btn btn-default" name="submit" value="Submit">Signup</button>
      </form>
      </div><!--/sign up form-->
    </div>
  </div>
</div>

