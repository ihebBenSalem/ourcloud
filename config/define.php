<?php
/**
* Database Config
*/
//Database Info
$_HOST="";
$_USERNAME="";
$_DB_PASSWORD="";
$_DB_NAME="";

if(!defined('host'))
    define('host', $_HOST);

if(!defined('username'))
    define('username', $_USERNAME);

if(!defined('pwd'))
	define('pwd', $_DB_PASSWORD);

if(!defined('db'))
    define('db', $_DB_NAME);
//alert info
define("r_success",'<center><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>successfully registered </strong> your account have been created <a href="/cloud/login">Login</a> </div></center>');

define("r_fail",'<center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>error while registering you...  </strong></div></center>');

//global path of the app /var/www/html/cloud
if(!defined('global_path'))
    define('global_path', dirname(dirname(__FILE__)) );

// split the phrase by any number of / characters,
$keywords = preg_split("/[\/,]+/",dirname(dirname(__FILE__ )));


//get the cloud based directory /cloud
if(!defined('cloud_path'))
    define('cloud_path',"/".$keywords[4]);

//set the themes globla path /cloud/themes
if(!defined('themes'))
    define('themes', cloud_path."/Themes" );

?>
