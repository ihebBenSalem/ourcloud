<?php
require_once("../../../config/connect.php");
include_once(global_path."/model/client.php");

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
$permit_size=$row["free_size"]/1073741824;

$mypage=new client($user_id);
$used_disc= $mypage->get_memoire($user_id);
?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Wellcome!</strong> you are looking good today.Stay productive with ourcloud .
</div>



<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<a href="#" class="thumbnail">
		<img src=<?php echo $avatar; ?> ><br> 
		<div>

</div>
	</a>


<div class="panel panel-warning">
	  <div class="panel-heading">
			<h3 class="panel-title">Disk Size</h3>
	  </div>
	  <div class="panel-body">
			free space : <?php echo $permit_size;  ?> GO<br>
			used disk :<?php echo $used_disc;  ?> MO
	  </div>
</div>



<div class="panel panel">
	<div class="panel-heading">
		<h3 class="panel-title">Member in this space</h3>
	</div>
	<div class="panel-body">
		Panel content
	</div>
</div>



</div>


<div class="col-xs-8 col-sm-8 col-md-8 col-lg-9">
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">community</h3>
	  </div>
	  <div class="panel-body">
	<form action="" method="POST" role="form">
	<div class="form-group">
		<label for="">public</label>
		<textarea  id="feed" class="form-control" placeholder="What's on your mind ?" rows="1" required="required"></textarea>
<hr></hr>
	</div>
	<button type="button" class="btn btn-primary" id="post">submit</button>
	<button type="button" class="btn btn-info" >upload</button>
	</form>	  
</div>
</div>
</div>

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
</div>
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
	<div class="panel panel-default">
		  <div class="panel-body">

<div id="myfeeds"></div>
		  </div>
		  <div class="panel-footer">
more			</div>
	</div>
</div>
	<script type="text/javascript" src=<?php echo themes."/jquery.js";?>></script>

<script type="">
	
	$("#post").click(function(){
var data={feed:$("#feed").val()};
$.ajax({
url:"feeds.php",
data:data,
success:function(msg)
{
	$("#myfeeds").html(msg);
}
});
});
</script>
