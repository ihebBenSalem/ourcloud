<?php

require("../model/client.php");
session_start();

if(isset($_SESSION['user'])=="")
{
  header("Location: ".cloud_path."/login");
}

if (isset($_GET["d"])) {
	# code...
	$id_del=$_GET["d"];
$mypage=new client();
$mypage->delete($id_del);

}





?>