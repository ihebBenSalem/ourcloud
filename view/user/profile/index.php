<?php
require_once("../../../config/connect.php");
require_once(global_path."/model/identicon.php");

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
	<!-- CSS STYLE  !-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<!-- JS  !-->
	<script type="text/javascript" src=<?php echo themes."/jquery.js";?>></script>
	<script type="text/javascript" src=<?php echo themes."/bootstrap/js/bootstrap.min.js" ; ?>></script>

<div class=dashboard-page> 
	<div class=container-fluid> <div class=row> 
		<div class="col-sm-3 col-md-2 sidebar"> 
		<div class=text-center> <h2 class=brand>MyCloud<small></small></h2> 
		<img src=<?php echo $avatar; ?> class=user-avatar><br> 
		<small><?php  echo $user_name;  ?></small><br>
		<a ui-sref=login class="btn btn-white btn-outline btn-rounded btn-block" href=<?php echo cloud_path."/login/logout.php?logout" ;?>>Logout</a> 
		</div> <ul class="nav nav-sidebar"> 
		<li ng-class="{active: $state.includes('overview')}">
		<a ui-sref=overview>Overview <span class=sr-only>(current)</span></a></li> 
		<li ng-class="{active: $state.includes('reports')}">
		<a ui-sref=reports href=<?php echo cloud_path."/view/user" ;?>>Mycloud</a></li> 
		</ul> </div> <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" ui-view> 
		<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href=<?php echo cloud_path."/view/user" ;?>>OURCloud</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">

			<li class="active"><a href="#" id="myhome"><i class="fa fa-tachometer"></i>MYHOME</a></li>

<li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <i class="fa fa-code-fork"></i>
 MYSPACE <i class="fa fa-sort-desc"></i>

    </a>
    <div class="dropdown-menu form-login stop-propagation" role="menu">
        <div class="form-group">
          
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Search" />
            <hr></hr>

<div class="media">
  <a class="media-left" href="#">
    <img class="media-object" src="http://icons.iconarchive.com/icons/elegantthemes/beautiful-flat-one-color/128/dev-icon.png" id="myimg" alt="Generic placeholder image">
  </a>
  <div class="media-body">
    <h4 class="media-heading">Media heading</h4>
    Cras sit amet nibh libero
  </div>
</div>

<style type="text/css">
	#myimg{

		height: 24px;
		width: 24px;
	}

</style>


        </div>
      <hr></hr> 
        <button type="button" class="btn btn-info btn-block">Create new space</button>
    </div>
</li>

</li>
			<li><a href="#" id="mysearch"></i>#MYSEARCH</a></li>
			<li><a href="#"><i class="fa fa-email"></i>#MSSAGES</a></li>

<script type="text/javascript">
	$('.stop-propagation').on('click', function (e) {
    e.stopPropagation();
});

</script>

<style type="text/css">
	.form-login{
  padding: 1em;
  min-width: 420px; /* change width as per your requirement */
}

</style>
		</ul>
		<ul class="nav navbar-nav navbar-right">
<li>

<a href="#"> <span class="badge badge-success"><i class="fa fa-bell"></i> <span class="glyphicon glyphicon-icon-signal" aria-hidden="true"></span>   0</span>
</a>
	
</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
 SETTING<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#" id="change">change profile</a></li>
					<li><a href=<?php echo cloud_path."/login/logout.php?logout" ;?>>logout</a></li>
					
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>

<div id="tab"></div>

		</div> 
		</div> 
		</div> 
		</div>






<script type="text/javascript">

$(document).ready(function(){
get("home");
get_c("comm");
$("#change").click(function(){get("setting");});
$("#myhome").click(function(){get("home");});
$("#mysearch").click(function(){get("search");});
});

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

function get(i)
{
  $.ajax({
url:i+".php",
success:function(msg)
{
  $("#tab").html(msg);
}
});
}


</script>
