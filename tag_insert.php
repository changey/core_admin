<?php /*
 * process whatever you want here but don't make any output! *
 */
ob_start();
include_once 'rnheader.php';
include_once 'config.php';

$user = $_GET['user'];
$pass = $_GET['pass'];
$name = $_POST['name'];
echo $name;

$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;

$query = "INSERT INTO tags (name) VALUES('$name')";
mysql_query($query);

mysql_close($con);
//$loggedin = TRUE;
header("Location: tags.php");
//exit();
ob_end_flush();
?>