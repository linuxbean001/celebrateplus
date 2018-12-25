<?php
 include("connect.php");
 if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
{
}
else
{
	$eve = $_REQUEST['eve_id'];
	location("login.php?frm=$eve");
}
 
 $eve_id = $_REQUEST['eve_id'];
  
 if(GetValue("events","oid","id",$eve_id) != $_SESSION['SESS_USER_ID'])
 {
 	$check_attendence = hb_get_result("select * from attendee where user_id='".$_SESSION['SESS_USER_ID']."' and event_id='".$eve_id."'");
	$is_regiestered = mysql_num_rows($check_attendence);
	if($is_regiestered > 0 && !($_REQUEST['attendee_id'] > 0))
	{
	?>
		<script language="javascript" type="text/javascript">
			alert("You have already confirmed attendance to this event");
			window.location.href='acc_event_detail.php?eve_id=<?=$eve_id;?>';
		</script>
	<? 
	exit;
	}
	else
	{
 	
	$eve_det_res = hb_get_result("select * from events where id=$eve_id and deleted != 1");
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
	$anonymous = $_REQUEST['anonymous'];

	if($how_mch > 0)
	{
		$funding = 'Yes';
	}
	else
	{
		$funding = 'No';
	}
	
	if($_REQUEST['attendee_id'] > 0)
	{
		$attendee_id = $_REQUEST['attendee_id'];
		$old_status_query = "select * from attendee where id='".$attendee_id."'";
		$old_status_result = mysql_query($old_status_query) or die(mysql_error());
		$old_status_row = mysql_fetch_array($old_status_result);
		if($old_status_row['is_attendee'] == 1)
		{
			$event_max_cap = GetValue("events","max_cap","id",$eve_id);
			/*=======Updating the space available field in events table by re-adding no. of peoples attending in the event=========*/	
				if($event_max_cap != "")
				{
					$tot_addendees = $old_status_row['tot_addendees'];
					$eve_upd = hb_get_result("update events set space_available=space_available+$tot_addendees where id=".$eve_id);
				}
			/*=======================================================================================================================*/			
		}
		$update_att12 = "update attendee set 
						status = 'Maybe',
						is_attendee = 0 
						where id='".$attendee_id."'";
		hb_get_result($update_att12) or die(mysql_error());
	}
	else
	{	
		$insert_att12 = "insert into attendee set 
		org_id='".$event_org."',
		event_id='".$eve_id."',
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
		anonymous = '".$anonymous."',
		funding='".$funding."',
		is_attendee='".$is_attendee."',
		user_id='".$_SESSION['SESS_USER_ID']."',
		status = 'Maybe'"; 		
		hb_get_result($insert_att12) or die(mysql_error());
	}
	
	
	//=============================================================
	
	//echo "select * from invitations_email where email='$org_email' and event_id='".$eve_id."'";
	$check_attendence2 = hb_get_result("select * from invitations_email where email='$org_email' and event_id='".$eve_id."'");
	$is_regiestered2 = mysql_num_rows($check_attendence2);
	$inc_del_row =  mysql_fetch_array($check_attendence2);
	$inc_del_row['id'];
	
	if($is_regiestered2 == 0)
	{
		
		
		
		$create_invitation_query = "insert into invitations set `event_id` = '$eve_id',`invitation_date` = now()";
		hb_get_result($create_invitation_query) or die(mysql_error());
 
	 	$last_inv_id= mysql_insert_id();
 
 		$create_invitation_email_query = "insert into invitations_email set
							  `event_id` = '$eve_id',
							  `invitations_id` = $last_inv_id,
							  `add_date` = now(),
							  `email` = '$org_email'";
 		hb_get_result($create_invitation_email_query) or die(mysql_error());
		
							  
 		
	}

	
	location("acc_event_detail.php?eve_id=".$eve_id."&goto=maybe");
 	
 }
 }
 else
 {
 	?>
		<script language="javascript" type="text/javascript">
			alert('As the owner of this event you must attend the event and not select the status maybe or not attending.');
			window.location.href='acc_event_detail.php?eve_id=<?=$eve_id;?>';
		</script>
	<?
	exit; 
 }
 	
?>