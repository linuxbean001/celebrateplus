<? include("connect.php");?>
<?
	if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
	{
	}
	else
	{
		$eve = $_REQUEST['eve_id'];
		location("login.php?frm=$eve");
	}
	//include("login_check.php");
	$page_content = GetValue("staticpage","content","id","24");
	$event_id = $_REQUEST['event_id'];
	/*if(!($_SESSION['notification_allowed'] == true))
	{
		location("index.php");
		exit;
	}*/
	
	/*====Query for checking that if user has already register to this event or not======*/
//echo "select * from attendee where user_id='".$_SESSION['SESS_USER_ID']."' and 		event_id='".$event_id."'";

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

/*=============================================================================================================*/	
	$eve_det_res = hb_get_result("select * from events where id=$event_id and deleted != 1");
	$eve_det_row = mysql_fetch_object($eve_det_res);	
	$event_nm = $eve_det_row->title;
	$event_org = $eve_det_row->oid;
	$event_title = $eve_det_row->title;
	$event_sdate = $eve_det_row->sdate;
	$event_edate = $eve_det_row->edate;
	$event_etime = $eve_det_row->etime;
	$event_stime = $eve_det_row->stime;
	$event_max_cap = $eve_det_row->max_cap;
	$event_loc_city = $eve_det_row->loc_city;
	$event_loc_state = $eve_det_row->loc_state; 
	$event_loc_name = $eve_det_row->loc_name;
	$event_loc_street = $eve_det_row->loc_street;
	$event_loc_suit = $eve_det_row->loc_suit;
	$event_loc_zip = $eve_det_row->loc_zip;
	$event_loc_country = $eve_det_row->loc_country;
	
	$org_dt =  hb_get_result("select fname,lname,email,id from organizer where id=".$_SESSION['SESS_USER_ID']);
	$org_rw = mysql_fetch_array($org_dt);
	$org_fname = $org_rw['fname'];
	$org_lname = $org_rw['lname'];
	$org_email = $org_rw['email'];  	
	$tot_addendees = $_REQUEST['tot_addendees'];
	$comments = $_REQUEST['comments'];
	$funding = $_REQUEST['donate'];
	$how_mch = $_REQUEST['how_mch'];
	if($how_mch > 0)
	{
		$funding = 'Yes';
	}
	else
	{
		$funding = 'No';
	}	
	
	$insert_att12 = "insert into attendee set 
	org_id='".$event_org."',
	event_id='".$event_id."',
	etitle='".$event_title."',
	esdate='".$event_sdate."',
	estime='".$event_stime."',
	eedate='".$event_edate."',
	eetime='".$event_etime."',
	ecity='".$event_loc_city."',
	estate='".$event_loc_state."',
	ufname='".$org_fname."',
	ulname='".$org_lname."',
	uemail='".$org_email ."',
	cdate=now(),
	tot_addendees='".$tot_addendees."',
	comments='".$comments."',
	how_mch = '".$how_mch."',
	funding='".$funding."',
	is_attendee='".$is_attendee."',
	user_id='".$_SESSION['SESS_USER_ID']."',
	gave_to_site='".$_SESSION['session_gave_to_site']."',
	gave_to_event_owner='".$_SESSION['session_gave_to_event_owner']."',
	commission_rate='".$_SESSION['session_commission_rate']."',
	payment_status='New'"; 
	hb_get_result($insert_att12) or die(mysql_error());
	
	$latest_id = mysql_insert_id();
	
	
/*Updating the space available field in events table by subtracting no. of peoples attending in the event*/	
	if($event_max_cap !="")
	{
		$eve_upd = hb_get_result("update events set space_available=space_available-$tot_addendees where id=".$event_id);
	 }
/*===========================================================*/

	 
	$to_email_org = GetValue("organizer","email","id",$event_org);
