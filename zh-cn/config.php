<?php
$mysql_hostname = "127.0.0.1";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "publications";
$con = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Can't connect to database");
mysql_select_db($mysql_database, $con) or die("Can't select database");
?>