<?php 
include("connect.php");
if(isset($_REQUEST['update']))
	{
		$count1 = $_REQUEST['count'];
		
		for($i = 1;$i <= $count1;$i++)
		{
			$disp = "disp".$i;
		
			$pid = "pid".$i;
			
			$active_name = "active".$i;
			$active_value = 0;

			
			if(isset($_REQUEST[$disp]))
			{
				$disp1 = $_REQUEST[$disp];
			}
			if($_REQUEST[$active_name] == 'on')
			{
				$active_value = 1;
			}		
			
			
			$query = "update promo set displayorder=".$disp1.",active=".$active_value." where id=".$_REQUEST[$pid];
			hb_get_result($query);

		}
			location("manage_promo.php?msg=2");
	}
	$count = 0;
	$imageid = 0;
	$LeftLinkSection = 4;
	$pagetitle="Slides";
	$condition = "";
	$condition2 = "";
	$sel= "select * from promo where name like '".$_GET["order"]."%'";
	$sel= $sel.$condition.$condition2. " order by displayorder";
	$result=$prs_pageing->number_pageing($sel,20,10,'N','Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_NAME?></title>
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

</head>
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
                <td align="left" valign="top"><table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><FORM  name="order" action="#" method="post">
                          <TABLE cellSpacing=0 cellPadding=1 border=0 >
                            <tr>
                              <td colspan="25" height="20"><b>View By</b></td>
                            </tr>
                            <?=$prs_pageing->order();?>
                          </TABLE>
                        </FORM></td>
                    </tr>
                    <? if($_GET["msg"]) { ?>
                    <tr>
                      <TD align="center"><span style="color:#CC6600;">
                        <?
                                if($_GET["msg"]==1)
                                    echo "Detail Added Successfully.";
                                elseif($_GET["msg"]==2)
                                    echo "Detail Updated Successfully.";
                                elseif($_GET["msg"]==3)
                                    echo "Detail Deleted Successfully.";
                                elseif($_GET["msg"]==4)
                                    echo "Detail with this name is already Exist.";	
                                elseif($_GET["msg"]==5)
                                    echo "This Detail is in use. You can not delete this client.";	
                                
                            ?>
                        </span></TD>
                    </tr>
                    <? } 
                     ?>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
                                  <td align="left" valign="middle" class="title_wrapper_middle">Manage
                                    <?=$pagetitle?></td>
                                  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
                                </tr>
                              </table></td>
                          </tr>
                          <form name="frmNewsList" method="post" action="">
                            <tr>
                              <td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td width="30" height="27" class="arial_13_bold">No.</td>
										  <td width="30" height="27" class="arial_13_bold">Active</td>
                                          <td width="549" class="arial_13_bold">Slide Title</td>
											<td width="153" class="arial_13_bold">Slide Image</td>
											<td width="112"  align="center" class="arial_13_bold">Display Order</td>
                                          <td width="171" class="arial_13_bold">Actions</td>
                                        </tr>
                                        <? while($get=mysql_fetch_object($result[0])) { $count++; ?>
                                        <input type="hidden" name="pid<?=$count;?>" id="pid<?=$count;?>" value="<?=$get->id;?>" />
                                        <tr>
                                          <td height="49" class="photo"><?=$count;?>.</td>
										  <td align="left" class="photo">
										  	<input type="checkbox" name="active<?=$count;?>" id="active<?=$count;?>" <? if($get->active == 1){ ?> checked="checked"<? } ?> />
										  </td>
                                          <td align="left" class="photo"><?=stripslashes($get->name); ?></td>
										  <td align="center" class="photo"><img src="../promo_images/<?=stripslashes($get->pimage);?>" height="60" width="60"/></td>
										  <td align="center" class="photo"><input onKeyPress="return keycode();" size="3" type="textbox" id="disp<?=$count;?>" name="disp<?=$count;?>" value="<?=$get->displayorder;?>" ></td>
                                          <td class="photo"><img src="images/pencil.jpg" width="11" height="11" /> &nbsp;<a href="javascript:;" onClick="window.location.href='add_promo.php?id=<?php echo ($get->id); ?>&mode=edit'" class="edit" >Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/delete.jpg" width="10" height="10" /> &nbsp;<a href="javascript:;" onClick="deleteconfirm('Are you sure that you want to delete this content promo? \n','add_promo.php?id=<?php echo ($get->id); ?>&mode=delete')" class="edit" >Delete</a></td>
                                        </tr>
                                        <? } ?>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td height="5px"></td>
                                  </tr>
                                  <tr>
                                    <td  valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tr>
                                          <td align="left" width="25"></td>
                                          <td align="left"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_promo.php?mode=add'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="add_new" type="submit" name="update" value="UPDATE" ></td>
                                          <td align="right"><?=$result[1]?>
                                            &nbsp;</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <input type="hidden" name="count" id="count" value="<?=$count;?>" />
                          </form>
                          <script>
				  	function chkSelectAll()
					{
						totchk=document.getElementById("count").value;
						if(document.getElementById("chkAll").checked==true)
						{
							for(a=1;a<=totchk;a++)
							{
								chkname="chk"+a;
								document.getElementById(chkname).checked=true;
							}
						}
						else
						{
							for(a=1;a<=totchk;a++)
							{
								chkname="chk"+a;
								document.getElementById(chkname).checked=false;
							}
						}
					}
				  	function chkDelete()
					{
						return confirm("Sure to delete selected news.");
					}
				  </script>
				  
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="10" align="left" valign="top"><img src="images/scb_left.png" width="10" height="10" /></td>
                                  <td align="left" valign="top" class="scb">&nbsp;</td>
                                  <td width="10" align="left" valign="top"><img src="images/scb_right.png" width="10" height="10" /></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
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
