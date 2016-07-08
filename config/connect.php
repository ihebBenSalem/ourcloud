<?php

require("define.php");

$db_c = new mysqli(host,username,pwd,db);
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }


?>