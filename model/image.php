<?php
require("../config/define.php");
session_start();
$id_sess=$_SESSION["user"];

$dbLink = new mysqli(host,username,pwd, db);
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = " SELECT * FROM `upload_file` WHERE `ext`='png' or `ext`='jpeg' or `ext`='jpg' and `user_id`='$id_sess' order by created DESC    ";
$result = $dbLink->query($sql);
 
// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<center><p><h3>Upload your files here</h3></p>

<img src="img/up.png" />
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
                </thead>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
          
$img_src=icon_image($row["ext"]);
            echo '
                

                    <td class="mdl-data-table__cell--non-numeric"> <img src="'.$img_src.'">
'.$row['name'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$row['mime'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$row['size'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$row['created'].'}</td>
                    <td class="mdl-data-table__cell--non-numeric"><a href="'.cloud_path.'/controller/download.php?id='.$row['file_id'].'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Download</a></td>

                <!-- Colored raised button -->


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
        );
  return  $allowed[$ext];
   
   }


?>



