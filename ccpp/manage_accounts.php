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
			$query = "DELETE FROM  organizer where id=".$_REQUEST[$pid];
		}
		hb_get_result($query);
		
	}
	location("manage_accounts.php?msg=3");
}

if(isset($_REQUEST['update']))
{
	$count1 = $_REQUEST['count'];
	
	for($i = 1;$i <= $count1;$i++)
	{
		$disp = "disp".$i;	
		$pid = "pid".$i;
		
		if(isset($_REQUEST[$disp]))
		{
			$disp1 = $_REQUEST[$disp];
		}
		
		 $query = "update organizer set display_order=".$disp1." where id=".$_REQUEST[$pid];
		hb_get_result($query);

	}
		
		location("manage_accounts.php?msg=2");
}
$LeftLinkSection = 1;
$pagetitle="Organizers";

if(isset($_REQUEST['sort_lname']) and $_REQUEST['sort_lname']!='-')
{
	if($_REQUEST['sort_lname']=="asce")
	{
		$sel = "select * from organizer order by lname";
	}
	if($_REQUEST['sort_lname']=="desc")
	{
		$sel = "select * from organizer order by lname desc";
	}
}
else if(isset($_REQUEST['sort_date']) and $_REQUEST['sort_date']!='-')
{
	if($_REQUEST['sort_date']=="old")
	{
		$sel = "select * from organizer order by add_date asc";
	}
	if($_REQUEST['sort_date']=="new")
	{
		$sel = "select * from organizer order by add_date desc";
	}
}
else if($_REQUEST['submit1'])
{
	$sel = "select * from organizer where username like'%".$_REQUEST['uname']."%' and email like '%".$_REQUEST['email_add']."%' and lname like '%".$_REQUEST['lstname']."%'";
}
else
{
	$sel= "select * from organizer where lname like '".$_GET["order"]."%' order by add_date desc" ;
}

//echo $sel;
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
							<table width="100%" border="0">
  								<tr>
  									<td width="75%"><table>
                                        <tr>
                                            <td>
                                            <table width="100%" cellpadding="1" cellspacing="1" border="0">
                                            <tr><td><strong>Sorting Options:</strong></td></tr>
                                           
                                                <tr>
													<form name="srt_lname" id="srt_lname" action="" method="get">
                                                    <td width="22%"><strong>Sort Last Name By :</strong>&nbsp;&nbsp;
                                                    <select name="sort_lname" id="sort_lname" onchange="srt_lname.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="asce" <? if($_REQUEST['sort_lname']=="asce"){?> selected="selected"<? }?>>A to Z</option>
                                                            <option value="desc" <? if($_REQUEST['sort_lname']=="desc"){?> selected="selected"<? }?>>Z to A</option>
                                                        </select>
                                                    </td>
													</form>
													<form name="srt_date" id="srt_date" action="" method="get">
                                                    <td width="78%"><strong>Date Registered :</strong> &nbsp;&nbsp;		
                                                    <select name="sort_date" id="sort_date" onchange="srt_date.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['sort_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
                                                            <option value="old" <? if($_REQUEST['sort_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
                                                      </select>				</td>
													  </form>
                                                    
                                                </tr>
                                                
                                                
                                                
                                            </table>
                                            </td>
                                            </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td>
                                            <table width="100%" cellpadding="1" cellspacing="1" border="0">
                                            <tr><td><strong>Search Options :</strong></td></tr>
                                            <form name="srch_lname" id="srch_lname" action="" method="post">
                                                <tr>
                                                    
                                                    <td width="25%"><strong>Email Address :</strong> &nbsp;&nbsp;
                                                      <input type="text" name="email_add" value="<?=$_REQUEST['email_add']?>" id="email_idd" /></td>
                                                    <td width="24%"><strong> Last Name</strong>&nbsp;&nbsp;
                                                      <input type="text" name="lstname" id="lstname" value="<?=$_REQUEST['lstname'];?>" /></td>
                                                     <td width="28%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td>
                                                </tr>
                                                </form>
                                                
                                                
                                            </table>
                                            </td>
                                            </tr>
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
                                     </table></td>
  									 <td width="25%" valign="top" align="center">
                                      <table width="100%" border="0">
                                      <tr>
                                        <td style="font-size:20px; color:#3694DA" align="center">TOTAL ACCOUNTS</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><table width="100" border="0" height="50" bgcolor="#3694DA">
                                      <tr>
                                        <td style="color:#FFFFFF; font-size:26px; font-weight:bold" align="center" valign="middle">
                                            <?
                                               echo stripslashes(GetValue("organizer","count(*)",1,1)); 
                                            ?>
                                        </td>
                                      </tr>
                                    </table>
                                    </td>
                                      </tr>
                                    </table>
                                    
                                    </td>
                                          </tr>
                                        </table>

                        </td>
                   </tr>
		
                    
					<? if($_GET["msg"]) { ?>
							<tr>
								<TD align="center"><span style="color:#CC6600;">
								<?
								if($_GET["msg"]==1)
									echo "Account Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "Account Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "Account Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "Account with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This Account is in use. You can not delete this Account.";	
								
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Manage Accounts</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						<td width="25" height="27" class="arial_13_bold"><input type="checkbox" name="chkAll" id="chkAll" value="chkAll" onclick="chkSelectAll();" /></td>
						<td class="arial_13_bold">No.</td>
								<td   class="arial_13_bold">Date Registered</td>
								<td   class="arial_13_bold">Name</td>
								<td   class="arial_13_bold">Email Address</td>
							<?php /*?><td class="arial_13_bold" align="center">Display Order</td><?php */?>
	  					<td class="arial_13_bold">Actions</td></tr>
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
						 
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->add_date)); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->fname)." ".stripslashes($get->lname); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->email); ?></strong></td>
							<?php /*?><td align="center" class="photo"><input  size="3" type="textbox" name="disp<?=$count; ?>" value="<?=$get->display_order;?>" ></td><?php */?><td  align="center"nowrap class="photo" >				 
				  <input name="button" type="button" class="send_form" onClick="window.location.href='add_account.php?id=<?php echo ($get->id); ?>&mode=edit'" value=" EDIT ">
                    <input name="button2" type="button" class="send_form" onClick="deleteconfirm('Are you sure that you want to delete this account? \n','add_account.php?id=<?php echo($get->id); ?>&mode=delete');" value="DELETE">
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='view_user.php?id=<?php echo ($get->id); ?>'" value="VIEW DETAILS">			<br />
					<?
						$event_ids= '';
						$events_query = "select id from events where oid = '".$get->id."'";
						$events_result = hb_get_result($events_query) or die(mysql_error());
						$events_total = mysql_num_rows($events_result);
						if($events_total > 0)
						{
							while($events_data = mysql_fetch_array($events_result))
							{
								$event_ids .= ",".stripslashes($events_data['id']);
							}
							$event_ids = ltrim($event_ids,",");
						}
					?>
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='manage_events.php?org_id=<?php echo ($get->id); ?>'" value="VIEW EVENTS">
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='payments1.php?id=<?php echo ($get->id); ?>'" value="VIEW FUNDING HISTORY">
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
											<td align="center" width="20"><input type="submit" name="btnDelete" id="btnDelete" value="DELETE" class="red" onclick="return chkDelete();" /></td>
											<td align="center" width="20"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_account.php?mode=add'" /></td>
													<td align="center" width="20"><input class="add_new" type="submit" name="update" value="UPDATE" ></td><td align="right"><?=$result[1]?>&nbsp;</td>
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
								return confirm("Are you sure that you want to delete the selected organizer?");
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
