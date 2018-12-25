<?		 					
include("connect.php");

if(isset($_REQUEST['btnDelete']))
{
	$count1 = $_REQUEST['count'];
	
	for($i = 1;$i <= $count1;$i++)
	{
		$pid = "pid".$i;
		$chk = "chk".$i;
		
		if(isset($_REQUEST[$chk]))
		{
			$query = "DELETE FROM  ad where id=".$_REQUEST[$pid];
		}
		
		hb_get_result($query);
		
	}
	location("manage_ad.php?msg=3");
}

if(isset($_REQUEST['update']))
	{
		$count1 = $_REQUEST['count'];
		
		for($i = 1;$i <= $count1;$i++)
		{
			$pid = "pid".$i;
			
			$is_feature = "is_feature".$i;
			
			
				if($_REQUEST[$is_feature] == "on")
				{
					$isactivevalue = 1;
				}
				else
				{
					$isactivevalue = 0;
				}
			
		 	 $query = "update ad  set is_feature='".$isactivevalue."' where id=".$_REQUEST[$pid];
			hb_get_result($query);
			
		}
		location("manage_ad.php?msg=2");
	}
$LeftLinkSection = 6;
$count = 0;
$pagetitle="Ads";
$sel= "select * from ad where (select name from advertiser where id=ad.advertiser_id) like '".$_GET["order"]."%' order by id" ;
$result=$prs_pageing->number_pageing($sel,20,10,'N','Y');

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
<style type="text/css">
	.send_form_big
	{
		background: url(images/send_form_bg_big.png) no-repeat scroll left top transparent;
		border: 0 none;
		color: #FFFFFF;
		cursor: pointer;
		font-family: Arial,Helvetica,sans-serif;
		font-size: 11px;
		font-weight: bold;
		height: 22px;
		text-align: center;
		text-decoration: none;
		width:150px;
	}
</style>


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
									echo "Ad Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "Ad Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "Ad Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "Ad with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This Ad is in use. You can not delete this Ad.";	
								
							 ?>
							</span></TD>
						   </tr>
					 <? } 					  
					?> 
					<tr>
						<td>
							<form name="frmNewsList" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
						  <td align="left" valign="middle" class="title_wrapper_middle">Manage Ads</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						<td width="42" height="27" class="arial_13_bold"><input type="checkbox" name="chkAll" id="chkAll" value="chkAll" onclick="chkSelectAll();" /></td>
						<td width="38" class="arial_13_bold">No.</td>
							<?php /*?><td width="130"   class="arial_13_bold">Featured</td><?php */?>
								
								<td width="217"   class="arial_13_bold">Advertiser Name</td>
                                <td width="300"   class="arial_13_bold">Ad Location</td>	
                                <td width="140"   class="arial_13_bold">Ad Image</td>							
	  					<td width="216" class="arial_13_bold">Actions</td>
				</tr>
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
								$count++;
						 ?>	 
							 <tr>
							  <td height="49" class="photo">
							  <input type="hidden" name="pid<?=$count;?>" id="pid<?=$count;?>" value="<?=$get->id;?>" />
							  <input type="checkbox" name="chk<?=$count;?>" id="chk<?=$count;?>" value="<?=$count;?>" /></td>
							 <td height="49" class="photo"><?=$count;?>.</td>
						 <?php /*?><td class="photo" align="center"><input <?=($get->is_feature==1)?"checked":"";?>  type="checkbox" name="is_feature<?=$count; ?>"></td><?php */?>
							  <td class="photo"> <strong> <? echo stripslashes(GetValue("advertiser","name","id",$get->advertiser_id)); ?></strong></td>
                              
					<td class="photo">
							<? echo stripslashes(str_replace(",","<br>",$get->location)); ?>
							</td>
                            <td align="left" class="photo">
										 <?
										$image_path= $get->image_path;
										 
											if($image_path!="" && file_exists("../advertiser_images/".$image_path))
											{
											?>
												<img alt="image" src="../include/sample.php?nm=../advertiser_images/<?=$image_path;?>&mwidth=80&mheight=80" border="0" >
											<?											
											}
										?></td>
							  <td  align="center"nowrap class="photo" >				 
				  <input name="button" type="button" class="send_form" onClick="window.location.href='add_ad.php?id=<?php echo ($get->id); ?>&mode=edit'" value=" EDIT ">
                    <input name="button2" type="button" class="send_form" onClick="deleteconfirm('Are you sure you want to delete this ad? \n','add_ad.php?id=<?php echo($get->id); ?>&mode=delete');" value="DELETE">
						
                  </td>
				  
				   </tr>
                <? } ?>			
				  
				
				 <input type="hidden" name="count" id="count" value="<?=$count;?>" />   
						 </table></td>
								</tr>
								<tr><td height="5px"></td></tr>
								<tr>
								  <td  valign="middle">
									<table width="98%" border="0" cellpadding="2" cellspacing="2" align="center">
										<tr>
										<td align="center" width="60"><input type="submit" name="btnDelete" id="btnDelete" value="DELETE" class="red" onclick="return chkDelete();" /></td>
											<td align="center" width="75"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_ad.php?mode=add'" /></td>
											<td width="825" colspan="7" align="left" style="padding-left:20px;"><input class="add_new" type="submit" name="update" value="UPDATE" ></td>
											<td width="19" align="right"><?=$result[1]?>&nbsp;</td>
										  
										</tr>
									</table>
									
								   </td>
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
								return confirm("Are you sure that you want to delete the selected ads?");
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
