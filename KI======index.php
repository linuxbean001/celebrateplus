<? include("connect.php");


	if($_REQUEST['submit_x'] > 0 && $_REQUEST['submit_y'] > 0)
	{
		$email = $_REQUEST['email'];
		if(GTG_is_dup_add('maillist','email',$email))
		{
			unset($_REQUEST['Submit']);
			location("index.php?msg=4");							
			return;
		}																														
		$query = "insert into maillist 
		set email='$email'"; 
		
		hb_get_result($query) or die(mysql_error());
		location("index.php?msg=1");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to</title>
<style type="text/css">
body {
	margin:0px;
	padding:0px;	
}
.main {
	float:left;
	width:100%;
	margin:0px;
	padding:0px;
}
.margin { 
	margin:0 auto;
	width:600px;
}
.min {	
	float:left;
	width:600px;
}
.logo {
	float:left;
	width:600px;
	text-align:center;
}
.logo img {
	padding-top:35px;
	padding-bottom:40px;
}
.logo_bot_tex_red {
	float:left;
	width:600px;
	color:#f15804;
	font-family:"Century Gothic";
	font-size:30px;
	line-height:30px;
	padding-bottom:10px;
	text-align:center;
}
.logo_bot_tex_black {
	float:left;
	width:600px;
	color:#000000;
	font-family:"Century Gothic";
	font-size:20px;
	line-height:24px;
	padding-bottom:40px;
	text-align:center;
	font-style:italic;
}
.intro_surch_main {
	float:left;
	width:600px;
	background-image:url(images/mail_bg.png);
	background-position:center top;
	background-repeat:no-repeat;
	padding-bottom:20px;
}
.intro_surch {
	font-family:"Century Gothic";
	font-size:18px;
	color:#000000;
	width:480px;
	padding:0px 20px;
	line-height:60px;
	border:none;
	background:none;
	height:62px;
	margin-left:35px;
}
.intro_sign_up {
	float:left;
	width:600px;
	text-align:center;
}

</style>
</head>

<body>
<div class="main">
	<div class="margin">
		<div class="min">
			<div class="logo"><img src="images/celebrateplus.png" border="0" /></div>
			<div class="logo_bot_tex_red">The new way to raise funds<br />for your parties and events!</div>
			<div class="logo_bot_tex_black">Stay informed, receive updates and get notified<br />when we launch in 3rd quarter 2012:</div>
			<?
			if($_REQUEST['msg'] == 1)
			{
			?>
			<div class="logo_bot_tex_black" style="padding-bottom:10px; color:#FF0000;">Thank you for subscribing!</div>
			<?
			}
			?>
			<?
			if($_REQUEST['msg'] == 4)
			{
			?>
			<div class="logo_bot_tex_black" style="padding-bottom:10px; color:#FF0000;">Your email address is alredy registred.</div>
			<?
			}
			?>
			<form name="add_email" id="add_emial" method="post" action="index.php" onSubmit="javascript: return gtg_check1();">
			
			<div class="intro_surch_main"><input name="email" id="email" type="text" value="email address" class="intro_surch"  onBlur="if(this.value==''){this.value='email address'}" onFocus="if(this.value=='email address'){this.value=''}" /></div>
			
			<div class="intro_sign_up"><input type="image" name="submit" id="submit" src="images/sign_up.png" /></div>
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
							alert("Please enter valid email.")
							document.getElementById("email").focus();
							return false;
						}
					}
				}
			</script>
			</form>
		</div>
	</div>
</div>
</body>
</html>
