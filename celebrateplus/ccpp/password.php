<?
session_start();

include ("../include/config.inc.php");
include_once ("../include/sendmail.php");
include ("../include/functions.php");
$pas;
$ADMIN_MOUSEHOUR_COLOUR="#cccccc";
$ADMIN_MOUSEOUT_COLOUR="#FFFFFF";
$ADMIN_TOP_BGCOLOUR="#FFFFFF";

$db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
mysql_select_db($DATABASENAME,$db);  
$pas=$_GET["pas"];


	$query="select * from admin where username='".$_POST["name"]."' and password='".md5($_POST["pass"])."'";
	$result=mysql_query($query,$db);
  //echo $result;
	$row=mysql_fetch_array($result);
  
	$ADMIN_USERNAME=$row["username"];
	$ADMIN_PASSWORD=$row["password"];

	$name=$_POST["name"];
	$pass=md5($_POST["pass"]);

	if($_POST["name"]==$ADMIN_USERNAME && md5($_POST["pass"])==$ADMIN_PASSWORD)
	{		
		$_SESSION["ADMIN_SESS_USERID"]=$row["id"];
		setcookie("UsErOfAdMiN",$name);
		$_SESSION["ADMIN_SESS_USERTYPE"]="admin";
		$_SESSION["FIRST"]=$name;
		header("Location:deskboard.php?menu_name=Default");
		exit;
	}
 
   	 	
	$query="select * from sub_admin where username='".$_POST["name"]."' and password='".md5($_POST["pass"])."'";
	$result=mysql_query($query,$db);
  //echo $result;
	$row=mysql_fetch_array($result);
  
	$ADMIN_USERNAME=$row["username"];
	$ADMIN_PASSWORD=$row["password"];

	$name=$_POST["name"];
	$pass=md5($_POST["pass"]);

	if($_POST["name"]==$ADMIN_USERNAME && md5($_POST["pass"])==$ADMIN_PASSWORD)
	{		
		$_SESSION["ADMIN_SESS_USERID"]=$row["id"];
		setcookie("UsErOfAdMiN",$name);
		$_SESSION["ADMIN_SESS_USERTYPE"]="sub_admin";
		$_SESSION["FIRST"]=$name;
		header("Location:deskboard.php?menu_name=Default");
		exit;
	}
  
 
   	 header("Location:index.php?pas=1");

  
?>