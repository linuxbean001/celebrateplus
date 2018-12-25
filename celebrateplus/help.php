<? 
	include("connect.php");
	require_once('recaptchalib.php');
	$id=13;
	$promo_query="select * from content_promos where navigation like '%".$id."%'";
	$promo_result=mysql_query($promo_query);
	$total_promo_rows = mysql_num_rows($promo_result);
?>
<? $a = GetContent(13);
if(isset($_REQUEST['Send']))
{		 	
	$privatekey = "6LfG8tcSAAAAAH_0Z0uYKKM5Muil7ETF55ctfN1H";
		  $resp = recaptcha_check_answer ($privatekey,
		  $_SERVER["REMOTE_ADDR"],
		  $_POST["recaptcha_challenge_field"],
		  $_POST["recaptcha_response_field"]);
		
		  if (!$resp->is_valid) 
		  {
		  // What happens when the CAPTCHA was entered incorrectly
		   ?>
				<script language="javascript">
								alert("Please enter the correct security code");
								window.history.go(-1);
							</script>
			<?php	
		  } 
		  else 
		  {
				$body='<table width="500" border="0" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; background-color:#CCCCCC; color:#333333;">
					<tr>
						<td width="32%">
							<div align="right"><strong>Name	 :</strong></div></td>
						<td width="78%"><div align="left">'.$_REQUEST['name'].' </div></td>
					</tr>
					<tr>
						<td width="32%">
							<div align="right"><strong>Email Address :</strong></div></td>
						<td width="78%"><div align="left">'.$_REQUEST['email'].' </div></td>
					</tr>
					<tr>
						<td width="32%">
							<div align="right"><strong>Phone :</strong></div></td>
						<td width="78%"><div align="left">'.$_REQUEST['phone'].' </div></td>
					</tr>
					<tr>
						<td>
						<div align="right"><strong>Subject Line :</strong></div></td>
						<td><div align="left">'.$_REQUEST['subject'].' </div></td>
					</tr>
					
					<tr>
						<td>
						<div align="right"><strong>Message :</strong></div></td>
						<td><div align="left">'.$_REQUEST['message'].' </div></td>
					</tr>
				
					</table>';
											
										
						$to="support@idealgrowth.com";
						$to2="Help@CelebratePlus.com";
						
						
						$from=$_REQUEST['email'];
						$subject="CelebratePlus Web Site Inquiry";
						//$mailcontent = $body; 
						$cc="";
						hb_send_mail($to,$subject,$body,$from,$cc);
						hb_send_mail($to2,$subject,$body,$from,$cc);
						?>
						<script language="javascript">
							alert("Thank you for contacting us!");
							window.location.href= "help.php";
						</script>
					<?	
					
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(13);?>
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
                        	<div class="tab_box_bg_inner_left" <?php if(!($total_promo_rows > 0)) {?> style="width:966px" <?php } ?>>
                            	<div class="tab_box_bg_inner_left_text" <?php if(!($total_promo_rows > 0)) {?> style="width:935px" <?php } ?>>
                                <?=$a[1]?>
                                </div>
                            </div>
                        	<?php if($total_promo_rows > 0) {?>
                        		<div class="tab_box_bg_inner_right">
									<?php include("right_content.php");?>
								</div>
							<?php } ?>
							<form action="help.php" name="help_form"  method="post" enctype="multipart/form-data" onSubmit="javascript:return contactcheck();">
								<div class="tab_right_text_main">
									<div class="tab_right_text_title" >Contact Us!</div>
									<div class="reg_wid_form_input_main" style="padding-top:25px;">
										<div class="reg_wid_form_name"><span style="color:#FF0000">*</span>Name : </div>
										<div class="reg_wid_form_input_box">
											<div class="reg_wid_form_input"><input type="text" name="name" id="name" /></div>
										</div>
									</div>
									<div class="reg_wid_form_input_main">
										<div class="reg_wid_form_name"><span style="color:#FF0000">*</span>Email Address : </div>
										<div class="reg_wid_form_input_box">
											<div class="reg_wid_form_input"><input type="text" name="email" id="email"/></div>
										</div>
									</div>									
									<div class="reg_wid_form_input_main">
										<div class="reg_wid_form_name">Phone : </div>
										<div class="reg_wid_form_input_box">
											<div class="reg_wid_form_input"><input type="text" name="phone" id="phone"/></div>
										</div>
									</div>
									<div class="reg_wid_form_input_main">
										<div class="reg_wid_form_name"><span style="color:#FF0000">*</span>Subject Line : </div>
										<div class="reg_wid_form_input_box">
											<div class="reg_wid_form_input"><input type="text" name="subject" id="subject"/></div>
										</div>
									</div>
									<div class="reg_wid_form_input_main" style="height:138px;">
										<div class="reg_wid_form_name"><span style="color:#FF0000">*</span>Message : </div>
										<div class="reg_wid_form_input_box">
											<div class="cplus_acctcreateevent_tr">
												<textarea name="message" id="message" style="height:134px; width:354px;"></textarea>
											</div>
										</div>
									</div>
									<div class="reg_wid_form_input_main">
										<div class="reg_wid_form_name"><span style="color:#FF0000">*</span>Security Code : </div>
										<div class="reg_wid_form_input_box">
											<?php
											  $publickey = "6LfG8tcSAAAAANuIHyjmP5WsmZl2zhDTSOU-tR2C"; 
											  echo recaptcha_get_html($publickey);
											 ?> 
										</div>
									</div>
									<div class="reg_wid_form_input_main">
										<div class="reg_wid_form_name">&nbsp;</div>
										<div class="reg_wid_form_input_box" style="padding-top:85px;">
											<div>
												<input type="hidden" name="Send" value="Send" />
												<input width="126" type="image" height="34" value="" id="send_invitation" name="send_invitation" src="images/send.png">
											</div>
										</div>
									</div>
								</div>
							</form>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
				<?
				$get_add_query2 = "select * from ad where location like '%Help Footer%' order by rand() limit 1";
					$get_add_result2 = hb_get_result($get_add_query2) or die(mysql_error());
					if(mysql_num_rows($get_add_result2) > 0)
					{
				?>
				<div class="promo_title" style="padding-top:20px; height:90px;">
				<?
					
						while($get_add_row2 = mysql_fetch_array($get_add_result2))
						{
							 
							 ?>
							 <a href="<?=$get_add_row2['link'];?>" target="_blank">
							 <img src="advertiser_images/<?=$get_add_row2['image_path'];?>" width="923" height="90" border="0" />
							 </a>
							 <?
						}
				?>
				</div>
				<?
				}
				?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
<script language="javascript">
	function contactcheck()
	{
		if(document.getElementById("name").value == "")
		{
			alert("Please enter your name.");
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("email").value == "")
		{
			alert("Please enter your email address.");
			document.getElementById("email").focus();
			return false;
		}
		else
		{
			var emailPat=/^(.+)@(.+)$/
			var matchArray=document.getElementById("email").value.match(emailPat)
		
			if (matchArray==null) 
			{
				alert("The email address you entered is not formatted correctly.")
				document.getElementById("email").focus();
				return false;
			}
		}
		if(document.getElementById("subject").value == "")
		{
			alert("Please enter a subject line.");
			document.getElementById("subject").focus();
			return false;
		}
		if(document.getElementById("message").value == "")
		{
			alert("Please enter a message.");
			document.getElementById("message").focus();
			return false;
		}
		
	}
</script>