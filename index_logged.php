<?php // index.php
include_once 'rnheader.php';

echo ("<h2>About Us</h2>
<h4>We are a crowd-source airfare finder website with the aid of computer algorithm. Flight gurus throughout the world are the main source to find the best airfare. They compete to find the best fare for flyers. </h4>
<h2>What is your reward?</h2>
<h4>An experienced flight guru can earn up to $70/hr. We provide a reward of $30 and up for the winner of each flight search competition.</h4>
<h2>Sounds like you?</h2>
<h4>Simply fill out the below form and we will contact you soon</h4>
<br />");?><form method='post' action="send_form_email.php">

<table class="noborder">
<tr>
<td width=40%>
<LABEL for="from" value="your email">Your Email</LABEL>
<td width=40%>
<LABEL for="to">Select a Password</LABEL>
<tr>
<td><input type="text" compulsory="yes" size="30" value="" id="from1" name="email" />
<td><input type="password" size="30" value="" id="to1" name="password" />
</table>
<br />
<LABEL for="depart">A great flight plan you planned that you are most proud of</LABEL>
<br />
<textarea name='flight' cols='62' rows='5'></textarea><br /><br />
<input class="buttonc" type='submit' value='Submit' />
</form>

</div>
	</div>
  </body>
</html>
<?php
include "footer.php"
?>