<?php /*
 * process whatever you want here but don't make any output! *
 */
ob_start();
include_once 'rnheader.php';

$con = mysql_connect("127.0.0.1", "root", "");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("publications", $con);
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
header("Location: competition_send.php?trip_id=" . $trip_id . "&view=" . $user . "");
exit();
ob_end_flush();
?>