<?php
require_once("../../../config/connect.php");

session_start();
$user_id=$_SESSION["user"];
if(!isset($_SESSION['user']))
{
  header("Location: ".cloud_path."/login");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

	if(move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']['name'])){
	$img="images/".$_FILES["file"]["name"];		

	$q=$db_c->query(" update profile_info set photo='$img' where user_id='$user_id'   ");

if ($q) {
	# code...
header("location:".cloud_path."/view/user/profile/");
}
	}
	else
	{
		echo "Upload files not allowed ! please check your server persmission to upload files .<br>";
		echo '<a href="'.cloud_path.'/view/user/profile/">back</a>';

	}
	exit;
}
?>

