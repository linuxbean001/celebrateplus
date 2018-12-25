<?php									
include("connect.php");
$LeftLinkSection = 5;
function get_next_date($date)
{
	$timestamp = strtotime($date);
	$date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($date)). " +1 day"));
	return $date;
}
 $abc = split(" ",$_REQUEST['org_lname']); 

if($_REQUEST['submit1'])
{
	 
	$sel = "select organizer.*,events.* from organizer, events where events.title like '%".$_REQUEST['event_title']."%' and ((organizer.lname like '%".$abc[1]."%' and organizer.fname like '%".$abc[0]."%') or (organizer.lname like '%".$abc[0]."%' and organizer.fname like '%".$abc[1]."%')) and events.loc_city like '%".$_REQUEST['ecity']."%' and events.loc_state like '%".$_REQUEST['estate']."%' and events.loc_country like '%".$_REQUEST['ecountry']."%' and events.payment like '%".$_REQUEST['payment']."%' and events.oid=organizer.id"; 
	if($_REQUEST['ord_st_dt'] != '' && $_REQUEST['ord_end_dt'] != '')
	{
		$ord_st_dt_array=explode("-",$_REQUEST['ord_st_dt']);
		$ord_st_dt=$ord_st_dt_array[2]."-".$ord_st_dt_array[0]."-".$ord_st_dt_array[1];
		$ord_end_dt_array=explode("-",$_REQUEST['ord_end_dt']);
		$ord_end_dt=$ord_end_dt_array[2]."-".$ord_end_dt_array[0]."-".$ord_end_dt_array[1];
	 	$sel .= " and events.sdate >= '".$ord_st_dt."' and events.edate <= '".get_next_date($ord_end_dt)."'";
	}
	else if($_REQUEST['ord_st_dt'] != '')
	{
	 	$ord_st_dt_array=explode("-",$_REQUEST['ord_st_dt']);
		$ord_st_dt=$ord_st_dt_array[2]."-".$ord_st_dt_array[0]."-".$ord_st_dt_array[1];
		$sel .= " and events.sdate >= '".$ord_st_dt."'";
	}
	else if($_REQUEST['ord_end_dt'] != '')
	{
		$ord_end_dt_array=explode("-",$_REQUEST['ord_end_dt']);
		$ord_end_dt=$ord_end_dt_array[2]."-".$ord_end_dt_array[0]."-".$ord_end_dt_array[1];
		$sel .= " and events.edate <= '".get_next_date($ord_end_dt)."'";	 
	}	
}
else 
{
$sel = "select events.*,organizer.id as organizer_id,organizer.fname as fname,organizer.lname as lname  from events left join organizer on events.oid=organizer.id order by sdate desc";
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
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

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
							<td width="21%"><strong>Event Title :</strong>&nbsp;&nbsp;
							<input type="text" name="event_title" id="event_title" value="<?=$_REQUEST['event_title']?>" />
							</td>
							<td width="26%"><strong>Report Start Date   :</strong>&nbsp;&nbsp;
							<input type="text" name="ord_st_dt" id="ord_st_dt" value="<?=$_REQUEST['ord_st_dt']?>" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.Search_option.ord_st_dt,'mm-dd-yyyy',this)" />
							</td>
							<td width="25%"><strong>Report End Date    :</strong> &nbsp;&nbsp;
							  <input type="text" name="ord_end_dt" value="<?=$_REQUEST['ord_end_dt']?>" id="ord_end_dt" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.Search_option.ord_end_dt,'mm-dd-yyyy',this)" /></td>
							  <td width="28%"><strong> Organizer</strong>&nbsp;&nbsp;
							  <input type="text" name="org_lname" id="org_lname" value="<?=$_REQUEST['org_lname'];?>" /></td>
							
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="21%"><strong>Event City   :</strong>&nbsp;&nbsp;
							<input type="text" name="ecity" id="ecity" value="<?=$_REQUEST['ecity']?>" />
							</td>
							<td width="26%"><strong>Event State   :</strong> &nbsp;&nbsp;
							  <input type="text" name="estate" value="<?=$_REQUEST['estate']?>" id="estate" /></td>
							<td width="25%"><strong>Event Country :</strong>&nbsp;
							  <input type="text" name="ecountry" id="ecountry" value="<?=$_REQUEST['ecountry'];?>" /></td>
							<td width="28%"><strong>Payment Method Selected  :</strong>&nbsp;
							<select name="payment" id="payment">
								<option value="">Select</option>
								<option value="Check" <?php if($_REQUEST['payment'] == "Check") {?> selected="selected" <?php } ?>>Check </option>
								<option value="PayPal" <?php if($_REQUEST['payment'] == "PayPal") {?> selected="selected" <?php } ?>>PayPal</option>
							</select> </td> 
							
						</tr>
						<tr><td>&nbsp;</td></tr>
						</table>
						<table width="100%" cellpadding="1" cellspacing="1" border="0">
						<tr>
							
							
							  
							 <td width="25%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td>
						</tr>
					</table>
						</form>
					</td></tr>
				<tr>
					<td>
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					
					
						<tr>
							 <td width="92%" align="right"><a href="print_event_report.php" target="_blank"><img src="images/print_report.png" border="0" /></a></td>
							 <td width="8%" align="right"><a href="email_event_report.php" target="_blank"><img src="images/email_report.png"  border="0" /></a></td>
						</tr>
						
						
						
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
					<? if($_GET["msg"]) { ?>
							<tr>
								<TD align="center"><span style="color:#CC6600;">
								<?
								if($_GET["msg"]==1)
									echo "Organizer Added Successfully.";
								elseif($_GET["msg"]==2)
									echo "Organizer Updated Successfully.";
								elseif($_GET["msg"]==3)
									echo "Organizer Deleted Successfully.";
								elseif($_GET["msg"]==4)
									echo "Organizer with this name is already Exist.";	
								elseif($_GET["msg"]==5)
									echo "This Organizer is in use. You can not delete this Organizer.";	
								
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Event Report</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						
						<td class="arial_13_bold" height="27">No.</td>
								<td   class="arial_13_bold">Event Title</td>
								<td   class="arial_13_bold">Event Start Date</td>
								<td   class="arial_13_bold">Event End Date</td>
								<td   class="arial_13_bold">Event City</td>
								<td   class="arial_13_bold">Event State</td>
								<td   class="arial_13_bold">Organizer Name</td>
								<td   class="arial_13_bold">Funding Goal</td>
								<td   class="arial_13_bold">Funded Amount</td>
								<td   class="arial_13_bold"># of Donors</td>
								<td   class="arial_13_bold">Event Space</td>
								<td   class="arial_13_bold"># of Attendees</td>
						</tr>
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {
							 $event = new hb_event($get->id);  
								$count++;
						 ?>	 
							 <tr>
							  
							 <td height="49" class="photo"  style="border-left: 1px solid #D3E5ED;"><?=$count;?>.</td>
						 
							  <td class="photo"> <a href="view_event.php?id=<? echo stripslashes($get->id); ?>" class="report_link"><strong> <? echo stripslashes($get->title); ?></strong></a></td>
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->sdate)); ?></strong></td>
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->edate)); ?></strong></td>
							<td class="photo"> <strong> <? echo stripslashes($get->loc_city); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->loc_state); ?></strong></td>
							  <td class="photo">  <a href="view_organizer_detail.php?id=<? echo stripslashes($get->organizer_id); ?>" class="report_link"><strong> <? echo stripslashes($get->fname); ?>&nbsp;<? echo stripslashes($get->lname); ?></strong></a></td>
							<td class="photo"> <strong><? echo stripslashes($get->fund_amt); ?></strong></td>
							<td class="photo"> <strong><? echo $event->get_net_donation_for_event(); ?></strong></td>
							  <td class="photo"> <strong> <? echo $event->get_donators_total_for_event(); ?></strong></td>
							   <td class="photo"> <strong> <? echo stripslashes($get->max_cap); ?></strong></td>
							   <td class="photo"> <strong><? echo $event->get_attendees_total_for_event(); ?></strong></td>			  
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
											<td align="center"><?=$result[1]?>&nbsp;</td>
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
								return confirm("Are you sure that you want to delete the selected Organizer.");
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
