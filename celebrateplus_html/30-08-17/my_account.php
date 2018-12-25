<? include("connect.php");

include("login_check.php");
$key= rand(26,25147);
?>
<? 
	$acc_pg_name='my_account';
$a = GetContent(5);

$fetchquery = "select * from organizer where id=".$_SESSION['SESS_USER_ID'];
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				
				
				$password = keshav_decrypt($row['password']);
				$fname= stripslashes($row['fname']);
				$opted_email= stripslashes($row['opted_email']);
				$lname= stripslashes($row['lname']);
				$email= stripslashes($row['email']);
				$phone= stripslashes($row['phone']);
				$payment_method= stripslashes($row['payment_method']);
				$mstreet_address= stripslashes($row['mstreet_address']);
				$mapartment= stripslashes($row['mapartment']);
				$mcity= stripslashes($row['mcity']);
				$mstate= stripslashes($row['mstate']);
				$mzip= stripslashes($row['mzip']);
				$mcountry= stripslashes($row['mcountry']);
				$mcomments= stripslashes($row['mcomments']);
				$paypalid= stripslashes($row['paypalid']);
				$city= stripslashes($row['city']);
				$state= stripslashes($row['state']);
				$country= stripslashes($row['country']);
				$find_us= stripslashes($row['find_us']);
				$acc_notes= stripslashes($row['acc_notes']);
				$ran_no= stripslashes($row['ran_no']);
				$temp= $row['temp'];
				
				$b = base64_decode($temp);
				$commission_rate= stripslashes($row['commission_rate']);
		}
	}
	


