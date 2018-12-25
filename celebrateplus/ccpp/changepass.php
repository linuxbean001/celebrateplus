<? 
  include("connect.php") ;
   $LeftLinkSection = 6;
  $Error=0;
  
  if(isset($_POST['Submit']))
  {
  	 $query = "select * from ".$_SESSION["ADMIN_SESS_USERTYPE"]." where password='".md5($_REQUEST['old'])."' and id='".$_SESSION["ADMIN_SESS_USERID"]."'";
	 $result = mysql_query($query);
	 if(mysql_num_rows($result) > 0)
	 {
	 	$query = "update ".$_SESSION["ADMIN_SESS_USERTYPE"]." set password='".md5($_REQUEST['new'])."' where id='".$_SESSION["ADMIN_SESS_USERID"]."' and password='".md5($_REQUEST['old'])."'";
		mysql_query($query);
	 	$Message = "Password Changed Successfully"; 
	 }
	 else
	 {
	 	$Message = "Your old password does not match what is stored in the system."; 
	 }
  }



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


<script type="text/javascript" src="js/switchcontent.js"></script>
<link href="css/rokmoomenu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/rokmoomenu.js"></script>
<script type="text/javascript">
window.addEvent('domready', function() {
		new Rokmoomenu($E('ul.nav'), {
			bgiframe: false,
			delay: 500,
			animate: {
				props: ['opacity', 'width', 'height'],
				opts: {
					duration: 500,
					fps: 100,
					transition: Fx.Transitions.Expo.easeOut
				}
			}
		});
	});
</script>


<SCRIPT language=javascript src="body.js"></SCRIPT>
<script>
function valid()
{
	if(document.addprod.name.value=="")
	{
		alert("Enter Password");
		document.addprod.name.select();
		return false;
	}
}
</script>
</head>
<script>
function valid()
{
	if(document.addprod.name.value=="")
	{
		alert("Enter Password");
		document.addprod.name.select();
		return false;
	}
}
</script>
<body onload="MM_preloadImages('images/main_controls.jpg','images/server_settings_o.jpg','images/product_o.jpg','images/usear_o.jpg','images/seo._o.jpg','images/static_page_o.jpg','images/inactive_tab_o.jpg','images/product_buttom_o.jpg','images/last_one_o.jpg')">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><? include("top.php"); ?></td>
  </tr>

  <tr>
    <td align="left" valign="top" class="middle_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="23" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" width="17%"><? include("left.php"); ?></td>
            <td align="left" valign="top">
                <table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td>
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
                        <td align="left" valign="middle" class="title_wrapper_middle">My Account</td>
                        <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
                      </tr>
                      
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="middle_right_bg">
                  	  <TABLE cellSpacing=10 cellPadding=0  border=0 width="95%">
                       
                        <!--content-->
                        <tr>
                        <td>
                         <form name=addprod action="#" onSubmit="return gtg_checkpass();" method=post enctype="multipart/form-data">
		<input type="hidden" name="FRMCATID">
				
			  
				<TABLE cellSpacing=2 cellPadding=1 width=500 border=0>
				  <TBODY>
					<TR> 
					  <TD colSpan=2></TD>
					  <TD class=a align=right colSpan=2 nowrap>* Required Information</TD>
					</TR>
					<TR> 
					  <TD class=th-d noWrap colSpan=4>Password Information</TD>
					</TR>
					<? if($Message) { ?>
					<TR>
					  <TD colSpan=4 align="center" vAlign=top class="" style="color:#FF0000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;"><? echo $Message; ?></TD>
				    </TR>
					<? } ?>
					<TR> 
					  <TD class=f-c vAlign=top align=right>&nbsp;&nbsp;<font color="red">*</font>Old Password : </TD>
					  <TD vAlign=top colSpan=3><input name="old" id="old" type="password"  class="solidinput" value="<?php //echo $name; ?>" size="30" >					   </TD>
					</TR>
					<TR> 
					  <TD class=f-c vAlign=top align=right>&nbsp;&nbsp;<font color="red">*</font>New Password  : </TD>
					  <TD vAlign=top colSpan=3><input name="new" id="new" type="password"  class="solidinput" value="<?php //echo $name; ?>" size="30" >					   </TD>
					</TR>
					<TR> 
					  <TD class=f-c vAlign=top align=right>&nbsp;&nbsp;<font color="red">*</font>Confirm New Password  : </TD>
					  <TD vAlign=top colSpan=3><input name="cnew" id="cnew" type="password"  class="solidinput" value="<?php //echo $name; ?>" size="30" >					   </TD>
					</TR>
					<TR> 
					  <TD colSpan=4>&nbsp;</TD>
					</TR>
					<TR> 
					  <TD align=right>&nbsp;</TD>
					  <TD><INPUT type=submit name="Submit" value="Change Password" class="bttn" onClick="return valid();">						</TD>
					  <TD align=right>&nbsp;</TD>
					  <TD>&nbsp;</TD>
					</TR>
					<TR> 
					  <TD colSpan=4> <P>&nbsp;</P>
						<P>&nbsp;</P></TD>
					</TR>
				  </TBODY>
				</TABLE>
        
</FORM>
<script language="javascript">
function gtg_checkpass()
{
	if(document.getElementById("old").value.split(" ").join("") == "")
	{
		alert("Please enter old password.");
		document.getElementById("old").focus();
		return false;
	}
	if(document.getElementById("new").value.split(" ").join("") == "")
	{
		alert("Please enter new password.");
		document.getElementById("new").focus();
		return false;
	}
	if(document.getElementById("cnew").value.split(" ").join("") == "")
	{
		alert("Please enter confirm new password.");
		document.getElementById("cnew").focus();
		return false;
	}
	if(document.getElementById("new").value.split(" ").join("") != document.getElementById("cnew").value.split(" ").join(""))
	{
		alert("Your password and password confirmation must match.");
		document.getElementById("new").focus();
		return false;
	}
	
	return true;
}
</script>
                </td></tr>
                </TABLE>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="10" align="left" valign="top"><img src="images/scb_left.png" width="10" height="10" /></td>
                        <td align="left" valign="top" class="scb">&nbsp;</td>
                        <td width="10" align="left" valign="top"><img src="images/scb_right.png" width="10" height="10" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                        </td>
                    </tr>
                </table> 
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><? include("footer.php"); ?></td>
  </tr>

</table>
</body>
</html>
