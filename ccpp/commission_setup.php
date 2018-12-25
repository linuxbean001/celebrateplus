<? 
  include("connect.php") ;
   $LeftLinkSection = 6;
  $Error=0;
  
  if(isset($_POST['Submit']))
  {
		$commission_rate = $_REQUEST['commission_rate'];
		$update_query = "update commission_rate set commission_rate = '$commission_rate' where id = '1'";
		mysql_query($update_query) or die(mysql_error());
		location("commission_setup.php");
  }
  $commission_rate = GetValue("commission_rate","commission_rate","id",1);
  



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
                        <td align="left" valign="middle" class="title_wrapper_middle">Commission Rate</td>
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
					  <TD class=f-c vAlign=top align=right>&nbsp;&nbsp;<font color="red">*</font>Commission Rate : </TD>
					  <TD vAlign=top colSpan=3><input name="commission_rate" id="commission_rate" type="text"  class="solidinput" value="<?php echo $commission_rate; ?>" size="30" >					   </TD>
					</TR>
					<TR> 
					  <TD colSpan=4>&nbsp;</TD>
					</TR>
					<TR> 
					  <TD align=right>&nbsp;</TD>
					  <TD><INPUT type=submit name="Submit" value="Save" class="bttn" onClick="return valid();">						</TD>
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
	if(document.getElementById("commission_rate").value.split(" ").join("") == "")
	{
		alert("Please enter commission rate.");
		document.getElementById("commission_rate").focus();
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
