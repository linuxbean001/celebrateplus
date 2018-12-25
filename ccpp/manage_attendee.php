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
			$query = "DELETE FROM  attendee where id=".$_REQUEST[$pid];
		}
		hb_get_result($query);
		
	}
	location("manage_attendee.php?msg=3");
}
$LeftLinkSection = 1;
$pagetitle="Attendees";
include("srch_sort_attende.php");
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
					<form name="Sorting_options" id="Sorting_options" action="" method="post">
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td style="color:#FF0000;"><strong>Sorting Options:</strong></td></tr>
					
						<tr>
							<td width="29%"><strong>By Confirmation Date :</strong>&nbsp;&nbsp;
							<select name="conf_date" id="conf_date" onchange="change_latest(this.id);Sorting_options.submit()">
									<option value="">Select</option>
									<option value="new" <? if($_REQUEST['conf_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
									<option value="old" <? if($_REQUEST['conf_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
								</select>
							</td>
							<td width="19%"><strong>By Event Title :</strong> &nbsp;&nbsp;		
							<select name="event_title" id="event_title" onchange="change_latest(this.id);Sorting_options.submit()">
									<option value="">Select</option>
									<option value="asce" <? if($_REQUEST['event_title']=="asce"){?> selected="selected"<? }?>>A to Z</option>
									<option value="desc" <? if($_REQUEST['event_title']=="desc"){?> selected="selected"<? }?>>Z to A</option>
							  </select>
							  </td>
							   <td width="25%"><strong>By Start Date :</strong> &nbsp;&nbsp;		
							<select name="start_date" id="start_date" onchange="change_latest(this.id);Sorting_options.submit()">
									<option value="">Select</option>
									<option value="new" <? if($_REQUEST['start_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
									<option value="old" <? if($_REQUEST['start_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
							  </select>				
							 </td>
							  <td width="27%"><strong>By End Date :</strong> &nbsp;&nbsp;		
							<select name="end_date" id="end_date" onchange="change_latest(this.id);Sorting_options.submit()">
									<option value="">Select</option>
									<option value="new" <? if($_REQUEST['end_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
									<option value="old" <? if($_REQUEST['end_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
							  </select>				
							 </td>
							
							
						</tr>
						</table>
						<input type="hidden" name="latest" id="latest" />
					</form>
					</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				<tr>
					<td>
					<form name="Search_option" id="Search_option" action="" method="post">
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td style="color:#FF0000;"><strong>Search Options :</strong></td></tr>
					
						<tr>
							<td ><strong>Event Title :</strong>&nbsp;&nbsp;
							<input type="text" name="evnt_title" id="evnt_title" value="<?=$_REQUEST['evnt_title']?>" />
							</td>							
							
						</tr>
						
					</table>
					<table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">					
					
						<tr>
													
							<td width="45%"><strong> Organizer's Email Address :</strong>&nbsp;&nbsp;
							  <input type="text" name="org_email" id="org_email" value="<?=$_REQUEST['org_email'];?>" /></td>
							<td width="45%"><strong>Organizer's Last Name :</strong>&nbsp;&nbsp;
							<input type="text" name="org_lname" id="org_lname" value="<?=$_REQUEST['org_lname']?>" />
							</td>
						</tr>
						
					</table>
					<table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">
						<tr>
							<?php /*?><td width="30%"><strong>User's Username :</strong>&nbsp;&nbsp;
							<input type="text" name="uusrname" id="uusrname" value="<?=$_REQUEST['uusrname']?>" />
							</td><?php */?>
							<td width="45%"><strong>User's Email Address :</strong> &nbsp;&nbsp;
							  <input type="text" name="uemail" value="<?=$_REQUEST['uemail']?>" id="uemail" /></td>
							<td width="45%"><strong>User's Last Name :</strong>&nbsp;&nbsp;
							  <input type="text" name="ulname" id="ulname" value="<?=$_REQUEST['ulname'];?>" /></td>
							  
							 
						</tr>
						<tr><td>&nbsp;</td></tr>
						
						
						
					</table>
					<table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:10px;">
						<tr>
							<?php /*?><td width="32%"><strong>Organizer's Username :</strong> &nbsp;&nbsp;
							  <input type="text" name="org_uname" value="<?=$_REQUEST['org_uname']?>" id="org_uname" /></td>	<?php */?>						
							<td width="45%"><strong>Event City :</strong> &nbsp;&nbsp;
							  <input type="text" name="city" value="<?=$_REQUEST['city']?>" id="city" /></td>
							<td width="45%"><strong>Event State :</strong>&nbsp;&nbsp;
							<input type="text" name="state" value="<?=$_REQUEST['state']?>" id="state" />
								<?php /*?><select name="state" id="state">
									  <option value="">Select State</option>
									  <?
											$q = "select * from keshavstate order by name";
											$r = mysql_query($q);
											while($r1 = mysql_fetch_array($r))
											{
												$name = ucfirst(stripcslashes($r1['name']));
												if($name != "I live outside of the U.S")
												{
													?><option value="<?=$r1['name'];?>" <?php if($_REQUEST['state'] == $r1['name']) { ?> selected="selected" <?php } ?>><?=$name;?></option><?
												}
											}
									  ?>
									</select><?php */?>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td width="30%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td></tr>
						
						
					</table>
					</form>
					</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				<tr>
					<td>
						
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr><td width="20%" style="color:#FF0000;"><strong>Filter Options:</strong></td>
								</tr>
								<tr>
									<form name="filter_loc_city" id="filter_loc_city" method="post">
									<td> <strong>Filter By Event City</strong>:&nbsp;<br />
								<? $flt = hb_get_result("select * from events group by loc_city");?>
										<select name="filter_loc_city" id="filter_loc_city" onchange="document.filter_loc_city.submit()">
										<option value="">Select</option>
										<?
										while($flt_r = mysql_fetch_array($flt))
										{
											if($flt_r['loc_city']!="")
											{
										?>
											<option value="<?=$flt_r['loc_city']?>" <? if($_REQUEST['filter_loc_city']==$flt_r['loc_city']){?> selected="selected" <? }?>><?=$flt_r['loc_city']?></option>
										<? 
										 	} 
										}
										?>
										</select>
									</td>
									</form>
									<form name="filter_loc_state" id="filter_loc_state" method="post">
									<td width="22%"> <strong>Filter By Event State</strong>:&nbsp;<br />
								<? $flt = hb_get_result("select * from events group by loc_state");?>
										<select name="filter_loc_state" id="filter_loc_state" onchange="document.filter_loc_state.submit()">
										<option value="">Select</option>
										<?
										while($flt_r = mysql_fetch_array($flt))
										{
											if($flt_r['loc_state']!="")
											{
										?>
											<option value="<?=$flt_r['loc_state']?>" <? if($_REQUEST['filter_loc_state']==$flt_r['loc_state']){?> selected="selected" <? }?>><?=$flt_r['loc_state']?></option>
										<? }
										}
										?>
										</select>
									</td>
									</form>
									<form name="filter_funding" id="filter_funding" method="post">
									<td width="58%"> <strong>Filter By Funding Provided</strong>:&nbsp;<br />
								
										<select name="filter_funding" id="filter_funding" onchange="document.filter_funding.submit()">
										<option value="">Select</option>
										<option value="Yes" <? if($_REQUEST['filter_funding']=="Yes"){?> selected="selected" <? }?>>Yes</option>
										<option value="No" <? if($_REQUEST['filter_funding']=="No"){?> selected="selected" <? }?>>No</option>
										</select>
								  </td>
								  	</form>
									
					</tr>
								
							</table>
							<?php /*?><script language="javascript">
								if(document.getElementById('filter1').value != '')
								{
									show_data(document.getElementById('filter1').value,'<?=$_REQUEST['load'];?>');
								}
							</script><?php */?>
						
					</td>
				</tr>
					<tr><td>&nbsp;</td></tr>
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
									echo "Attendee Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "Attendee Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "Attendee Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "Attendee with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This Attendee is in use. You can not delete this Attendee.";	
								
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Manage Attendees</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						<td width="41" height="27" class="arial_13_bold"><input type="checkbox" name="chkAll" id="chkAll" value="chkAll" onclick="chkSelectAll();" /></td>
						<td width="34" class="arial_13_bold">No.</td>
								<td width="95"   class="arial_13_bold">Confirmation Date</td>
								<td width="104"   class="arial_13_bold"># of Attendees</td>
								<td width="104"   class="arial_13_bold">Event Title</td>
								<td width="61"   class="arial_13_bold">Event Start Date</td>
								<td width="89"   class="arial_13_bold">Event End Date</td>
								<td width="120"   class="arial_13_bold">Organizer's Name</td>
								<td width="124"   class="arial_13_bold">Organizer's Email</td>
								<td width="119"   class="arial_13_bold">User's Name</td>
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
						 
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->cdate)); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->tot_addendees); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->etitle); ?></strong></td>
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->esdate)); ?></strong></td>
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->eedate)); ?></strong></td>
							  <td class="photo"> <strong> <a href="view_user.php?id=<?=$get->org_id?>" style="text-decoration:none;"><? echo stripslashes(GetValue("organizer","fname","id",$get->org_id))." ".stripslashes(GetValue("organizer","lname","id",$get->org_id)); ?></a></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes(GetValue("organizer","email","id",$get->org_id)); ?></strong></td>
							  <td class="photo"> <strong><a href="view_user.php?id=<?=$get->user_id?>" style="text-decoration:none;"> 						<?
									echo GetValue("organizer","fname","id",$get->user_id);
								?>&nbsp;
								<?
									echo GetValue("organizer","lname","id",$get->user_id);
								?>	</a></strong></td>
							  <td  align="left"nowrap class="photo" >				 
				  <input name="button" type="button" class="send_form" onClick="window.location.href='add_attendee.php?id=<?php echo ($get->id); ?>&mode=edit'" value=" EDIT ">
                    <input name="button2" type="button" class="send_form" onClick="deleteconfirm('Are you sure that you want to delete this attendee? \n','add_attendee.php?id=<?php echo($get->id); ?>&mode=delete');" value="DELETE"><br/>
					<input name="button2" type="button" class="send_form_big" onclick="window.location.href='view_attendee.php?id=<?php echo ($get->id); ?>'" value="VIEW ATTENDEE DETAILS">
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
											<td align="center" width="20"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_attendee.php?mode=add'" /></td><td align="right"><?=$result[1]?>&nbsp;</td>
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
								return confirm("Are you sure that you want to delete the selected attendee?");
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
<script language="javascript">
	function change_latest(new_value)
	{
		document.getElementById("latest").value = new_value;
	}
</script>