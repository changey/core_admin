<?php /*
* process whatever you want here but don't make any output! *
*/

ob_start();
include_once 'config.php';

$tagId = $_GET['tagId'];
//$email = $_GET['email'];
// $query = "SELECT * FROM contacts WHERE user='$user'";
$query = "DELETE FROM tags WHERE id='$tagId'";
       mysql_query($query) or die (mysql_error($con));

echo 'deleted tag successfully';

mysql_close($con);
ob_end_flush(); 
?>