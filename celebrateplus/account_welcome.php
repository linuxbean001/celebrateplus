<? include("connect.php");
	if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
{
}
else
{
	$eve = $_REQUEST['eve_id'];
	location("login.php?frm=$eve");
}

?>
<? 
	$acc_pg_name='home';
$a = GetContent(15);?>
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
                    	<div class="inner_title_bg">Welcome to your CelebratePlus Account!</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?><br /><br />
								</div>
                                <div class="acc_come_link_main">
                                	<div class="acc_come_link">
                                	<ul>
                                    	<li><div class="acc_come_link_img"><a href="create_event.php"><img src="images/Create An Event.png" /></a></div>
                                        <div class="acc_come_link_aa"><a href="create_event.php">Create An Event</a></div></li>
                                        <li><div class="acc_come_link_img"><a href="account_find_event.php"><img src="images/Find An Event.png" /></a></div>
                                        <div class="acc_come_link_aa"><a href="account_find_event.php">Find An Event</a></div></li>
                                        <li><div class="acc_come_link_img"><a href="event_attending.php"><img src="images/Events I'm Attending.png" /></a></div>
                                        <div class="acc_come_link_aa"><a href="event_attending.php">Events I'm Attending</a></div></li>
                                        <li><div class="acc_come_link_img"><a href="event_hosting.php"><img src="images/events I'm Hosting.png" /></a></div>
                                        <div class="acc_come_link_aa"><a href="event_hosting.php">Events I'm Hosting</a></div></li>
                                        <li><div class="acc_come_link_img"><a href="my_account.php"><img src="images/my_account.png" /></a></div>
                                        <div class="acc_come_link_aa"><a href="my_account.php">My Account</a></div></li>
                                        <li><div class="acc_come_link_img"><a href="logout.php"><img src="images/Logout.png" /></a></div>
                                        <div class="acc_come_link_aa"><a href="logout.php">Logout</a></div></li>
                                    </ul>
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
