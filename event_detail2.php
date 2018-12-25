<? include("connect.php");?>
<?
	//include("login_check.php");
	//$global_show_errors = true;
	if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
	{
	}
	else
	{
		$eve = $_REQUEST['eve_id'];
		location("login.php?frm=$eve");
	}
	$event_id = checkNum($_REQUEST['eve_id']);
	$_SESSION['event_id'] = $event_id;
	$_SESSION['from_where'] = 'event_detail2.php';
	$event_query = hb_get_result("select * from events where id=$event_id and deleted != 1");
	$event_row = mysql_fetch_object($event_query);
	$event_title = stripslashes($event_row->title);
	$event_start = $event_row->sdate;
	$event_end = $event_row->edate;
	$event_stime = $event_row->stime;
	$event_etime = $event_row->etime;
	$event_max_cap = $event_row->max_cap; 
	$event_loc_name = stripslashes($event_row->loc_name);
	$event_loc_street = stripslashes($event_row->loc_street);
	$event_loc_suite = stripslashes($event_row->loc_suite);
	$event_loc_city = stripslashes($event_row->loc_city);
	$event_loc_state = stripslashes($event_row->loc_state);
	$event_loc_zip = stripslashes($event_row->loc_zip);
	$event_loc_country = stripslashes($event_row->loc_country);
	$event_description = stripslashes($event_row->description);
	$event_fund_amt = stripslashes($event_row->fund_amt);
	$event_display_fund = stripslashes($event_row->display_fund);
	$space_available = $event_row->space_available;
	$event_max_don_amt = stripslashes($event_row->max_don_amt);
	$event_image_path = stripslashes($event_row->image_path);
	$event_fund_allowed = stripslashes($event_row->fund_allowed);
	$fund_end_date = stripslashes($event_row->fund_end_date);
	$attendee_list_public = stripslashes($event_row->attendee_list_public);
	
	
	$define_donation_levels = stripslashes($event_row->define_donation_levels);
	$df_friends = stripslashes($event_row->df_friends);
	$df_bronze = stripslashes($event_row->df_bronze);
	$df_silver = stripslashes($event_row->df_silver);
	$df_gold = stripslashes($event_row->df_gold);
	$df_platinum = stripslashes($event_row->df_platinum);
	$df_benefactor = stripslashes($event_row->df_benefactor);
	
	if($df_benefactor == ""){ $df_benefactor = 0;}
	if($df_platinum == ""){ $df_platinum = 0;}
	if($df_friends == ""){ $df_friends = 0;}
	if($df_bronze == ""){ $df_bronze = 0;}
	if($df_silver == ""){ $df_silver = 0;}
	if($df_gold == ""){ $df_gold = 0;}	
	
	$org_fname = stripslashes(GetValue("organizer","fname","id",$event_row->oid));
	$org_lname = stripslashes(GetValue("organizer","lname","id",$event_row->oid));
	$fb_link = $SITE_URL."event_detail.php?eve_id=".$_REQUEST['eve_id'];
	$site_logo = $SITE_URL."images/logo_invite_email.png";
	$fb_message = $org_fname." ".$org_lname." has invited you to an event <b>".$event_title."</b> on CelebratePlus.";
	
	if($event_max_cap !="")
	{
		
		if($space_available <= 0)
		{
			
			$space_available = 0;
		}
	}
	if($event_max_cap =="")
	{
		$space_available = "There is no limit to the number of people that can attend."; 
	}
	
	$day = date("l",strtotime($event_start));
	$month = date("M",strtotime($event_start));
	$year = date("Y",strtotime($event_start));
	$dd = split("-",$event_start);
	$dd = $dd[2];
	
	$day1 = date("l",strtotime($event_end));
	$month1 = date("M",strtotime($event_end));
	$year1 = date("Y",strtotime($event_end));
	$dd1 = split("-",$event_end);
	$dd2 = $dd1[2];
	
/*=============Query for checking that if user has already register to this event or not=======================*/
	$check_attendence = hb_get_result("select * from attendee where user_id='".$_SESSION['SESS_USER_ID']."' and event_id='".$event_id."' and is_attendee = '1'");
	$is_regiestered = mysql_num_rows($check_attendence);
	
/*=============================================================================================================*/	

/* Processing area started */

