<?php
include_once 'rnheader.php';
include_once 'sqlfoo.php';

$trip_id = $_GET['trip_id'];

?>
<script type="text/javascript">
            function first(){
                document.getElementById("update").innerHTML = "$18";
            }
            function second(){
                document.getElementById("update").innerHTML = "$28";
            }
            function third(){
                document.getElementById("update").innerHTML = "$38";
            }
        </script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<BODY>
<div class="inner">
<?php
echo ("<form id=\"radioform\" action=\"pay2.php?trip_id=" . $trip_id . "\" target=\"report\" onsubmit=\"window.open('about:blank','report','width=300,height=200')\">");
?>
Your Finder's Fee<br />
There will be a competition for flight gurus to find the best flight for you. They are motivated by your award.<br />
We guarantee to have a lower cost flight!<br />
<TABLE>
<TR>
<TD width=85%>100% Money-Back Satisfication Guarantee
<TD>free
</Table>
<br />
What package would you like to choose<br />

<table>
<tr>
<td width=85% ><input type='radio' name='pa' value='0' onclick="first();" />Economy Award (simple itinerary)
<td>$18
<tr>
<td width=85% ><input type='radio' name='pa' value='1' onclick="second();" checked="checked"/>Normal Award (attract more gurus)
<td>$28
<tr>
<td width=85% ><input type='radio' name='pa' value='2' onclick="third();"/>Premium Award (attract the best gurus)
<td>$38
</table><br />
Total Award<br />
<span id="update">$28</span><br /><br />
Your are not obligated to purchase a flight, but we recommend booking the flight quickly.<br />
<?php echo("<input type=\"hidden\" value=\"" . $trip_id  . "\" name=\"trip_id\" />");
?>
<input type='submit' value='Confirm Your Award to Gurus' />
</form>
<?php
//debug only. delete it when publish
$query = "UPDATE bids
		  SET paid = '1'
		  WHERE trip_id= '$trip_id'";
		    mysql_query($query);
	mysql_close($con);
echo("<input type=\"button\" value=\"next step (debug only)\" onClick=\"window.location='rnlogin.php?trip_id=" . $trip_id . "'\">");

?>
<script type="text/javascript">
var submit = document.getElementById("submit");
submit.onclick = checkradio;
</script>
</div>
</body>