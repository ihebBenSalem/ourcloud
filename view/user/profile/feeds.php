<?php
require_once("../../../config/connect.php");
include_once(global_path."/lib/security.php");

session_start();
$user_id=$_SESSION["user"];
if(!isset($_SESSION['user']))
{
  header("Location: ".cloud_path."/login");
}

$q=$db_c->query(" SELECT * FROM `profile_info`,user_info WHERE user_info.user_id='$user_id' and user_info.user_id=profile_info.user_id ");
$row=$q->fetch_array();

$avatar=$row["photo"];
$username=$row["user_name"];


if (isset($_REQUEST["feed"]) && !empty($_REQUEST["feed"])) {
$txt= xss_clean($_REQUEST["feed"]);

$q=$db_c->query(" insert into oc_community(text,user_id,photo,user_name) values('$txt','$user_id','$avatar','$username') ");


}
	?>
	<script>
get_c("comm");
	function get_c(i)
{
  $.ajax({
url:i+".php",
success:function(msg)
{
  $("#myfeeds").html(msg);
}


});
}
</script>