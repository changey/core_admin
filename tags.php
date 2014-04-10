<?php
	require_once 'rnheader.php';
?>
<html>
	<head>
		<title></title>
	</head>
	<script type="text/javascript">
		function DoNav(theUrl) {
			document.location.href = theUrl;
		}
	</script>
	<style>

 body { 

  background-attachment: fixed; 

  background-image: url(images/bg2.jpg); 

  background-repeat: repeat; 

  background-position: right bottom; 

  } 

table {
    overflow:hidden;
    border:1px solid #d3d3d3;
    background:#fefefe;
    width:90%;
    margin:5% auto 0;
    -moz-border-radius:5px; /* FF1+ */
    -webkit-border-radius:5px; /* Saf3-4 */
    border-radius:5px;
    -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}
th, td { text-align:center; }
th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
tr.odd-row td {background:#f6f6f6;}
td.first, th.first {text-align:left}
td.last {border-right:none;}
/*
Background gradients are completely unnecessary but a neat effect.
*/
td {
    background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
    background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
}
tr.odd-row td {
    background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
    background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
}
th {
    background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
    background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
}
/*
I know this is annoying, but we need additional styling so webkit will recognize rounded corners on background elements.  Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
*/
tr:first-child th.first {
    -moz-border-radius-topleft:5px;
    -webkit-border-top-left-radius:5px; /* Saf3-4 */
}
tr:first-child th.last {
    -moz-border-radius-topright:5px;
    -webkit-border-top-right-radius:5px; /* Saf3-4 */
}
tr:last-child td.first {
    -moz-border-radius-bottomleft:5px;
    -webkit-border-bottom-left-radius:5px; /* Saf3-4 */
}
tr:last-child td.last {
    -moz-border-radius-bottomright:5px;
    -webkit-border-bottom-right-radius:5px; /* Saf3-4 */
}
	</style>
	<body>
	  <div class="inner">
		<?php
		include_once 'sqlfoo.php';
		include_once 'config.php';

		// sending query
		$oUser = new user();
		echo "
		<table>
			<tr>
				";?>
				<th width=20%>Tag</th>
				<!--<th width=20%>Time Left</th>";-->
				<?php 
				$oUser -> paid = "1";
				$oUser -> awarded = "\0";
				$oUser -> priceo = "priceo";
				$query = $oUser -> get("bids", "trip_id", "DISTINCT");

				$result = mysql_query($query) or die(mysql_error($con));
				$rows_num = mysql_num_rows($result);
				$query2 = "SELECT MAX(trip_id) AS MaxTripId FROM bids";
				$result2 = mysql_query($query2) or die(mysql_error($con));
				while ($row = mysql_fetch_row($result2)) {
				$trip_max=$row[0];
				}

				for($i=1;$i<=$trip_max;$i++)   {
				$oUser -> trip_id = $i;
				//$oUser->get();

				$query = $oUser -> get("bids", "depplace", "DISTINCT", "1");
				$result = mysql_query($query) or die(mysql_error($con));
				if (!$result) {
				die("Query to show fields from table failed");
				}

				$fields_num = mysql_num_fields($result);

				// printing table headers

				echo "</tr>\n";
			// printing table rows
			while ($row = mysql_fetch_row($result)) {
			//for ($i = 0; $i < 4; $i++) {
			$trip_id=$row[1];

			echo ("
			<tr onclick=\"DoNav('competition_detail.php?trip_id=" . $trip_id . "&view=" . $user ."');\">");
			if($row[2]!=0){
			echo "<td width=20%>$" . $row[2] . "</td>";
			}
			else{
			echo "<td width=20%>TBA</td>";
			}
			echo "<td width=20%>"
			?>
			<?php echo $row[3] . "<br />" . $row[5] . "</td>";
				echo "<td width=20%>" . $row[4] . "<br />" . $row[6] . "</td width=25%>";
				/*$now = strtotime(time());
				 $send_time = strtotime($row[2]);
				 $left = round(abs($now - $send_time) / 3600,2);
				 echo "<td>" .$left . "</td>";*/

				echo "</tr>\n";
				}
				}
				echo "</table><br />";
				mysql_free_result($result);
				mysql_close($con);
				?>
		</div>
		<!--<img src="displayImg.php?url=http://www.geonames.org/flags/x/tw.gif" />-->
	</body>
</html>