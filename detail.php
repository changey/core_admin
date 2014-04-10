<html>
	<head></head>
	<script type="text/javascript">
		function DoNav(theUrl) {
			document.location.href = theUrl;
		}
	</script>
	<?php
		include_once 'rnheader.php';
		include_once 'sqlfoo.php';
		echo("<br /><body>
		<div class=\"inner\">");

		$poster = $_GET['poster'];
		if ($poster != $_SESSION['user']) {
			die("<br /><br />You have to be the competition holder to see the detail");
		}
		include_once 'config.php';

		if (isset($_GET['id'])) {
			$id = sanitizeString($_GET['id']);
		}
		if (isset($_GET['trip_id'])) {
			$trip_id = sanitizeString($_GET['trip_id']);
		}
		$oUser = new user();
		$oUser -> id = $id;
		$oUser -> pricel = "\0";

		//$oUser -> itin_poster = "Mark";

		$query = $oUser -> get("bids", "depplace");

		$result = mysql_query($query) or die(mysql_error($con));
		if (!$result) {
			die("Query to show fields from table failed");
		}

		echo "<h1>This is the real detail</h1>";
	?>
	<?php	// printing table headers
		/*for ($i = 0; $i < $fields_num; $i++) {
		 $field = mysql_fetch_field($result);
		 echo "<td>{$field->name}</td>";
		 }*/

		echo "<table class=\"main\"><tr>";
		echo "<th>Price Per Person</th>
<th>From</th>
<th>To</th>
<th>Guru</th>";
		echo "</tr>\n";

		// printing table rows
		while ($row = mysql_fetch_row($result)) {
			//$row = mysql_fetch_row($result);
			echo "<tr>";
			echo "<td width=25%>$" . $row[2] . "</td>";
			echo "<td width=25%>" . $row[3] . "<br />" . $row[5] . "</td>";
			echo "<td width=25%>" . $row[4] . "<br />" . $row[6] . "</td>";
			echo "<td width=25%>" . $row[7] . "</td>";
			echo "</tr>\n";
			echo "</table><br />";
			echo "Additional information: " . $row[10];
			echo "<br />";
			echo "Instructions: " . $row[11];
			echo "<br /><br/>";
			echo "Award a guru";
			echo "<br /><br />";
		}

		mysql_free_result($result);
		$guru = new user();
		$guru -> trip_id = $trip_id; 
		$guru -> pricel = "\0";
		$query2 = $guru -> get("bids", "depplace");

		$result2 = mysql_query($query2) or die(mysql_error($con));
		if (!$result2) {
			die("Query to show fields from table failed");
		}
		while ($row = mysql_fetch_row($result2)) {
			echo("<table class=\"bottom\">");
			$guru = $row[12];
			        echo("<tr onclick=\"DoNav('post_award.php?trip_id=" . $trip_id . "&guru=" . $guru . "&id=" . $id . "');\">
			          <td width=50%>");
			echo $row[12];
			echo("</td>
			          <td >Select
			          </td>
			        </tr>
			      </table>
			");
		}
		mysql_close($con);
	?>
	  </div>
	</body>
</html>