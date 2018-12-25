<?php
include("connect.php");

$func = $_REQUEST['f'];
$response = "";

if($func == "loggedIn")
{
	 if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0) $response .= "true";
	 else $response .= "false";
}

if($func == "emailCheck")
{
	$email = $_REQUEST['email'];
	$exist = hb_get_result("select email from organizer where email = '".$email."'");
	if(mysql_num_rows($exist) > 0) $response .= "false";
	else $response .= "true";
}

if($func == "login")
{
	if($_POST['email']!="" && $_POST['password']!="")
	{
	   $email=GTG_security($_POST['email']);
	   $password=$_POST['password'];	
       $log_query = "select * from organizer where email='".$email."' and password='".keshav_encrypt($password)."'";

	   $log_result = hb_get_result($log_query);
	   if(mysql_num_rows($log_result))
	   { 
		  	$log_row = mysql_fetch_array($log_result);		  
	    	$_SESSION['SESS_USER_ID'] = $log_row['id'];
	    	$response .= "true";
	   }
	   else $response .= "false";
	} 	  
}

echo $response;

?>