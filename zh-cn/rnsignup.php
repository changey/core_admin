<?php // rnsignup.php
ob_start();
include_once 'rnheader.php';
$trip_id=$_GET['trip_id'];
echo <<<_END
<script>
function checkUser(user)
{
if (user.value == '')
{
document.getElementById('info').innerHTML = ''
return
}
params = "user=" + user.value
request = new ajaxRequest()
request.open("POST", "rncheckuser.php", true)
request.setRequestHeader("Content-type",
"application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{
if (this.readyState == 4)
{
if (this.status == 200)
{
if (this.responseText != null)
{
document.getElementById('info').innerHTML =
this.responseText
}
else alert("Ajax error: No data received")
}
else alert( "Ajax error: " + this.statusText)
}
}
request.send(params)
}
function ajaxRequest()
{
try
{
var request = new XMLHttpRequest()
}
catch(e1)
{
try
{
request = new ActiveXObject("Msxml2.XMLHTTP")
}
catch(e2)
{
try
{
request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch(e3)
{
request = false
}
}
}
return request
}
</script>
<h3>Sign up</h3>
_END;
$error = $user = $pass = "";
if (isset($_SESSION['user']))
	destroySession();
if (isset($_POST['user'])) {
	$user = sanitizeString($_POST['user']);
	$pass = sanitizeString($_POST['pass']);
	
	if ($user == "" || $pass == "") {
		$error = "Not all fields were entered<br /><br />";
	} else {
		$query = "SELECT * FROM rnmembers WHERE user='$user'";
		if (mysql_num_rows(mysql_query($query))) {
			$error = "That username already exists<br /><br />";
		}else{
			header("Location: post_signup.php?trip_id=" . $trip_id . "&user=" . $user . "&pass=" . $pass . "");
			ob_end_flush();	
		}
	}
}
?>
<?php echo("
<div class=\"inner\">
<form method='post' action='rnsignup.php?trip_id=" . $trip_id . "'>$error") ?>
<?php
echo <<<_END
Username <input type='text' maxlength='16' name='user' value='$user'
onBlur='checkUser(this)'/><span id='info'></span><br /><br />
Password <input type='password' maxlength='16' name='pass'
value='$pass' /><br /><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type='submit' value='Signup' />
</form>
</div>
_END;
include "footer.php"
?>