/*========================== Email for event confirmation=========================================*/
/*$body='
	<table width="523" border="0" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
	<tr>
		<td colspan=2>
			<div align="right" colspan="4" nowrap="nowrap">
				<strong>Your attendance has been confirmed to '.$event_nm.'. Your event details can be found below:</strong>
			</div>
		</td>
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
			<div align="right">
				<strong>Event Name: </strong>
			</div>
		</td>
		<td>
			<div align="left">'.$event_nm.' </div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="right"><strong>Start Date: </strong></div>
		</td>
		<td>
			<div align="left">'.convert_us($event_sdate).' </div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="right"><strong>Start Time: </strong></div>
		</td>
		<td>
			<div align="left">'.$event_stime.' </div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="right"><strong>End Date: </strong></div>
		</td>
		<td>
			<div align="left">'.convert_us($event_edate).' </div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="right"><strong>End Time: </strong></div>
		</td>
		<td>
			<div align="left">'.$event_etime.' </div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="right"><strong>Summary: </strong></div>
		</td>
		<td>
			<div align="left">'.stripslashes($comments).' </div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="right" valign="top"><strong>Event Location: </strong></div>
		</td>
		<td>
			<div align="left">'.$event_loc_name.'<br />'.$event_loc_street.'&nbsp;'.$event_loc_suit.'<br />'.$event_loc_city.'&nbsp;'.$event_loc_state.'&nbsp;'.$event_loc_zip.'&nbsp;'.$event_loc_country.'
			</div>
		</td>
	</tr>
	</table>';
	$to=$org_email;
	$from="info@celebrateplus.com";
	$mailcontent=$body;
	$subject="Your attendance has been confirmed to ".$event_title;
	SendHTMLMail1($to,$subject,$body,$from);*/

/*=========Email to the founder or organizer of the event=============*/
/*$body1='
	<table width="523" border="0" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
	<tr>
	<td colspan=2><div align="right" colspan="4" nowrap="nowrap">
	<strong>'.$org_fname.' '.$org_lname.' has confirmed their attendance to '.$event_title.'</strong>
	</div>
	</td>
	</tr>
	<tr><td height="10px;"></td></tr>	
	<tr><td height="10px;"></td></tr>
	<tr>
		<td><div align="right"><strong>Total Attendees: </strong></div></td>
		<td><div align="left">'.$tot_addendees.' </div></td>
	</tr>
	<tr><td height="10px;"></td></tr>
	<tr>
		<td><div align="right"><strong>Funding: </strong></div></td>
		<td><div align="left">'.$funding.' </div></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Funding Amount: </strong></div></td>
		<td><div align="left">'.$how_mch.' </div></td>
	</tr>	
	<tr>
		<td><div align="right"><strong>Confirmation Comments: </strong></div></td>
		<td><div align="left">'.stripslashes($comments).' </div></td>
	</tr>
	</table>';	
	$to=$to_email_org;
	$from="info@celebrateplus.com";
	$mailcontent=$body1;
	$subject= $org_fname." ".$org_lname." has confirmed their attendance to ".$event_title;
	SendHTMLMail1($to,$subject,$body1,$from);*/
/*=======================================*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Thank you for contributing to the event <?=$event_nm?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
							<div class="myacc_menu_main">	
							<? include("account_menu.php");?>
							</div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
								<? if($is_attendee == 1){ ?>
                            	<div class="tab_box_bg_inner_left_text_regconf">Your attendance to the event <?=$event_nm?> has been confirmed. To view the event details in the future please view the <a href="event_attending.php">Events I'm Attending</a> tab within your account.</div>
								<?
									}else{
								?>
								<div class="tab_box_bg_inner_left_text_regconf">Thanks for your contribution for the event <?=$event_nm?>!</div>
								<div class="tab_box_bg_inner_left_text_regconf"><br /><?=$page_content?>.</div>
								<?
									}
								?>
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
<?
	unset($_SESSION['notification_allowed']);
?>