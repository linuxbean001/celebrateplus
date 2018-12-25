<?php 

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

?>

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

<body class="login_main_bg">
<? if($_REQUEST['type']=="")
{ ?>
<FORM id="frm" name="frm" action="password.php" method="post">
  <table width="36%" height="97%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="middle"><table width="328" border="0" align="center" cellpadding="0" cellspacing="0" style="vertical-align:middle">
        <?php
	  if($pas==1)
	  {
	?>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8" align="left" valign="top"><img src="images/login_top1.jpg" width="8" height="26" /></td>
                <td align="left" valign="middle" class="login_top_center"><img src="images/hollmark.jpg" width="16" height="14" />&nbsp;&nbsp;&nbsp;<span class="login_text">Access Denied&nbsp;&nbsp;&nbsp;&nbsp;</span>| user/password combination wrong</td>
                <td width="8" align="left" valign="top"><img src="images/login_top2.jpg" width="8" height="26" /></td>
              </tr>
          </table></td>
        </tr>
        <? 
  		}
  ?>
  <?php
	  if($_REQUEST['msg']==3)
	  {
	?>
        <tr>
          <td><table width="103%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8" align="left" valign="top"><img src="images/login_top1.jpg" width="8" height="26" /></td>
                <td align="left" valign="middle" class="login_top_center"><img src="images/hollmark.jpg" width="16" height="14" />&nbsp;&nbsp;&nbsp;<span class="login_text">Login details has been mailed to email address.</td>
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
                <td align="center" valign="top"><img src="images/cplus_logo.png"  border="0" /></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login_middle_bg"><table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
                    
                    <tr>
                      <td height="30" align="left" valign="middle" class="login_username"><strong>Username :</strong></td>
                      <td align="left"><input type="text" name="name" id="name" class="text_box_bg" style="width:226px; height:20px;" /></td>
                    </tr>
                    <tr>
                      <td height="30" align="left" valign="middle" class="login_username"><strong>Password :</strong></td>
                      <td align="left"><input type="password" name="pass" id="pass" class="text_box_bg" style="width:226px; height:20px;" /></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                      <td align="left" valign="top">&nbsp;</td>
                    </tr>
                     
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                      <td height="30" align="left" valign="bottom"><table width="212" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="32" align="left" valign="bottom"><a href="javascript:;" onClick="document.frm.submit();"><img src="images/submit_btn.png" width="85" height="28" border="0" /></a></td>
                            <td align="left" valign="top" style="padding-top:2px;"></td>
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
      </table></td>
    </tr>
  </table>
</FORM>
<? }else{ ?>
<FORM id="frmmmm" name="frmmmm" action="forgot_pwd_process.php" method="post">
  <table width="10%" height="97%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="middle"><table width="328" border="0" align="center" cellpadding="0" cellspacing="0" style="vertical-align:middle">
        <?php
	  if($_REQUEST['msg']==4)
	  {
	?>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8" align="left" valign="top"><img src="images/login_top1.jpg" width="8" height="26" /></td>
                <td align="left" valign="middle" class="login_top_center"><img src="images/hollmark.jpg" width="16" height="14" />&nbsp;&nbsp;&nbsp;<span class="login_text">Access Denied&nbsp;&nbsp;&nbsp;&nbsp;</span>| email address is incorrect.</td>
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
                <td align="center" valign="top"><a href="#"><img src="images/login_logo.jpg"  border="0" /></a></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login_middle_bg"><table width="94%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                      <td align="left" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="30" align="left" valign="middle" class="login_username"><strong><br>
Enter your email :</strong></td>
                      <td align="left"><input type="text" name="forgot_email" id="forgot_email" class="text_box_bg" style="width:226px; height:20px;" /></td>
                    </tr>
                   
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                      <td align="left" valign="top" height="15px"></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                      <td align="right" valign="top" height="15px"><a href="index.php"> Login?</a></td>
                    </tr>
                    
                    <tr>
                      <td align="left" valign="top">&nbsp;</td>
                      <td height="30" align="left" valign="bottom"><table width="212" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="32" align="left" valign="bottom"><a href="javascript:;" onClick="document.frmmmm.submit();"><img src="images/login_submit.jpg" width="85" height="28" border="0" /></a></td>
                            <td align="left" valign="top" style="padding-top:2px;"></td>
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
      </table></td>
    </tr>
  </table>
</FORM>
<? } ?>
</body>
</html>
