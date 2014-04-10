<?php /*
* process whatever you want here but don't make any output! *
*/
ob_start();
include_once 'config.php';

$depplace = $_POST['fromp'];
$arrplace = $_POST['top'];
$deptime = $_POST['deptime'];
$arrtime =  $_POST['arrtime'];
$flexibility = $_POST['flex'];
$people = $_POST['people'];
$class = $_POST['class'];
$nearby = $_POST['nearby'];
$anyairlines = $_POST['anyairlines'];
$multistops = $_POST['multistops'];
$addtional = $_POST['additional'];
$type = '';
$award = 0;
$paid = 0;
$date = date('m/d/Y h:i:s a', time());
echo count($depplace);
for($i=0;$i<count($depplace);$i++){
$query = "INSERT INTO itinerary
(poster, depplace, arrplace, deptime,arrtime,flexibility, people, class,
nearby,multistops,anyairlines,additional,type,award,paid,time)
VALUES
('eric', '$depplace[$i]', '$arrplace[$i]','$deptime[$i]','$arrtime','$flexibility[$i]','$people',
'$class','$nearby','$anyairlines','$multistops','$additional','$type','','','$date')";

mysql_query($query, $con) or die(mysql_error($con));
}
//}
/*$query = "INSERT INTO bids
(depplace, arrplace, deptime,arrtime,paid,sendtime)
VALUES
('$depplace', '$arrplace','$deptime','$arrtime','','$date')";
mysql_query($query, $con) or die(mysql_error($con));*/
$query = "INSERT INTO bids (trip_id, depplace, arrplace, deptime, arrtime)
                  SELECT id, depplace, arrplace, deptime, arrtime
                  FROM itinerary ORDER BY id DESC LIMIT 1";
		mysql_query($query) or die(mysql_error($con)); 

mysql_close($con);
//header("Location: fee.php");
exit();
ob_end_flush();
?>