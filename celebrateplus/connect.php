<?php
	session_start();
	ob_start();
	header("Cache-Control: public");
	include ("config.inc.php");
	include_once ("include/sendmail.php");
	include ("include/functions.php");

	
  $ADMIN_MOUSEHOUR_COLOUR="#cccccc";
  $ADMIN_MOUSEOUT_COLOUR="#FFFFFF";
  $ADMIN_TOP_BGCOLOUR="#FFFFFF";
  
  $db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
  mysql_select_db($DATABASENAME,$db);  
  
  $GBV_CURRENT_USER_PAYPAL_ID = GetValue("organizer","paypalid","id",$_SESSION['SESS_USER_ID']);
  $GBV_SITE_COMMISSION_RATE = GetValue("commission_rate","commission_rate","id",1);
  
  $current_file_redirect_uri = $_SERVER['REQUEST_URI'];
    
?>
