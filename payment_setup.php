<? include("connect.php");
include("login_check.php");
if($_REQUEST['save_x'] > 0 && $_REQUEST['save_y'] > 0)
{
	$paypalid = $_REQUEST['paypalid'];
	if($paypalid != '')
	{
		$update_query = "update organizer set paypalid = '$paypalid' where id = '".$_SESSION['SESS_USER_ID']."' limit 1";
		hb_get_result($update_query) or die(mysql_error());
	}
	
	
	
}
$select_query = "select paypalid from organizer where id = '".$_SESSION['SESS_USER_ID']."' limit 1";
	$pp_id_result =	hb_get_result($select_query) or die(mysql_error());
	
	$pp_id_row = mysql_fetch_array($pp_id_result);
	
	$GBV_CURRENT_USER_PAYPAL_ID  = $pp_id_row['paypalid'];
?>
<? 
	$acc_pg_name='create_event';
$a = GetContent(22);?>
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
</style>
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Payment Method Setup</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								
                                <div class="col-md-12">
                                	<div class="col-md-6">
                                    	<div class="form_login_title">New to PayPal?</div>
                                	<div class="reg_wid_form_input_main">
                                    	<div>If you currently do not have a PayPal account, you can signup for PayPal easily by following the link below. Once you complete your PayPal setup you can then add your PayPal account to your CelebratePlus account and you can start accepting event donations online.</div>
                                    </div>
									<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name"><input type="image" name="signup_for_paypal" id="signup_for_paypal" src="images/signup_for_paypal.png" onclick="window.open('https://www.paypal.com');" /></div>
                                       
                                    </div>
                                    
									<!--<div class="addevent_2btn_main" style="margin-left:390px; margin-top:965px; position:absolute; padding-left:0px;"><input type="image" name="save_event" id="save_event" src="images/save_without_creating_invit.png" /></div>-->
                                    </div>
									<form name="CREATE_EVENT" id="CREATE_EVENT" enctype="multipart/form-data" method="post" onsubmit="javascript:return crt_event_chk()" action="payment_setup.php">
                                	<div class="col-md-6">
                                    	<div class="form_login_title">Already have a PayPal Account</div>
                                        	<div>Already have a PayPal account? Connect your PayPal account to your CelebratePlus account by entering the email address that you used when registering with PayPal into the My PayPal Account field below. Once you have connected your PayPal account to your CelebratePlus account you can start accepting event donations online and the funds will be directly deposited into your PayPal account on record.</div>
                                        	<br>
                                        <div class="form-group">										
                                    		<div>
													My PayPal Account : &nbsp;
																							
											</div>
                                        	
											
                                        	<input name="paypalid" type="text" class="form-control" id="paypalid" value="<?=$GBV_CURRENT_USER_PAYPAL_ID;?>"  <?php /*?><? if($GBV_CURRENT_USER_PAYPAL_ID != ''){ ?> readonly="true" disabled="disabled"<? } ?><?php */?> />
													<div style="float:left; padding-top:10px;">
														<img src="images/why.jpg" onmouseover="document.getElementById('question_mark_title').style.display='block'" onmouseout="document.getElementById('question_mark_title').style.display='none'"/>
														<div style="position:absolute; border:solid 1px #666666; color:#444444; padding:2px 5px; line-height:14px; font-size:11px; margin-left:15px; display:none; z-index:9999; width:210px; background-color:#DDDDDD; font-weight:normal; border-radius:5px;" id="question_mark_title">
															Your My PayPal Account is the email address that you used when you registered your PayPal account.
														</div>
													</div>
											
											<?
												/*if($GBV_CURRENT_USER_PAYPAL_ID != '')
												{
												?>
												<input type="hidden" name="paypalid" id="paypalid" value="<?=$GBV_CURRENT_USER_PAYPAL_ID;?>" />
												<?
												}*/
											?>
                                        	
                                    	</div>
									<div class="col-md-6">
                                    	<div class="form-group">
                                        	<input type="image" name="save" id="save" src="images/save.png" />
                                           
                                        </div>
                                        
                                    </div>
                                    </div><!-- Hidden declaration started -->
								<input type="hidden" name="submitted" id="submitted" value="submitted" />
								<!-- Hidden declaration ended -->
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
    </body>
</html>
<script type="text/javascript">
	function crt_event_chk()
	{
		if(document.getElementById("paypalid").value.split(" ").join("") == "")
		{
			alert("Please enter your paypal email address.");
			document.getElementById("paypalid").focus();
			return false;
		}
		else
		{
			var emailPat=/^(.+)@(.+)$/
			var matchArray=document.getElementById("paypalid").value.match(emailPat)
		
			if (matchArray==null) 
			{
				alert("Please enter your valid paypal email address.")
				document.getElementById("paypalid").focus();
				return false;
			}
		}
		return true;
	}
function show(fund_allowed)
{
	if(fund_allowed == 'Yes')
	{
		document.getElementById("funding_attributes").style.display = 'block';
	}
	else
	{
		document.getElementById("funding_attributes").style.display = 'none';
	}
}
</script>