<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location:/cloud/view/user/");
}
include '/var/www/html/cloud/config/define.php';
include ("/var/www/html/cloud/lib/security.php");
include("/var/www/html/cloud/config/connect.php");


if (isset($_POST["del"]) && !empty($_POST["del"])) {
	# code...
		$id=xss_clean($_POST["del"]);
$sql=$db_c->query("  DELETE FROM `cloud`.`user_info` WHERE `user_info`.`user_id` = '$id' ");

if ($sql) {
	# code...
	header("location:/cloud/view/admin/");
}


}


if (isset($_POST["admin"]) && !empty($_POST["admin"])) {
	# code...
			$id=xss_clean($_POST["admin"]);

		$sql=$db_c->query(" UPDATE  `cloud`.`user_info` SET  `check_admin` =  'admin' WHERE  `user_info`.`user_id` ='$id'; ");

if ($sql) {
	# code...
	header("location:/cloud/view/admin/");
}
}




?>