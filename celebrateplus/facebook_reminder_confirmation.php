<?php
	include("connect.php");
	$acc_pg_name='Facebook Invitation Confirmation';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $acc_pg_name;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body style="background:none;">
		<div class="top" style="padding-left:15px;">
			<div class="logo"><img src="images/logo.png" /></div>		
		</div>
		<div class="tab_box_bg_inner_left_text_regconf" style="padding:15px; width:auto;">
			<?php 
				if($_REQUEST['msg'] == 1) 
				{
					echo "Your Facebook message has been posted to your wall and your network has been notified about your event. Close this window and invite others using your other social networks, or continue on to your CelebratePlus dashboard";
				}
				else if($_REQUEST['msg'] == 2)
				{
					echo "Your selected Facebook friends have been reminded about your event. Close this window and invite others using your other social networks, or continue on to your CelebratePlus dashboard.";
				}
			?>
			<!--Your selected Facebook friends have been reminded about your event. Close this window and invite others using your other social networks, or continue on to your CelebratePlus dashboard.-->
		</div>            
    </body>
</html>


