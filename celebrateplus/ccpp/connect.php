<?php
	session_start();
	/*
	$sam_cnn_page_array=split("/",$_SERVER['PHP_SELF']);	
	if($sam_cnn_page_array[count($sam_cnn_page_array)-1] != "index.php")
	{		
		include("security.php");
	}
	*/
	include("security.php");
	include ("../include/config.inc.php");
	include_once ("../include/sendmail.php");
	include ("../include/functions.php");
	include("../classes/event.php");
	include("../classes/organizer.php");
	include("../classes/attendee.php");
	
  $ADMIN_MOUSEHOUR_COLOUR="#cccccc";
  $ADMIN_MOUSEOUT_COLOUR="#FFFFFF";
  $ADMIN_TOP_BGCOLOUR="#FFFFFF";
  
  $db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
  mysql_select_db($DATABASENAME,$db);  
    
?>
