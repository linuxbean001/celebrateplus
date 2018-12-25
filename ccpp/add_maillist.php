<?									
include("connect.php");

$LeftLinkSection = 4;
$pagetitle="eMail";
$lastname="";
$firstname="";
$email="";
			
		if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
		{
			$id = $_REQUEST["id"];											
			$fetchquery = "select * from maillist where id=".$id;
			$result = hb_get_result($fetchquery);
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_array($result))
				{
				
			$email= stripslashes($row['email']);
			
				}
			}
			
		}if(isset($_REQUEST['Submit']))
		{
				
				$email= addslashes($_REQUEST['email']);
					if(isset($_REQUEST['mode']))
				{
					switch($_REQUEST['mode'])
					{
						case 'add' :
							if(GTG_is_dup_add('maillist','email',$email))
							{
								unset($_REQUEST['Submit']);
								location("add_maillist.php?msg=4&mode=add");							
								return;
							}																														
							$query = "insert into maillist 
							set email='$email'"; 
							
							hb_get_result($query) or die(mysql_error());
							location("manage_maillist.php?msg=1");															
							
						break;
						
						case 'edit' :
														
							if(GTG_is_dup_edit('maillist','email',$email,$_REQUEST['id']))
							{
								unset($_REQUEST['Submit']);
								location("add_maillist.php?msg=4&mode=edit&id=".$_REQUEST['id']);							
								return;
							}
							$query = "update maillist set email='$email'"; 																														
							$query.=" where id=".$_REQUEST['id'];
							hb_get_result($query) or die(mysql_error());
							location("manage_maillist.php?msg=2");
						break;
						
					}	
				}
				
		}	
		if(isset($_REQUEST['mode']))
		{
			switch($_REQUEST['mode'])
			{
				case 'delete' :
		$query = "delete from maillist where id=".$_REQUEST['id'];     
					hb_get_result($query) or die(mysql_error());
					location("manage_maillist.php?msg=3");
				break;
			}	
		} ?>	



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE?></title>
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
		alert("Enter client");
		document.addprod.name.select();
		return false;
	}
}

function addEvent1212()
{
var ni = document.getElementById('myDiv');
var numi = document.getElementById('theValue1212');
var num = (document.getElementById("theValue1212").value -1)+ 2;
numi.value = num;
var divIdName = "Account"+num;
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
newdiv.innerHTML = "<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\"><tr><td><strong>Discount Rule:</strong></td><td> Purchases Qty between </td><td><input name=\"DiscFrom_"+num+"\" type=\"text\" size=\"10\" /></td><td> and </td><td><input name=\"DiscTo_"+num+"\" type=\"text\" size=\"10\" /> </td><td> of this product</td></tr><tr><td>&nbsp;</td><td>will receive a </td><td><select name=\"DiscTyle_"+num+"\"><option value=\"1\">Price Discount</option><option value=\"2\">Percent Discount</option></select> </td><td> of $ </td><td> <input name=\"DiscAmt_"+num+"\" id=\"DiscAmt_"+num+"\" type=\"text\" size=\"10\" onkeydown='return checkValidDisc(event);' onkeyup='checkValidAmt(this.value,this.name);' /> </td><td> off each individual item  <a href=\"javascript:;\" onclick=\"removeEvent1212(\'"+divIdName+"\')\"> <strong>[x]</strong></a></td></tr><tr height=11><td></td></tr></table>";
ni.appendChild(newdiv);
}

function checkValidDisc(evt,nm)
{
	evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false
    }
    return true
}
function checkValidAmt(amt,nm)
{
	if(amt>100)
	{
		alert("You cannnot enter discount amount more than 100.");
		document.getElementById(nm).value="";
	}
}

function removeEvent1212(divNum)
{
var d = document.getElementById('myDiv');
var olddiv = document.getElementById(divNum);
d.removeChild(olddiv);
}

