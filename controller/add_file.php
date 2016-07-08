<?php
// Check if a file has been uploaded
require("../model/client.php");
include 'phpfslit.php';

session_start();

if(isset($_SESSION['user'])=="")
{
  header("Location: ".cloud_path."/login");
}

$id_of_user=$_SESSION['user'];

$mypage=new client($id_of_user);
$free_size=$mypage->get_permit_size();
$permit_size = intval($free_size);


if (isset($_FILES['uploaded_file'])) {
    # code...
$name=$_FILES['uploaded_file']['name'];
$mime=$_FILES['uploaded_file']['type'];
$data=$_FILES['uploaded_file']['tmp_name'];
$size=$_FILES['uploaded_file']['size'];
$size = intval($size);
$file_path=$_FILES['uploaded_file']['name'];
$error=$_FILES['uploaded_file']['error'];

$disc_size=$mypage->get_memoire()+$size;


if ( ($size >= 1000000*40) && ($permit_size >= $disc_size) ) {
$parts=fsplit($data,1000000*40);
$mypage->upload_fsplit($name,$mime,$data,$size,$file_path,$error,$parts);
}
else
{
$mypage->upload($name,$mime,$data,$size,$file_path,$error,$free_size);

}

}

?>
 
 