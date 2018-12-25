<?
include("connect.php");

$msg = "";

	
if(isset($_REQUEST['update']))
	{
	
		$count1 = $_REQUEST['count'];
		
		for($i = 1;$i <= $count1;$i++)
		{	
			$pid = "pid".$i;
			$approve = "approve".$i;
			$bannervalue= 0;
			if(isset($_REQUEST[$approve]))
			{
				if($_REQUEST[$approve] != "")
					$bannervalue= 1;
			}
			$query = "update blog_post_comments set approve=".$bannervalue." where id=".$_REQUEST[$pid];
			hb_get_result($query);
		}
	
		$uurl="blog_post_comments.php?id=".$_REQUEST['post_idd']."&msg=2";
			location($uurl);

	}


	$count = 0;
	$imageid = 0;
	$LeftLinkSection = 4;
	$pagetitle="Comments";

	$sel= "select * from blog_post_comments where post_id='".$_REQUEST['id']."' order by add_date desc";
	
	$result=$prs_pageing->number_pageing($sel,25,10,'N','Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

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
							<FORM  name="order" action="#" method="post">
									  <TABLE cellSpacing=0 cellPadding=1 border=0 >
												<tr><td colspan="25" height="20"><b>View By</b></td></tr>
												<?=$prs_pageing->order();?>
											</TABLE>
							 </FORM>
						</td>
					</tr>
					<? if($_GET["msg"]) { ?>
							<tr>
								<TD align="center"><span style="color:#CC6600;">
								<?
								if($_GET["msg"]==1)
									echo "Comment Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "Comment Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "Comment Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "Comment with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This Comment is in use. You can not delete this Comment.";	
								
							 ?>
							</span></TD>
						   </tr>
					 <? } 					  
					?> 
					<tr>
						<td>
							<form name="frmforum" id="frmforum" method="post" >
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                          <tr>
                            <td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td width="40" height="27" class="arial_13_bold">No.</td>
                                        <td width="76" height="27" class="arial_13_bold">Approve</td>
                                        <td class="arial_13_bold" width="454">Description</td>
                                       
										<td width="118" class="arial_13_bold" align="center">Posted By</td>
                                        <td class="arial_13_bold" width="170">Date</td>
                                        <td width="95" class="arial_13_bold">Actions</td>
                                      </tr>
                                      <? while($get=mysql_fetch_object($result[0])) { $count++; ?>
                                      <tr>
                                        <td height="49" class="photo"><?=$count;?>
                                          .</td>
                                          <td align="center" class="photo"><input <? if($get->approve == 1) { echo "checked='checked'"; } ?>  type="checkbox" name="approve<?=$count; ?>" value="<?=$get->id;?>"></td>
                                        <td align="left" class="photo"><? echo stripslashes($get->description); ?></td>
                                        
										<td align="left" class="photo"><?=stripslashes($get->name);?></td>
										
                                        <td align="left" class="photo"><? echo date("m-d-Y",strtotime(stripslashes($get->add_date))); ?></td>
                                        <td class="photo"><img src="images/delete.jpg" width="10" height="10" /> &nbsp;<a href="javascript:;" onClick="deleteconfirm('Are you sure you want to delete this comment? \n','del_comment.php?id=<?php echo ($get->id); ?>&mode=delete&post_id=<?php echo ($get->post_id); ?>')" class="edit" >Delete</a></td>
                                      </tr>
                                      <input type="hidden" name="pid<?=$count; ?>" value="<?=$get->id;?>" >
                                      <? } ?>
                                      <input type="hidden" name="count" value="<?=$count; ?>" >
                                      <input type="hidden" name="post_idd" id="post_idd" value="<?php echo $_REQUEST['id'];?>" />
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="5px"></td>
                                </tr>
                                <tr>
                                  <td  valign="middle"><table width="98%" border="0" cellpadding="0" cellspacing="0" align="center">
                                      <tr>
                                        <td align="left">
                                        <input class="add_new" type="submit" name="update" value="Update" /></td>
                                        <td align="right"><?=$result[1]?>
                                          &nbsp;</td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table></td>
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
								return confirm("Are you sure you want to delete this blog post?");
							}
						  </script>
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
