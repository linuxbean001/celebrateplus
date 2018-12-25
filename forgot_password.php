<? 
include("connect.php");
if($_REQUEST["Submit"])
{	
	$result=mysql_query("select * from organizer where email='".addslashes($_REQUEST["email"])."'") or die(mysql_error());	
	
	if(mysql_num_rows($result) > 0)
	{	
		$row=mysql_fetch_array($result);
		$to=$_REQUEST["email"];
		//$to=$row["email"];
		$from="info@celebrateplus.com";
		$subject="Your Celebrate Plus Account Login Information";
		$mailcontent='<table width="100%" border="0" cellpadding="2" cellspacing="2">
		<tr>
				<td colspan="2">Your Celebrate Plus account login information can be found below:</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="right" width="40%">Username :
				</td>
				<td>'.stripslashes($row["email"]).'		
				</td>
			</tr>
			<tr>
				<td align="right" width="40%">Password :
				</td>
				<td>'.stripslashes(keshav_decrypt($row["password"])).'		
				</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
		</table>';
		/*echo $mailcontent;
		exit;*/
		hb_send_mail($to,$subject,$mailcontent,$from);
		echo '<script language="javascript">location.href="forgot_password.php?msg=1";</script>';
	}
	else
	{
		echo '<script language="javascript">location.href="forgot_password.php?msg=2";</script>';
	}
	exit;
}
?>
<? $a = GetContent(26);?>
<? 
$pg_nm = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Celebrate Plus | Forgot Password</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Retrieve Your Password </div>
                    </div>
					
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
                                <div class="reg_wid_form_main" style="padding:0;">
                                	<div class="login_left" style="width:550px; border:none;">
									<?php if(isset($_REQUEST["msg"])) { ?>
										<div style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000; padding:0px; padding-bottom:10px;">
										<?
											if($_REQUEST["msg"]==1)
											{
												echo 'Your login information has been sent to your registered email address.';
											}
											if($_REQUEST["msg"]==2)
											{
												echo 'The email address that you entered could not be found.';
											}
										?>
										</div>
									<?php } ?>
										<form name="frm" method="post" action="forgot_password.php" onsubmit="javascript:return fp_empty_chk();">
											
	                                			<div class="form-group">
													<label>Enter your email address :</label>
													<input type="text" name="email" id="email" value="" class="form-control"  />
												</div>
												<div class="form-group">
													<div class="">
														<input type="hidden" name="Submit" id="Submit" value="Submit" />
														<input type="image" src="images/submit.png" name="SubmitImage" id="SubmitImage"/>
													</div>
												</div>
											
										</form>
									</div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
				<?
				$get_add_query2 = "select * from ad where location like '%Login Footer%' order by rand() limit 1";
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
	function fp_empty_chk()
	{
		if(document.getElementById("email").value.split(" ").join("") == "")
		{
			alert("Please enter an email address.");
			document.getElementById("email").focus();
			return false;
		}
		else
		{
			var emailPat=/^(.+)@(.+)$/
			var matchArray=document.getElementById("email").value.match(emailPat)
		
			if (matchArray==null) 
			{
				alert("The email address that you entered was not formatted correctly. Please re-input the email address in the correct format.");
				document.getElementById("email").focus();
				return false;
			}
		}
	}
</script>
