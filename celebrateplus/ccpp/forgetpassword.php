<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
</head>

<body style="background-color:#4F5D66"  style="padding-top:5px">
<form name="frm" id="frm" method="post" action="forget_pwd_process.php?Submit=1">
<table width="328" border="0" align="center" cellpadding="0" cellspacing="0">
  <?php
	  if($_REQUEST["msg"]==1)
	  {
	?>
  		<tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" align="left" valign="top"><img src="images/login_top1.jpg" width="8" height="26" /></td>
        <td align="left" valign="middle" class="login_top_center"><img src="images/hollmark.jpg" width="16" height="14" />&nbsp;&nbsp;&nbsp;<span class="login_text">Login Detail Sent Sucessfully to your Email</td>
        <td width="8" align="left" valign="top"><img src="images/login_top2.jpg" width="8" height="26" /></td>
      </tr>
    </table></td>
  </tr>
  <? 
  		}
  ?>
  <?php
	  if($_REQUEST["msg"]==2)
	  {
	?>
  		<tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" align="left" valign="top"><img src="images/login_top1.jpg" width="8" height="26" /></td>
        <td align="left" valign="middle" class="login_top_center"><img src="images/hollmark.jpg" width="16" height="14" />&nbsp;&nbsp;&nbsp;<span class="login_text">Your Email Address does not match with Database</td>
        <td width="8" align="left" valign="top"><img src="images/login_top2.jpg" width="8" height="26" /></td>
      </tr>
    </table></td>
  </tr>
  <? 
  		}
  ?>
  <tr>
    <td height="4"></td>
  </tr>
  <tr>
    <td><table width="328" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" valign="top"><a href="#"><img src="images/login_logo.jpg" width="328" height="119" border="0" /></a></td>
      </tr>
      <tr>
        <td align="left" valign="top" class="login_middle_bg"><table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
             <tr>
              <td colspan="2"><strong>Forget Password !</strong></td>
            </tr>
             <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td height="30" align="left" valign="middle" class="login_username"><strong>Email :</strong></td>
              <td align="left"><input type="text" name="email" id="email" value=""  /></td>
            </tr>
           
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td height="40" align="left" valign="bottom"><table width="212" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="85" align="left" valign="bottom"><a href="javascript:;" onclick="javascript:document.frm.submit();"><img src="images/login_submit.jpg" width="85" height="28" border="0" /></a></td>
                    <td width="127" align="left" valign="bottom"><a href="javascript:;" onclick="javascript:window.close();"><img src="images/close.jpg" width="44" height="25" border="0" /></a></td>
                  </tr>
                  
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</FORM>
</body>
</html>
