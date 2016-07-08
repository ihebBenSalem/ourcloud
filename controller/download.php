<?php
session_start();
$id_of_user=$_SESSION['user'];

require("../model/client.php");

if(isset($_SESSION['user'])=="")
{
  header("Location: ".cloud_path."/login");
}

if(isset($_GET["id"]))
{

$id=$_GET["id"];

 $dbLink = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
$req=$dbLink->query(" select * from upload_file where file_id='$id'  ");
$row=$req->fetch_array();

if ($row["splited"] =='1') {
	
	$name=$row["name"];
	$ext=$row["ext"];
	$size=$row["size"];
	$mime=$row["mime"];
	$mypage=new client($id_of_user);
	$mypage->download_split($name,$ext,$id,$size,$mime);
}
else
{
	$mypage=new client($id_of_user);
$mypage->download($id);
}
}
?>