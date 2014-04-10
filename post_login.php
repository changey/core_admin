<?php /*
 * process whatever you want here but don't make any output! *
 */
ob_start();
include_once 'rnheader.php';
include_once 'config.php';

$user = $_GET['user'];
$pass = $_GET['pass'];
$trip_id = $_GET['trip_id'];

$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;

$query = "UPDATE bids
		  SET poster = '$user'
		  WHERE trip_id= '$trip_id'";
mysql_query($query);
mysql_close($con);
//header("Location: index2.php");
//}

mysql_close($con);
//$loggedin = TRUE;
header("Location: tags.php?user=" . $user . "");
exit();
ob_end_flush();
?>