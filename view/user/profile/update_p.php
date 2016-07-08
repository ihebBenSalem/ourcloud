<?php
require_once("../../../config/connect.php");
include_once(global_path."/lib/security.php");

session_start();
$user_id=$_SESSION["user"];
if(!isset($_SESSION['user']))
{
  header("Location: ".cloud_path."/login");
}

if (isset($_REQUEST["uname"])) {
	# code...

	$uname= xss_clean($_REQUEST["uname"]);

if (isset($_REQUEST["upass"]) && !empty($_REQUEST["upass"])) {
	# code...
			$upass=md5(xss_clean($_REQUEST["upass"]));

$q=$db_c->query(" update user_info set password='$upass' where user_id='$user_id'   ");

if($q)
{
	echo '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Your profile successfuly updated</strong>
	</div>';
}
else
{
	echo '<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Try agin</strong> sorry an error occured !!
	</div>';
}


}



if (!empty($_REQUEST["uname"])) {
	# code...
	$q=$db_c->query(" update user_info set user_name='$uname' where user_id='$user_id'   ");
if($q)
{
	echo '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Your profile successfuly updated</strong>
	</div>';
}
else
{
	echo '<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Try agin</strong> sorry an error occured !!
	</div>';
}

}





}






?>