<? 
	include("connect.php");
	header("Cache-Control: public");
?>
<? $a = GetContent(4);?>
<?

	if($_REQUEST['submit_x'] > 0 && $_REQUEST['submit_y'] > 0)
	{
		$username= addslashes($_REQUEST['username']);
		$password= keshav_encrypt($_REQUEST['password1']);
		unset($_REQUEST['cpassword1']);
		unset($_REQUEST['password1']);
		$email= addslashes($_REQUEST['email_id']);
		$fname= addslashes($_REQUEST['fname']);
		$lname= addslashes($_REQUEST['lname']);
		$phone= addslashes($_REQUEST['phone']);
		$country= addslashes($_REQUEST['country']);
		$state= addslashes($_REQUEST['state']);
		$opted_email= addslashes($_REQUEST['opted_email']);
		
		$exist = hb_get_result("select email from organizer where email = '".$email."'");
		if(mysql_num_rows($exist) > 0)
			{?>
		<script language="javascript">
			alert("The email address that you used is already registered to another CelebratePlus account. Please login to your account or use a different email address.");
			window.history.go(-1);	
		</script>
		<? exit;}else { 
		$query = "insert into organizer set add_date=now(),password='$password',email='$email',fname='$fname',lname='$lname',phone='$phone',opted_email='$opted_email',username='$username',state='$state',country='$country'";
					$printrrequest = print_r($_REQUEST,true);
					$query3 = addslashes($query);
					$query2 = "INSERT INTO registerLog SET request='$printrrequest', queryStr = '$query3' ";
					//echo $query2;
					hb_get_result($query2);
					$date = date('Y-m-d H:i:s');
					file_put_contents("registerLog.txt", "$date: $query2 \n\n", FILE_APPEND);
					hb_get_result($query) or die(mysql_error());
					$_SESSION['SESS_USER_ID'] = mysql_insert_id(); 
				}
				
				if($_REQUEST['opted_email'] == "true")
				{
					if(!GTG_is_dup_add('maillist','email',$email))
					{
						$query = "insert into maillist set email='$email'"; 							
							hb_get_result($query) or die(mysql_error());																						
					}		
				}
		/*=====================================================================================================================*/			
					$body='<table width="570" border="0" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				<tr>
					<td colspan=2>
						<div align="right" colspan="4" nowrap="nowrap"><strong>Thank you for registering with CelebratePlus. Using CelebratePlus you can create events,manage attendees and raise funds to support your event.Your account information can be found below:</strong></div></td>
					
				</tr>
				<tr>
				<td height="10px;"></td>
				</tr>
				<tr>
					<td>
					<div align="right"><strong>Email : </strong></div></td>
					<td><div align="left">'.$email.' </div></td>
				</tr>
				<tr>
				<td height="10px;"></td>
				</tr>
				<tr>
					<td>
					<div align="right"><strong>Password: </strong></div></td>
					<td><div align="left">'.$password.' </div></td>
				</tr>
				<tr>
					<td>
					<div align="right"><strong>Thank you!</strong></div></td>
					<td></td>
				</tr>
				<tr>
					<td>
					<div align="right"><strong>CelebratePlus</strong></div></td>
					<td></td>
				</tr>
				</table>';
			
			
			$to=$email;
			$from="info@celebrateplus.com";
			$mailcontent=$body;
			$subject="Your CelebratePlus Account";
			
			//SendHTMLMail1($to,$subject,$body,$from);
		/*=====================================================================================================================*/

		if($_SESSION['then_go'] != '')
		{
			// Now get the session into a local variable as we need to free it for other pages
			$then_go = $_SESSION['then_go'];
			
			// Now free the session
			unset($_SESSION['then_go']);

			location($then_go);
		}
		else
		{
			location("account_welcome.php");
		}
	}
	
?>


