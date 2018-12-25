<?
    session_start();
	
	include ("../include/config.inc.php");
	include_once ("../include/sendmail.php");
	include ("../include/functions.php");
	
  $db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD);
  mysql_select_db($DATABASENAME,$db);   
if($_REQUEST["Submit"])
{	
	$result=mysql_query("select * from admin where email='".addslashes($_REQUEST["email"])."'");	
	
	if(mysql_num_rows($result) > 0)
	{	
		$row=mysql_fetch_array($result);
		//$to=$_REQUEST["email"];
		$to=$_REQUEST["email"];
		$from=$ADMIN_MAIL;
		$subject="Your Admin Password Recovery";
		$mailcontent='<table width="100%" border="0" cellpadding="2" cellspacing="2">
		<tr>
				<td colspan="2">Hi, Here is your login information:</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="right" width="40%">Password :
				</td>
				<td>'.stripslashes($row["password"]).'		
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
		</table>';
		/*echo $mailcontent;
		exit;*/
		SendHTMLMail($to,$subject,$mailcontent,$from);
		echo '<script language="javascript">location.href="forgetpassword.php?msg=1";</script>';
	}
	else
	{
		echo '<script language="javascript">location.href="forgetpassword.php?msg=2";</script>';
	}
}
?>