?>
<?

	if($_REQUEST['update_x'] > 0 and $_REQUEST['update_y'] > 0)
	{
		
		$password= keshav_encrypt($_REQUEST['password1']);
		$temp= $_REQUEST['password'];
		$email= addslashes($_REQUEST['email_id']);
		$opted_email= addslashes($_REQUEST['opted_email']);
		$fname= addslashes($_REQUEST['fname']);
		$lname= addslashes($_REQUEST['lname']);
		$phone= addslashes($_REQUEST['phone']);
		$city= addslashes($_REQUEST['city']);
		$state= addslashes($_REQUEST['state']);
		$country= addslashes($_REQUEST['country']);
		$cpassword= addslashes($_REQUEST['cpassword1']);
		$paypalid = addslashes($_REQUEST['paypalid']);
		if($paypalid != '')
		{
			$payment_method = 'PayPal';
		}
		$commission_rate = addslashes($_REQUEST['commission_rate']);
		
		$e =  encrypt($temp,$key);
		$temp = base64_encode($e);
		$temp = rtrim($temp,"==");
		$query = "update organizer set 			
					password='$password',
					email='$email',
					fname='$fname',
					lname='$lname',
					phone='$phone',
					city='$city',
					state='$state',
					country='$country',
					opted_email='$opted_email',
					paypalid='$paypalid',
					payment_method='$payment_method'
					where id = '".$_SESSION['SESS_USER_ID']."' limit 1";
					hb_get_result($query) or die(mysql_error());
					
					if($_REQUEST['opted_email'] == "true")
					{
						if(!GTG_is_dup_add('maillist','email',$email))
						{
							$query = "insert into maillist set email='$email'"; 							
								hb_get_result($query) or die(mysql_error());																						
						}		
					}
					else {
						if(GTG_is_dup_add('maillist','email',$email))
						{
							$query = "delete from maillist where email='$email'"; 							
								hb_get_result($query) or die(mysql_error());																						
						}		
					}						
				   location("my_account.php?msg=1");
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(5);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">My Account</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								<? if($_REQUEST['msg']==1){?>
								<div class="tab_box_bg_inner_left_text_regconf" style="width:900px; color:#FF0000; text-align:center;">Your account details have been updated successfully.</div>
								<? }?>
								<form name="site_update" id="site_update" method="post" action="my_account.php" onsubmit="javascript: return gtg_check1();">
                                <div class="reg_wid_form_main">
								
                                        
                                	<div class="reg_wid_form_left">
									
									<div>&nbsp;</div>
									
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Email<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="email_id"  type="text" id="email_id" value="<?=$email; ?>" class="form-control" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Password<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="password1" type="password" id="password1" value="<?=$password; ?>" class="form-control" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Confirm Password<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input type="password" name="cpassword1" id="cpassword1" value="<?=$password?>" class="form-control" /></div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">PayPal ID :</div>
                                        <div class="reg_wid_form_input_box">
											<div style="width:250px;">
                                        		<div class="reg_wid_form_input"><input type="text" name="paypalid" id="paypalid" value="<?=$paypalid?>" class="form-control" /></div>
												<div style="float:left; padding-top:10px;">
														<img src="images/why.jpg" onmouseover="document.getElementById('question_mark_title').style.display='block'" onmouseout="document.getElementById('question_mark_title').style.display='none'"/>
														<div style="position:absolute; border:solid 1px #666666; color:#444444; padding:2px 5px; line-height:14px; font-size:11px; margin-left:15px; display:none; z-index:9999; width:210px; background-color:#DDDDDD; font-weight:normal; border-radius:5px;" id="question_mark_title">
															Your PayPal ID is the email address that you used when you registered your PayPal account.
														</div>
													</div>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main" style="padding-bottom:0px;">
                                    	<div class="reg_wid_form_name" style="line-height:20px;">&nbsp;</div>
                                        <div class="reg_wid_form_input_box" style="height:40px;"><a href="payment_setup.php" class="common_link">How do I create my PayPal account?</a>
                                        </div>
                                    </div>
									<?php /*?><div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Commission Rate<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input type="text" name="commission_rate" id="commission_rate" value="<?=$commission_rate?>" /></div>
                                        </div>
                                    </div><?php */?>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name"><input type="checkbox" name="opted_email" id="opted_email" value="true" <?php if($opted_email == "true"){?> checked="checked" <?php } ?> /></div>
                                        <div class="reg_wid_form_input_box">
	                                       <div class="reg_btn_main" style="width:250px; padding-top:0px;">I would like to receive special offers, notifications and updates from CelebratePlus</div> 
                                       </div>
                                    </div>
                                    
                                    </div>
                                    <div class="reg_wid_form_right">
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">First Name<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="fname"  type="text" id="fname" value="<?=$fname; ?>" class="form-control" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Last Name<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="lname"  type="text" id="lname" value="<?=$lname; ?>" class="form-control" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Phone :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="phone" size="30" type="text" id="phone" value="<?=$phone; ?>" class="form-control" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">City :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input name="city" type="text" id="city" value="<?=$city; ?>" class="form-control" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">State<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
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
															?><option <? if($state == $r1['name']) { ?> selected="selected" <? } ?> value="<?=$r1['name'];?>"><?=$name;?></option><?
														}
													}
											  ?>
										    </select>
											<?php /*?><input name="state" type="text" id="state" value="<?=$state; ?>" /><?php */?>
											</div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Country<span style="color:#FF0000;">*</span> :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input">
											<select name="country" id="country" class="form-control">
											<option value="">Select Country</option>
											<option value="United States of America" <? if($country == 'United States of America') { ?> selected="selected" <? } ?>>United States of America</option>
											</select>
											</div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">&nbsp;</div>
                                        <div class="reg_wid_form_input_box" style="padding-top:0px;">
	                                       <div class="reg_btn_main" style="padding-top:0px">
											 <input type="image" name="update" id="update" src="images/update.png" />
	                                       </div> 
                                       </div>
                                    </div>
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
						var emailPat=/^(.+)@(.+)\.(.+)$/
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
					if(document.getElementById("cpassword").value.split(" ").join("") == "")
					{
						alert("Please enter confirm password.");
						document.getElementById("cpassword").focus();
						return false;
					}
					if(document.getElementById("cpassword").value.split(" ").join("") != document.getElementById("password").value.split(" ").join(""))
					{
						alert("Your password and password confirmation should match.");
						document.getElementById("cpassword").focus();
						return false;
					}
					if(document.getElementById("password").value.split(" ").join("") != document.getElementById("cpassword").value.split(" ").join(""))
					{
						alert("Your password and password confirmation do not match.");
						document.getElementById("cpassword").focus();
						return false;
					}
					if(document.getElementById("paypalid").value.split(" ").join("") != "")
					{
						var emailPat=/^(.+)@(.+)\.(.+)$/
						var matchArray=document.getElementById("paypalid").value.match(emailPat)
					
						if (matchArray==null) 
						{
							alert("Please enter a valid PayPal ID. Your PayPal ID must be the email address that is affiliated with your PayPal account.")
							document.getElementById("paypalid").focus();
							return false;
						}
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
					
					if(document.getElementById("state").value.split(" ").join("") == "")
					{
						alert("Please select a state.");
						document.getElementById("state").focus();
						return false;
					}
					if(document.getElementById("country").value.split(" ").join("") == "")
					{
						alert("Please select a country.");
						document.getElementById("country").focus();
						return false;
					}
		}
</script>