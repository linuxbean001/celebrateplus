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
	$event_id = checkNum($_REQUEST['eve_id']);
	// I do need to secure the flow of the site as we mover further to paypal payments
	// So I will create a session that will make this possible
	$_SESSION['event_id'] = $event_id;
	$_SESSION['from_where'] = 'event_attending_confirmation.php';
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
	$event_space_available = stripslashes($event_row->space_available);
	$event_fund_allowed = stripslashes($event_row->fund_allowed);
	$fund_end_date = stripslashes($event_row->fund_end_date);
	$define_donation_levels = stripslashes($event_row->define_donation_levels);
	$today = date("Y-m-d");
	$end_date_timestamp = strtotime($fund_end_date);
	$today_timestamp = strtotime($today);
	if($end_date_timestamp <= 0 || $end_date_timestamp == '')
	{
		$end_date_timestamp = $today_timestamp;
	}
	
	$df_friends = stripslashes($event_row->df_friends);
	$df_bronze = stripslashes($event_row->df_bronze);
	$df_silver = stripslashes($event_row->df_silver);
	$df_gold = stripslashes($event_row->df_gold);
	$df_platinum = stripslashes($event_row->df_platinum);
	$df_benefactor = stripslashes($event_row->df_benefactor);
	
	$event_donate_to_attend = $event_row->donate_to_attend;
	if($event_donate_to_attend=='yes')
	{
		$event_donate_to_attend = 'Yes';
	}
	$event_max_don_amt = $event_row->max_don_amt;
	$event_max_don_amt1 = $event_max_don_amt;
	if($event_max_don_amt1 <= 0 || $event_max_don_amt1 == '')
	{
		$event_max_don_amt1 = 0;
	}
	
	$event_max_don_amt = str_replace(',', '', $event_max_don_amt); 
	$event_max_don_amt = intval($event_max_don_amt);
	
	
	
	if($event_max_cap !="")
	{
		if($event_space_available <= 0)
		{
			$event_space_available = 0;
		}
	}
	if($event_max_cap =="")
	{
		$event_space_available = "There is no limit to the number of people that can attend."; 
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
                    	<div class="inner_title_bg">Confirm Your Attendance to <?=str_replace("\\","",$event_title);?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
                            	<div class="tab_box_bg_inner_left_text_regconf">
                                	<div>
                                        <div class="eve_text_main"><span>When:</span></div>
                                        <span><?=$day?> <?=$month?> <?=$dd?>, <?=$year?> at <?=$event_stime;?> until <?=$day1?> <?=$month1?> <?=$dd2?>, <?=$year1?> at <?=$event_etime;?></span>
                                        
                                        <div class="eve_text_main"><span>Where:</span></div> 
										<div>
											<?=str_replace("\\","",$event_loc_name);?> <?=$event_loc_street?> <?=$event_loc_suite?> <?=$event_loc_city?>
											<?php if($event_loc_state != '' || $event_loc_zip != '' || $event_loc_country != '') { echo ','; }?> <?=$event_loc_state?> <?=$event_loc_zip?> <?=$event_loc_country?> &nbsp;
										</div>
                                        <div class="eve_text_main"><span>Space Left:</span></div>
										<div><?=$event_space_available?></div>
                                    </div>
									<form name="confirm_event_frm" id="confirm_event_frm" method="post" action="event_confirmation.php" onsubmit="javascript: return confirm_chk()">
									<input type="hidden" name="event_id" id="event_id" value="<?=$event_id?>" />
									<input type="hidden" name="don_require" id="don_require" value="<?=$event_donate_to_attend?>" />
                                    <div style="margin-top: 20px;width: 400px;">
                                    	<div class="form-group">
                                        	<div class="">How Many People Are Attending?<span style="color:#FF0000;">*</span><br /><span style="font-size:12px; line-height:15px; padding-right:5px; font-style:italic; text-align:left; color:#FF0000;">Include yourself in the number of people attending.</span></div>
                                            <div class="">
                                            	<div class=""><input type="text" name="tot_addendees" class="form-control" id="tot_addendees" onblur="show_confirm_box(this.value)" /></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="">Comments / Message :</div>
                                            <div class="">
                                            	<div class=""><textarea name="comments" class="form-control" id="comments"></textarea></div>
                                            </div>
                                        </div>
										<?
											if($event_fund_allowed == 'Yes')
											{
										?>
                                        <div class="eve_text_main_form_in_main">
                                        	<div class="eve_text_main_form_name">Would You Like To Donate?<span style="color:#FF0000;">*</span></div>
                                            <div class="eve_text_main_form_input_box">
                                            	<div class="eve_text_main_form_input">
                                                	<select class="eve_text_main_form_select" name="donate" id="donate" onchange="show(this.value)">
                                                    	<option value="">Select</option>
                                                    	<option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
												<div  id="show_amt22" style="display:none;" >
                                                <div style="float:left; width:330px;">
												<div style="float:left; width:330px;">
												<div class="eve_text_main_form_name" style="padding:0 15px 0 10px; width:98px;">How much?<span style="color:#FF0000;">*</span></div>
                                                <div class="eve_text_main_form_input" style="height:50px;">
													<input type="text" name="how_mch" id="how_mch" value="" /><br />
													<span style="font-size:8pt; padding-left:23px;"> Maximum Contribution: $2,000.00 </span>
												</div>
												</div>
												<div style="float:left; width:330px;">
												<div class="eve_text_main_form_name" style="padding:0 15px 0 5px; width:300px;">
												<input type="checkbox" name="anonymous" id="anonymous" value="yes" /> Keep my donation anonymous.</div>
												<? if($define_donation_levels == "yes"){ ?>
												<div class="eve_text_main_form_name" style="padding:0 15px 0 5px; width:300px; font-size:12px;">
												<a href="javascript:;" onclick="document.getElementById('earn_donor_status').style.display='block'; this.style.display='none';document.getElementById('hide_donor_tag').style.display='block';;" style="color:#0774BB; text-decoration:none; font-size:12px; display:block;" id="view_donor_tag">
													View Donor Status Levels
												</a>
												<a href="javascript:;" onclick="document.getElementById('earn_donor_status').style.display='none'; this.style.display='none';document.getElementById('view_donor_tag').style.display='block';" style="color:#0774BB; text-decoration:none; font-size:12px; display:none;" id="hide_donor_tag">
													Hide Donor Status Levels
												</a>												
												</div>
												<div class="eve_name_left" id="earn_donor_status" style="padding-left:20px; display:none;">
													<div class="contribute_btn" style="text-align:left; padding-top:0px;">													
													<div class="contribute_btn" style="text-align:left; padding-top:0px; font-size:19px; font-weight:bold; color:#134990;">
													Earn Donor Status
													</div>
													<div class="contribute_btn" style="text-align:left; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px;">Donation Level</div>
													<div style="float:left; width:148px;">Donation Amount</div>
													</div>
													<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px; color:#F86802;" >Friend :</div>
													<div style="float:left; width:148px; color:#666666; cursor:pointer;">
														<span style="cursor:pointer" onclick="fill_how_mch('<?=$df_friends;?>');">$<?=$df_friends;?></span>
													</div>
													</div>
													<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px; color:#F86802;">Bronze :</div>
													<div style="float:left; width:148px; color:#666666; cursor:pointer;">
														<span style="cursor:pointer" onclick="fill_how_mch('<?=$df_bronze;?>');">$<?=$df_bronze;?></span>
													</div>
													</div>
													<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px; color:#F86802;">Silver :</div>
													<div style="float:left; width:148px; color:#666666; cursor:pointer;">
														<span style="cursor:pointer" onclick="fill_how_mch('<?=$df_silver;?>');">$<?=$df_silver;?></span>
													</div>
													</div>
													<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px; color:#F86802;">Gold :</div>
													<div style="float:left; width:148px; color:#666666; cursor:pointer;">
														<span style="cursor:pointer" onclick="fill_how_mch('<?=$df_gold;?>');">$<?=$df_gold;?></span>
													</div>
													</div>
													<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px; color:#F86802;">Platinum :</div>
													<div style="float:left; width:148px; color:#666666;">
														<span style="cursor:pointer" onclick="fill_how_mch('<?=$df_platinum;?>');">$<?=$df_platinum;?></span>
													</div>
													</div>
													<div class="contribute_btn" style="text-align:left; padding-top:8px; font-size:14px; font-weight:bold; ">
													<div style="float:left; width:148px; color:#F86802;">Benefactor :</div>
													<div style="float:left; width:148px; color:#666666;">
														<span style="cursor:pointer" onclick="fill_how_mch('<?=$df_benefactor;?>');">$<?=$df_benefactor;?></span>
													</div>
													</div>
													</div>
												</div>
												<? } ?>
                                                
												</div>
												</div>
												</div>
                                            </div>
                                        </div>
										<?
											}
										?>
                                        <div class="eve_text_main_form_in_main">
										
                                        	<div class="eve_text_main_form_name" style="display:block;" id="def"><input type="submit" class="eve_text_main_form_input_btn" name="eve_confirmation"  value=""/></div>
											<div class="eve_text_main_form_name" style="display:none;" id="def1"><input type="submit" class="eve_text_main_form_input_btn1" value=""/></div>
                                            <div class="eve_text_main_form_input_box">&nbsp;</div>
                                        </div>
                                    </div>
									<input type="hidden" name="is_attendee" id="is_attendee" value="1" />
									<input type="hidden" name="attendee_id" id="attendee_id" value="<?php echo $_REQUEST['attendee_id'];?>" />
									</form>
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
	<!------------------------------------->	
		<link rel="stylesheet" type="text/css" href="jquery.confirm/jquery.confirm.css" />
		
		
		<div id="confirmOverlay" style="display: none;">
			<div id="confirmBox">
				<h1>Confirmation</h1><p>Are you sure <span id="addendee_val">59</span> attendees will be attending the event?</p>
				<div id="confirmButtons">
					<a class="button" href="javascript:;" onclick="yes();">Yes</a>
					<a class="button" href="javascript:;" onclick="no();">No</a>
				</div>
			</div>
		</div>
		
	<!------------------------------------->		
    </body>
	
</html>
<script type="text/javascript">
			function show_confirm_box(val)
			{
				if(val > 50)
				{
					document.getElementById("addendee_val").innerHTML= val;
					document.getElementById("confirmOverlay").style.display= 'block';
				}
			}
			function yes()
			{
				document.getElementById("confirmOverlay").style.display= 'none';
				confirm_chk();
			}
			function no()
			{
				document.getElementById("confirmOverlay").style.display= 'none';
				document.getElementById("tot_addendees").focus();
			}
			function confirm_chk()
			{
				if(document.getElementById("tot_addendees").value.split(" ").join("") == "")
				{
					alert("Please enter the number of people that are attending the event including you.");
					document.getElementById("tot_addendees").focus();
					return false;
				}				
				if(document.getElementById("donate").value.split(" ").join("") == "")
				{
					alert("Please select whether you would like to donate or not.");
					document.getElementById("donate").focus();
					return false;
				}
				if(document.getElementById("show_amt22").style.display=='block')
				{
					if(<?=$today_timestamp?> > <?=$end_date_timestamp?>)
					{
						alert("The funding period on this event has expired. You will not be able to donate to this event.");
						return false;
					}
					if(document.getElementById("how_mch").value.split(" ").join("") == "")
					{
						alert("Please enter the amount that you would like to donate in the format XX.XX");
						document.getElementById("how_mch").focus();
						return false;
					}
					
					if(document.getElementById("how_mch").value < <?=$event_max_don_amt1?>)
					{
						alert("The minimum donation amount for this event is <?=$event_max_don_amt1;?> Please adjust your donation amount to make sure it's greater than or equal to this amount.");
						document.getElementById("how_mch").focus();
						return false;
					}
					if(document.getElementById("how_mch").value > 2000)
					{
						alert("The maximum donation amount through CelebratePlus is $2,000.00.");
						document.getElementById("how_mch").focus();
						return false;
					}
					
				}
				var a =document.getElementById("don_require").value;
				
				var b = document.getElementById("donate").value;
				
				if(a != '')
				{
					if(a != b)
					{
						alert("This event requires a donation to attend.");
						document.getElementById("donate").focus();
						return false;
					}
				}				
				
				return true;
			}
			function show(ans)
			{
				
				if(ans=='Yes')
				{	
					document.getElementById("show_amt22").style.display='block';
					document.getElementById("def1").style.display='block';
					document.getElementById("def").style.display='none';
					document.getElementById("confirm_event_frm").action='make_payment.php';
				}
				else
				{
					document.getElementById("how_mch").value = '';
					document.getElementById("anonymous").value = '';
					document.getElementById("show_amt22").style.display='none';
					document.getElementById("def1").style.display='none';
					document.getElementById("def").style.display='block';
					document.getElementById("confirm_event_frm").action='event_confirmation.php';
				}
			}
			
			function fill_how_mch(value)
			{
				document.getElementById("how_mch").value = value;
			}
			
		</script>

