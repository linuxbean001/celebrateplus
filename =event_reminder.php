<?php
include("connect.php");
$event_mail_IR="Reminder";
$event_mail_header="An event reminder for";
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
	$invitation_message = $_REQUEST['invitation_message'];
	// First check whether this person has right to send invitation for this event	
	if(GetValue("events","oid","id",$event_id) == $_SESSION['SESS_USER_ID'])
	{
		$invitation_design_style = $_REQUEST['invitation_design_style'];
		
		$get_email_inve = "select email from invitations_email where event_id=".$event_id;
		$res_email_inve = hb_get_result($get_email_inve) or die(mysql_error());
		if(mysql_num_rows($res_email_inve) > 0)
		{
			while($row_email_inve = mysql_fetch_array($res_email_inve))
			{
				$email1[]= strtolower($row_email_inve['email']);
			}
		}
		$organizer_id=GetValue("events","oid","id",$event_id);
		$get_email_atten = "select uemail,status from attendee where event_id=".$event_id." and org_id=".$organizer_id."";
		$res_email_atten = hb_get_result($get_email_atten) or die(mysql_error());
		if(mysql_num_rows($res_email_atten) > 0)
		{
			while($row_email_atten = mysql_fetch_array($res_email_atten))
			{
				
				if($row_email_atten['status'] != 'Not Attending')
				{
					$email1[]= strtolower($row_email_atten['uemail']);
				}
				else
				{
					$key = array_search($row_email_atten['uemail'],$email1);
					
					if($key)
					{
						unset($email1[$key]);
					}
				}
			}
		}
		
		$final_email = array_unique($email1);	
		
		$event_name = GetValue("events","title","id",$event_id);
		$mail_subject = "An event reminder for $event_name";
			
		$organizer_first_name = GetValue("organizer","fname","id",$organizer_id);
		$organizer_last_name = GetValue("organizer","lname","id",$organizer_id);
		
		foreach( $final_email as $final_email2)
		{
			
			$mail_to = $final_email2;
			
			if($invitation_design_style == "1")
			{
				include('email_design_1.php');
			}
			if($invitation_design_style == "2")
			{
				include('email_design_2.php');
			}
			if($invitation_design_style == "3")
			{
				include('email_design_3.php');
			}
			if($invitation_design_style == "4")
			{
				include('email_design_4.php');
			}
			if($invitation_design_style == "5")
			{
				include('email_design_5.php');
			}
			if($invitation_design_style == "6")
			{
				include('email_design_6.php');
			}
			if($invitation_design_style == "7")
			{
				include('email_design_7.php');
			}
			if($invitation_design_style == "8")
			{
				include('email_design_8.php');
			}
			if($invitation_design_style == "9")
			{
				include('email_design_9.php');
			}
			if($invitation_design_style == "10")
			{
				include('email_design_10.php');
			}	
			if($invitation_design_style == "11")
			{
				include('email_design_11.php');
			}	
			if($invitation_design_style == "12")
			{
				include('email_design_12.php');
			}		
			
			$mail_from = GetValue("organizer","email","id",$organizer_id);
			
			hb_send_mail($mail_to,$mail_subject,$mail_body,$mail_from);
			unset($_SESSION['personal_photo11']);
			unset($_SESSION['personal_photo12']);
		}
		location("event_invitees.php?msg=1&edit_id=".$event_id);
	}
	else
	{
		location("index.php");
	}
}
?>
<? 
	
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
		background-image:url(images/send.png);
		width:126px;
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
	.reg_wid_form_input_main
	{
		width:850px !important;
	}
</style>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#personal_photo11').live('change', function()			{ 
			           $("#priview_image_div11").html('');
			    $("#priview_image_div11").html('<img src="loader.gif" alt="Uploading...."/>');
				document.getElementById("create_invitation").action="ajaximage11.php";
			$("#create_invitation").ajaxForm({
						target: '#priview_image_div11'
		}).submit();
		document.getElementById("create_invitation").action="event_reminder.php";
			});
			
			 $('#personal_photo12').live('change', function()			{ 
			           $("#priview_image_div12").html('');
			    $("#priview_image_div11").html('<img src="loader.gif" alt="Uploading...."/>');
				document.getElementById("create_invitation").action="ajaximage12.php";
			$("#create_invitation").ajaxForm({
						target: '#priview_image_div12'
		}).submit();
		document.getElementById("create_invitation").action="event_reminder.php";
			});
        }); 
