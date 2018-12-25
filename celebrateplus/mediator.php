<?php
	include("connect.php");
	if($_SESSION['SESS_USER_ID'] == "")
	{
		location("login_contribute.php?event_id=".$_REQUEST['event_id']);
	}
	else
	{
		location("make_payment.php?event_id=".$_REQUEST['event_id']."&is_attendee=0&tot_addendees=0&donate=Yes&how_mch=".$_REQUEST['how_mch']);
	}

?>
