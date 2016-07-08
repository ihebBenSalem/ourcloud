<?php
require_once '../config/dbconnect.php';
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
else if(isset($_SESSION['user'])!="")
{
	header("Location:".cloud_path."/view/index/");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location:".cloud_path."/view/index/");
}
?>