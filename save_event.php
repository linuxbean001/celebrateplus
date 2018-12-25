<? include("connect.php");
	include_once("config.inc.php");
	if(isset($_REQUEST['submitted']))
	{
		/*------------------------------ Validate User to create event ---------------*/
	
			$event_result_array = sh_get_validate_user_to_create_event_vars();
			$total_funding_event = $event_result_array['total_funding_event'];
			$total_fund_active_event = $event_result_array['total_fund_active_event'];
			$fund_allowed = $_REQUEST['funding'];
			
			if($fund_allowed == "Yes")
			{
				if($total_funding_event >= 3)
				{
					?>
						<script language="javascript">
							alert("Due to money laundering policies upheld by CelebratePlus, we can only allow you to host 3 events which collect funding per year. The year period is determined based on your signup date.");
							window.history.go(-1);
						</script>
					<?php
					exit;
				}
				else if($total_fund_active_event >= 2) 
				{ 	
					?>
						<script language="javascript">
							alert("Due to money laundering policies upheld by CelebratePlus, we can only allow 2 events to collect funding at the same time.");
							window.history.go(-1);
						</script>
					<?php
					exit;
				}
			}
		
		/*----------------------------------------------------------------------------*/
		if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0) {}
		else
		{
			$username= addslashes($_REQUEST['username']);
			$password= keshav_encrypt($_REQUEST['password']);
			unset($_REQUEST['cpassword']);
			unset($_REQUEST['password']);
			$email= addslashes($_REQUEST['email']);
			$fname= addslashes($_REQUEST['fname']);
			$lname= addslashes($_REQUEST['lname']);
			$phone= addslashes($_REQUEST['phone']);
			$country= addslashes($_REQUEST['country']);
			$state= addslashes($_REQUEST['state']);
			$opted_email= addslashes($_REQUEST['opted_email']);

			$query = "insert into organizer set add_date=now(),password='$password',email='$email',fname='$fname',lname='$lname',phone='$phone',opted_email='$opted_email',username='$username',state='$state',country='$country'";
			$printrrequest = print_r($_REQUEST,true);
			$query3 = addslashes($query);
			$query2 = "INSERT INTO registerLog SET request='$printrrequest', queryStr = '$query3' ";
			//echo $query2;
			hb_get_result($query2);
			$date = date('Y-m-d H:i:s');
			file_put_contents("registerLog.txt", "$date: $query2 \n\n", FILE_APPEND);
			hb_get_result($query) or die(mysql_error());
			$_SESSION['SESS_USER_ID'] = mysql_insert_id(); 
		
			if($_REQUEST['opted_email'] == "true")
			{
				if(!GTG_is_dup_add('maillist','email',$email))
				{
					$query = "insert into maillist set email='$email'"; 							
						hb_get_result($query) or die(mysql_error());																						
				}		
			}
		}
		
		$oid = $_SESSION['SESS_USER_ID'];
		$title= addslashes($_REQUEST['title']);
		$sdate= addslashes(get_database_date($_REQUEST['sdate']));
		$stime= addslashes($_REQUEST['stime']);
		$edate= addslashes(get_database_date($_REQUEST['edate']));
		$etime= addslashes($_REQUEST['etime']);
		$max_cap= addslashes($_REQUEST['max_cap']);
		$summary= addslashes($_REQUEST['title']);//addslashes($_REQUEST['summary121']);
		$description= addslashes($_REQUEST['description121']);
		$loc_name= addslashes($_REQUEST['loc_name']);
		$loc_street= addslashes($_REQUEST['loc_street']);
		$loc_suite= addslashes($_REQUEST['loc_suite']);
		$loc_city= addslashes($_REQUEST['loc_city']);
		$loc_state= addslashes($_REQUEST['loc_state']);
		$loc_zip= addslashes($_REQUEST['loc_zip']);
		$loc_country= addslashes($_REQUEST['loc_country']);
		$fund_amt= addslashes($_REQUEST['fund_amt']);
		$current_fund= addslashes($_REQUEST['current_fund']);
		$fund_end_date= addslashes(get_database_date($_REQUEST['fund_end_date']));
		$payment= addslashes($_REQUEST['payment']); 
		$max_don_amt= addslashes($_REQUEST['max_don_amt']);
		$donate_to_attend= addslashes($_REQUEST['donate_to_attend']);
		$define_donation_levels= addslashes($_REQUEST['define_donation_levels']);
		
		$df_friends= addslashes($_REQUEST['df_friends']);
		$df_bronze= addslashes($_REQUEST['df_bronze']);
		$df_silver= addslashes($_REQUEST['df_silver']);
		$df_gold= addslashes($_REQUEST['df_gold']);
		$df_platinum= addslashes($_REQUEST['df_platinum']);
		$df_benefactor= addslashes($_REQUEST['df_benefactor']);
		
		$searchable= addslashes($_REQUEST['searchable']);
		$display_fund= addslashes($_REQUEST['display_fund']);
		$attendee_list_public= addslashes($_REQUEST['attendee_list_public']);
		$space_available= $_REQUEST['max_cap'];
		$paypalid = $_REQUEST['paypalid'];
	
		$fund_allowed = $_REQUEST['funding'];
		$map_link = $_REQUEST['map_link'];
		
		$image_path="";

		$socialArray = array();

		if($_REQUEST['email'] != "") $socialArray[] = "email";
		if($_REQUEST['twitter'] != "") $socialArray[] = $_REQUEST['twitter'];
		if($_REQUEST['facebook'] != "") $socialArray[] = $_REQUEST['facebookType'];
		if($_REQUEST['linkedin'] != "") $socialArray[] = $_REQUEST['linkedin'];

		$invitation_design_style = $_REQUEST['invitation_design_style'];
		$invitation_message = $description;
		$invitees = $_REQUEST['invitees'];

		unset($_SESSION['personal_photo']);
		if($_SESSION['personal_photo'] == '' && isset($_FILES))
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
				include_once('SimpleImage.php');
				$image = new SimpleImage();
				$image->load('uploads/'.$personal_photo);
				$image->resizeToWidth($width);
				$image->save('uploads/'.$thumb_image_path);
				$_SESSION['personal_photo'] = $thumb_image_path;
			}
		}
		
    	if ($_FILES["image_path"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["full"]["error"] . "<br />";
		}
		else
		{
		   
		   $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
		   move_uploaded_file($_FILES["image_path"]["tmp_name"],"event_images/".$image_path);
		}
					// If the user has entered the paypal id in create_event.php page then we should update it in organizer table
					if($paypalid != '')
					{
						$update_query = "update organizer set paypalid = '$paypalid' where id = '".$_SESSION['SESS_USER_ID']."' limit 1";
							
						hb_get_result($update_query) or die(mysql_error());
					}
		
				 	$query = "insert into events 
					set
					 display_order='$display_order',
					 oid='$oid',
					 add_date=now(),
					 title='$title',
					 sdate='$sdate',
					 stime='$stime',
					 edate='$edate',
					 etime='$etime',
					 max_cap='$max_cap',
					 summary='$summary',
					 description='$description',
					 loc_name='$loc_name',
					 loc_street='$loc_street',
					 loc_suite='$loc_suite',
					 loc_city='$loc_city',
					 loc_state='$loc_state',
					 loc_zip='$loc_zip',
					 loc_country='$loc_country',
					 fund_amt='$fund_amt',
					 current_fund='$current_fund',
					 fund_end_date='$fund_end_date',
					 payment='$payment',
					 max_don_amt='$max_don_amt',
					 donate_to_attend='$donate_to_attend',
					 define_donation_levels='$define_donation_levels',
					 
					 df_friends='$df_friends',
					 df_bronze='$df_bronze',
					 df_silver='$df_silver',
					 df_gold='$df_gold',
					 df_platinum='$df_platinum',
					 df_benefactor='$df_benefactor',
					 
					 display_fund='$display_fund',
					 attendee_list_public='$attendee_list_public',
					 searchable='$searchable',
					 space_available='$space_available',
					 image_path='$image_path',
					 map_link='$map_link',
					 fund_allowed='$fund_allowed'"; 
					//echo $query;
					hb_get_result($query) or die(mysql_error());
					$id_of_event_created_last = mysql_insert_id();
	if(mysql_insert_id() > 0)
	{
/*=================================Event creation confirmation email=========================================*/
	$body='<table width="523" border="0" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
	<tr>
		<td colspan=2>
			<div align="right" colspan="4" nowrap="nowrap"><strong>You have successfully created the event  '.$title.'</strong></div></td>
		
	</tr>
	<tr>
	<td height="10px;"></td>
	</tr>
	<tr>
	<td height="10px;" align="right"><strong>Event Details</strong></td>
	</tr>
	<tr>
	<td height="10px;"></td>
	</tr>
	<tr>
		<td>
		<div align="right"><strong>Event Name: </strong></div></td>
		<td><div align="left">'.$title.' </div></td>
	</tr>
	
	<tr>
		<td>
		<div align="right"><strong>Start Date: </strong></div></td>
		<td><div align="left">'.convert_us($sdate).' </div></td>
	</tr>
	<tr>
		<td>
		<div align="right"><strong>Start Time: </strong></div></td>
		<td><div align="left">'.$stime.' </div></td>
	</tr>
	
	<tr>
		<td>
		<div align="right"><strong>End Date: </strong></div></td>
		<td><div align="left">'.convert_us($edate).' </div></td>
	</tr>
	<tr>
		<td>
		<div align="right"><strong>End Time: </strong></div></td>
		<td><div align="left">'.$etime.' </div></td>
	</tr>
	<tr>
		<td>
		<div align="right"><strong>Summary: </strong></div></td>
		<td><div align="left">'.$summary.' </div></td>
	</tr>
	
	<tr>
		<td>
		<div align="right" valign="top"><strong>Event Location: </strong></div></td>
		<td><div align="left">'.$loc_name.'<br />'.$loc_street.'&nbsp;'.$loc_suit.'<br />
		'.$loc_city.'&nbsp;'.$loc_state.'&nbsp;'.$loc_zip.'&nbsp;'.$loc_country.'
		
		
		 </div></td>
	</tr>
	
	</table>';
	

$org_email = GetValue("organizer","email","id",$oid);
$to=$org_email;

$from="info@celebrateplus.com";

$mailcontent=$body;
$subject="You have successfully created the event ".$title;

$event_id = $id_of_event_created_last;
$fb_link = $SITE_URL."event_detail.php?eve_id=".$event_id;
$org_fname = stripslashes(GetValue("organizer","fname","id",$_SESSION['SESS_USER_ID']));
$org_lname = stripslashes(GetValue("organizer","lname","id",$_SESSION['SESS_USER_ID']));
$event_title = stripslashes(GetValue("events","title","id",$event_id));
$site_logo = $SITE_URL."images/logo_invite_email.png";
$fb_message = $org_fname." ".$org_lname." has invited you to an event ";

$tmpSecure = $SITE_SECURE_URL;
$SITE_SECURE_URL = $SITE_URL;

include_once("include_social_functions.php");
include_once("createEmail.php");

if(in_array("email",$socialArray))
{
	createEmailInvitation($event_id,$invitation_design_style,$invitation_message,$invitees,$SITE_SECURE_URL);
}

if(in_array("Facebookpost",$socialArray))
{
	?> <script>hb_sharing_a_text('<?php echo $fb_link?>','<?php echo $event_title; ?>','<?php echo $site_logo;?>','<?php echo addslashes($fb_message);?>');</script> <?php
}

if(in_array("Facebookmessage",$socialArray))
{
	?> <script>hb_sharing_a_text_new('<?php echo $fb_link?>','<?php echo $event_title; ?>','<?php echo $site_logo;?>','<?php echo addslashes($fb_message);?>');</script> <?php
}


if(in_array("Twitter",$socialArray))
{
	?> <script>send_twitter_invite();</script> <?php
}

if(in_array("LinkedIn",$socialArray))
{
	?> <script>send_linkedin_invite();</script> <?php
}

$SITE_SECURE_URL = $tmpSecure;



//hb_send_mail($to,$subject,$body,$from);
/*===========================================================================================================*/					
}	
				/*if($_REQUEST['create_event_x'] > 0 && $_REQUEST['create_event_y'] > 0)
				{
					location("create_email_invitation.php?event_id=$id_of_event_created_last");
				}
				else if($_REQUEST['save_event_x'] > 0 && $_REQUEST['save_event_y'] > 0)
				{
					location("event_hosting.php");
				}*/

				//location("acc_event_detail.php?eve_id=$event_id");
	}
?>

<script>window.location = "acc_event_detail.php?eve_id=<?php echo $event_id ?>&mode=show";</script>