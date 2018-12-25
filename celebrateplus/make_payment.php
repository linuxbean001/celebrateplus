<?php
	include("connect.php");
	$_SESSION['notification_allowed'] = true;
	
	/*
	https://www.paypal.com/
	Username: celebrateplus2012@gmail.com
	Password: cplus2012
	*/
	
	// Now here we need to make sure that we have an event stored in this session variable "$_SESSION['event_id']"
	// and the page which referred must be "event_attending_confirmation.php"
	// If this page fails in satisfying the above conditions then just redirect it to the page where it has been referred from.
	if(!($_SESSION['event_id'] > 0 || $_SESSION['from_where'] == 'event_attending_confirmation.php' || $_SESSION['from_where'] == 'event_detail.php' || $_SESSION['from_where'] == 'acc_event_detail.php'))
	{
		?>
			<script language="javascript">
				alert("Please don't try to execute this page manually.");
				window.history.go(-1);
			</script>
		<?
		exit;
	}
	unset($_SESSION['from_where']);
	
	$is_attendee = $_REQUEST['is_attendee'];
	if($is_attendee == 1 && $_SESSION['SESS_USER_ID'] > 0)
	{
	$check_attendence = hb_get_result("select * from attendee where user_id='".$_SESSION['SESS_USER_ID']."' and event_id='".$event_id."' and is_attendee = '1'");
	$is_regiestered = mysql_num_rows($check_attendence);
	if($is_regiestered > 0)
	{
	?>
		<script language="javascript" type="text/javascript">
			alert("You have already confirmed attendance to this event");
			window.location.href='acc_event_detail.php?eve_id=<?=$event_id;?>';
		</script>
	<? 
	exit;
	}
	}
	
	// Get the amount that the attendee would donate for this event using the request from the previous page.
	$DONATION_AMOUNT = str_replace(",","",$_REQUEST['how_mch']);
	if($DONATION_AMOUNT <= 0 || $DONATION_AMOUNT == '')
	{
		?>
			<script language="javascript">
				alert("Please enter a positive value for the donation amount.");
				window.history.go(-1);
			</script>
		<?
		exit;
	}
	
	$fund_end_date = GetValue("events","fund_end_date","id",$_SESSION['event_id']);
	$today = date("Y-m-d");
	$end_date_timestamp = strtotime($fund_end_date);
	$today_timestamp = strtotime($today);
	if($end_date_timestamp <= 0 || $end_date_timestamp == '')
	{
		$end_date_timestamp = $today_timestamp;
	}
	if($today_timestamp > $end_date_timestamp)
	{
		?>
			<script language="javascript">
				alert("The funding period on this event has expired. You will not be able to donate to this event.");
				window.history.go(-1);
			</script>
		<?
		exit;
	}
	
	$event_id = $_SESSION['event_id'];
	$tot_addendees = $_REQUEST['tot_addendees'];
	$comments = $_REQUEST['comments'];
	$how_mch = $_REQUEST['how_mch'];
	$is_attendee = $_REQUEST['is_attendee'];
	// Now first get paypal email address of the site so that we can send a percentage of donation to the site owner
	$SITE_COMMISSION_RATE = $GBV_SITE_COMMISSION_RATE;
	$SITE_OWNER_PAYPAL_EMAIL =  'celebrateplus2012@gmail.com';
	$SITE_OWNER_PAYPAL_AMOUNT = ($DONATION_AMOUNT * $SITE_COMMISSION_RATE) / 100;
	$SITE_OWNER_PAYPAL_AMOUNT = number_format($SITE_OWNER_PAYPAL_AMOUNT,2);
	
	// Now get here the email address of event owner
	// First get the id of the owner of the event
	$EVENT_OWNER_ID = GetValue("events","oid","id",$event_id);
	//$EVENT_OWNER_PAYPAL_EMAIL = 'koller_1326086763_per@idealgrowth.com';
	// And then get the paypal email address of the owner of the event
	$EVENT_OWNER_PAYPAL_EMAIL = GetValue("organizer","paypalid","id",$EVENT_OWNER_ID);
	if($EVENT_OWNER_PAYPAL_EMAIL == '' || (!(preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/',$EVENT_OWNER_PAYPAL_EMAIL))))
	{
		if($EVENT_OWNER_PAYPAL_EMAIL == '')
		{
			$error_message = "Currently we have not intiated the process of receiving donation, so please try again at a later time.";
		}
		else if(!(preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/',$EVENT_OWNER_PAYPAL_EMAIL)))
		{
			$error_message = "The users PayPal account that is hosting this event is not configured correctly. Please inform the organizer or try again later.";
		}
		?>
			<script language="javascript">
				alert("<?php echo $error_message;?>");
				window.history.go(-1);
			</script>
		<?
		exit;
	}
	$EVENT_OWNER_PAYPAL_AMOUNT = $DONATION_AMOUNT - $SITE_OWNER_PAYPAL_AMOUNT;
	
	// Now set these attributes in a session so we can later store them with attendee data
	$_SESSION['session_commission_rate'] = $GBV_SITE_COMMISSION_RATE;
	$_SESSION['session_gave_to_site'] = $SITE_OWNER_PAYPAL_AMOUNT;
	$_SESSION['session_gave_to_event_owner'] = $EVENT_OWNER_PAYPAL_AMOUNT;
/*
*******************************************************************
THIS IS STRICTLY EXAMPLE SOURCE CODE. IT IS ONLY MEANT TO
QUICKLY DEMONSTRATE THE CONCEPT AND THE USAGE OF THE ADAPTIVE
PAYMENTS API. PLEASE NOTE THAT THIS IS *NOT* PRODUCTION-QUALITY
CODE AND SHOULD NOT BE USED AS SUCH.

THIS EXAMPLE CODE IS PROVIDED TO YOU ONLY ON AN "AS IS"
BASIS WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, EITHER
EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY WARRANTIES
OR CONDITIONS OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY OR
FITNESS FOR A PARTICULAR PURPOSE. PAYPAL MAKES NO WARRANTY THAT
THE SOFTWARE OR DOCUMENTATION WILL BE ERROR-FREE. IN NO EVENT
SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL,  EXEMPLARY, OR
CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT
OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF
THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY
OF SUCH DAMAGE.


INSTRUCTIONS
1) Ensure that SSL and fopen() are enabled in the php.ini file
2) Written and Tested with PHP 5.3.0


IMPORTANT:
When you integrate this code look for TODO as an indication that 
you may need to provide a value or take action before executing this code.
*******************************************************************

*/

//turn php errors on
ini_set("track_errors", true);
ini_set('allow_url_fopen', 'On');
if($_SESSION['SESS_USER_ID'] > 0)
{
	$returnurl = $SITE_URL."event_payment_confirmation.php?event_id=".$event_id."&tot_addendees=".$tot_addendees."&comments=".$comments."&how_mch=".$how_mch."&is_attendee=".$is_attendee;
}
else
{
	$returnurl = $SITE_URL."event_payment_confirmation.php?event_id=".$event_id."&tot_addendees=".$tot_addendees."&comments=".$comments."&how_mch=".$how_mch."&is_attendee=".$is_attendee;
}

$x_Test_Request = hb_get_payment_mode();
if($x_Test_Request == 'TRUE')
{
	//PayPal Endpoint for test mode
	$url = trim("https://svcs.sandbox.paypal.com/AdaptivePayments/Pay");	
	
	// Details of sandbox api	
	$API_UserName = "celebrateplus2012-facilitator_api1.gmail.com";//"ideal_1326089590_biz_api1.idealgrowth.com";
	$API_Password = "1376451228";//"JRM6KCLBUS8TG2H2";
	$API_Signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31AHWiG4IyWP.UfNWbq4Oj5HME5V-2";//"A.R3ACbj83JZUccfn4PjuT1nKSfYAGxdt2xuBX-xumU49a4TVXDhiN0D";
	
	// Default App ID for Sandbox	
	$API_AppID = "APP-80W284485P519543T";
	
	$approved_url = "https://www.sandbox.paypal.com";
}
else
{
	//set PayPal Endpoint for live mode
	$url = trim("https://svcs.paypal.com/AdaptivePayments/Pay");
	
	// Details of original api
	$API_UserName = "celebrateplus2012_api1.gmail.com";
	$API_Password = "DP99FL38FK94SXW3";
	$API_Signature = "A1kBqtNKd.LWQfYJWNovDGIR8z6RA516KlrUdTF312CRq7bIQWmRUIgW";
	
	// Our App ID for original api
	$API_AppID = "APP-6DH22563VG619162F";//"APP-1SS921603A5037507";
	
	$approved_url = "https://www.paypal.com/";
}

/*
*******************************************************************
PayPal API Credentials
Replace <API_USERNAME> with your API Username
Replace <API_PASSWORD> with your API Password
Replace <API_SIGNATURE> with your Signature
*******************************************************************
*/


$API_RequestFormat = "NV";
$API_ResponseFormat = "NV";

//$SITE_OWNER_PAYPAL_EMAIL = "cplusowner@gmail.com";
//Create request payload with minimum required parameters
$bodyparams = array (	
											"currencyCode" => "USD",
											"cancelUrl" => $SITE_URL."event_attending_confirmation.php",
											"requestEnvelope.errorLanguage" => "en_US",
											"actionType" => "PAY",
											"returnUrl" => $returnurl,
											/* Parallel Payment Started */
											/*"receiverList.receiver(0).email" => $SITE_OWNER_PAYPAL_EMAIL, //TODO
											"receiverList.receiver(0).amount" => $SITE_OWNER_PAYPAL_AMOUNT, //TODO
											"receiverList.receiver(1).email" => $EVENT_OWNER_PAYPAL_EMAIL, //TODO
											"receiverList.receiver(1).amount" => $EVENT_OWNER_PAYPAL_AMOUNT, //TODO*/
											/* Parallel Payment Ended */
											
											/* Chained Payment Started */
											"receiverList.receiver(0).email" => $EVENT_OWNER_PAYPAL_EMAIL, //TODO
											"receiverList.receiver(0).amount" => $EVENT_OWNER_PAYPAL_AMOUNT + $SITE_OWNER_PAYPAL_AMOUNT, //TODO
											"receiverList.receiver(0).primary" => "true", //TODO
											"receiverList.receiver(1).email" => $SITE_OWNER_PAYPAL_EMAIL, //TODO
											"receiverList.receiver(1).amount" => $SITE_OWNER_PAYPAL_AMOUNT, //TODO
											"receiverList.receiver(1).primary" => "false" //TODO
											/* Chained Payment Ended */
											);
											
// convert payload array into url encoded query string

$body_data = http_build_query($bodyparams, "", chr(38));
try
{

    //create request and add headers
    $params = array("http" => array( 
					"method" => "POST",
					"content" => $body_data,
					"header" =>  "X-PAYPAL-SECURITY-USERID: " . $API_UserName . "\r\n" .
					"X-PAYPAL-SECURITY-SIGNATURE: " . $API_Signature . "\r\n" .
					"X-PAYPAL-SECURITY-PASSWORD: " . $API_Password . "\r\n" .
					"X-PAYPAL-APPLICATION-ID: " . $API_AppID . "\r\n" .
					"X-PAYPAL-REQUEST-DATA-FORMAT: " . $API_RequestFormat . "\r\n" .
					"X-PAYPAL-RESPONSE-DATA-FORMAT: " . $API_ResponseFormat . "\r\n" 
					));

    //create stream context
     $ctx = stream_context_create($params);
    

    //open the stream and send request
     $fp = fopen($url, "r", false, $ctx);

	if($fp == false)
	{
		throw new Exception("File opening failed = " . "$php_errormsg");
	}
    //get response
  	 $response = stream_get_contents($fp);

  	//check to see if stream is open
     if ($response === false) {
        throw new Exception("php error message = " . "$php_errormsg");
     }
           
    //close the stream
     fclose($fp);

    //parse the ap key from the response
    $keyArray = explode("&", $response);
        
    foreach ($keyArray as $rVal){
    	list($qKey, $qVal) = explode ("=", $rVal);
			$kArray[$qKey] = $qVal;
    }
       
    //set url to approve the transaction
    $payPalURL = $approved_url."/webscr?cmd=_ap-payment&paykey=" . $kArray["payKey"];

    //print the url to screen for testing purposes
    If ( $kArray["responseEnvelope.ack"] == "Success") {
    	//echo '<p><a href="' . $payPalURL . '" target="_blank">' . $payPalURL . '</a></p>';
		header("Location:".$payPalURL);
     }
    else {
    	echo 'ERROR Code: ' .  $kArray["error(0).errorId"] . " <br/>";
      echo 'ERROR Message: ' .  urldecode($kArray["error(0).message"]) . " <br/>";
    }
   
    /*
   	//optional code to redirect to PP URL to approve payment
    If ( $kArray["responseEnvelope.ack"] == "Success") {
   
  	  header("Location:".  $payPalURL);
      exit;
       }
     else {
     		echo 'ERROR Code: ' .  $kArray["error(0).errorId"] . " <br/>";
        echo 'ERROR Message: ' .  urldecode($kArray["error(0).message"]) . " <br/>";
     }
     */
}

catch(Exception $e) {
  	echo "Message: ||" .$e->getMessage()."||";
  }

?>
