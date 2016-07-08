<?php
session_start();
require_once '../config/dbconnect.php';
require_once(global_path.'/model/client.php');
include_once(global_path."/lib/security.php");



if(isset($_SESSION['user'])!="")
{
	header("Location:".cloud_path."/view/user/");
}

if(isset($_POST['btn-login']))
{

$mypage=new client();
$email=xss_clean($_POST["email"]);
$pass=xss_clean($_POST["pass"]);
$mypage->authentifier($email,$pass);
}
?>
<html>
<head>
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cloud</title>
<link rel="stylesheet" href="style.css" type="text/css" />
 <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

 <div class=login-page> 
 <div class=row> 



 <div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4"> 
 <img src=<?php echo cloud_path."/view/user/profile/images/flat-avatar.png" ;?> class=user-avatar> 

 <h1>Login<small>  To your session</small></h1> 

 <form role="form" method="POST"> 
 	<div class=form-content> 
 	<div class=form-group>  	
 	<input type="email" name="email" class="form-control input-underline input-lg" placeholder="Email" autocomplete="off"> 
 	</div> 

 	<div class=form-group> 
 	<input type="password" class="form-control input-underline input-lg" placeholder="Password" name="pass" autocomplete="off"> 
	</div> 
	
	</div> 
	
	<button type="submit" class="btn btn-white btn-outline btn-lg btn-block"  name="btn-login" >Login</button> 	
	<a href=<?php echo cloud_path."/login/register.php" ;?> class="btn btn-large btn-danger btn-block">Register now</a>
</form> 
</div> 
</div> 
</div>
</body>
 <script type="text/javascript" src=<?php echo themes."/jquery.js" ?>></script>

</html>