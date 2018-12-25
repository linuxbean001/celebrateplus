<?
include("connect.php");
//include("fckeditor/fckeditor.php") ;
include("login_check.php");
$event_id = $_REQUEST['event_id'];
if($event_id <= 0 || $event_id == '')
{
	?>
		<script language="javascript">
			window.history.go(-1);
		</script>
    <?
}
if(isset($_REQUEST['submitted']))
{
	// First check whether this person has right to send invitation for this event
	if(GetValue("events","oid","id",$event_id) == $_SESSION['SESS_USER_ID'])
	{
		$invitation_design_style = $_REQUEST['invitation_design_style'];
		$invitation_message = $_REQUEST['invitation_message'];
		$invitees = $_REQUEST['invitees'];
		
		$create_invitation_query = "insert into invitations set
							  `event_id` = '$event_id',
							  `design_style` = '$invitation_design_style',
							  `invitation_message` = '$invitation_message',
							  `invitees` = '$invitees'";
		$create_invitation_result = hb_get_result($create_invitation_query) or die(mysql_error());
		
		// Mail Sending Started
		// Separate all the invitees with the comma
		$invitees_array = explode(",",$invitees);
		foreach($invitees_array as $invitee)
		{
			$mail_to = $invitee;
			// *** where it says "Event Name", it should populate with the name of the event that the user created when sending out the invitation mails.
			// So find here the name of the event
			$event_name = GetValue("events","title","id",$event_id);
			$mail_subject = "You have been invited to attend $event_name";
			
			
			// So first get here the id of organizer
			$organizer_id = GetValue("events","oid","id",$event_id);
			$organizer_first_name = GetValue("organizer","fname","id",$organizer_id);
			$organizer_last_name = GetValue("organizer","lname","id",$organizer_id);
			
			$mail_body = "$organizer_first_name $organizer_last_name has invited you to attend their event $event_name. To view the event details and confirm your attendance <a href='".$SITE_URL."event_detail.php?eve_id=$event_id'>click here</a>.<br /><br />$invitation_message";
			// The email address populating into the "Email* :" text field in the "My Account" interface should be populated here in $mail_from
			// http://server/chris/cplus/my_account.php
			
			// Now get the organizer email
			$mail_from = GetValue("organizer","email","id",$organizer_id);
			
			hb_send_mail($mail_to,$mail_subject,$mail_body,$mail_from);
		}
		location("event_hosting.php");
	}
	else
	{
		location("index.php");
	}
}
?>
<? 
	//$acc_pg_name='create_event';
$a = GetContent(25);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(25);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
	.cplus_acctcreateevent .reg_wid_form_input_main {
	  float: left;
	  padding: 0pt 0pt 15px;
	  width: 905px;
	}
	.addevent_2btn
	{
		background-image:url(images/send_invitation.png);
		width:200px;
		height:34px;
	}
	.cplus_acctcreateevent ul li
	{
		color: #5C6166;
		float: left;
		font-size: 14px;
		list-style: none outside none;
		padding: 5px 0 0;
		width: 220px;
	}
	.cplus_acctcreateevent a
	{
		color: #5C6166;
		float: left;
		text-decoration: none;
	}
	.addevent_2btn_main
	{
		padding-left:0px;
	}
</style>
<? include_once("include_social_functions.php"); ?>
<?php include_once("google_analytics.php");?>
</head>
    <body>
  
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Create Invitation</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								<form name="create_invitation" id="create_invitation" enctype="multipart/form-data" method="post" onSubmit="javascript:return check_validation()">
                                <div class="cplus_acctcreateevent">
                                	<div style="float: left;width: 200px;">
                                       <ul style="margin-left:0px; padding-left:0px;" class="categoryitems2">
                                       		<li><a href="event_reminder.php?event_id=<?=$event_id;?>"><img width="24" height="24" src="images/email_envelope.png">&nbsp;&nbsp;&nbsp;Email</a>
                                            <br>..........................................</li>
                                            <li><a href="reminder_facebook_invitation.php?event_id=<?=$event_id;?>"><img width="24" height="24" src="images/facebook.gif">&nbsp;&nbsp;&nbsp;Facebook</a>
                                            <br>..........................................</li>
                                            <li><a href="reminder_twitter_invitation.php?event_id=<?=$event_id;?>"><img width="24" height="24" src="images/twitter.gif">&nbsp;&nbsp;&nbsp;Twitter</a>
                                            <br>..........................................</li>
                                            <li><a href="reminder_linkedin_invitation.php?event_id=<?=$event_id;?>"><img width="24" height="24" src="images/linkedin.gif">&nbsp;&nbsp;&nbsp;LinkedIn</a>
                                            <br>..........................................</li>
                                            <li style="background-image:none; list-style:none; height:8px;">&nbsp;</li>
                                        </ul>  
                                    </div>
                                	<div class="reg_wid_form_left" style="width:668px;">
                                    	<div class="form_login_title" style="width:668px;">Remind Your LinkedIn Connections</div>
										<?php
                                    	//<div class="addevent_2btn_main" style="padding-top:0px;"><input type="button" onClick="javascript:send_linkedin_invite();" name="send_invitation" id="send_invitation" class="addevent_3btn" value="" /></div>
										?>
										<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/Share" data-url="http://www.celebrateplus.com/reminder_linkedin_invitation_2.php?event_id=174" data-onSuccess="test"></script>
<script type="text/javascript">function test() { alert('Your reminder has successfully been shared with your connections on LinkedIn. ');}</script>										
										
                                    </div>
									
                               	  <div class="reg_wid_form_left"></div>
                                </div>
								<!-- Hidden declaration started -->
								<input type="hidden" name="event_id" id="event_id" value="<?=$event_id;?>" />
								<input type="hidden" name="submitted" id="submitted" value="submitted" />
								<!-- Hidden declaration ended -->
								</form>
                            </div>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
<script type="text/javascript">
	function check_validation()
	{
		if(document.getElementById("invitation_design_style").value.split(" ").join("") == "")
		{
			alert("Please select a design style for the invitation that you are sending.");
			document.getElementById("invitation_design_style").focus();
			return false;
		}
		if(document.getElementById("invitees").value.split(" ").join("") == "")
		{
			alert("Please enter at least one email address.");
			document.getElementById("invitees").focus();
			return false;
		}
		return true;
	}
</script>