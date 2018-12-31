<!DOCTYPE html>
<html lang="en">
<head>
	<title>Awnto ID - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
				
	<?php session_start();
require_once("application/protect.user.php");
$login = new USER();
$redirect_login = config::get('redirect_login');
if($login->is_loggedin()!="")
{
	if(isset($_GET['return'])) {
    		$login->redirect(urldecode($_GET['return']));
									}
		else
			$login->redirect($redirect_login);
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		if(isset($_GET['return'])) {
    		$login->redirect(urldecode($_GET['return']));
									}
		else
			$login->redirect($redirect_login);
		
	}
	else
	{
		$error = "username or password incorrect !";
	}	
}
?>


<div class="signin-form">
<div class="container">

	<section id="content">
		<form class="form-signin" method="post" id="login-form">
		<form action="">
			<h1></h1>
<div id="error">
	<?php
		if(isset($error))
		{
	?>
		<div>
			<h3>&nbsp; <?php echo $error; ?> !</h3> 
		</div>
	<?php
		}
	?>
</div>


<span class="login100-form-title">
	<br><br>
						Awnto ID
					</span>



			<div class="form-group">
				<input  class="input100" type="text" class="form-control" name="txt_uname_email" placeholder="Username or Phone" required="" id="username" />
			</div>

			<div class="form-group">
				<input  class="input100" type="password" class="form-control" name="txt_password" placeholder="Password" required="" id="password" />
			</div>


			<div class="form-group">
				<input class="login100-form-btn" type="submit" name="btn-login" value="Log in" id="login" />
				<?php if (config::get('allow_signup')):?>
				<a href="signup.php"><b></b></a>
				<?php endif;?>
			</div>
		</form><!-- form -->
			
			<div class="text-center p-t-12">
						<span class="txt1">
							New to Awnto<br>
						</span>
						<a  class="login100-form-btn" class="txt2" href="signup.php">
							Sign Up
						</a>
					</div>
			
		<div class="button">
		</div><!-- button -->
	</section><!-- content -->
</div>
				
				
				
			</div>
		</div>
	</div>
	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>