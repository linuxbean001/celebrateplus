<? include("connect.php");
include("login_check.php");
	/*------------------------------ Validate User to create event ---------------*/
	
		$event_result_array = sh_get_validate_user_to_create_event_vars();
		$total_funding_event = $event_result_array['total_funding_event'];
		$total_fund_active_event = $event_result_array['total_fund_active_event'];
		
	/*----------------------------------------------------------------------------*/
?>
<? 
	$acc_pg_name='create_event';
$a = GetContent(16);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
	.save_without_creating_invitation
	{
		background: url("images/save_without_creating_invit.png") no-repeat scroll 0 0 transparent;
		border: medium none;
		cursor: pointer;
		float: left;
		height: 33px;
		width: 274px;
	}
	.cplus_acctcreateevent .reg_wid_form_name
	{
		width:155px;
	}
</style>
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Create An Event</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
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
								<form name="CREATE_EVENT" id="CREATE_EVENT" enctype="multipart/form-data" action="save_event.php" method="post" onsubmit="javascript:return crt_event_chk()">
                                <div class="cplus_acctcreateevent">
                                	<div class="reg_wid_form_left">
                                    	<div class="form_login_title">Basic Event Information</div>
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Title<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="title" type="text" id="title" /></div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Page Image :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class=""><input type="file" name="image_path" id="image_path" ></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Start Date :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
                                            	<input name="sdate" type="text" id="sdate" readonly="true" />
												&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.CREATE_EVENT.sdate,'mm/dd/yyyy',this)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event Start Time :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="stime" type="text" id="stime" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event End Date :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
											<input name="edate" type="text" id="edate" />
											&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.CREATE_EVENT.edate,'mm/dd/yyyy',this)" />
											</div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Event End Time :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="etime" type="text" id="etime" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Maximum Capacity :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="max_cap" type="text" id="max_cap" onkeyup="javascript:calculate_mindonation(document.getElementById('fund_amt').value,this.value)" /></div>
                                        </div>
                                    </div>
                                    	<div class="form_login_title" style="padding-left:25px; padding-top:70px; width:335px;">Location</div>                                    
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Name :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_name" type="text" id="loc_name" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Street Address :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_street" type="text" id="loc_street" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Suite # or Apt # :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_suite" type="text" id="loc_suite" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">City :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_city" type="text" id="loc_city" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">State / Province :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_state" type="text" id="loc_state" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Zip / Postal Code :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_zip" type="text" id="loc_zip" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Country :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="loc_country" type="text" id="loc_country" /></div>
                                        </div>
                                    </div>
									<div style="float:left; width:377px; padding-top:0px;">
                                    <div  id="chng_pad1" style="padding-top:0px; padding-left:7px;">
									<input type="image" name="create_event" id="create_event" src="images/next_cre.png" /></div>
									<div  id="chng_pad2" style="padding-left:10px; padding-top:7px; padding-left:7px;"><input type="image" name="save_event" id="save_event" src="images/save_without_creating_invit.png" /></div>
									</div>
                                    </div>
                                	<div class="cplus_acctcreateevent_right">
                                    	<div class="form_login_title">Description</div>
                                    	<div class="cplus_acctcreateevent_input_main">
                                        	<div class="cplus_acctcreateevent_name">Summary<span style="color:#FF0000;">*</span> :</div>
                                            <div class="cplus_acctcreateevent_tr_main">
                                            	<div class="cplus_acctcreateevent_tr"><textarea name="summary121" id="summary121"></textarea></div>
                                            </div>
                                        </div>
                                        <div class="cplus_acctcreateevent_input_main">
                                        	<div class="cplus_acctcreateevent_name">Full Description :</div>
                                            <div class="cplus_acctcreateevent_tr_main">
                                            	<div class="cplus_acctcreateevent_tr"><textarea name="description121" id="description121"></textarea></div>
                                            </div>
                                        </div>
                                        <div class="form_login_title" style="width:350px; padding-top:28px;">Event Funding</div>
                                    </div>
                                    <div style="float:left; width:360px; ">
									<div class="reg_wid_form_left">
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">I would like to accept funding for this event<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><div class="eve_text_main_form_input">
                                                	<select class="eve_text_main_form_select" name="fund_allowed" id="fund_allowed" onchange="show(this.value)" style="padding-top:0px;">
                                                    	<option value="">Select</option>
                                                    	<option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div></div>
                                        </div>
                                    </div>
									<div style="float:left; display:none;" id="funding_attributes">
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">PayPal ID<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
											<div style="width:250px;">
                                        		<div class="reg_wid_form_input"><input name="paypalid" type="text" id="paypalid" value="<?=$GBV_CURRENT_USER_PAYPAL_ID;?>" /></div>
												<div style="float:left; padding-top:10px;">
													<img src="images/why.jpg" onmouseover="document.getElementById('question_mark_title').style.display='block'" onmouseout="document.getElementById('question_mark_title').style.display='none'"/>
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
                                        	<div class="reg_wid_form_input"><input name="fund_amt" type="text" id="fund_amt" onkeyup="javascript:calculate_mindonation(this.value,document.getElementById('max_cap').value)"/></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Minimum Donation Amount :</div>
                                        <div class="reg_wid_form_input_box" style="height:35px;">
                                        	<div class="reg_wid_form_input"><input name="max_don_amt" type="text" id="max_don_amt"  /></div>
											
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	
                                        
                                  <div class="reg_wid_form_input" id="min_donation" style="background-image:none; width:435px; font-size:10px; color:#FF0000"></div>
											
                                        
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Funding Close Date :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input" style="width:237px;">
											<input name="fund_end_date" type="text" id="fund_end_date" />
											&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.CREATE_EVENT.fund_end_date,'mm/dd/yyyy',this)" />
											</div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:420px; float:left; text-align:left;">
                                        <span style="padding:0 10px 0 0; text-align:left;"><input type="checkbox" name="donate_to_attend" id="donate_to_attend" value="yes" /></span>All attendees must donate to attend</div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:420px; float:left; text-align:left;">
                                        <span style="padding:0 10px 0 0; text-align:left;"><input type="checkbox" name="define_donation_levels" id="define_donation_levels" onchange="javascript:show_defin_d_level();" value="yes" /></span>I would like to define donation levels</div>
                                    </div>
									<div id="defin_d_level" style="width:440px; float:left; display:none;">
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Friend :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="df_friends" type="text" id="df_friends" /></div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Bronze :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_bronze" type="text" id="df_bronze" />
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Silver :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_silver" type="text" id="df_silver" />
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Gold :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_gold" type="text" id="df_gold" />
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Platinum :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_platinum" type="text" id="df_platinum"/>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:440px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:217px;">Benefactor :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
												<input name="df_benefactor" type="text" id="df_benefactor"/>
											</div>
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
                                        <span style="padding:0 10px 0 0;"><input type="checkbox" name="searchable" id="searchable" value="yes" /></span>Allow this event to be searchable</div>
                                    </div>
                                    <div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:372px; text-align:left;">
                                        <span style="padding:0 10px 0 0;"><input type="checkbox" name="display_fund" id="display_fund" value="yes" /></span>Display funding details on event details page</div>
                                    </div>
									<div class="reg_wid_form_input_main" style="width:420px; padding:0 0 15px 45px;">
                                    	<div class="reg_wid_form_name" style="width:372px; text-align:left;">
                                        <span style="padding:0 10px 0 0;"><input type="checkbox" name="attendee_list_public" id="attendee_list_public" value="yes" /></span>Make attendee list public</div>
                                    </div>
                                    </div>
									</div>									
                                </div>
								<!-- Hidden declaration started -->
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
		if(document.getElementById("fund_allowed").value.split(" ").join("") == "")
		{
			alert("Please select whether you would like to accept funding for this event.");
			document.getElementById("fund_allowed").focus();
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
		}
		if(document.getElementById("fund_allowed").value == "Yes")
		{			
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
</script>

<script type="text/javascript">
	function calculate_mindonation(fund_amt,max_cap)
	{
		if(fund_amt != "" && max_cap != "")
		{
		var min_donation_amt = parseInt(fund_amt.replace(/,/gi,""))/parseInt(max_cap.replace(/,/gi,""));
		
		document.getElementById('min_donation').innerHTML="Minimum donation amount per attendee to meet your target funding amount: $"+min_donation_amt.toFixed(2);
		}
		else
		{
			document.getElementById('min_donation').innerHTML="";
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