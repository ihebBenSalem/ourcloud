<?php
/**
* 
*/
include("../config/define.php");
class user
{
	
	function __construct()
	{
		# code...
	}

	function authentifier($email_,$password_){
	$email = mysql_real_escape_string($email_);
	$upass = mysql_real_escape_string($password_);
	$res=mysql_query("SELECT * FROM user_info WHERE user_email='$email'");
	$row=mysql_fetch_array($res);
	
	if($row['password']==md5($upass))
	{
		$_SESSION['user'] = $row['user_id'];
		$_SESSION["username"]=$row["user_name"];
		$browser=$_SERVER['HTTP_USER_AGENT'];
		$ip=$_SERVER['SERVER_ADDR'];

	mysql_query(" insert into login_info(user_email,browser,ip)values('$email','$browser','$ip')  ");
	if ($row["check_admin"]=="client") {
			# code...
				header("Location:".cloud_path."/view/user/profile");
		}
		else{
			header("Location:".cloud_path."/view/admin");
}	
	
	}
	/*

	else
	{
     if(isset($_COOKIE['login'])){
          if($_COOKIE['login'] < 3){
               $attempts = $_COOKIE['login'] + 1;
               setcookie('login', $attempts, time()+60*10); //set the cookie for 10 minutes with the number of attempts stored
          } else{
               echo 'You are banned for 10 minutes. Try again later';
          }
     } else{
          setcookie('login', 1, time()+60*10); //set the cookie for 10 minutes with the initial value of 1
     }
        
	}*/
}



}





?>