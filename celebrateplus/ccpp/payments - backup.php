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
			$query = "DELETE FROM  events where id=".$_REQUEST[$pid];
		}
		hb_get_result($query);
		
	}
	location("manage_events.php?msg=3");
}
if(isset($_REQUEST['update']))
{
	$count1 = $_REQUEST['count'];
	
	for($i = 1;$i <= $count1;$i++)
	{
		$pid = "pid".$i;
		$amt_paid = "amt_paid".$i;
		$order_status = "order_status".$i;
		//echo "update events set amt_paid_org=".$_REQUEST[$amt_paid].",order_status = '".$_REQUEST[$order_status]."' where id=".$_REQUEST[$pid];
//$af = "update events set amt_paid_org=".$_REQUEST[$amt_paid].",order_status = ".$_REQUEST[$order_status]." where id=".$_REQUEST[$pid];
	$new = hb_get_result("update events set amt_paid_org='".$_REQUEST[$amt_paid]."',order_status = '".$_REQUEST[$order_status]."' where id=".$_REQUEST[$pid]);
	} 
}

$LeftLinkSection = 2;
$pagetitle="Payments";
if($_REQUEST['submit1'])
{
	if($_REQUEST['uusrname']!="" or $_REQUEST['ulname']!="" or $_REQUEST['uemail']!="")
	{
		
		$user_table_qry = hb_get_result("select * from user where username like '%".$_REQUEST['uusrname']."%' and lname like '%".$_REQUEST['ulname']."%' and email like '%".$_REQUEST['uemail']."%'");
		while($user_tab_row = mysql_fetch_array($user_table_qry))
		{
			 $user_id_arr = $user_id_arr.$user_tab_row['id'].",";
		}
			
		$user_id_arr = rtrim($user_id_arr,",");
		
		if($user_id_arr!="")
		{
			$attende_tbl_qry = hb_get_result("select * from attendee where user_id in ($user_id_arr)");
			while($attende_tbl_row = mysql_fetch_array($attende_tbl_qry))
			{
				$attende_tbl_id = $attende_tbl_id.$attende_tbl_row['event_id'].",";
			} 
			$attende_tbl_id = rtrim($attende_tbl_id,","); 
			$sel = "select * from events where id in ($attende_tbl_id)";
		}
		
	}
	else
	{
		$sel = "select organizer.*,events.* from organizer, events where events.title like '%".$_REQUEST['event_title']."%' and organizer.username like '%".$_REQUEST['org_uname']."%' and organizer.email like '%".$_REQUEST['org_email']."%' and organizer.lname like '%".$_REQUEST['org_lname']."%' and events.sdate >= '".$_REQUEST['ord_st_dt']."' and events.edate <= '".$_REQUEST['ord_end_dt']."' and events.oid=organizer.id";
	}
	
}
else 
{
	//$sel= "select * from events where title like '".$_GET["order"]."%' order by add_date desc";
	$sel= "select * from events where title like '".$_GET["order"]."%' and order_status!='New' order by add_date desc";
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
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
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
			<?php /*?><td align="left" valign="top" width="17%"><? include("left.php"); ?></td><?php */?>
			<td align="left" valign="top">
				<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr><td style="padding-left:20px;">
				<form name="Search_option" id="Search_option" action="" method="post">
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td style="color:#FF0000;"><strong>Search Options :</strong></td></tr>
					
						<tr>
							<td width="23%"><strong>Event Title :</strong>&nbsp;&nbsp;
							<input type="text" name="event_title" id="event_title" value="<?=$_REQUEST['event_title']?>" />
							</td>
							<td width="26%"><strong>Organizer's Username :</strong> &nbsp;&nbsp;
							  <input type="text" name="org_uname" value="<?=$_REQUEST['org_uname']?>" id="org_uname" /></td>
							<td width="25%"><strong> Organizer's Email Address</strong>&nbsp;
							  <input type="text" name="org_email" id="org_email" value="<?=$_REQUEST['org_email'];?>" /></td>
							  <td width="26%"><strong> Organizer's Last Name</strong>&nbsp;&nbsp;
							  <input type="text" name="org_lname" id="org_lname" value="<?=$_REQUEST['org_lname'];?>" /></td>
							
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="23%"><strong>User's Username  :</strong>&nbsp;&nbsp;
							<input type="text" name="uusrname" id="uusrname" value="<?=$_REQUEST['uusrname']?>" />
							</td>
							<td width="26%"><strong>User's Last Name  :</strong> &nbsp;&nbsp;
							  <input type="text" name="ulname" value="<?=$_REQUEST['ulname']?>" id="ulname" /></td>
							<td width="25%"><strong> User's Email Address :</strong>&nbsp;
							  <input type="text" name="uemail" id="uemail" value="<?=$_REQUEST['uemail'];?>" /></td>
							  
							
						</tr>
						<tr><td>&nbsp;</td></tr>
						</table>
						<table width="100%" cellpadding="1" cellspacing="1" border="0">
						<tr>
							<td width="25%"><strong>Order Start Date Range   :</strong>&nbsp;&nbsp;
							<input type="text" name="ord_st_dt" id="ord_st_dt" value="<?=$_REQUEST['ord_st_dt']?>" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.Search_option.ord_st_dt,'yyyy-mm-dd',this)" />
							</td>
							<td width="24%"><strong>Order End Date Range   :</strong> &nbsp;&nbsp;
							  <input type="text" name="ord_end_dt" value="<?=$_REQUEST['ord_end_dt']?>" id="ord_end_dt" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.Search_option.ord_end_dt,'yyyy-mm-dd',this)" /></td>
							
							  
							 <td width="25%"><input type="submit" name="submit1" id="submit1" onclick="Search_option.submit()" class="send_form" value="Search" /></td>
						</tr>
					</table>
					
					</form>
					</td></tr>
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
									echo "Event Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "Event Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "Event Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "Event with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This Event is in use. You can not delete this Event.";	
								
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Payments</td>
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
						<td width="35" class="arial_13_bold">No.</td>
								<td width="100"   class="arial_13_bold">Order Date </td>
								<td width="177" align="center" class="arial_13_bold">User's Email Address </td>
								<td width="97"   class="arial_13_bold">Event Title </td>
								<td width="220"   class="arial_13_bold">Organizer's Email Address </td>
							
							<td width="175" align="center" class="arial_13_bold">Order Amount </td>
							<td width="188" align="center" class="arial_13_bold">Event Donation</td>
							<td width="188" align="center" class="arial_13_bold">Commission</td>
							<td width="182" align="center" class="arial_13_bold">Order Status </td>
	  					
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
								$count++;
						 ?>	 
							 <tr>
							  <td height="49" class="photo">
							  <?
							  	$event = new hb_event($get->id);
							  ?>
							  <input type="hidden" name="pid<?=$count;?>" id="pid<?=$count;?>" value="<?=$get->id;?>" />
							  <input type="checkbox" name="chk<?=$count;?>" id="chk<?=$count;?>" value="<?=$count;?>" /></td>
							 <td height="49" class="photo"><?=$count;?>.</td>
						 		 <td class="photo"> <strong> <? echo convert_us(stripslashes($get->add_date)); ?></strong></td>
								  <td class="photo"> <strong>
							   <? 
							   		echo $event->get_attendees_names_for_event();
							   ?>
							   </strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->title); ?></strong></td>
					<td class="photo">
							<? 
							$field_result2=hb_get_result("select * from organizer where id in (".$get->oid.") order by id");				
							$field_value_list2="";
							while($field_row2=mysql_fetch_array($field_result2))
							{
								if($field_value_list2=="")
								{
									$field_value_list2=stripslashes($field_row2["email"]);
								}
								else
								{
									$field_value_list2 .= ",".stripslashes($field_row2["email"]);
								}
							}
							echo $field_value_list2;
							?>
							</td>
							 
							   <td class="photo"><strong> <? echo $event->get_gross_donation_for_event(); ?></strong></td>
							   <td class="photo"><strong> <? echo $event->get_net_donation_for_event(); ?></strong></td>
							   <td class="photo"><strong> <? echo $event->get_net_commission_for_event(); ?></strong></td>
							   <td class="photo">
							   	<select name="order_status<?=$count;?>" id="order_status">
									<!--<option value="">Select</option>-->
									<option value="New" <? if($get->order_status=="New") {?> selected="selected"<? }?>>New</option>
									<?php /*?><option value="Payment Scheduled" <? if($get->order_status=="Payment Scheduled") {?> selected="selected"<? }?>>Payment Scheduled</option><?php */?>
									<option value="Complete" <? if($get->order_status=="Complete") {?> selected="selected"<? }?>>Complete</option>
									<option value="Cancelled" <? if($get->order_status=="Cancelled") {?> selected="selected"<? }?>>Cancelled</option>
								</select>
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
											<td align="center" width="20"><input type="submit" name="btnDelete" id="btnDelete" value="Delete" class="red" onclick="return chkDelete();" /></td>
											<?php /*?><td align="center" width="20"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_events.php?mode=add'" /></td><?php */?>
													<td align="center" width="20"><input class="add_new" type="submit" name="update" value="Update" ></td><td align="right"><?=$result[1]?>&nbsp;</td>
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
								return confirm("Are you sure that you want to delete the selected Event.");
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
