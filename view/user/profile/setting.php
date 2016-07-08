<?php
require_once("../../../config/connect.php");
session_start();
$user_id=$_SESSION["user"];
if(!isset($_SESSION['user']))
{
  header("Location: ".cloud_path."/login");
}

$q=$db_c->query(" SELECT * FROM `profile_info`,user_info WHERE user_info.user_id='$user_id' and user_info.user_id=profile_info.user_id ");
$row=$q->fetch_array();
$user_name=$row["user_name"];
$avatar=$row["photo"];
?>

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<a href="#" class="thumbnail">
		<img src=<?php echo $avatar; ?> class=user-avatar><br> 
		<form  method="post" action="upload.php" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" class="btn btn-default" value="Update photo">
    </form>	
	</a>

</div>

<div class="col-xs-8 col-sm-8 col-md-8 col-lg-9">

<div id="myalert"></div>

<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">change your profile</h3>
	  </div>
	  <div class="panel-body">


<form action="" method="POST" role="form">
	<legend>update profile</legend>

	<div class="form-group">
<?php
$result = $db_c->query(" SELECT * FROM `profile_info`,user_info WHERE user_info.user_id='$user_id' and user_info.user_id=profile_info.user_id ");

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

echo '<label for="">Username</label><input type="text" class="form-control" id="u_name" placeholder="username" value="'.$rs["user_name"].'">';
echo '<label for="">email</label><input class="form-control" id="disabledInput" type="text" value="'.$rs["user_email"].'" disabled>';
echo '<label for="">Password</label><input type="password"  class="form-control" id="u_pass"  placeholder="password" ">';


}


?>

	</div>

	

	<button type="button" class="btn btn-primary" id="update">update</button>
</form>







  </div>
</div>

</div>

<script type="text/javascript" src=<?php echo themes."/jquery.js" ;?>></script>

<script type="text/javascript">
	
$(document).ready(function(){




$("#update").click(function(){

var data={uname:$("#u_name").val(),upass:$("#u_pass").val() };

$.ajax({

url:"update_p.php",
data:data,
success:function(msg)
{
	$("#myalert").html(msg);
}


});







});



});



</script>





