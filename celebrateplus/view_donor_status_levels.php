<? include("connect.php");?>
<?
	$event_id = checkNum($_REQUEST['eve_id']);
	$_SESSION['from_where'] = 'event_detail.php';
	$_SESSION['event_id'] = $event_id;
	$event_query = hb_get_result("select * from events where id=$event_id and deleted != 1");
	$event_row = mysql_fetch_object($event_query);
	$event_title = stripslashes($event_row->title);
	
	
	$define_donation_levels = stripslashes($event_row->define_donation_levels);
	$df_friends = stripslashes($event_row->df_friends);
	$df_bronze = stripslashes($event_row->df_bronze);
	$df_silver = stripslashes($event_row->df_silver);
	$df_gold = stripslashes($event_row->df_gold);
	$df_platinum = stripslashes($event_row->df_platinum);
	$df_benefactor = stripslashes($event_row->df_benefactor);
	
	
	
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<?php include_once("google_analytics.php");?>
</head>
    <body style="background-color:#FFFFFF; background-image:none;">
    	
                                	<div class="eve_name_left" style="padding-left:20px;">
						
										
										
							<? if($define_donation_levels == "yes"){ ?>
							<div class="contribute_btn" style="text-align:left;">
							<div class="contribute_btn" style="text-align:left; font-size:19px; font-weight:bold; color:#F86802;">
							<?=$event_title;?>
							</div>
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
                                    </div>
                                    
                                       
    </body>
</html>
