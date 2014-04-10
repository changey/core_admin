<?php /*
* process whatever you want here but don't make any output! *
*/
ob_start();
include_once 'config.php';
include_once 'sqlfoo.php';
        $trip_id = $_POST['trip_id'];
		
		$oUser = new user();
		$oUser -> trip_id = $trip_id;

		//$oUser -> itin_poster = "Mark";

		$query = $oUser -> get("bids", "depplace","","1");
		echo $query;
		$result = mysql_query($query) or die(mysql_error($con));
		if (!$result) {
			die("Query to show fields from table failed");
		}
		while ($row = mysql_fetch_row($result)) {
			$depplace=$row[3];
			$arrplace=$row[4];
			$poster=$row[9];
		}
		
		$user=$_GET['view'];
		$trip_id = $_POST['trip_id'];
		$price = $_POST['price'];
		$source = $_POST['source'];
		$deptime = $_POST['deptime'];
		$arrtime = $_POST['arrtime'];
		$depstops= $_POST['depstops'];
		$arrstops = $_POST['depstops'];
		$additional = $_POST["additional"];
		$instructions = $_POST['instructions'];
		$sendtime = date('m/d/Y h:i:s a', time());
			$query = "INSERT INTO bids
	(trip_id, depplace, arrplace, expert, price, source, depstops, arrstops, deptime, arrtime, additional, instructions, sendtime,poster, paid)
	VALUES
	('$trip_id', '$depplace', '$arrplace', '$user', '$price', '$source','$depstops','$arrstops','$deptime','$arrtime','$additional','$instructions','$sendtime','$poster', '1')";	
			mysql_query($query, $con) or die(mysql_error($con));
			$query = "DELETE FROM bids
	                  WHERE	price=0";
	    mysql_query($query, $con) or die(mysql_error($con));

			
		mysql_close($con);
header("Location: competition_detail.php?trip_id=" . $trip_id ."&view=" . $user);
exit();
ob_end_flush();
?>