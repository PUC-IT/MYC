<?php
$first_bit = $this->uri->segment(1);
$form_location = base_url().$first_bit.'/submit_login';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="<?php echo base_url(); ?>favicon.ico">
		<title>Welcome To Computer Online Shopping</title>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="<?php echo base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url(); ?>assets/css/jumbotron.css" rel="stylesheet">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/prettyPhoto.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/price-range.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url() ?>">Home</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<?php
					echo Modules::run('store_categories/_draw_top_nav');
					?>
					
					<?php echo anchor('youraccount/start', 'Create Account'); ?>
					</div><!--/.navbar-collapse -->
				</div>
			</nav>
			<hr>
      <div class="container" style="min-height: 450px;">
         <h1>Create Account</h1>
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-1">
						<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="<?= $form_location ?>" method="post">
							<input type="text" name="username" value="<?= $username ?>" placeholder="Username or E-mail Address" id="inputtext"/>
							<input type="password" name="pword" id="inputPassword" placeholder="Password" required/>
							<span>
							<?php
							if ($first_bit=='youraccount') {?>
								<input type="checkbox" class="checkbox" value="remember-me" name="remember"> Remember me
							</span>
							<?php }?>
							<button type="submit" class="btn btn-default" name="submit" value="Submit">Login</button>
						</form>
						</div><!--/login form-->
					</div>
					<div class="col-sm-1">
						<h2 class="or">OR</h2>
					</div>
					<div class="col-sm-4">
						<div class="signup-form"><!--sign up form-->
						<h2>New Customer ?</h2>
            <p><strong>Register Account</strong></p>
            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
            <a href="http://www.itcomputerkh.com/index.php?route=account/register" class="btn btn-primary">Continue</a></div>
						</div><!--/sign up form-->
					</div>
				</div>
			</div>

      </div>
      <hr>
			
			<div class="container">
				<footer>
					<p>&copy; 2017 Computer OnlineShop</p>
				</footer>
				</div><!-- /container -->
				<!-- Bootstrap core JavaScript
				================================================== -->
				<!-- Placed at the end of the document so the pages load faster -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
				<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery.min.js"><\/script>')</script>
				<script src="<?php echo base_url(); ?>dist/js/bootstrap.min.js"></script>
				<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
				<script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
			</body>
		</html>