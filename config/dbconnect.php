<?php

require("define.php");
if(!mysql_connect(host,username,pwd))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db(db))
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>