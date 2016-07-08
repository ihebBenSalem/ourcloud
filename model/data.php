<?php                   
require("../config/define.php");

?>

                    <!-- CSS -->
<link rel="stylesheet" href="css/photon.min.css">
<link rel="stylesheet" href="css/main.css">
                    <!-- META TAG -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport">


                    <!-- CSS -->
<link rel="stylesheet" type="text/css" href=<?php echo themes."/mdl/material.min.css"; ?>>
<link rel="stylesheet" type="text/css" href=<?php echo themes."/bootstrap/css/bootstrap.min.css"; ?>>

                    <!-- JS -->
<script type="text/javascript" src=<?php echo themes."/jquery.js" ;?>></script>
<script type="text/javascript" src=<?php echo themes."/bootstrap/js/bootstrap.min.js" ;?>></script>
<?php
session_start();
$id_sess=$_SESSION["user"];
$dbLink = new mysqli(host,username,pwd, db);
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = " select * from upload_file where user_id='$id_sess' order by created DESC    ";



$result = $dbLink->query($sql);
 
// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<center><p><h3>Upload your files here</h3></p>

<img src="img/Database-Cloud-icon.png" width="250px"  />
        </center>


        ';
    }
    else {
        // Print the top of a table
        echo '<table class="table mdl-js-data-table mdl-data-table--selectable ">
                <thead>
                    <th>Name</th>
                    <th>Mime</th>
                    <th>Size (bytes)</th>
                    <th>Created</th>
                    <th>Download</th>
                    <th>Delete</th>
                    <th>Share</th>
                </thead>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
          
$img_src=icon_image($row["ext"]);
            echo '
                

                    <td class="mdl-data-table__cell--non-numeric"> <img src="'.$img_src.'">
'.$row['name'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$row['mime'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$row['size'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$row['created'].'</td>
                    <td class="mdl-data-table__cell--non-numeric"><a href="'.cloud_path.'/controller/download.php?id='.$row['file_id'].'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Download</a></td>
                    <td class="mdl-data-table__cell--non-numeric"><a href="'.cloud_path.'/controller/del.php?d='.$row['file_id'].'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button">Delete</a></td>
                    <td ><button class="btn btn-default" id="'.$row["file_id"].'-1">
        <span class="icon icon-popup"></span><input data-toggle="modal" data-target="#modal-id" type="hidden" id="'.$row["file_id"].'" value="'.$row["file_id"].'" />
      </button>
      </td>

<script type="text/javascript">$("#'.$row["file_id"].'-1").click(function(){
page($("#'.$row["file_id"].'").val());

});</script>


                </tr>';
        }
 
        // Close table
        echo '</table>';
    }
 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();

function icon_image($ch)
{

    if (checkvalidext($ch)=="image") {
    # code...
return "img/file_type/image.png";
}
else if(checkvalidext($ch)=="pdf")
{
return "img/file_type/application-pdf.png";
}
else if(checkvalidext($ch)=="doc")
{
return "img/file_type/x-office-document.png";
}
else if(checkvalidext($ch)=="ppt")
{
return "img/file_type/x-office-presentation.png";
}
else if(checkvalidext($ch)=="audio")
{
return "img/file_type/audio.png";
}else if(checkvalidext($ch)=="txt")
{
return "img/file_type/text.png";
}
else if(checkvalidext($ch)=="code")
{
return "img/file_type/text-code.png";
}
else if(checkvalidext($ch)=="video")
{
return "img/file_type/video.png";
}
else
{
    return "img/file_type/file.png";

}

}




function checkvalidext($ext) {
  $allowed = array(
         'jpg'    =>    "image",
        'gif'    =>    "image",
        'png'    =>    "image",
        'jpeg'    =>    "image",
        'mp3'    =>    "audio",
        'pdf'    =>    "pdf",
        'zip'    =>    "zip",
        'doc'    =>    "doc",
        'docx'    =>    "doc",
        'ppt'    =>    "ppt",
        'pptx'    =>    "ppt",
        'txt'    =>    "txt",
        'odt'    =>    "doc",
        'py'    =>    "code",
        'java'    =>    "code",
        'c'    =>    "code",
        'mp4'    =>    "video",
        );
  return  $allowed[$ext];
   
   }


function my_request($ch)

{
return $ch;
}


?>

<script>

$(document).ready(function(){



});





function page(i)
{
    

   var data={idf:i};

$.ajax({
url:"<?php echo cloud_path."/controller/share.php";?>",
data:data,
success:function(msg)
{

var person = prompt("share this file", msg);

  








}


});

}

</script>