$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '$event_id'";
$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
$currently_funded_amount = mysql_result($funded_amount_result,0);
$currently_funded_amount = number_format($currently_funded_amount,2);

/* Processing area ended */
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $event_title;?></title>
<meta name="og:title" content="<?php echo $event_title;?>" />
<meta name="og:description" content='<?php echo $fb_message;?>' />
<meta name="og:content" content='<?php echo $fb_message;?>' />
<meta name="og:type" content="link" />
<meta name="og:url" content="<?php echo $fb_link;?>" />
<meta name="og:image" content="<?php echo $site_logo;?>" />
<meta property="fb:app_id" content="342321239162728" />
<meta property="http://ogp.me/ns#locale" content="en_US" />
<meta property="http://ogp.me/ns#site_name" content="<?php echo $SITE_URL;?>" />
<meta property="http://ogp.me/ns#type" content="website" />
<meta property="http://ogp.me/ns#title" content="<?php echo $event_title;?>" />
<meta property="http://ogp.me/ns#description" content="<?php echo $fb_message;?>" />
<meta property="http://ogp.me/ns/fb#app_id" content="342321239162728" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
</head>
<body>
<div class="main">
<? include("header.php");?>
	<div class="middle_inner">
		<div class="tab_box_main">
			<div class="tab_box_title_main">
				<div class="inner_title_bg"><?=str_replace("\\","",$event_title);?>
				<!-- AddThis Button BEGIN -->
											<div class="addthis_toolbox addthis_default_style " style="width:277px; float:right; padding-top:19px; padding-right:19px;" >
											<a class="addthis_button_facebook_like" fb:like:layout="button_count" style="width:75px;"></a>
											<a class="addthis_button_tweet" style="width:80px;"></a>
											<a class="addthis_button_google_plusone" g:plusone:size="medium" style="width:60px;"></a>
											<a class="addthis_counter addthis_pill_style" style="width:50px;"></a>
											</div>
											<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f8eaaa376a248d6"></script>
											<!-- AddThis Button END -->
				</div>
			</div>
			<div class="tab_box_bg_main">
				<div class="myacc_menu_main">
					<? include("account_menu.php");?>
				</div>
				<div class="tab_box_bg_inner">
                	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
                    	<div class="tab_box_bg_inner_left_text_regconf">
							<div class="eve_name_left">							
					<?
					if($event_image_path !="" and file_exists("event_images/".$event_image_path))
					{		
					?>		
								<div class="eve_name_left_box">
									<img src="event_images/<?=$event_image_path;?>" width="296" height="279" />
								</div>
					<?
					}
					?>
								<?
								if($event_fund_allowed == "Yes")
								{
									$today = date("Y-m-d");
									if($fund_end_date >= $today)
									{
								?>
									<div class="contribute_btn">
										<span onclick="javascript:show_contribution_block();">
											<img src="images/contribute_btn.png" />
										</span>
									</div>
								<?
									}
								}
								?>
								<form name="confirm_event_frm" id="confirm_event_frm" method="post" action="make_payment2.php" onsubmit="javascript: return confirm_chk('<?=$event_max_don_amt;?>',document.getElementById('how_mch').value)">
								<div style="display:none" id="contribution_block">									
										<?php 
											$total_user_donation_to_this_event=sh_GetValue("attendee","count(*)","user_id",$_SESSION['SESS_USER_ID']."' and event_id = '".$_REQUEST['eve_id']."' and funding = 'Yes");
											if($total_user_donation_to_this_event >= 3)
											{
												?>
												<div class="contribute_btn">
													You can only donate to the same event 3 times.
												</div>
												<?php
											}
											else
											{
												?>
												<div class="contribute_btn" style="padding-left:48px;">
										<div class="reg_wid_form_input" style="line-height:16px;height:65px;">
											<input type="text" name="how_mch" id="how_mch" />
											<br />
											<span style="font-size:8pt;"> Maximum Contribution: $2,000.00 </span>
				
										</div>
									</div>
												<div class="contribute_btn">
													<input type="image" name="submit" id="submit" src="images/contribute_btn2.png" />
												</div>
												<?php
											}
										?>
								</div>
							<input type="hidden" name="donate" id="donate" value="Yes" />
							<input type="hidden" name="comments" id="comments" value="" />
							<input type="hidden" name="tot_addendees" id="tot_addendees" value="0" />
							<input type="hidden" name="is_attendee" id="is_attendee" value="0" />
							<input type="hidden" name="event_id" id="event_id" value="<?=$event_id;?>" />
							</form>
							<? if($define_donation_levels == "yes"){ ?>
							<div class="contribute_btn" style="text-align:left;">
							<div class="contribute_btn" style="text-align:left; font-size:19px; font-weight:bold; color:#134990;">
							Earn Donor Status
							</div>
							<div class="contribute_btn" style="text-align:left; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px;">Donation Level</div>
							<div style="float:left; width:148px;">Donation Amount</div>
							</div>
							<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px; color:#F86802;">Friend :</div>
							<div style="float:left; width:148px; color:#666666;">$<?=$df_friends;?></div>
							</div>
							<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px; color:#F86802;">Bronze :</div>
							<div style="float:left; width:148px; color:#666666;">$<?=$df_bronze;?></div>
							</div>
							<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px; color:#F86802;">Silver :</div>
							<div style="float:left; width:148px; color:#666666;">$<?=$df_silver;?></div>
							</div>
							<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px; color:#F86802;">Gold :</div>
							<div style="float:left; width:148px; color:#666666;">$<?=$df_gold;?></div>
							</div>
							<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px; color:#F86802;">Platinum :</div>
							<div style="float:left; width:148px; color:#666666;">$<?=$df_platinum;?></div>
							</div>
							<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
							<div style="float:left; width:148px; color:#F86802;">Benefactor :</div>
							<div style="float:left; width:148px; color:#666666;">$<?=$df_benefactor;?></div>
							</div>
							
							
							
							</div>
							<? } ?>
							<?
					$get_add_query = "select * from ad where location like '%Event Details Page Left Column%' order by rand() limit 1";
					$get_add_result = hb_get_result($get_add_query) or die(mysql_error());
					if(mysql_num_rows($get_add_result) > 0)
					{
					?>
					<div style="float:left; text-align:center; width:296px; padding:15px 0px 15px 0px; ">
					<?
					
						while($get_add_row = mysql_fetch_array($get_add_result))
						{
							 
							 ?>
							 <a href="<?=$get_add_row['link'];?>" target="_blank"><img src="advertiser_images/<?=$get_add_row['image_path'];?>" width="250" height="250" border="0" /></a>
							 <?
						}
					
					?>
				
					</div>
					<?
					}
					?>
							</div>
							<div class="eve_name_right" style="width:625px">
							<? if($_REQUEST['goto'] == "maybe") {?>
							<div style="float:left; width:645px; color:#FF0000; font-size:14px; font-weight:bold;  text-align:left; margin-top:-25px;">Your attendance has been registered. You have confirmed that you will maybe attend this event.<br />&nbsp;</div>
							<?
							}
							?>
							<? if($_REQUEST['goto'] == "not_attending") {?>
							<div style="float:left; width:645px; color:#FF0000; font-size:14px; font-weight:bold;  text-align:left; margin-top:-25px;">Your attendance has been registered. You have confirmed that you will not attend this event.<br />&nbsp;</div>
							<?
							}
							?>
							<?
							if(($space_available > 0) or $event_max_cap =="")
							{
								$check_attendence = hb_get_result("select * from attendee where user_id='".$_SESSION['SESS_USER_ID']."' and event_id='".$event_id."'");
								$is_regiestered = mysql_num_rows($check_attendence);
								if(!($is_regiestered > 0))
								{
									?>
										<div class="not_eve_btn" style="width:645px">
											<a href="event_attending_confirmation.php?eve_id=<?=$event_id;?>">
												<img src="images/im_attending.png" />
											</a>
											<a href="maybe.php?eve_id=<?=$event_id;?>&goto=maybe"><img src="images/mybe.png" /></a>
											<a href="not_attending.php?eve_id=<?=$event_id;?>&goto=not_attending"><img src="images/not_attending.png" /></a>									
										</div>
									<?
								}
								else
								{
									$im_attending = '';
									$maybe='';
									$not_attending = '';
									$attendence_status_row = mysql_fetch_array($check_attendence);
									$attendence_status = $attendence_status_row['status'];
									$is_attendee = $attendence_status_row['is_attendee'];
									$attendee_id = $attendence_status_row['id'];
									if($is_attendee == 1)
									{	$attendence_status = "attending"; $im_attending = '_green';	}
									else if($attendence_status == "Maybe")
									{	$attendence_status = "maybe attending"; $maybe='_green';	}
									else if($attendence_status == "Not Attending")
									{	$attendence_status = "not attending"; $not_attending = '_green';	}
									?>
										<div id="message_div_id" class="not_eve_btn" style="width:645px; color:#FF0000; font-weight:bold; display:block;">
											You have selected that you will be <?php echo $attendence_status;?> this event. <span onclick="show_status_links();" style="cursor:pointer; color:#0774BB;">Click here</span> if you would like to change your status.
										</div>
										<div id="status_update_button_div" class="not_eve_btn" style="width:645px; display:none;">
											<?php if($im_attending != "_green") {?>
											<a href="event_attending_confirmation.php?eve_id=<?=$event_id;?>&attendee_id=<?=$attendee_id;?>"> <?php } ?>
												<img src="images/im_attending<?=$im_attending;?>.png" />
											<?php if($im_attending != "_green") {?> </a> <?php } ?>
											<?php if($maybe != "_green") {?>
											<a href="maybe.php?eve_id=<?=$event_id;?>&goto=maybe&attendee_id=<?=$attendee_id;?>"> <?php } ?>
												<img src="images/mybe<?=$maybe;?>.png" />
											<?php if($maybe != "_green") {?> </a> <?php } ?>
											<?php if($not_attending != "_green") {?>
											<a href="not_attending.php?eve_id=<?=$event_id;?>&goto=not_attending&attendee_id=<?=$attendee_id;?>"> <?php } ?>
												<img src="images/not_attending<?=$not_attending;?>.png" />
											<?php if($not_attending != "_green") {?> </a> <?php } ?>								
										</div>
									<?
								}
							}
							?>
								<div class="noy_text">
                                <span>When:</span>
								<?=$day?> <?=$month?> <?=$dd?>, <?=$year?> at <?=$event_stime;?> until <?=$day1?> <?=$month1?> <?=$dd2?>, <?=$year1?> at <?=$event_etime;?><br />
								<span>Where:</span>
								<?=str_replace("\\","",$event_loc_name);?> <?=$event_loc_street?> <?=$event_loc_suite?> <?=$event_loc_city?>
											<?php if($event_loc_state != '' || $event_loc_zip != '' || $event_loc_country != '') { echo ','; }?> <?=$event_loc_state?> <?=$event_loc_zip?> <?=$event_loc_country?> <br />								
								<span>Space Left:</span> <?=$space_available;?>
                                <div class="noy_text_main"><?=$event_description?></div>
                                <div class="eve_left_box_main">
								<?
									if($event_display_fund=='')
									{
										$style = 'style="width:267px;"';
									}
									if($event_fund_amt=='')
									{
										$style = 'style="border:0px;"';
									}
								?>
									<div class="eve_left_box" <?=$style;?>>
									<?
									if($event_fund_amt!='')
									{
									?>
										<div class="eve_left_box_left">
											<div class="eve_left_box_left_title">TARGETED FUNDING AMOUNT</div>
                                        	<div class="eve_left_box_left_xxx">$<?=$event_fund_amt;?></div>
										</div>
									<?
									}
									?>
									<?
									if($event_display_fund=='yes')
									{
									?>
										<div class="eve_left_box_left">
											<div class="eve_left_box_left_title">CURRENTLY FUNDED AMOUNT</div>
											<div class="eve_left_box_left_xxx">$<?=$currently_funded_amount;?></div>
										</div>
									<?
									}
									?>
								</div>
							</div>
							<?
							if($event_max_don_amt !="")
							{
							?>
								<div class="noy_text">
									<span>Minimum Donation Amount to Attend: </span>$<?=$event_max_don_amt;?>
								</div>
							<?
							}
							?>
							<?
							if($attendee_list_public == "yes")
							{
							?>
							<div class="noy_text">
								<span>Who is attending?</span>
							</div>
							<div class="events_page_main" style="width:617px; padding-bottom:15px;">
                                	<div class="events_page_title_main" style="width:596px;">
                                    	
                                        <div class="events_page_title_date" style="width:240px;">Name</div>
                                        <div class="events_page_title_location" style="width:175px;"># of Attendees </div>
                                        
                                        <div class="events_page_title_addtend" style="width:125px;">Donation Amount</div>
                                    </div>
									<? if($define_donation_levels == "yes"){ ?>
                                    <div class="events_page_addtop_main" style="width:617px;">
									<?
										$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > '".$df_benefactor."'  order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:7px; font-weight:bold; color:#F86802; ">
										Benefactor
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	}
									 	}?>
										<?
									$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > '".$df_platinum."' and how_mch <= '".$df_benefactor."' order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:15px; font-weight:bold; color:#F86802; ">
										Platinum
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	
										}
									 	}
										?>
										<?
									$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > '".$df_gold."' and how_mch <= '".$df_platinum."' order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:15px; font-weight:bold; color:#F86802; ">
										Gold
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	
										}
									 	}
										?>
										<?
									$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > '".$df_silver."' and how_mch <= '".$df_gold."' order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:15px; font-weight:bold; color:#F86802; ">
										Silver
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	
										}
									 	}
										?>
										<?
									 $eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > '".$df_bronze."' and how_mch <= '".$df_silver."' order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:15px; font-weight:bold; color:#F86802; ">
										Bronze
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	
										}
									 	}
										?>
										<?
									$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > '".$df_friends."' and how_mch <= '".$df_bronze."' order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:15px; font-weight:bold; color:#F86802; ">
										Friend
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	
										}
									 	}
										?>
										<?
									$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."' and how_mch > 0 and how_mch <= '".$df_friends."' order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										?>
										<div style="width:596px; padding-left:20px; padding-top:15px; font-weight:bold; color:#F86802; ">
										Donor
										</div>
										<?
										while($event_row = mysql_fetch_object($eve_res))
										{
										
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	
										}
									 	}
										?>   
                                    </div>
									<? }else{ ?>
									<div class="events_page_addtop_main" style="width:617px;">
									<?
									$eve_query = "select * from attendee where is_attendee = 1 and event_id='".checkNum($_REQUEST['eve_id'])."'   order by how_mch desc";
										$eve_res = hb_get_result($eve_query) or die(mysql_error());
										
										if(mysql_num_rows($eve_res) > 0)
										{
										
										while($event_row = mysql_fetch_object($eve_res))
										{
										
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_how_mch = $event_row->how_mch;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											$anonymous= $event_row->anonymous;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main" style="width:596px;">
                                        	
                                            <div class="events_page_add_date" style="width:250px;">
											<?
											if($anonymous == "yes")
											{
												echo "Anonymous";
											}
											else
											{
											?>
											<?=$fname123?>&nbsp;<?=$lname123?>
											<?
											}
											?>
											

											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            
                                            <div class="events_page_add_addtend" style="width:125px;">$<?=number_format($att_how_mch,2);?></div>
                                            
                                        </div>
										
                                   	 <? 
									 	}
									 	}?>
									</div>
									<? } ?>
                                </div>
							<?
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab_box_bottom">
		<img src="images/tab_box_bottom.png" />
	</div>
</div>
</div>
</div>
</div>
<div class="bottom">
	<? include("footer.php");?>
</div>
</body>
</html>
<script language="javascript">
	function show_contribution_block()
	{
		$(document.getElementById('contribution_block')).fadeIn(700);
	}
	function confirm_chk(event_max_don_amt,how_mch)
	{
		var event_max_don_amt1 = parseInt(event_max_don_amt);
		var how_mch1 = parseInt(how_mch);
		
		if(how_mch1 < event_max_don_amt1)
		{
			
			alert('Your donation amount must be equal to or greater than the minimum event donation amount of $'+event_max_don_amt1+'.');
			document.getElementById("how_mch").value ="";
			document.getElementById("how_mch").focus();
				
			return false;
		}
		if(how_mch1 > 2000)
		{
			
			alert('The maximum donation amount through CelebratePlus is $2,000.00.');
			document.getElementById("how_mch").focus();
				
			return false;
		}
		return true;
	}
</script>
<script language="javascript">
	function show_status_links()
	{
		document.getElementById('status_update_button_div').style.display = 'block';
		document.getElementById('message_div_id').style.display = 'none';	
	}
</script>