<? include("connect.php");
include("login_check.php");
$acc_pg_name='';
$a = GetContent(19);
$event_id = checkNum($_REQUEST['edit_id']);
$sel1= "select * from invitations_email where event_id = '$event_id' order by add_date desc" ;
$result1=$prs_pageing->number_pageing($sel1,20,10,'N','Y') or die(mysql_error());
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
                    	<div class="inner_title_bg">Invitees for <?=stripslashes(GetValue("events","title","id",checkNum($_REQUEST['edit_id'])))?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<?php if($_REQUEST['msg'] == 1) {?>
								 <div style="width:100%; text-align:center; height:auto; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000;">
									Your event reminder has been sent.								
								 </div>
								<?php } ?>
                                <div class="find_btn_main">
                                	<div class="find_btn"><a href="create_event.php"><img src="images/start_event.png" /></a></div>
                                    <div class="find_btn"><a href="payment_setup.php"><img src="images/setup_mypemp.png" /></a></div>
									<div class="find_btn"><a href="event_reminder.php?event_id=<?=$_REQUEST['edit_id'];?>"><img src="images/event_reminder.png" /></a></div>
									<div class="find_btn"><a href="event_email_invitation.php?event_id=<?=$_REQUEST['edit_id'];?>"><img src="images/event_invitees.png" /></a></div>
                                </div>
                                 <div class="table-responsive">
                                 <table class="table table-hover">
                                	<thead>
                                	<tr>
                                    	<th>Date Invited</th>
                                        <th>Email Address</th>
                                        <th>Attendance</th>
                                    </tr>   
                                    </thead>
                                    <tbody>
										<? $count=0; 
											while($inv_row = mysql_fetch_array($result1[0]))
											{  
												$count++;
										?>
                                    	<tr>
                                        	<td>
											<? echo convert_us($inv_row['add_date']); ?>
											</td>
                                            <td>
											<? echo stripslashes($inv_row['email']); ?>											
											</td>
                                            <td>
											 <?
	$invite_status = "select status from attendee where uemail = '".$inv_row['email']."' and event_id = '$event_id'";
	$invite_status_result=hb_get_result($invite_status)or die(mysql_error());
	$invite_status_row=mysql_fetch_array($invite_status_result);
	$invite_status_count = mysql_num_rows($invite_status_result);
	$invite_status_row['status'];
	if($invite_status_count == 0 && $invite_status_row['status'] == "")
	{
		echo "Has Not Confirmed";
	}
	if($invite_status_count != 0 && $invite_status_row['status'] =="")
	{
		echo "Confirmed";
	}
	if($invite_status_count != 0 && $invite_status_row['status'] !="")
	{
		echo $invite_status_row['status'];
	}
											 ?>
											</td>
                                        </tr>
                                   	 <? }?>   
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