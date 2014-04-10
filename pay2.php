<script type="text/javascript">
function close_window(){
    window.opener.location = 'pop_up.php';
    window.close();
}
</script>
<?php
//require 'path-to-Stripe.php';
ob_start();
include_once 'config.php';
require_once('./lib/Stripe.php');

$trip_id = $_GET['trip_id'];

if ($_POST) {
  Stripe::setApiKey("mQC8viinQVRwMgwZf4xfktYay9zeuZCz");
  $error = '';
  $success = '';
  $pa=$_GET['pa'];
		if ($pa==0){
			$pay= 1800;
		}
		else if ($pa==1){
			$pay= 2800;
		}
		else{
			$pay= 3800;
		}
  try {
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
    Stripe_Charge::create(array("amount" => $pay,
                                "currency" => "usd",
                                "card" => $_POST['stripeToken']));
    $success = 'Your payment was successful.';
	$query = "UPDATE bids
			          SET paid = '1'
			          WHERE trip_id= '$trip_id'";
		    mysql_query($query);
	mysql_close($con);
	echo("<script>  
   window.opener.location =\"rnlogin.php?rnlogin.php=" . $trip_id . "\";  
   window.close();  
   </script>  ");  
	ob_end_flush();
	
  }
  catch (Exception $e) {
    $error = $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title></title>
        <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_6r3yWBs3WSLc7vZZFgWBSh46ccGXc');

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }

            $(document).ready(function() {
                $("#payment-form").submit(function(event) {
                    // disable the submit button to prevent repeated clicks
                    $('.submit-button').attr("disabled", "disabled");

                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
                });
            });
        </script>
    </head>
    <body>
        <!-- to display errors returned by createToken -->
        <span class="payment-errors"><?= $error ?></span>
        <span class="payment-success"><?= $success ?></span>
        <!-- to display errors returned by createToken -->
        <form action="" method="POST" id="payment-form">
            <div class="form-row">
                <label>Card Number</label>
                <input type="text" size="20" class="card-number" />
            </div>
            <div class="form-row">
                <label>CVC</label>
                <input type="text" size="4" class="card-cvc" />
            </div>
            <div class="form-row">
                <label>Expiration (MM/YYYY)</label>
                <input type="text" size="2" class="card-expiry-month"/>
                <span> / </span>
                <input type="text" size="4" class="card-expiry-year"/>
            </div>
            <div>
            	<label>Accepted</label><br />
            	<img src="images/visa.jpg" width="40px" alt="a">
            	<img src="images/mastercard.jpeg" width="40px" alt="a">
            	<img src="images/american_express.jpeg" width="40px" alt="a">
            </div>	
            <button type="submit" class="submit-button">Submit Payment</button>
        </form>
    </body>
</html>