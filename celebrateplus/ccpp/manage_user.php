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
			$query = "DELETE FROM  user where id=".$_REQUEST[$pid];
		}
		hb_get_result($query);
		
	}
	location("manage_user.php?msg=3");
}
$LeftLinkSection = 1;
$pagetitle="Users";
//print_r($_REQUEST); exit;
if(isset($_REQUEST['lname']) and $_REQUEST['lname']!="-")
{

	if($_REQUEST['lname']=="asce")
	{
		$sel = "select * from user order by lname";
	}
	if($_REQUEST['lname']=="desc")
	{
		$sel = "select * from user order by lname desc";
	}
}
else if(isset($_REQUEST['reg_date']))
{

	if($_REQUEST['reg_date']=="old")
	{
		$sel = "select * from user order by add_date"; 
	}
	if($_REQUEST['reg_date']=="new")
	{
		$sel = "select * from user order by add_date desc";
	}
}
else if($_REQUEST['submit1']=="Search")
{	
	 $sel = "select * from user where username like '%".$_REQUEST['uname']."%' and email like '%".$_REQUEST['email']."%' and lname like '%".$_REQUEST['lname1']."%' and city like '%".$_REQUEST['city']."%' and state like '%".$_REQUEST['state']."%'"; 
}
else
{
$sel= "select * from user where lname like '".$_GET["order"]."%' order by add_date desc" ;
}

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
	.send_form_big1
	{
		background: url(images/send_form_bg_big1.png) no-repeat scroll left top transparent;
		border: 0 none;
		color: #FFFFFF;
		cursor: pointer;
		font-family: Arial,Helvetica,sans-serif;
		font-size: 11px;
		font-weight: bold;
		height: 22px;
		text-align: center;
		text-decoration: none;
		width:175px;
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
					<form name="Sorting_options" id="Sorting_options" action="" method="post">
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td style="color:#FF0000;"><strong>Sorting Options:</strong></td></tr>
					
						<tr>
							
							<td width="21%"><strong>By Last Name  :</strong> &nbsp;&nbsp;		
							<select name="lname" id="lname" onchange="Sorting_options.submit()">
									<option value="-">Select</option>
									<option value="asce" <? if($_REQUEST['lname']=="asce"){?> selected="selected"<? }?>>A to Z</option>
									<option value="desc" <? if($_REQUEST['lname']=="desc"){?> selected="selected"<? }?>>Z to A</option>
							  </select>				</td>
							  <td width="79%"><strong>By Registration Date   :</strong> &nbsp;&nbsp;		
							<select name="reg_date" id="reg_date" onchange="Sorting_options.submit()">
									<option value="-">Select</option>
									<option value="new" <? if($_REQUEST['reg_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
									<option value="old" <? if($_REQUEST['reg_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
							  </select>				
							 </td>
							
							
						</tr>
						</table>
						
					</form>
					</td>
					</tr>
					<tr>
					<td>
					<form name="Search_option" id="Search_option" action="" method="post">
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td style="color:#FF0000;"><strong>Search Options :</strong></td></tr>
					
						<tr>
							<td width="30%"><strong>Username :</strong>&nbsp;&nbsp;
							<input type="text" name="uname" id="uname" value="<?=$_REQUEST['uname']?>" />
							</td>
							<td width="28%"><strong>Email Address :</strong> &nbsp;&nbsp;
							  <input type="text" name="email" value="<?=$_REQUEST['email']?>" id="email" /></td>
							<td width="42%"><strong> Last Name</strong>&nbsp;&nbsp;
							  <input type="text" name="lname1" id="lname1" value="<?=$_REQUEST['lname1'];?>" /></td>
							 
						</tr>
						
					</table>
					<table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">
						<tr>
							
							<td width="20%"><strong>City :</strong> &nbsp;&nbsp;
							  <input type="text" name="city" value="<?=$_REQUEST['city']?>" id="city" /></td>
							<td width="80%"><strong> State</strong>&nbsp;&nbsp;
							  <input type="text" name="state" id="state" value="<?=$_REQUEST['state'];?>" /></td>
							  
							
							 
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td width="20%"><input type="submit" name="submit1" id="submit1" onclick="Search_option.submit()" class="send_form" value="Search" /></td></tr>
						
						
					</table>
					</form>
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
					<? if($_GET["msg"]) { ?>
							<tr>
								<TD align="center"><span style="color:#CC6600;">
								<?
								if($_GET["msg"]==1)
									echo "User Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "User Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "User Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "User with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This User is in use. You can not delete this User.";	
								
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Manage Users</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						<td width="49" height="27" class="arial_13_bold"><input type="checkbox" name="chkAll" id="chkAll" value="chkAll" onclick="chkSelectAll();" /></td>
						<td width="42" class="arial_13_bold">No.</td>
								<td width="158"   class="arial_13_bold">Date Registered</td>
								<td width="110"   class="arial_13_bold">Name</td>
								<td width="63"   class="arial_13_bold">City</td>
								<td width="187"   class="arial_13_bold">Email Address</td>
								<td width="187"   class="arial_13_bold">Username</td>
	  					<td width="406" class="arial_13_bold" align="center">Actions</td>
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
						 
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->add_date)); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->fname)." ".stripslashes($get->lname); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->city); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->email); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->username); ?></strong></td>
							  <td  align="center"nowrap class="photo" >				 
				  <input name="button" type="button" class="send_form" onClick="window.location.href='add_user.php?id=<?php echo ($get->id); ?>&mode=edit'" value=" EDIT ">
                    <input name="button2" type="button" class="send_form" onClick="deleteconfirm('Are you sure that you want to delete this user? \n','add_user.php?id=<?php echo($get->id); ?>&mode=delete');" value="DELETE">
					<input name="button2" type="button" class="send_form_big" onclick="window.location.href='view_user.php?id=<?php echo ($get->id); ?>'" value="VIEW USER DETAILS">
					<?
						$event_ids = '';
						$attendee_query = "select id from attendee where user_id = '".$get->id."'";
						$attendee_result = hb_get_result($attendee_query) or die(mysql_error());
						$attendee_total = mysql_num_rows($attendee_result);
						if($attendee_result > 0)
						{
							while($attendee_data = mysql_fetch_array($attendee_result))
							{
								$event_ids .= ",".$attendee_data['id'];
							}
							$event_ids = ltrim($event_ids,",");
						}
					?>
					<br/>
					<input name="button2" type="button" class="send_form_big" onclick="window.location.href='manage_events.php?event_ids=<?php echo $event_ids; ?>'" value="VIEW EVENTS ATTENDING">
					<input name="button2" type="button" class="send_form_big1" onclick="window.location.href='#'" value="VIEW FUNDING CONTRIBUTION">
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
											<td align="center" width="20"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_user.php?mode=add'" /></td><td align="right"><?=$result[1]?>&nbsp;</td>
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
								return confirm("Are you sure that you want to delete the selected user?");
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
