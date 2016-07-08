<?php
session_start();
require("user.php");
include("../config/define.php");

class client extends user
{

public $uid;


public function __construct($uid)
{
$this->uid=$uid;
}
    function get_memoire()
{
     mysql_connect(host,username,pwd);
    mysql_select_db(db);

$ch=$this->uid;
$request=mysql_query(" select sum(size) AS value_sum from upload_file where user_id='$ch' ");
$row = mysql_fetch_assoc($request); 
$sum = $row['value_sum'];
return $sum/1000000;  

}

   function get_memoire2($ch)
{
    mysql_connect(host,username,pwd);
    mysql_select_db(db);
$request=mysql_query(" select sum(size) AS value_sum from upload_file where user_id='$ch' ");
$row = mysql_fetch_assoc($request); 
$sum = $row['value_sum'];
return intval($sum);
}


function get_permit_size()
{
    $ch=$this->uid;
		mysql_connect(host,username,pwd);
	mysql_select_db(db);
$request=mysql_query(" select * from profile_info where user_id='$ch' ");
while($row = mysql_fetch_assoc($request))
{

return intval($row["free_size"]);
}
}


function upload($name,$mime,$data,$size,$file_path,$error,$permit_size)
{
$id_of_user=$this->uid;
if(isset($name) ){
    // Make sure the file was sent without errors
    if($error == 0) {
        // Connect to the database
        $dbLink = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
	     // Gather all required data
        $name = $dbLink->real_escape_string($name);
        $mime = $dbLink->real_escape_string($mime);
        
        $data = $dbLink->real_escape_string(file_get_contents($data));
        $size = intval($size);
        $ext = pathinfo($file_path, PATHINFO_EXTENSION);

        $file_path = hash_file("sha1",$file_path);
        $hash = explode("  ", exec("md5sum $file_path"));
        $rHash=$hash[0];
$disc_size=$this->get_memoire()+$size;


if( $permit_size >= $disc_size )
{
       $query = "INSERT INTO `upload_file` (`name`, `mime`, `size`, `data`, `created`,hash,ext,user_id,splited)VALUES ('{$name}', '{$mime}', {$size}, '{$data}', NOW(),'{$rHash}','{$ext}','$id_of_user','0')";
 
        $result = $dbLink->query($query);
 
        // Check if it was successfull
             if($result) {
header("location:".cloud_path."/view/user");
              }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
}
else
{
    echo 'Get premuime account now';
}


    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($error);
    }
 
    // Close the mysql connection
    $dbLink->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="'.cloud_path.'">here</a> to go back</p>';
}



function download($id)
{
	if(isset($id)) {
// Get the ID
    $id = intval($id);
 
    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        $dbLink = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Fetch the file information
        $query = "
            SELECT file_id, `mime`, `name`, `size`, `data`
            FROM `upload_file`
            WHERE `file_id` = {$id}";
        $result = $dbLink->query($query);
 
        if($result) {
            // Make sure the result is valid
            if($result->num_rows == 1) {
            // Get the row
                $row = mysqli_fetch_assoc($result);
 
                // Print headers
                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
 
                // Print data
                ob_clean();
                flush();
                echo $row['data'];

            }
            else {
                echo 'Error! No image exists with that ID.';
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
        }
        @mysqli_close($dbLink);
    }
}
else {
    echo 'Error! No ID was passed.';
}
}


function merge($ch,$name)
{
exec('cat'.$ch.' >> merge/'.$name);
}

function download_split($name,$ext,$file_id,$size,$mime)
{

$id_of_user=$this->uid;

$dbLink = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
                $file_hash = hash_file("sha1",$name);

$query=$dbLink->query(" select * from oc_split where file_id='$file_id' and user_id='$id_of_user'  ");

while($row=$query->fetch_array())
{
    $concat_parts .= ' '.$row["index"];
}

$this->merge($concat_parts,$name);

    header("Content-Type: ". $mime);
    header("Content-Length: ". $size);
    header("Content-Disposition: attachment; filename=".$name);
    ob_clean();
    flush();
    readfile("merge/".$name); 

}




function delete($id_del)
{
	if (isset($id_del) && ! empty($id_del)) {
	mysql_connect(host,username,pwd);
	mysql_select_db(db);
	$rs=mysql_query(" DELETE FROM `upload_file` WHERE `file_id`='$id_del' ");
if ($rs) {
header("location:".cloud_path."/view/user");
}
else
{
	echo "alert('probleme');";
}
}
}

function share($id_file)
{

 $con = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
$request=$con->query(" select * from user_info where user_id='$this->uid'  ");
$row=$request->fetch_array(MYSQLI_ASSOC);
$username=$row["user_name"];
$uid=$row["user_id"];
$req=$con->query(" select * from upload_file where file_id='$id_file'  ");
$data=$req->fetch_array(MYSQLI_ASSOC);
$name_of_file=$data["name"];
$type=$data["mime"];

$token=$this->generateID();

$con->query(" insert into oc_share(file_target,item_type,uid_owner,uid_user,token,file_source) values('$name_of_file','$type','$username','$uid','$token','$id_file')  ");
return "http://127.0.0.1/".cloud_path."/model/share.php?sh=".$token;
}



function upload_fsplit($name,$mime,$data,$size,$file_path,$error,$parts)
{

$id_of_user=$this->uid;

$dbLink = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }


        $ext = pathinfo($file_path, PATHINFO_EXTENSION);

        $file_path = hash_file("sha1",$file_path);
        $hash = explode("  ", exec("md5sum $file_path"));
        $rHash=$hash[0];
$query = "INSERT INTO `upload_file` (`name`, `mime`, `size`, `created`,hash,ext,user_id,splited) VALUES ('{$name}', '{$mime}', {$size}, NOW(),'{$rHash}','{$ext}','$id_of_user','1')";
$result = $dbLink->query($query);

$file_splited_id=$dbLink->query(" select * from upload_file where name='$name' and user_id='$id_of_user' order by created DESC ");

$row=$file_splited_id->fetch_array();
 $idd_file=$row["file_id"];
$this->index($name,$idd_file,$parts,$id_of_user);




}

function index($name,$file_id,$parts,$id_of_user)
{

$dbLink = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }



foreach ($parts as $key => $value) {
        
        $hash= md5($value);

$result = $dbLink->query(" INSERT INTO `cloud`.`oc_split` (`id_split`, `file_name`, `file_id`, `index`,user_id,hash_file) VALUES (NULL, '$name', '$file_id', '$value','$id_of_user','$hash'); ");
if ($result) {
header("location:".cloud_path."/view/user");
}
else
{
    echo "Failed ! while the file being splited";
}


}

}









function generateID()
{
    $capital_letters = range("A", "Z");
    $lowcase_letters = range("a", "z");
    $numbers         = range(0, 9);

    $all = array_merge($capital_letters, $lowcase_letters, $numbers);
    $count = count($all);    
    $id    = "";

    for($i = 0; $i < 15; $i++)
    {
        $key = rand(0, $count-1);
        $id .= $all[$key];
    }
    return $id;
}








}


?>






