<?
include("connect.php");
include("fckeditor/fckeditor.php") ;
include("login_check.php");
$event_id = $_REQUEST['event_id'];
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
		$create_invitation_result = mysql_query($create_invitation_query) or die(mysql_error());
		
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
	$acc_pg_name='create_event';
$a = GetContent(21);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
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
		background-image:url(images/send.png);
		width:126px;
		height:34px;
	}
</style>
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
                                	<div class="reg_wid_form_left" style="width:905px;">
                                    	<div class="form_login_title" style="width:905px;">Create Your Invitation</div>
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name" style="width:100%; text-align:left">Select the design for your invitation: <span style="color:#FF0000;">*</span></div>
                                    </div>
									<div class="reg_wid_form_input_main" style="height:50px;">
                                        <div class="reg_wid_form_input_box">
											<div class="eve_text_main_form_input">
													<select name="invitation_design_style" id="invitation_design_style" class="eve_text_main_form_select">
														<option value="">Select Design Style</option>
														<option value="Design 1">Design 1</option>	
														<option value="Design 2">Design 2</option>
														<option value="Design 3">Design 3</option>
														<option value="Design 4">Design 4</option>
														<option value="Design 5">Design 5</option>											
													</select>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name" style="width:100%; text-align:left">Enter your personal message: </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="height:250px;">
                                        <div class="reg_wid_form_input_box" style="width:450px;">
											<?php
												$oFCKeditor = new FCKeditor('invitation_message') ;
												$oFCKeditor->BasePath = 'fckeditor/';
												$oFCKeditor->Value = $invitation_message;
												$oFCKeditor->Height = 250;
												$oFCKeditor->Width = 350;
												$oFCKeditor->Create() ;
											?>   
                                        </div>
                                    </div>
									 <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name" style="width:905px; text-align:left">Enter the email addresses of the people you would like to invite below.<br /> Separate each of the email addresses by a comma:</div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="height:111px;">
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
                                            	<div class="cplus_acctcreateevent_tr"><textarea name="invitees" id="invitees"></textarea></div>
                                            </div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="padding-top:40px;"  >
										<a href="#"><img src="images/import_facebook_contact.png" border="0" /></a>
									</div>
									<div class="reg_wid_form_input_main" >
										<a href="#"><img src="images/import_gmail_contact.png" border="0" /></a>
									</div>
									
                                    	<div class="addevent_2btn_main"><input type="submit" name="send_invitation" id="send_invitation" class="addevent_2btn" value="" /></div>
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