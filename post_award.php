<?php /*
 * process whatever you want here but don't make any output! *
 */
include_once 'rnheader.php';

ob_start();
include_once 'config.php';

$trip_id = $_GET['trip_id'];
$guru = $_GET['guru'];
$id=$IGET['id'];
$confirm=$_POST['confirm'];
echo $confirm;
echo ("
<div class=\"inner\">
<br /><br />");
echo "Award " . $guru . " ?";
echo ("<br /><br />");
echo ("<form method='post' action='post_award.php?guru=" . $guru . "&trip_id=" . $trip_id . "'>");
?>
<input type='radio' name='confirm' value='1' id='nearby1'/>Yes
<br /><br />	<input type='submit' value='Submit' />
</form>
</div>
<?php
if($confirm==1){
$query = "UPDATE bids
		  SET awardee = '$guru',
		      awarded = '1'
		  WHERE trip_id= '$trip_id'";
mysql_query($query);
header("Location: competition_listing.php");
}
mysql_close($con);
exit();
ob_end_flush();
?>