</script>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Send a Reminder for <?=GetValue("events","title","id",$event_id);;?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								<form action="event_reminder.php" name="create_invitation" id="create_invitation" enctype="multipart/form-data" method="post" onSubmit="javascript:return check_validation()" >
								
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
                                    	<div class="form_login_title" style="width:668px;">Create Your Reminder</div>
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name" style="width:100%; text-align:left">Select the design for your reminder email: <span style="color:#FF0000;">*</span></div>
                                    </div>
									<div style="float:left; width:50%">
									<div class="reg_wid_form_input_main" style="height:50px; width:360px;" >
                                        <div class="reg_wid_form_input_box" style="width:360px;">
											<div class="eve_text_main_form_input">
													<select name="invitation_design_style" id="invitation_design_style" class="eve_text_main_form_select" onChange="show_priview(this.value);">
														<option value="">Select Design Style</option>
														<option value="1">Design 1</option>	
														<option value="2">Design 2</option>
														<option value="3">Design 3</option>
														<option value="4">Design 4</option>
														<option value="5">Design 5</option>
														<option value="6">Design 6</option>
														<option value="7">Design 7</option>
														<option value="8">Design 8</option>
														<option value="9">Design 9</option>
														<option value="10">Design 10</option>	
														<option value="11">Custom Photo Vertical</option>
														<option value="12">Custom Photo Horizontal</option>										
													</select>
											</div>
                                        </div>
										<div class="reg_wid_design_priview_link"><a href="view_invitation_design.php" target="_blank">View Reminder Design Options</a> </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="height:50px; width:360px; display:none;" id="personal_photo_div11" >
                                        <div class="reg_wid_form_input_box" style="width:360px;">
											<div class="reg_wid_form_name" style="width:350px; text-align:left">Upload Your Personal Photo: </div>
											<div class="" style=" padding-bottom:15px;">
												<input type="file" name="personal_photo11" id="personal_photo11" />	
											</div>
                                        </div>										
                                    </div>
									<div class="reg_wid_form_input_main" style="height:50px; width:360px; display:none;" id="personal_photo_div12" >
                                        <div class="reg_wid_form_input_box" style="width:360px;">
											<div class="reg_wid_form_name" style="width:350px; text-align:left">Upload Your Personal Photo: </div>
											<div class="" style=" padding-bottom:15px;">
												<input type="file" name="personal_photo12" id="personal_photo12" />	
											</div>
                                        </div>										
                                    </div>
									<div class="reg_wid_form_input_main"  style="width:360px;">
                                    	<div class="reg_wid_form_name" style="width:350px; text-align:left">Enter your personal message: </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="height:320px;width:340px;">
                                        <div class="reg_wid_form_input_box" style="width:330px;">
											
											<textarea name="invitation_message" style="width:100%;height:300PX"><?=$invitation_message?></textarea> 
									  
                                        </div>
                                    </div>
									<div class="addevent_2btn_main" style="padding:0px; width:340px; text-align:center;">
										<input type="image" src="images/send_reminder.png" width="126" height="34" name="send_invitation" id="send_invitation" onClick="submit_invitation()"  value="" />
										</div>
									</div>
									<a href="javascript:void();" onClick="open_reminder_preview()">
									<div id="priview_image_div1" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design1.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div2" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design2.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div3" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design3.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div4" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design4.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div5" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design5.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div6" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design6.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div7" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design7.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div8" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design8.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div9" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design9.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div10" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design10.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div11" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design11.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div12" style="float:right; width:320px; height:300px; display:none;">
										<img src="invitation_design_images/image_design12.png" id="priview_image" width="375" />
									</div>
                                    </a>
										
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
	var last_div=1;
	function show_priview(div_id)
	{
		if(div_id != "" && (div_id == 11))
		{ 
			document.getElementById("personal_photo_div11").style.display="block";
			document.getElementById("personal_photo_div12").style.display="none";
		}
		else if(div_id != "" && (div_id == 12))
		{  
			document.getElementById("personal_photo_div12").style.display="block";
			document.getElementById("personal_photo_div11").style.display="none";
		}
		else
		{ 
			document.getElementById("personal_photo_div11").style.display="none";
			document.getElementById("personal_photo_div12").style.display="none";
		}		
		document.getElementById("priview_image_div"+last_div).style.display="none";	
		document.getElementById("priview_image_div"+div_id).style.display="block";	
		last_div=div_id;		
	}
	function open_reminder_preview()
	{
		if(document.getElementById("invitation_design_style").value.split(" ").join("") == "")
		{
			alert("Please select a design style for the invitation that you are sending.");
			document.getElementById("invitation_design_style").focus();
			return false;
		}
		document.forms.create_invitation.action="open_reminder_preview.php";
		document.forms.create_invitation.target="_blank";
		document.forms.create_invitation.submit();
	}
	function submit_invitation()
	{
		document.forms.create_invitation.action="event_reminder.php";
		document.forms.create_invitation.target="_self";	
	}
</script>