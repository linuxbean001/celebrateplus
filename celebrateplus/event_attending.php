<? include("connect.php");
include("login_check.php");
?>
<? 
	$acc_pg_name='event_attending';
$a = GetContent(18);?>

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
                    	<div class="inner_title_bg">Events I’m Attending</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
                                <div class="find_btn_main">
                                	<div class="find_btn"><a href="account_find_event.php"><img src="images/find_eve.png" /></a></div>
                                    <!--<div class="find_btn"><a href="#"><img src="images/fund_eve.png" /></a></div>-->
                                </div>
                                <div class="events_page_main">
                                	<!--<div class="events_page_title_main">
                                    	<div class="events_page_title_eve">Event Name</div>
                                        <div class="events_page_title_date">Date</div>
                                        <div class="events_page_title_location">Location</div>
                                    </div>-->
									<table cellpadding="0" cellspacing="0" border="0" width="935">
										<tr class="events_host_title_tr">
											<td width="20"></td>
											<td class="event_host_td1 event_title_style" style="width:300px; border:none;">Event Name</td>
											<td class="event_host_td2 event_title_style" style="width:190px; border:none;">Date</td>
											<td class="event_host_td3 event_title_style" style="border:none;">Location</td>
											<td class="event_host_td4 event_title_style" style="border:none;">&nbsp;</td>
											<td class="event_host_td5 event_title_style" style="width:125px; border:none;"></td>
										</tr>  
									<? //	echo "select * from attendee where user_id=".$_SESSION['SESS_USER_ID'];
										$attending_res = hb_get_result("select * from attendee where user_id=".$_SESSION['SESS_USER_ID']." and is_attendee = 1 order by esdate desc");
										while($att_row = mysql_fetch_object($attending_res))
										{
											$eve_nm = $att_row->etitle;
											$eve_st_dt = convert_us($att_row->esdate);
											$eve_ed_dt = convert_us($att_row->eedate);
											$eve_id = $att_row->event_id;
											
											$eve_loc = stripslashes(GetValue("events","loc_name","id",$att_row->event_id));?>
											<tr class="events_host_data_tr">
												<td class="event_host_td1" style="width:20px;"></td>
												<td class="event_host_td1 event_data_style">
													<a href="acc_event_detail.php?eve_id=<?=$eve_id;?>"><?=str_replace("\\","",$eve_nm);?></a>
												</td>
												<td class="event_host_td2 event_data_style">
													<?
														if($eve_st_dt != "00-00-0000")
														{
															echo $eve_st_dt;
														}
														?> - <?
														if($eve_ed_dt != "00-00-0000")
														{
															echo $eve_ed_dt;
														}
													?>
												</td>
												<td class="event_host_td3 event_data_style"><?=str_replace("\\","",$eve_loc);?></td>
												<td class="event_host_td4 event_data_style"><?=$eve_fname?>&nbsp;<?=$eve_lname?></td>
												<td class="event_host_td5 event_data_style"><a href="acc_event_detail.php?eve_id=<?=$eve_id;?>"><img src="images/event_details.png" /></a></td>
										</tr>
										<? }?>
                                    </table>
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
