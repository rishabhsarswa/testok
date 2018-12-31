
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Awnto ID - Sign Up</title>
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





<?php
session_start();
require_once('application/protect.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}
if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);	
	$upass_confirm = strip_tags($_POST['txt_upass_confirm']);
//
//
// User random hash generator for password reset
function random_string($length) { $key = ''; $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
    for ($i = 0; $i < $length; $i++) { $key .= $keys[array_rand($keys)]; } return $key; }
    $randomstring = random_string(64);
//
//
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if($upass!=$upass_confirm) {
		$error[] = "Password doesn't match !";
	}
	
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$uname) {
				$error[] = "sorry username already taken !";
			}
			else if($row['user_email']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
				if($user->register($uname,$umail,$upass,$randomstring)){	
					$user->redirect('message.php?8338292374938737483472923Success465443');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>




  <body>
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
		if(config::get('allow_signup'))
		{
			?>



<span class="login100-form-title">
	<br><br>
						Awnto ID
					</span>






			<div class="form-group">
				<input class="input100" type="text" class="form-control" name="txt_uname" placeholder="Username" required="" id="username" />
			</div>
			<div class="form-group">
				<input class="input100" type="text" class="form-control" name="txt_umail" placeholder="Phone" required="" id="email" />
			</div>
			<div class="form-group">
				<input class="input100" type="password" class="form-control" name="txt_upass" placeholder="Password" required="" id="password" />
			</div>
			<div class="form-group">
				<input class="input100" type="password" class="form-control" name="txt_upass_confirm" placeholder="Confirm Password" required="" id="confirm_password" onchange='check_pass();'/>
			</div>
			<div class="form-group">
				<input class="login100-form-btn" type="submit" value="Sign up" name="btn-signup" id="submit" />
				<a href="login.php"><b></b></a>
			</div>
	<?php
}
		else 
			header("location: message.php?88673834958894930356536786SignupDisabled455843");
      ?>
		</form><!-- form -->
			
			
						<div class="text-center p-t-12">
						<span class="txt1">
							Already on Awnto<br>
						</span>
						<a class="login100-form-btn" class="txt2" href="login.php">
							Login
						</a>
					</div>
			
			
	</section><!-- content -->
</div><!-- container -->
<script src="js/index.js"></script>

