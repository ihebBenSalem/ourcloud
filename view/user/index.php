<?php
session_start();
require_once '../../config/dbconnect.php';
require_once(global_path.'/model/client.php');

if(!isset($_SESSION['user']))
{
  //if not authentified redirect user
  header("Location: ".cloud_path."/login");
}

$uid= $_SESSION["user"];
$mypage2=new client($uid);

$mem=$mypage2->get_memoire();
$permit_size= $mypage2->get_permit_size()/1073741824;

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Cloud</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/photon.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href=<?php echo themes."/mdl/material.min.css"; ?>>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
     <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

</head>
  <body>







<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header" >
  <header class="mdl-layout__header mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">OurCloud</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="#">Home</a>
        <a class="mdl-navigation__link" href=<?php echo cloud_path."/view/user/profile/" ;?>>Profile</a>
        <a class="mdl-navigation__link" href="#">API</a>
        <a class="mdl-navigation__link" href=<?php echo cloud_path."/login/logout.php?logout" ;?>>Logout</a>
      </nav>

    </div>
  </header>

  </div>
  <main class="mdl-layout__content">

    <div class="page-content"><!-- Your content goes here -->
 <div class="window">
      <!-- .toolbar-header sits at the top of your app -->
      <header class="toolbar toolbar-header" id="myheader">
  <div class="toolbar-actions">
    <div class="btn-group">
      <button class="btn btn-default active">
        <span class="icon icon-home"></span>
      </button>
      <button class="btn btn-default" type="button">
        <span class="icon icon-folder"></span>
      </button>
      <button class="btn btn-default " id="mycloud">
        <span class="icon icon-cloud"></span>
      </button>
      <button class="btn btn-default">
        <span class="icon icon-popup"></span>
      </button>
      <button class="btn btn-default ">
        <span class="icon icon-shuffle"></span>
      </button>    
    </div>

      </button>
<button id="mybtn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect ">
        <span class="icon icon-install"></span>
        browse
      </button>

        <button class="btn btn-default pull-right">
        <span class="icon icon-flow-cascade"></span> 
        <?php echo  '  '.$mem.' MO /'.$permit_size.'GO' ; ?>
      </button>



      <!-- Accent-colored raised button with ripple -->
<button id="upload" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored  mdl-button--raised">
<span class="icon icon-upload-cloud"></span> upload

</button>










  </div>
</header>

      <!-- Your app's content goes inside .window-content -->
      <div class="window-content">
        <!-- MDL Progress Bar with Indeterminate Progress -->
<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>


        <div class="pane-group">
          <div class="pane pane-sm sidebar">
            <nav class="nav-group">
              <h5 class="nav-group-title">Favorites</h5>
              <span class="nav-group-item" id="all_section">
                <span class="icon icon-home active"></span>
                All
              </span>
              <span class="nav-group-item " id="music_section">
                <span class="icon icon-music"></span>
                My music
              </span>

              <span class="nav-group-item" id="image_section" >
                <span class="icon icon-picture"></span>
                My image
              </span>
              
              <span class="nav-group-item" id="video_section">
                <span class="icon icon-video"></span>
                video
              </span>
              
              <span class="nav-group-item" id="pdf_section">
                <span class="icon icon-doc"></span>
                My PDF
              </span>
              <span class="nav-group-item" id="doc_section">
                <span class="icon icon-doc-text"></span>
                My Doc
              </span>
              <span class="nav-group-item" id="ppt_section">
                <span class="icon icon-doc-text"></span>
                My PPT
              </span>
             
            </nav>



          </div>

          <div class="pane">

<div id="tab"></div><!-- MDL Spinner Component -->
<div id="wait"><center><div class="mdl-spinner mdl-js-spinner is-active"></div></center>
</div>

 <form action=<?php echo cloud_path."/controller/add_file.php" ;?> id="myform" method="post" enctype="multipart/form-data">
        <input type="file" name="uploaded_file" id="browse"><br>
    </form>    



          </div>
        </div>
      </div>
    </div>


    </div>
  </main>
</div>





    <!-- Javascript -->
    <script src="js/menu.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
<script type="text/javascript" src=<?php echo themes."/jquery.js" ;?>></script>
<script>


$(document).ready(function(){

$.ajax({
url:"<?php echo cloud_path."/model/data.php" ;?>",
success:function(msg)
{
  $("#tab").html(msg);
}


});

$("#image_section").click(function(){get("image");});
$("#music_section").click(function(){get("music");});
$("#pdf_section").click(function(){get("pdf");});
$("#all_section").click(function(){get("data");});
$("#video_section").click(function(){get("video");});
$("#doc_section").click(function(){get("doc");});
$("#ppt_section").click(function(){get("ppt");});
$("#mycloud").click(function(){page("<?php echo cloud_path."/model/multi/index.php"  ;?>");});


$("#upload").hide();
$("#wait").hide();

function get(i)
{
  $.ajax({
url:"<?php echo cloud_path."/model/";?>"+i+".php",
success:function(msg)
{
  $("#tab").html(msg);
}


});
}


function page(path)
{
  $.ajax({
url:path,
success:function(msg)
{
  $("#tab").html(msg);
}


});
}

$("#mybtn").click(function(){
$("#browse").click();
$("#upload").show();
});
$("#upload").click(function(){

$("#wait").show();

$("#myform").submit();
});
});
</script> 
  </body>
<!-- javascript -->
    <script type="text/javascript" src=<?php echo themes."/bootstrap/js/bootstrap.min.js";?>></script>
    <script type="text/javascript" src=<?php echo themes."/jquery.js" ;?>></script>
</html>
