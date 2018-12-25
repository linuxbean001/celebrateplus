<? include("connect.php");
?>
<? 
include("login_check.php");
	$acc_pg_name='';
	
$a = GetContent(19);
$eve_query = "select * from attendee where is_attendee = 1 and event_id=".checkNum($_REQUEST['edit_id'])."";
$eve_res = hb_get_result($eve_query) or die(mysql_error());


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
                    	<div class="inner_title_bg">Attendees for <?=stripslashes(GetValue("events","title","id",checkNum($_REQUEST['edit_id'])))?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	
                                <div class="find_btn_main">
                                	<div class="find_btn"><a href="create_event.php"><img src="images/start_event.png" /></a></div>
                                    <div class="find_btn"><a href="#"><img src="images/setup_mypemp.png" /></a></div>
                                </div>
                                <div class="events_page_main">
                                	<div class="events_page_title_main">
                                    	<div class="events_page_title_eve2" style="width:180px;">Confirmation Date </div>
                                        <div class="events_page_title_date" style="width:240px;">Attendee Name </div>
                                        <div class="events_page_title_location" style="width:175px;"># of Attendees </div>
                                        <div class="events_page_title_addtend" style="width:135px;">Funding</div>
                                        <div class="events_page_title_addtend">Total Funded </div>
                                    </div>
                                    <div class="events_page_addtop_main">
									<?
										while($event_row = mysql_fetch_object($eve_res))
										{
											$confirm_dt = date("m-d-Y",strtotime($event_row->cdate));
											$fname123 = GetValue("organizer","fname","id",$event_row->user_id);
											$lname123 = GetValue("organizer","lname","id",$event_row->user_id);
											$tot_addendees = $event_row->tot_addendees;
											$funding = $event_row->funding;
											$att_fund_amt = $event_row->fund_amt;
											
											$gave_to_event_owner= $event_row->gave_to_event_owner;
											 stripslashes($row['gave_to_event_owner']);
											
											
									?>
                                    	<div class="events_page_add_main">
                                        	<div class="events_page_add_eve2" style="width:180px;"><?=$confirm_dt?></div>
                                            <div class="events_page_add_date" style="width:250px;"><?=$fname123?>&nbsp;<?=$lname123?>
											
											</div>
                                            <div class="events_page_add_location" style="width:175px;"><?=$tot_addendees?></div>
                                            <div class="events_page_add_addtend" style="width:135px;"><?=$funding?></div>
                                            <div class="events_page_add_addtend">$<?=$gave_to_event_owner;?></div>
                                            <div class="events_page_add_btn2">
                                            	<?php /*?><div class="events_page_add_btn_main2"><a href="edit_event.php?edit_id=<?=$eve_id;?>"><img src="images/editevent.png" /></a></div>
                                                <div class="events_page_add_btn_main2"><a href="#"><img src="images/atttendees.png" /></a></div>
                                                <div class="events_page_add_btn_main2"><a href="#"><img src="images/funding.png" /></a></div><?php */?>
                                            </div>
                                        </div>
										
                                   	 <? }?>   
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