function addEvent1215()
{
var ni = document.getElementById('myDiv1215');
var numi = document.getElementById('theValue1215');
var num = (document.getElementById("theValue1215").value -1)+ 2;
numi.value = num;
var divIdName = "Account"+num;
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
newdiv.innerHTML = "<input type='hidden' value='' name='recID[]' /><table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\"><tr height=\"11\"><td colspan=\"5\"><?=$LINE_SAPERATOR;?></td></tr><tr><td width=\"125\"><strong>Product Image:</strong></td><td width=\"100\">Select Image:</td><td width=\"277\"><input type=\"file\" name=\"othImg_"+num+"\" size=\"25\"/></td><td>&nbsp;</td><td width=\"35\" align=\"center\"><a href=\"javascript:;\" onclick=\"removeEvent1215(\'"+divIdName+"\')\"> <strong>[x]</strong></a></td></tr><tr height=11><td></td></tr></table>";
ni.appendChild(newdiv);
}
function removeEvent1215(divNum)
{
var d = document.getElementById('myDiv1215');
var olddiv = document.getElementById(divNum);
d.removeChild(olddiv);
}
</script>
                                                        </head>
                                                        
                                                        <body onLoad="MM_preloadImages('images/main_controls.jpg','images/server_settings_o.jpg','images/product_o.jpg','images/usear_o.jpg','images/seo._o.jpg','images/static_page_o.jpg','images/inactive_tab_o.jpg','images/product_buttom_o.jpg','images/last_one_o.jpg')">
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
                                                                                  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"Edit":"Add"; ?>
                                                                                                    <?=$pagetitle?></td>
                                                                                  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
                                                                                </tr>
                                                                            </table></td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td align="left" valign="top" class="middle_right_bg">
                                                                                <TABLE  cellSpacing=0 cellPadding=0  border=0 width="95%" align="center">
                                                                                                
                                                                                                <tr>
                                                                                                  <td class="a-l" ><span style="color:#CC6600;">
                                                                                                    <?php 
                                                                                                            $msg = $_REQUEST['msg'];
                                                                                                            if($msg == 1)
                                                                                                                echo "<span style='color:#CC6600;'>Mail List Added Successfully.</span>";	 
                                                                                                            elseif($msg == 2)
                                                                                                                echo "<span style='color:#CC6600;'>Mail List Updated Successfully.</span>";	 
                                                                                                            elseif($msg == 3)
                                                                                                                echo "<span style='color:#CC6600;'>Mail List Deleted Successfully.</span>";	 
                                                                                                            elseif($msg == 4)
                                                                                                                echo "<span style='color:#CC6600;'>Mail List with this Email Id already exists.</span>";	 
                                                                                                                
                                                                                                            if($gmsg == 1)
                                                                                                                echo "Please enter all the information."; 
                                                                                                        ?>
                                                                                                    </span></td>
                                                                                                </tr>
                                                                                                <TR>
                                                                                                  <TD><form action="add_maillist.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
                                    <input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
                                    <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
                                                                                                      <tr>
                                          <td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
                                        </tr>

										<!-- Temparory Disable
                                                                                                      <tr>
                                          <td width="41%" align="right" class="f-c"><span style="color:#FF0000;">*</span>First Name</td>
                                          <td width="60%" class="f-c"><input type="text" name="firstname" id="firstname" value="<?=$firstname?>" size="35" maxlength="100" /></td>
                                        </tr>

                                                                                                      <tr>
                                          <td width="24%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Last Name</td>
                                          <td class="f-c"><input type="text" name="lastname" id="lastname" value="<?=$lastname?>" size="35" maxlength="100" /></td>
                                        </tr>
										-->

                                                                                                      <tr>
                                          <td width="24%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Email</td>
                                          <td class="f-c"><input type="text" name="email" id="email" value="<?=$email?>" size="35" maxlength="100" /></td>
                                        </tr>
                                                                                                      <tr>

                                          <td>&nbsp;
                                                                                                          <input type="hidden" value="<?=$_GET["id"]; ?>" name="id"></td>
                                          <td><?php if($_REQUEST['mode'] == 'add') { ?>
                                                                                                          <input name="Submit" type="submit" value="Add" class="send_form"  />
                                                                                                          <?php } else { ?>
                                                                                                          <input name="Submit" type="submit" value="Edit" class="send_form" /></td>
                                          <?php } ?>
                                        </tr>
                                                                                                    </table>
                                                                                                  </form>  
                                                                                                  </TD>
                                                                                                </TR>
                                                                                              </TABLE>
                                                                                              
	                               <script language="javascript">
								   
								   function keshav_check()
								   { 
									/* Temparory Disable
									if(document.frm.firstname.value.split(" ").join("") == "")
									{
										alert("Please enter First name.");
										document.frm.firstname.focus();
										return false;
									}
									if(document.frm.lastname.value.split(" ").join("") == "")
									{
										alert("Please enter Last name.");
										document.frm.lastname.focus();
										return false;
									}
									*/
									if(document.frm.email.value.split(" ").join("") == "")
									{
										alert("Please enter an email address.");
										document.frm.email.focus();
										return false;
									}
									else
									{
										if(!emailCheck(document.frm.email.value))
										{
											document.frm.email.focus();
											return false;
										}
									}
									return true;
									
								}
								function emailCheck(s1) 
								{
									emailStr=s1;
								
										var emailPat=/^(.+)@(.+)$/
										var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
										var validChars="\[^\\s" + specialChars + "\]"
										var quotedUser="(\"[^\"]*\")"
										var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
										var atom=validChars + '+'
										var word="(" + atom + "|" + quotedUser + ")"
										var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
										var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
										var matchArray=emailStr.match(emailPat)
										if (matchArray==null) 
										{
											alert("Email address seems incorrect (check @ and .'s)")
											return false
										}
								return true;
								}	</script>
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