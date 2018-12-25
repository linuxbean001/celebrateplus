<?php
include("connect.php");
$event_mail_IR="Reminder";
$event_mail_header="An event reminder for";
include("login_check.php");
$event_id = $_REQUEST['event_id'];
$event_name = GetValue("events","title","id",$event_id);
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
		
		if($_SESSION['personal_photo'] == '')
		{
			$personal_photo="";
			
			if ($_FILES["personal_photo"]["error"] > 0)
			{
				//echo "Error: " . $_FILES["full"]["error"] . "<br />";
			}
			else
			{
			   
			   $personal_photo = rand(1,999).trim($_FILES["personal_photo"]["name"]); 
			   move_uploaded_file($_FILES["personal_photo"]["tmp_name"],"uploads/".$personal_photo);
			   $_SESSION['personal_photo'] = $personal_photo;
			   
			   if($invitation_design_style == 11)
			   {
			   		$width = 386;
			   }
			   else if($invitation_design_style == 12)
			   {
				   	$width = 600;
			   }
			    $thumb_image_path = "thumb_".$personal_photo;
				include('SimpleImage.php');
				$image = new SimpleImage();
				$image->load('uploads/'.$personal_photo);
				$image->resizeToWidth($width);
				$image->save('uploads/'.$thumb_image_path);
				$_SESSION['personal_photo'] = $thumb_image_path;
			}
		}
		
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
			$mail_from = GetValue("organizer","fname","id",$organizer_id)." ".GetValue("organizer","lname","id",$organizer_id)."<".GetValue("organizer","email","id",$organizer_id).">";			
			hb_send_mail($mail_to,$mail_subject,$mail_body,$mail_from);			
		}
		unset($_SESSION['personal_photo']);
		location("event_reminder.php?msg1=1&event_id=".$event_id);
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
		padding: 6px 0 0 0;
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
<?php $redirect_link_after_invitation_complate = "facebook_reminder_confirmation.php"; ?>
<? include_once("include_social_functions.php"); ?>
<?php include_once("google_analytics.php");?>
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
								<?php if($_REQUEST['msg1'] == 1) {?>
								 <div style="width:100%; text-align:center; height:auto; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000;">
									Your reminder have been sent! Also, don't forget to use Facebook, Twitter and LinkedIn to share the event socially.							
								 </div>
								<?php } ?>
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								<form action="event_reminder.php" target="_self" name="create_invitation" id="create_invitation" enctype="multipart/form-data" method="post" onSubmit="javascript:return check_validation()" >
								
                                <div class="col-md-12">
                                	<div class="col-md-6">
                                       <ul style="margin-left:0px; padding-left:0px;" class="categoryitems2">
                                       		<li>
												<div style="float:left;width:100%;">
													<div style="float:left">
														<a href="event_reminder.php?event_id=<?=$event_id;?>">
															<img width="24" height="24" src="images/email_envelope.png">
														</a>
													</div>
													<div style="float: left; padding-top: 5px;">	
														<a href="event_reminder.php?event_id=<?=$event_id;?>">
															&nbsp;&nbsp;&nbsp;Email
														</a>
													</div>
                                           		</div>
												<div style="float:left;width:100%;">
													..........................................
												</div>
											</li>                                            
											<li>
												<div style="float:left;width:100%;">
													<div style="float:left">														
														<a href="javascript:;" onClick="javascript:fb_invitation_option();">
															<img width="24" height="25" src="images/facebook.gif">
														</a>
													</div>
													<div style="float: left; padding-top: 5px;">
														<!--<a href="javascript:;" onClick="javascript:hb_sending_friend_request_to_multiple_friends()">-->
														<a href="javascript:;" onClick="javascript:fb_invitation_option();">
															&nbsp;&nbsp;&nbsp;Facebook
														</a>
													</div>
                                           		</div>
												<div style="float:left;width:220px;">
													..........................................
												</div>
											</li>											                                           
                                            <li>
												<div style="float:left;width:220px;">
													<div style="float:left">
														<a href="javascript:;" onClick="javascript:send_twitter_invite();">
															<img width="24" height="25" src="images/twitter.gif">
														</a>
													</div>
													<div style="float: left; padding-top: 5px;">
														<a href="javascript:;" onClick="javascript:send_twitter_invite();">
															&nbsp;&nbsp;&nbsp;Twitter
														</a>											
                                            		</div>
                                           		</div>
												<div style="float:left;width:220px;">
													..........................................
												</div>
											</li>
                                            <li>
												<div style="float:left;width:220px;">
													<div style="float:left">
														<a href="javascript:;" onClick="javascript:send_linkedin_invite();">
															<img width="24" height="27" src="images/linkedin.gif">
														</a>
													</div>
													<div style="float: left; padding-top: 5px;">
														<a href="javascript:;" onClick="javascript:send_linkedin_invite();">
															&nbsp;&nbsp;&nbsp;LinkedIn
														</a>											
                                            		</div>
                                           		</div>
												<div style="float:left;width:220px;">
													..........................................
												</div>
                                            </li>
                                            <li style="background-image:none; list-style:none; height:8px;">&nbsp;</li>
                                        </ul>  
                                    </div>
                                	<div class="col-md-6">
                                    	<div class="form_login_title">Create Your Reminder</div>
                                	<div class="reg_wid_form_input_main">
                                    	Select the design for your reminder email: <span style="color:#FF0000;">*</span>
                                    </div>
									<div>
									<div class="form-group">
										<select name="invitation_design_style" id="invitation_design_style" class="form-control" onChange="show_priview(this.value);">
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
										<a href="view_invitation_design.php" target="_blank">View Reminder Design Options</a>
                                    </div>
									<div class="form-group" style="display:none;" id="personal_photo_div" >
										<div>Upload Your Personal Photo: </div>
										<input type="file" class="form-control" name="personal_photo" id="personal_photo" />				
                                    </div>
									<div class="form-group">
                                    	<div class="">Enter your personal message: </div>
                                    </div>
									<div class="form-group">
										<textarea name="invitation_message" class="form-control"><?=$invitation_message?></textarea> 
                                    </div>
									
									</div>
									<a href="javascript:void();" onClick="open_reminder_preview()">
									<div id="priview_image_div1" style="display:none;">
										<img src="invitation_design_images/image_design1.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div2" style="display:none;">
										<img src="invitation_design_images/image_design2.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div3" style="display:none;">
										<img src="invitation_design_images/image_design3.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div4" style="display:none;">
										<img src="invitation_design_images/image_design4.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div5" style="display:none;">
										<img src="invitation_design_images/image_design5.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div6" style="display:none;">
										<img src="invitation_design_images/image_design6.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div7" style="display:none;">
										<img src="invitation_design_images/image_design7.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div8" style="display:none;">
										<img src="invitation_design_images/image_design8.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div9" style="display:none;">
										<img src="invitation_design_images/image_design9.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div10" style="display:none;">
										<img src="invitation_design_images/image_design10.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div11" style=" display:none;">
										<img src="invitation_design_images/image_design11.png" id="priview_image" width="375" />
									</div>
									<div id="priview_image_div12" style="display:none;">
										<img src="invitation_design_images/image_design12.png" id="priview_image" width="375" />
									</div>
                                    </a>
										
                                    </div>
                                    <div class="addevent_2btn_main">
										<input type="image" src="images/send_reminder.png" width="126" height="34" name="send_invitation" id="send_invitation" onClick="submit_invitation()"  value="" />
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
		<!------------------------------------->
			
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		<?php 
			$fb_link = $SITE_URL."event_detail.php?eve_id=".$_REQUEST['event_id'];
			$org_fname = stripslashes(GetValue("organizer","fname","id",$_SESSION['SESS_USER_ID']));
			$org_lname = stripslashes(GetValue("organizer","lname","id",$_SESSION['SESS_USER_ID']));
			$event_title = stripslashes(GetValue("events","title","id",$_REQUEST['event_id']));
			$site_logo = $SITE_URL."images/logo_invite_email.png";
			$fb_message = $org_fname." ".$org_lname." has invited you to an event ";
		?>
		<div id="confirmOverlay" style="display: none;">
			<div id="confirmBox">
				<h1>Facebook Invitation  <img src="jquery.confirm/delete_icon.png" onClick="javascript:hide_this();"  style="float:right; margin-top:-5px; cursor:pointer;"/></h1>
				<!--<p>title</p>-->
				<div id="confirmButtons">
					<a class="button" href="javascript:;" onClick="javascript:hide_this(),hb_sharing_a_text('<?php echo $fb_link?>','<?php echo $event_title; ?>','<?php echo $site_logo;?>','<?php echo addslashes($fb_message);?>')">Post to Your Wall</a><br /> <br />
					<a class="button" href="javascript:;" onClick="javascript:hide_this(),hb_sharing_a_text_new('<?php echo $fb_link?>','<?php echo $event_title; ?>','<?php echo $site_logo;?>','<?php echo addslashes($fb_message);?>')">Send a Message to Your Friends</a>
				</div>
			</div>
		</div>
		
	<!------------------------------------->
    </body>
</html>
<script type="text/javascript">
	function fb_invitation_option()
	{
		document.getElementById("confirmOverlay").style.display='block';
	}
	function hide_this() 
	{
		document.getElementById("confirmOverlay").style.display='none';
	}
	function check_validation()
	{
		if(document.getElementById("invitation_design_style").value.split(" ").join("") == "")
		{
			alert("Please select a design style for the invitation that you are sending.");
			document.getElementById("invitation_design_style").focus();
			return false;
		}
		if(document.getElementById("personal_photo_div").style.display == "block")
		{
			if(document.getElementById("personal_photo").value == '')
			{
				alert("Please upload your photo.");
				document.getElementById("personal_photo").focus();
				return false;
			}
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
		if(div_id != "" && (div_id == 11 || div_id == 12))
		{ document.getElementById("personal_photo_div").style.display="block"; }	
		else
		{ document.getElementById("personal_photo_div").style.display="none"; }		
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