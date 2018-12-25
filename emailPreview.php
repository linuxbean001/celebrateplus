<?php
include("config.inc.php");
$event_mail_IR = "Invitation";
$invitation_design_style = $_REQUEST['style'];
$invitation_message = $_REQUEST['message'];
$tmpSecure = $SITE_SECURE_URL;
$SITE_SECURE_URL = $SITE_URL;

if($invitation_design_style == "1")
{
	include('email_design_1.php');
}
if($invitation_design_style == "2")
{
	include('email_design_2.php');
}
if($invitation_design_style == "3")
{
	include('email_design_3.php');
}
if($invitation_design_style == "4")
{
	include('email_design_4.php');
}
if($invitation_design_style == "5")
{
	include('email_design_5.php');
}
if($invitation_design_style == "6")
{
	include('email_design_6.php');
}
if($invitation_design_style == "7")
{
	include('email_design_7.php');
}
if($invitation_design_style == "8")
{
	include('email_design_8.php');
}
if($invitation_design_style == "9")
{
	include('email_design_9.php');
}
if($invitation_design_style == "10")
{
	include('email_design_10.php');
}
if($invitation_design_style == "11")
{
	include('email_design_11.php');
}
if($invitation_design_style == "12")
{
	include('email_design_12.php');
}

$SITE_SECURE_URL = $tmpSecure;

echo $mail_body;
?>