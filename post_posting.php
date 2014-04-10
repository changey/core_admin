<?php /*
* process whatever you want here but don't make any output! *
*/
ob_start();
include_once 'config.php';

$depplace = $_POST['from'];
$arrplace = $_POST['to'];
$deptime = $_POST['deptime'];
$arrtime =  $_POST['arrtime'];
$depflexibility = $_POST['depflex'];
$arrflexibility = $_POST['arrflex'];
$people = $_POST['people'];
$class = $_POST['class'];
$nearby = $_POST['nearby'];
$anyairlines = $_POST['anyairlines'];
$multistops = $_POST['multistops'];
$addtional = $_POST['additional'];
$type = '';
$award = 0;
$paid = 0;
//$poster
$date = date('m/d/Y h:i:s a', time());

$query = "INSERT INTO itinerary
(poster, depplace, arrplace, deptime,arrtime,depflexibility, arrflexibility, people, class,
nearby,multistops,anyairlines,additional,type,award,paid,time)
VALUES
('eric', '$depplace', '$arrplace','$deptime','$arrtime','$depflexibility','$arrflexibility','$people',
'$class','$nearby','$anyairlines','$multistops','$additional','$type','','','$date')";
mysql_query($query, $con) or die(mysql_error($con));

$query = "INSERT INTO bids (trip_id, depplace, arrplace, deptime, arrtime,nearby, anyairlines, multistops,depflexibility,arrflexibility, people, class, poster, paid)
                  SELECT id, depplace, arrplace, deptime, arrtime, nearby, anyairlines, multistops,depflexibility,arrflexibility, people, class, poster, paid
                  FROM itinerary ORDER BY id DESC LIMIT 1";
		mysql_query($query) or die(mysql_error($con)); 

$query = "   SELECT id
             FROM itinerary ORDER BY id DESC LIMIT 1";
$result = mysql_query($query) or die(mysql_error($con)); 
while($row = mysql_fetch_array($result)){
	$trip_id=$row[0];
}	

mysql_close($con);
header("Location: fee.php?trip_id=" . $trip_id . "");
exit();
ob_end_flush();
?>