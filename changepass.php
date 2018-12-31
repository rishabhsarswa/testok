<?php
  require_once("application/session.php");
  require_once("application/protect.user.php");
  $user = new user();
  $auth_user = new USER();
  $user_id = $_SESSION['user_session'];
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  $pr_id = $userRow['pr_id'];
  $redirect_login = config::get('redirect_login');

  if(!$auth_user->is_loggedin())
{
	$auth_user->redirect('login.php?return=changepass.php');
}

if(isset($_POST['btn-changepass']))
{
	$password = strip_tags($_POST['txt_password']);
	$passwordconfirm = strip_tags($_POST['txt_password_confirm']);
//
	if($password!=$passwordconfirm) {
		$error[] = "Password doesn't match !";
	}
	else if($password=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($password) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
		{
			try
			{
		if($user->changepass($password, $pr_id)){	
					$user->redirect('message.php?90819948564782345789056748PasswordChanged857432');
				}
		
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Awnto ID - Change Password</title>

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
  	
  
  

<span class="login100-form-title">
	<br><br>
						Awnto ID
					</span>

  
  
  
<div class="signin-form">
<div class="container">
	<section id="content">
		<form method="post" class="form-signin">
		<form action="">
			<h1></h1>

<?php
	if(isset($error))
	{
	 	foreach($error as $error)
	{
?>
            <div id="error">
            <h3>&nbsp; <?php echo $error; ?> !</h3> 
            <script type="text/javascript">function timedMsg(){var t=setTimeout("document.getElementById('error').style.display='none';",4000);}</script>
			<script language="JavaScript" type="text/javascript">timedMsg()</script>
            </div>

    <?php
	}
	}
	?>

	<?php
		{
		if(config::get('change_pass'))
		{
			?>
			<div class="form-group">
				<input class="input100" type="password" class="form-control" name="txt_password" placeholder="New Password" required="" id="username" />
			</div>

			<div class="form-group">
				<input class="input100" type="password" class="form-control" name="txt_password_confirm" placeholder=" Confirm Password" required="" id="password" />
			</div>

			<div class="form-group">
				<input class="login100-form-btn" type="submit" name="btn-changepass" value="Change Password" />
			</div>
			<div class="form-group">
			<a class="login100-form-btn" href="<?php echo $redirect_login ?>"><b>Cancel</b></a>
			</div>
			<?php
		}
		else
			header("location: message.php?34585474839057488936799350PassChangeDisabled985484");
		}
	      ?>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
<script src="js/index.js"></script>

</body>
</html>
