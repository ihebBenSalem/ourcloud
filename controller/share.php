<?php
require("../model/client.php");
require("../config/define.php");
session_start();
$uid=$_SESSION["user"];
$mypage=new client($uid);
if (isset($_REQUEST["idf"])) {
$id_file=stripcslashes($_REQUEST["idf"]);
$url=$mypage->share($id_file);
echo $url;
}
?>