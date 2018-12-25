<? include("connect.php");
?>
<? 
	include("login_check.php");
	
	$event_id = $_REQUEST['event_id'];
	$acc_pg_name='';
	
$a = GetContent(19);
$sel= "select * from attendee where funding = 'Yes' and event_id = '$event_id' order by cdate desc";
$result=$prs_pageing->number_pageing($sel,20,10,'N','Y');


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
                    	<div class="inner_title_bg">Funding for <?=stripslashes(GetValue("events","title","id",checkNum($_REQUEST['event_id'])))?></div>
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
                                <div class="table-responsive">
                                 <table class="table table-hover">
                                	<thead>
                                		<tr>
	                                    	<th>Donation Date</th>
											<th>Name</th>
	                                        <th>User's Email Address</th>
	                                        <th>Total Payment</th>
	                                        <th>Event Donation Amount</th>
	                                        <th>CelebratePlus Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 <? $count=0; 
										 while($get=mysql_fetch_object($result[0])) 
										 {  
											$count++;
									 ?>	 
                                    	<tr>
                                        	<td><? echo get_cplus_date($get->cdate); ?></td>
											<td><? echo stripslashes($get->ufname); ?> <? echo stripslashes($get->ulname); ?></td>
											<td><? echo stripslashes($get->uemail); ?></td>
                                            <td>$<? echo $get->how_mch; ?></td>
                                            <td>$<? echo $get->gave_to_event_owner; ?>
											<? $final_total = $final_total + $get->gave_to_event_owner; ?>
											</td>
                                            <td>$<? echo $get->gave_to_site; ?></td>
                                        </tr>
										
										
                                   	 <? }?>   
									<tr>	
                                        <td colspan="5"><strong>TOTAL&nbsp;:&nbsp;</strong></td>
                                        <td>$<? echo number_format($final_total,2); ?></td>
                                       </tr>
                                    </tbody>
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
