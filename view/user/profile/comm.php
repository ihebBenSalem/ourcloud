<style type="text/css">
	
	#myimg{
		width: 50px;
		height: 50px;
	}


</style>

<?php
require_once("../../../config/connect.php");

session_start();
$user_id=$_SESSION["user"];
if(!isset($_SESSION['user']))
{
  header("Location: ".cloud_path."/login");
}


$q=$db_c->query(" select * from oc_community order by time DESC limit 4");

	while (	$data=$q->fetch_array()) {
		echo '<div class="media">
  <a class="pull-left" href="#">';
		echo '
    <img class="media-object" id="myimg" src="'.$data["photo"].'">
  </a>
  <div class="media-body">
    <h4 class="media-heading">'.$data["user_name"].'</h4>
    '.$data["text"].'
 
    <!-- Nested media object -->
    <div class="media pull-right">
      published ,2 s ago
    </div>
  </div>
</div>';
	}






?>