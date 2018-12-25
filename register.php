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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(4);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg"><?=$a[0]?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								<form name="site_register" id="site_register" method="post" action="register.php" onSubmit="javascript: return gtg_check1();">
								<?
								if($_REQUEST['eve_id'])
								{
									?>
						<input type="hidden" name="eve_id" id="eve_id" value="<?=$_REQUEST['eve_id'];?>">
									<?
								}
								?>
                                <div class="row">
                                	<div class="col-md-6">
									
                                	<div class="form-group">
                                    	<label>Email<span style="color:#FF0000;">*</span> :</label>
                                        <input type="text" name="email_id" id="email_id" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                    	<label>Password<span style="color:#FF0000;">*</span> :</label>
                                        	<input type="password" name="password1" id="password1" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                    	<label>Confirm Password<span style="color:#FF0000;">*</span> :</label>
                                        	<input type="password" name="cpassword1"  id="cpassword1" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                    	<span><input type="checkbox" name="opted_email" id="opted_email" value="true" /></span>
	                                       <span> I would like to receive special offers, notifications and updates from CelebratePlus</span>
                                    </div>
                                   
                                    </div>
                                    <div class="col-md-6">
                                	<div class="form-group">
                                    	<label>First Name<span style="color:#FF0000;">*</span> :</label>
                                        <input type="text" name="fname" id="fname" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                    	<label>Last Name<span style="color:#FF0000;">*</span> :</label>
                                        <input type="text" name="lname" id="lname" class="form-control" />
                                    </div>
									<div class="form-group">
                                    	<label>Country<span style="color:#FF0000;">*</span> :</label>
										<select name="country" id="country" class="form-control">
											<option value="">Select Country</option>
											<option value="United States of America">United States of America</option>
										</select>
                                    </div>
									<div class="form-group">
                                    	<label>State<span style="color:#FF0000;">*</span> :</label>
											<select name="state" id="state" class="form-control">
											  <option value="">Select State</option>
											  <?
													$q = "select * from keshavstate order by name";
													$r = mysql_query($q);
													while($r1 = mysql_fetch_array($r))
													{
														$name = ucfirst(stripcslashes($r1['name']));
														if($name != "I live outside of the U.S")
														{
															?><option value="<?=$r1['name'];?>"><?=$name;?></option><?
														}

													}
											  ?>
										    </select>
                                    </div>
                                    <div class="form-group">
                                    	<label>Phone :</label>
                                        <input type="text" name="phone" id="phone" class="form-control" />
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                	<div class="form-group">
	                                    <input type="image" name="submit" id="submit" src="images/reg_btn.png" />
                                    </div>
                                </div>
						</form>
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
<script language="javascript" type="text/javascript">
			   function gtg_check1()
               {	
					if(document.getElementById("email").value.split(" ").join("") == "")
					{
						alert("Please enter your primary email address.");
						document.getElementById("email").focus();
						return false;
					}
					else
					{
						var emailPat=/^(.+)@(.+)$/
						var matchArray=document.getElementById("email").value.match(emailPat)
					
						if (matchArray==null) 
						{
							alert("Please enter a valid email address.")
							document.getElementById("email").focus();
							return false;
						}
					}
					if(document.getElementById("password").value.split(" ").join("") == "")
					{
						alert("Please enter your password.");
						document.getElementById("password").focus();
						return false;
					}
					if(document.getElementById("password").value.split(" ").join("") != document.getElementById("cpassword").value.split(" ").join(""))
					{
						alert("Your password and password confirmation do not match.");
						document.getElementById("cpassword").focus();
						return false;
					}
					if(document.getElementById("fname").value.split(" ").join("") == "")
					{
						alert("Please enter your first name.");
						document.getElementById("fname").focus();
						return false;
					}
					if(document.getElementById("lname").value.split(" ").join("") == "")
					{
						alert("Please enter your last name.");
						document.getElementById("lname").focus();
						return false;
					}
					if(document.getElementById("country").value.split(" ").join("") == "")
					{
						alert("Please select a country.");
						document.getElementById("country").focus();
						return false;
					}
					if(document.getElementById("state").value.split(" ").join("") == "")
					{
						alert("Please select a state.");
						document.getElementById("state").focus();
						return false;
					}
					
					
		}

</script>
