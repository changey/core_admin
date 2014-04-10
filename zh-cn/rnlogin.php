<?php // rnlogin.php
ob_start();
include_once 'rnheader.php';

$trip_id = $_GET['trip_id'];

echo "
<div class=\"inner\">
<h3>Member Log in</h3>";
$error = $user = $pass = "";
if (isset($_POST['user'])) {
	$user = sanitizeString($_POST['user']);
	$pass = sanitizeString($_POST['pass']);
	if ($user == "" || $pass == "") {
		$error = "Not all fields were entered<br />";
	} else {
		$query = "SELECT user,pass FROM rnmembers
WHERE user='$user' AND pass='$pass'";
		if (mysql_num_rows(queryMysql($query)) == 0) {
			$error = "Username/Password invalid<br />";
		} else {
			header("Location: post_login.php?trip_id=" . $trip_id . "&user=" . $user . "&pass=" . $pass . "");	
			ob_end_flush();
			/*$_SESSION['user'] = $user;
			$_SESSION['pass'] = $pass;
			die("You are now logged in. Please
<a href='index_logged.php?view=$user'>click here</a>.");*/
		}
	}
}
?>
<?php echo("<form method='post' action='rnlogin.php?trip_id=" . $trip_id . "&user=" . $user . "&pass=" . $pass . "'>$error"); ?>
<?php
echo <<<_END
Username <input type='text' maxlength='16' name='user'
value='$user' /><br /><br />
Password <input type='password' maxlength='16' name='pass'
value='$pass' /><br /><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<table>
  <tr>
    <td>
      <input type='submit' value='Login' />
    </td>
    <td>
_END;
?>
<?php
echo("<input type=\"button\" value=\"Sign up\" onClick=\"window.location='rnsignup.php?trip_id=" . $trip_id . "'\">");

?>
<?php
echo <<<_END
    </td>
  </tr>
</table>      
</form>
</div>
_END;
include "footer.php";
?>