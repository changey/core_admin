<?php /*
* process whatever you want here but don't make any output! *
*/

ob_start();
include_once 'config.php';

$user = $_GET['user'];
$pass = $_GET['pass'];
$trip_id = $_GET['trip_id'];

$query = "SELECT * FROM rnmembers WHERE user='$user'";
		if (mysql_num_rows(mysql_query($query))) {
			$error = "That username already exists<br /><br />";
		} else {
			$query = "INSERT INTO rnmembers (user, pass) VALUES('$user', '$pass')";
			mysql_query($query);
			
			$query = "UPDATE bids
			          SET poster = '$user'
			          WHERE trip_id= '$trip_id'";
		    mysql_query($query);
			//header("Location: index2.php");
		}

mysql_close($con);
header("Location: competition_listing.php");
exit();
ob_end_flush(); 
?>