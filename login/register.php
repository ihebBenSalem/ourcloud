<?php
include '../config/define.php';
include (global_path."/lib/security.php");

session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn-signup']))
{
	$uname = post_value_or("uname");
	$email = post_value_or("email");
	$upass = md5(post_value_or("pass"));
	
	$uname=xss_clean($uname);
	$email=xss_clean($email);
 	
 	$db_c = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }


$q=$db_c->query("INSERT INTO user_info(user_name,user_email,password,check_admin) VALUES('$uname','$email','$upass','client')");
	if($q)
	{

$user_id = $db_c->insert_id;
$db_c->query(" insert into profile_info(user_id) values('$user_id') ");
		$alert= r_success;

	}
	else
	{
		$alert= r_fail;
	} 
}

function post_value_or($key, $default = NULL) {
    return  isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : $default;
}
?>

<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Register&Login</title>

		<!-- Bootstrap CSS -->
		<link href=<?php echo themes."/bootstrap/css/bootstrap.css" ;?> rel="stylesheet">
		<link href="main.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
	</head>
	<body>

<div class=login-page> 
<div class=row> 
<div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4"> 
 <h1>SignUp Now<small> ,it's free</small></h1> 

<?php

echo $alert;
?>
 <form role="form" method="POST"> 
 	<div class=form-content> 
 

 
 <div class=form-group> 

<div class=form-group> 
<input type="text" name="uname" class="form-control input-underline input-lg"  placeholder="User Name" required autocomplete="off" />  
<input type="email" name="email" class="form-control input-underline input-lg" placeholder="Your Email" required autocomplete="off" />
<input type="password" name="pass" class="form-control input-underline input-lg"  placeholder="Your Password" required  autocomplete="off" />

</div> 

</div> 

<button button type="submit" name="btn-signup" class="btn btn-white btn-outline btn-lg btn-rounded btn-block" name="btn-signup" >Signup </button> 
<a href=<?php echo cloud_path."/login/" ;?> class="btn btn-large btn-success btn-block">Login</a>

</div>
</form> 
</div>
</div>
</div>

<script type="text/javascript" src= <?php echo themes."/jquery.js" ; ?>></script>
<script type="text/javascript" src= <?php echo themes."/bootstrap/js/bootstrap.min.js" ;?>></script>

	</body>
</html>