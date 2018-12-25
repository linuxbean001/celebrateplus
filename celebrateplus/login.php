<? include("connect.php");
?>
<? $a = GetContent(26);?>
<? 
$pg_nm = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(26);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Login</div>
                    </div>
					<form id="site_login" name="site_login" method="post" action="login_process.php" onsubmit="javascript:return login_chk()"> 
					
					<input type="hidden" name="frm" value="<?=$_REQUEST['frm']?>" />
					
						<input type="hidden" name="from_search" value="<?=$_REQUEST['eve_id']?>" />
					
						<input type="hidden" name="goto" value="<?=$_REQUEST['goto']?>" />
					
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px;">
                                <div class="reg_wid_form_main" style="padding-left:0;">
                                	<div class="login_left">
                                	<div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Email :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input type="text" name="email" id="email" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">Password :</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="reg_wid_form_input"><input type="password" name="password" id="password" /></div>
                                        </div>
                                    </div>
                                    <div class="reg_wid_form_input_main">
                                    	<div class="reg_wid_form_name">&nbsp;</div>
                                        <div class="reg_wid_form_input_box">
                                        	<div class="login_btn_main"><input type="submit" name="Submit" id="Submit" class="login_btn"  value=""/></div>
                                        </div>
                                    </div>
									<div class="reg_wid_form_input_main">
										<div class="reg_wid_form_name" style="width:100px;">&nbsp;</div>
                                        <div class="reg_wid_form_input_box" style="width:250px; text-align:right;">
											Forgot your password? <a href="forgot_password.php" style="color:#F86802">Click here.</a>
										</div>
									</div>
                                    </div>
                                    <div class="login_right">
                                    	<div class="login_right_title"><?=$a[0]?></div>
                                        <div class="login_right_text" style="padding-top:0px; margin-top:-4px;"><?=$a[1]?></div>
                                        <div class="reg_btn_main" style="padding-top:6px;"><a href="register.php?eve_id=<?=$_REQUEST['eve_id'];?>"><input type="button" class="reg_btn" onclick="window.location.href='register.php'" value="" /></a></div>
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
					</form>
                </div>
            </div>
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
<script type="text/javascript">
	function login_chk()
	{
		if(document.getElementById("email").value.split(" ").join("") == "")
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
				alert("Please enter valid email.")
				document.getElementById("email").focus();
				return false;
			}
		}
		if(document.getElementById("password").value.split(" ").join("") == "")
		{
			alert("Please enter password.");
			document.getElementById("password").focus();
			return false;
		}
		return true;
	}	
</script>
