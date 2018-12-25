<? include("connect.php");
include("login_check.php");
	/*------------------------------ Validate User to create event ---------------*/
	
		$total_funding_event = 0;
		$total_fund_active_event = 0;
		if(GetValue("events","fund_allowed","id",$_REQUEST['edit_id']) != 'Yes')
		{
			$event_result_array = sh_get_validate_user_to_create_event_vars();
			$total_funding_event = $event_result_array['total_funding_event'];
			$total_fund_active_event = $event_result_array['total_fund_active_event'];
		}
		
	/*----------------------------------------------------------------------------*/
?>
<? 
	$acc_pg_name='edit_event';
	
$a = GetContent(16);?>
<?
	if(isset($_REQUEST["edit_id"]) && $_REQUEST["edit_id"] > 0)
	{
		$edit_id = $_REQUEST["edit_id"];											
		$fetchquery = "select * from events where id=".$edit_id;
		$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				$oid= stripslashes($row['oid']);
				$add_date= get_cplus_date(stripslashes($row['add_date']));
				$title= stripslashes($row['title']);
				$sdate= stripslashes($row['sdate']);
				$stime= stripslashes($row['stime']);
				$edate= stripslashes($row['edate']);
				$etime= stripslashes($row['etime']);
				$max_cap= stripslashes($row['max_cap']);
				$summary=$row['summary'];
				//$summary = str_replace("rn","\n", $summary); 
				$description = $row['description'];
				//$description= stripslashes($description);
				//$description = str_replace("rn","\n", $description); 
				$loc_name= stripslashes($row['loc_name']);
				$loc_street= stripslashes($row['loc_street']);
				$loc_suite= stripslashes($row['loc_suite']);
				$loc_city= stripslashes($row['loc_city']);
				$loc_state= stripslashes($row['loc_state']);
				$loc_zip= stripslashes($row['loc_zip']);
				$loc_country= stripslashes($row['loc_country']);
				$fund_amt= stripslashes($row['fund_amt']);
				$current_fund= stripslashes($row['current_fund']);
				$fund_end_date= stripslashes($row['fund_end_date']);
				$payment= stripslashes($row['payment']);
				$max_don_amt= stripslashes($row['max_don_amt']);
				$donate_to_attend = stripslashes($row['donate_to_attend']);
				$searchable = stripslashes($row['searchable']);
				$display_fund = stripslashes($row['display_fund']);
				$image_path = stripslashes($row['image_path']);
				$space_available= $row['space_available'];
				$fund_allowed = $row['fund_allowed'];
				$fund_amt = $row['fund_amt'];
				$fund_end_date = $row['fund_end_date'];
				$max_don_amt = $row['max_don_amt'];
				$donate_to_attend = $row['donate_to_attend'];
				$define_donation_levels = $row['define_donation_levels'];
				
				$df_friends = $row['df_friends'];
				$df_bronze = $row['df_bronze'];
				$df_silver = $row['df_silver'];
				$df_gold = $row['df_gold'];
				$df_platinum = $row['df_platinum'];
				$df_benefactor = $row['df_benefactor'];
				
				$attendee_list_public = $row['attendee_list_public'];
				$map_link = $row['map_link'];		
				
		}
	}
	
}
?>
<?
	if(isset($_REQUEST['Submit_aa']))
	{
		$fund_allowed = $_REQUEST['fund_allowed'];
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
		$edit_id= addslashes($_REQUEST['edit_id']);
		$title= addslashes($_REQUEST['title']);
		$sdate= addslashes(get_database_date($_REQUEST['sdate']));
		$stime= addslashes($_REQUEST['stime']);
		$edate= addslashes(get_database_date($_REQUEST['edate']));
		$etime= addslashes($_REQUEST['etime']);
		$max_cap= addslashes($_REQUEST['max_cap']);
		$summary = $_REQUEST['summary121'];
		$summary = mysql_real_escape_string($summary);
		//$summary= addslashes($summary);
		$description = $_REQUEST['description121'];
		$description = mysql_real_escape_string($description);
		//$description = addslashes($description);
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
		$searchable= addslashes($_REQUEST['searchable']);
		$display_fund= addslashes($_REQUEST['display_fund']);
		$paypalid = $_REQUEST['paypalid'];
		$fund_amt= addslashes($_REQUEST['fund_amt']);
		$fund_end_date= addslashes(get_database_date($_REQUEST['fund_end_date']));
		$max_don_amt= addslashes($_REQUEST['max_don_amt']);
		$donate_to_attend= addslashes($_REQUEST['donate_to_attend']);
		$fund_allowed = $_REQUEST['fund_allowed'];
		
		$define_donation_levels= addslashes($_REQUEST['define_donation_levels']);
		
		$df_friends= addslashes($_REQUEST['df_friends']);
		$df_bronze= addslashes($_REQUEST['df_bronze']);
		$df_silver= addslashes($_REQUEST['df_silver']);
		$df_gold= addslashes($_REQUEST['df_gold']);
		$df_platinum= addslashes($_REQUEST['df_platinum']);
		$df_benefactor= addslashes($_REQUEST['df_benefactor']);
		
		$attendee_list_public = addslashes($_REQUEST['attendee_list_public']);
		$map_link = addslashes($_REQUEST['map_link']);
		
		if($define_donation_levels != "yes")
		{
			$df_friends= "";
			$df_bronze= "";
			$df_silver= "";
			$df_gold= "";
			$df_platinum= "";
			$df_benefactor= "";
		}
		
		if($fund_allowed == "No")
		{
			$fund_amt= "";
			$fund_end_date= "";
			$max_don_amt= "";
			$donate_to_attend="";
		}
		
		
		$space_available = $_REQUEST['space_available'] + $max_cap - $_REQUEST['max_available'];
		
		$image_path="";
		
		
    	if ($_FILES["image_path"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["full"]["error"] . "<br />";
		}
		else
		{
		   
		   $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
		   move_uploaded_file($_FILES["image_path"]["tmp_name"],"event_images/".$image_path);
		}
		
					if($paypalid != '')
					{
						$update_query = "update organizer set paypalid = '$paypalid' where id = '".$_SESSION['SESS_USER_ID']."' limit 1";
							
						hb_get_result($update_query) or die(mysql_error());
					}
			
					$query = "update events set
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
							searchable='$searchable',
							space_available = '$space_available',
							fund_amt='$fund_amt',
							fund_end_date='$fund_end_date',
							max_don_amt='$max_don_amt',
							donate_to_attend='$donate_to_attend',
							attendee_list_public='$attendee_list_public',
							map_link='$map_link',
							fund_allowed='$fund_allowed' "; 
					
					if($image_path!="")
					{
						deleteimage(checkNum($_REQUEST['edit_id']));
						$query.=" , image_path='".$image_path."'";
					}
					$query.=" where id=".$_REQUEST['edit_id'];

					echo "<br/><br/>$query";
					
					hb_get_result($query) or die(mysql_error());
					location("edit_event.php?edit_id=".$_REQUEST['edit_id']."&msg=1");
				break;
				
				
		}
function deleteimage($iid)
	{
		$dquery = "select image_path from events where id=".$_REQUEST['edit_id'];
		$dresult = hb_get_result($dquery);
		while($drow = mysql_fetch_array($dresult))
		{
			$dfile = $drow['image_path'];
			if($dfile != "")
			{
				if(file_exists("event_images/".$dfile.""))
				{
					unlink("event_images/".$dfile."");
				}
			}
		}
		mysql_free_result($dresult);
	}		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Edit An Event</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
						<div style="text-align:center"><a href="<?php echo $SITE_URL;?>/event_attendees.php?edit_id=<?php echo $_REQUEST["edit_id"];?>"><img src="images/view_atteds.png" border="0"/></a> &nbsp; <a href="<?php echo $SITE_URL;?>/event_invitees.php?edit_id=<?php echo $_REQUEST["edit_id"];?>"><img src="images/view_invite.png" border="0"/></a> &nbsp; <a href="<?php echo $SITE_URL;?>/event_funding.php?edit_id=<?php echo $_REQUEST["edit_id"];?>"><img src="images/view_funding.png" border="0"/></a> &nbsp; <a href="<?php echo $SITE_URL;?>/event_reminder.php?event_id=<?php echo $_REQUEST["edit_id"];?>"><img src="images/send_remind.png" border="0"/></a> &nbsp; <a href="<?php echo $SITE_URL;?>/event_email_invitation.php?event_id=<?php echo $_REQUEST["edit_id"];?>"><img src="images/invite_more_people.png" border="0"/></a></div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<?php  
								if($total_funding_event >= 3)
								{
									?>
									<div class="tab_box_bg_inner_left_text_regconf" style="padding-top:10px; color:#FF0000;">Due to money laundering policies upheld by CelebratePlus, we can only allow you to host 3 events which collect funding per year. The year period is determined based on your signup date.<br /><br />
									 You can still add events to your account, however you can not have more than three events which have accepted funding per year.</div>	
									<?php
								}
								else if($total_fund_active_event >= 2) { ?>
								<div class="tab_box_bg_inner_left_text_regconf" style="padding-top:10px; color:#FF0000;">You currently have two events active and collecting funding. Due to money laundering policies that CelebratePlus upholds, you can only have two events active and collecting funding at the same time. <br /><br />
								You can still add events to your account, however you can not have more than two events which accept funding.</div>
								<?php } ?>
								<div class="tab_box_bg_inner_left_text_regconf" style="color:#FF0000; padding-top:10px; text-align:center;">
									<? 	if($_REQUEST['msg']==1)
										{
											echo 'Your event has been updated successfully.';
										}
									?>
								</div>
								
								<form name="CREATE_EVENT" id="CREATE_EVENT" enctype="multipart/form-data" action="edit_event.php" method="post" onSubmit="javascript:return crt_event_chk()">
								<input type="hidden" name="space_available" id="space_available" value="<?=$space_available?>" />
								<input type="hidden" name="max_available" id="max_available" value="<?=$max_cap?>" />
								<input type="hidden" name="edit_id" id="edit_id" value="<?=$_REQUEST['edit_id']?>" />
                                <div class="cplus_acctcreateevent">
                                	<div class="reg_wid_form_left">
                                    	<div class="form_login_title">Basic Event Information</div>
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Title<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="title" type="text" id="title" value="<?=$title?>" /></div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Page Image :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class=""><input type="file" name="image_path" id="image_path" ></div>
											 
                                        </div>
										<div style="float:right; width:180px;">
										<? 
											if($image_path!="" && file_exists("event_images/".$image_path))
											{
											?>
                    <img alt="image" src="include/sample.php?nm=../event_images/<?=$image_path;?>&mwidth=120&mheight=120" border="0" >
                    <?											
											}
										?>
											</div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Start Date :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
                                            	<input name="sdate" type="text" id="sdate" readonly="true" value="<? if( $sdate != "0000-00-00"){ echo get_cplus_date($sdate); }?>" />
												&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.CREATE_EVENT.sdate,'mm/dd/yyyy',this)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Start Time :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="stime" type="text" id="stime" value="<?=$stime?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event End Date :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
											<input name="edate" type="text" id="edate" value="<? if( $edate != "0000-00-00"){ echo get_cplus_date($edate); }?>" />
											&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.CREATE_EVENT.edate,'mm/dd/yyyy',this)" />
											</div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event End Time :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="etime" type="text" id="etime" value="<?=$etime?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name" style="width:155px;">Maximum Capacity :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="max_cap" type="text" id="max_cap" value="<?=$max_cap?>" /></div>
                                        </div>
                                    </div>
                                    	<div class="form_login_title" style="padding-left:25px; padding-top:70px; width:335px;">Location</div>                                    
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Name :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_name" type="text" value="<?=$loc_name?>" id="loc_name" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Street Address :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_street" type="text" value="<?=$loc_street?>" id="loc_street" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Suite # or Apt # :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_suite" type="text"  value="<?=$loc_suite?>" id="loc_suite" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">City :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_city" type="text" id="loc_city" value="<?=$loc_city?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">State / Province :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_state" type="text" id="loc_state" value="<?=$loc_state?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Zip / Postal Code :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_zip" type="text" id="loc_zip" value="<?=$loc_zip?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Country :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_country" type="text" id="loc_country" value="<?=$loc_country?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Map Link :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="map_link" type="text" id="map_link" value="<?=$map_link?>" /></div>
                                        </div>
                                    </div>
                                    <div class="addevent_2btn_main">
									
									<input type="image"  src="images/update.png"  name="a" id="a" class="update_btn" value=" " />
									<input type="hidden" name="Submit_aa" id="Submit_aa" value="Submit_aa" />
									
									
									
									</div>
                                    </div>
                                	<div class="cplus_acctcreateevent_right">
                                    	<div class="form_login_title">Description</div>
                                    	<div class="cplus_acctcreateevent_input_main">
                                        	<div class="cplus_acctcreateevent_name">Summary<span style="color:#FF0000;">*</span> :</div>
                                            <div class="cplus_acctcreateevent_tr_main">
                                            	<div class="cplus_acctcreateevent_tr"><textarea name="summary121" id="summary121"><?=$summary?></textarea></div>
                                            </div>
                                        </div>
                                        <div class="cplus_acctcreateevent_input_main">
                                        	<div class="cplus_acctcreateevent_name">Full Description :</div>
                                            <div class="cplus_acctcreateevent_tr_main">
                                            	<div class="cplus_acctcreateevent_tr"><textarea class='editor' name="description121" id="description121"><?=$description?></textarea></div>
                                            </div>
                                        </div>
                                        <div class="form_login_title" style="width:350px; padding-top:28px;">Event Funding</div>
                                    </div>
									<div style="float:left; width:360px; ">
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">I would like to accept funding for this event<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><div class="eve_text_main_form_input">
                                                	<select class="eve_text_main_form_select" name="fund_allowed" id="fund_allowed" onChange="show(this.value)" style="padding-top:0px;">
                                                    	<option value="">Select</option>
                                                    	<option <? if($fund_allowed == "Yes"){?> selected="selected" <? }?> value="Yes">Yes</option>
                                                        <option <? if($fund_allowed == "No"){?> selected="selected" <? }?> value="No">No</option>
                                                    </select>
                                                </div></div>
                                        </div>
                                    </div>
                                    <div style="float:left; <? if($fund_allowed != "Yes"){?>display:none;<? } ?>  width:120px;" id="funding_attributes">
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">PayPal ID<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
											<div style="width:250px;">
												<div class="reg_wid_form_input"><input name="paypalid" type="text" id="paypalid" value="<?=$GBV_CURRENT_USER_PAYPAL_ID;?>" /></div>
												<div style="float:left; padding-top:10px;">
														<img src="images/why.jpg" onMouseOver="document.getElementById('question_mark_title').style.display='block'" onMouseOut="document.getElementById('question_mark_title').style.display='none'"/>
														<div style="position:absolute; border:solid 1px #666666; color:#444444; padding:2px 5px; line-height:14px; font-size:11px; margin-left:15px; display:none; z-index:9999; width:210px; background-color:#DDDDDD; font-weight:normal; border-radius:5px;" id="question_mark_title">
															Your PayPal ID is the email address that you used when you registered your PayPal account.
														</div>
													</div>
											<?php /*?><?
												if($GBV_CURRENT_USER_PAYPAL_ID != '')
												{
												?>
												<input type="hidden" name="paypalid" id="paypalid" value="<?=$GBV_CURRENT_USER_PAYPAL_ID;?>" />
												<?
												}
											?><?php */?>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 0 45px; height:25px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">&nbsp;</div>
                                        <div class="reg_wid_form_input_box" style="height:25px;">
												<a href="payment_setup.php" class="common_link">Don't have a PayPal account?</a>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Target Funding Amount :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="fund_amt" type="text" id="fund_amt" value="<?=$fund_amt;?>" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Minimum Donation Amount :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="max_don_amt" type="text" id="max_don_amt" value="<?=$max_don_amt;?>"  /></div>
                                        </div>
                                    </div>
									 <?
										if($fund_end_date == '12/31/1969')
										{
											$fund_end_date = '';
										}
									  ?>
                                    <div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Funding Close Date :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
											<input name="fund_end_date" type="text" id="fund_end_date" value="<? if( $fund_end_date != "0000-00-00"){ echo get_cplus_date($fund_end_date); }?>" />
											&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.CREATE_EVENT.fund_end_date,'mm/dd/yyyy',this)" />
											</div>
                                        </div>
                                    </div>
                                    
									
									
									<div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:420px; float:left; text-align:left;">
                                        <span style="padding:0 10px 0 0; text-align:left;"><input type="checkbox" name="donate_to_attend" id="donate_to_attend" value="yes" <? if($donate_to_attend == "yes"){?> checked="checked"<? } ?> /></span>All attendees must donate to attend</div>
                                    </div>
									
									
									
									<div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:420px; float:left; text-align:left;">
                                        <span style="padding:0 10px 0 0; text-align:left;"><input type="checkbox" name="define_donation_levels" id="define_donation_levels" onChange="javascript:show_defin_d_level();" value="yes" <? if($define_donation_levels == "yes"){ ?> checked="checked" <? } ?>/></span>I would like to define donation levels</div>
                                    </div>
									<div id="defin_d_level" style="width:440px; float:left; <? if($define_donation_levels == "yes"){ ?> <? } else { ?>  display:none; <? } ?>">
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Friend :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="df_friends" type="text" id="df_friends" value="<?=$df_friends;?>" /></div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Bronze :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_bronze" type="text" id="df_bronze"  value="<?=$df_bronze;?>"/>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Silver :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_silver" type="text" id="df_silver" value="<?=$df_silver;?>" />
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Gold :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_gold" type="text" id="df_gold" value="<?=$df_gold;?>" />
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Platinum :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_platinum" type="text" id="df_platinum" value="<?=$df_platinum;?>"/>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Benefactor :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_benefactor" type="text" id="df_benefactor" value="<?=$df_benefactor;?>"/>
											</div>
                                        </div>
                                    </div>
									</div>
									</div>
									
                                    <div class="cplus_acctcreateevent_right">
                                        <div class="form_login_title" style="width:350px; padding-top:28px;">Event Privacy</div>
                                    </div>
                                    <div class="reg_wid_form_left">
                                    <div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:300px; text-align:left;">
                                        <span style="padding:0 10px 0 0;"><input type="checkbox" name="searchable" <? if($searchable=='yes'){?> checked="checked"<? }?> id="searchable" value="yes" /></span>Allow this event to be searchable</div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:372px; text-align:left;">
                                        <span style="padding:0 10px 0 0;"><input type="checkbox" name="display_fund" id="display_fund" <? if($display_fund=='yes'){?> checked="checked"<? }?> value="yes" /></span>Display funding details on event details page</div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:372px; text-align:left;">
                                        <span style="padding:0 10px 0 0;"><input type="checkbox" name="attendee_list_public" id="attendee_list_public" value="yes" <? if($attendee_list_public == "yes"){ ?> checked="checked" <? } ?> /></span>Make attendee list public</div>
                                    </div>
                                    </div>
									</div>
                                </div>
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
	function validate_monetary_value(obj,message)
	{
	   var temp_value = obj.value;
	
	   if (temp_value == "")
	   {
		 return true;
	   }
	   var Chars = "0123456789.,";
	   var str_length = temp_value.length;
	   for (var i = 0; i < str_length; i++)
	   {
		   if(i == str_length-1)
		   {
		   	Chars = "0123456789";
		   }
		   if (Chars.indexOf(temp_value.charAt(i)) == -1)
		   {
			   alert(message);
			   obj.focus();
			   return false;
		   }
		   if(temp_value.charAt(i) == '.' && Chars.indexOf(',') != -1)
		   {
		   		Chars = "0123456789";
		   }
	   }
	   return true;
	} 
	function crt_event_chk()
	{
		if(document.getElementById("title").value.split(" ").join("") == "")
		{
			alert("Please enter an event title.");
			document.getElementById("title").focus();
			return false;
		}
		if(document.getElementById("summary121").value.split(" ").join("") == "")
		{
			alert("Please enter an event summary.");
			document.getElementById("summary121").focus();
			return false;
		}
		if(document.getElementById("fund_allowed").value == "Yes")
		{	
			if(document.getElementById("paypalid").value.split(" ").join("") == "")
			{
				alert("Please enter your PayPal ID so that you can receive donations directly to your PayPal account.");
				document.getElementById("paypalid").focus();
				return false;
			}
			else
			{
				var emailPat=/^(.+)@(.+)\.(.+)$/
				var matchArray=document.getElementById("paypalid").value.match(emailPat)
			
				if (matchArray==null) 
				{
					alert("Please enter a valid PayPal ID. Your PayPal ID must be the email address that is affiliated with your PayPal account.")
					document.getElementById("paypalid").focus();
					return false;
				}
			}		
			if(!validate_monetary_value(document.getElementById("fund_amt"),"Please enter a valid target funding amount.")){ return false; }
			if(!validate_monetary_value(document.getElementById("max_don_amt"),"Please enter a valid minimum donation amount.")){ return false; }
		}
		if(document.getElementById("define_donation_levels").checked == true)
		{
			if(!validate_monetary_value(document.getElementById("df_friends"),"Please enter a valid value for the donation level friend.")){ return false; }			
			if(!validate_monetary_value(document.getElementById("df_bronze"),"Please enter a valid value for the donation level bronze.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_silver"),"Please enter a valid value for the donation level silver.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_gold"),"Please enter a valid value for the donation level gold.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_platinum"),"Please enter a valid value for the donation level platinum.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_benefactor"),"Please enter a valid value for the donation level benefactor.")){ return false; }
		}
		return true;
	
	}
function show(fund_allowed)
{
	if(fund_allowed == 'Yes')
	{
		<?php 
			if($total_funding_event >= 3)
			{
				?>
					alert("Due to money laundering policies upheld by CelebratePlus, we can only allow you to host 3 events which collect funding per year. The year period is determined based on your signup date.");
					document.getElementById("fund_allowed").value = "";
				<?php 
			}
			else if($total_fund_active_event >= 2)
			{
				?>
					alert("Due to money laundering policies upheld by CelebratePlus, we can only allow 2 events to collect funding at the same time.");
					document.getElementById("fund_allowed").value = "";
				<?php 
			}
			else
			{
				?>
					document.getElementById("funding_attributes").style.display = 'block';
				<?php 
			}
		?>		
	}
	else
	{
		document.getElementById("funding_attributes").style.display = 'none';
	}
}	
function show_defin_d_level()
	{
		
		if(document.getElementById("define_donation_levels").checked == true)
		{
			document.getElementById("defin_d_level").style.display = 'block';
		}
		else
		{
			document.getElementById("defin_d_level").style.display = 'none';
		}
	}
		</script>
