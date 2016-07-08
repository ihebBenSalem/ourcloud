<?php
require("../config/define.php");
require("client.php");
?>
	<!-- CSS  !-->
	<link rel="stylesheet" type="text/css" href=<?php echo themes."/mdl/material.min.css"; ?>>
	<link rel="stylesheet" type="text/css" href=<?php echo themes."/bootstrap/css/bootstrap.css"; ?>>

	<!-- JS -->
	<script type="text/javascript" src=<?php echo themes."/jquery.js";?>></script>
	<script type="text/javascript" src=<?php echo themes."/bootstrap/js/bootstrap.min.js" ; ?>></script>


<?
session_start();
$id_sess=$_SESSION["user"];
if (isset($_GET["sh"])) {
	# code...
	$token=stripcslashes($_GET["sh"]);
$con = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
$request=$con->query(" select * from oc_share where token='$token'  ");
$row=$request->fetch_array(MYSQLI_ASSOC);
$file_id=$row["file_source"];
$file_name=$row["file_target"];

if(mysqli_num_rows($request)>0)
{
$mypage=new client($id_sess);
echo '<center><div class="jumbotron">
	<div class="container">
		<p>
			<form  method="POST" role="form">
				<legend>Download </legend>
			
				<div class="form-group">
					<label for="">'.$file_name.'</label>
				</div>
			
				
			
				<button type="submit" name="d" value="'.$file_id.'" class="btn btn-success btn-block">Download now</button>
			</form>
		</p>
	</div>
</div></center>';

}
else
{
	echo '<div class="jumbotron">
		<div class="container">
			<h1>404 not found </h1>
			<p>sorry !! your requested file is not found </p>
			<p>
				<a class="btn btn-primary btn-lg" href="'.cloud_path.'/view/user">Take me home</a>
			</p>
		</div>
	</div>';
}



}



if (isset($_POST["d"]) && !empty($_POST["d"])) {
	# code...
	$mypage=new client($id_sess);
	$mypage->download($_POST["d"]);
}



?>