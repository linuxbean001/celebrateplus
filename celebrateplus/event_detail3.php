<? include("connect.php");?>
<?
	$event_id = checkNum($_REQUEST['eve_id']);
	$_SESSION['from_where'] = 'event_detail3.php';
	$_SESSION['event_id'] = $event_id;
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
	$event_space_available = stripslashes($event_row->space_available);
	$event_max_don_amt = stripslashes($event_row->max_don_amt);
	$event_image_path = stripslashes($event_row->image_path);
	$event_fund_allowed = stripslashes($event_row->fund_allowed);
	
	$define_donation_levels = stripslashes($event_row->define_donation_levels);
	$df_friends = stripslashes($event_row->df_friends);
	$df_bronze = stripslashes($event_row->df_bronze);
	$df_silver = stripslashes($event_row->df_silver);
	$df_gold = stripslashes($event_row->df_gold);
	$df_platinum = stripslashes($event_row->df_platinum);
	$df_benefactor = stripslashes($event_row->df_benefactor);
	
	$org_fname = stripslashes(GetValue("organizer","fname","id",$event_row->oid));
	$org_lname = stripslashes(GetValue("organizer","lname","id",$event_row->oid));
	$fb_link = $SITE_URL."event_detail3.php?eve_id=".$_REQUEST['eve_id'];
	$site_logo = $SITE_URL."images/logo_invite_email.png";
	$fb_message = $org_fname." ".$org_lname." has invited you to an event <b>".$event_title."</b> on CelebratePlus.";
	
	if($event_max_cap !="")
	{
		if($event_space_available <= 0)
		{
			$event_space_available = 0;
		}
	}
	if($event_max_cap =="")
	{
		$event_space_available = "There is no limit to the number of people that can attend." ;
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
	
	$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '$event_id'";
$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
$currently_funded_amount = mysql_result($funded_amount_result,0);
$currently_funded_amount = number_format($currently_funded_amount,2);
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
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
                            	<div class="tab_box_bg_inner_left_text_regconf">
                                	<div class="eve_name_left">
									<? if($event_image_path !="" and file_exists("event_images/".$event_image_path)){?>
                                    	<div class="eve_name_left_box"><img src="event_images/<?=$event_image_path;?>" width="296" height="279" /></div>
									<? }?>
										<? if($event_fund_allowed == "Yes")
										{
										?>
                                        <div class="contribute_btn"><span onclick="javascript: if(confirm_chk()) { show_contribution_block();}"><img src="images/contribute_btn.png" /></span></div>
										<?
										}
										?>
										<form name="confirm_event_frm" id="confirm_event_frm" method="post" action="mediator.php" onsubmit="javascript: return confirm_chk()">
										<div style="display:none" id="contribution_block"><div class="contribute_btn" style="padding-left:48px;"><div class="reg_wid_form_input"><input type="text" name="how_mch" id="how_mch" /></div></div>
										<div class="contribute_btn"><input type="image" name="submit" id="submit" src="images/contribute_btn2.png" /></div></div>
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
									<? if($event_space_available > 0 or $event_max_cap ==""){?>
                                    	<div class="not_eve_btn" style="width:645px">
										
                                        	<a href="<?=hb_control_url("event_attending_confirmation.php?eve_id=".$event_id);?>"><img src="images/im_attending.png" /></a>
                                            <?php 
												if(isset($_SESSION['SESS_USER_ID']) && $_SESSION['SESS_USER_ID'] > 0)
												{	
													$maybe_redirect_url = "maybe.php?eve_id=".$event_id."&goto=maybe";
													$not_attending_redirect_url = "not_attending.php?eve_id=".$event_id."&goto=not_attending";
												}
												else
												{	
													$maybe_redirect_url = "login.php?eve_id=".$event_id."&goto=maybe";
													$not_attending_redirect_url = "login.php?eve_id=".$event_id."&goto=not_attending";
												}
											?>
											<a href="<?=$maybe_redirect_url;?>"><img src="images/mybe.png" /></a>
																						
                                            <a href="<?=$not_attending_redirect_url;?>"><img src="images/not_attending.png" /></a>
											
											
                                        </div>
									<? }?>
                                        <div class="noy_text">
                                        <span>When:</span> <?=$day?> <?=$month?> <?=$dd?>, <?=$year?> at <?=$event_stime;?> until <?=$day1?> <?=$month1?> <?=$dd2?>, <?=$year1?> at <?=$event_etime;?><br />
                                        <span>Where:</span> 
										<?=str_replace("\\","",$event_loc_name);?> <?=$event_loc_street?> <?=$event_loc_suite?> <?=$event_loc_city?>
											<?php if($event_loc_state != '' || $event_loc_zip != '' || $event_loc_country != '') { echo ','; }?> <?=$event_loc_state?> <?=$event_loc_zip?> <?=$event_loc_country?><br />
                                        <span>Space Left:</span> <?=$event_space_available?>
                                        <div class="noy_text_main"><?=$event_description?></div>
                                        <div class="eve_left_box_main">
										<? 	if($event_display_fund=='')
										   	{
										   		$style = 'style="width:267px;"';
											}
											if($event_fund_amt=='')
											{
												$style = 'style="border:0px;"';
											}
										?>
                                        	<div class="eve_left_box" <?=$style;?>>												
												<? if($event_fund_amt!=''){?>
                                            	<div class="eve_left_box_left">
                                                	<div class="eve_left_box_left_title">TARGETED FUNDING AMOUNT</div>
                                                    <div class="eve_left_box_left_xxx">$<?=$event_fund_amt;?></div>
                                                </div>
												<? }?>
												<? if($event_display_fund=='yes'){?>
                                                <div class="eve_left_box_left">
                                                	<div class="eve_left_box_left_title">CURRENTLY FUNDED AMOUNT</div>
                                                    <div class="eve_left_box_left_xxx">$<?=$currently_funded_amount;?></div>
                                                </div>
												<? }?>
												</div>
												</div>
												<? if($event_max_don_amt !=""){?>
												 <div class="noy_text">
												 <span>Minimum Donation Amount to Attend : </span>$<?=$event_max_don_amt;?>
												 </div>
												 <?php /*?><div class="eve_left_box_main">
												<div class="eve_left_box" style="width:305px; margin-top:10px;">
												<div class="eve_left_box_left" >
                                                	<div class="eve_left_box_left_title" style="width:305px;">MINIMUM DONATION AMOUNT TO ATTEND</div>
                                                    <div class="eve_left_box_left_xxx">$<?=$event_max_don_amt;?></div>
                                                </div>
												</div>
												</div><?php */?>
												<? }?>
                                            
                                        
                                        </div>
                                    </div>
                                </div>
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
<script language="javascript">
	function show_contribution_block()
	{
		$(document.getElementById('contribution_block')).fadeIn(700);
	}
	
	function confirm_chk()
	{
		<? if($_SESSION['SESS_USER_ID'] == ""){ ?>
		alert("You must be logged in to contribute to this event. Please first login to make your contribution.");
		window.location.href="login_contribute.php?event_id=<?php echo $_REQUEST['eve_id'];?>";
		return false;
		<?
		}
		?>
		return true;
	}
</script>