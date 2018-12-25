<?php									
include("connect.php");
$LeftLinkSection = 5;
if($_REQUEST['submit1'])
{
	$sel = "select * from organizer where username like'%".$_REQUEST['uname']."%' and email like '%".$_REQUEST['email_add']."%' and lname like '%".$_REQUEST['lstname']."%' and city like '%".$_REQUEST['ocity']."%' and state like '%".$_REQUEST['ostate']."%' and country like '%".$_REQUEST['ocountry']."%' and payment_method like '%".$_REQUEST['payment']."%'";
	if($_REQUEST['ord_st_dt'] != '' && $_REQUEST['ord_end_dt'] != '')
	{
		$a = convert_db($_REQUEST['ord_st_dt']);
		$b = convert_db($_REQUEST['ord_end_dt']);
		$sel .= " and add_date between '".$a."' and  '".$b."'";
	}
}
else
{
	$sel = "select organizer.* from organizer order by add_date desc";
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
				
				
				<tr>
					<td>
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td><strong>Search Options :</strong></td></tr>
					<form name="srch_lname" id="srch_lname" action="" method="post">
						<tr>
							<?php /*?><td width="27%"><strong>Username :</strong>&nbsp;&nbsp;
							<input type="text" name="uname" id="uname" value="<?=$_REQUEST['uname']?>" />
							</td><?php */?>
							<td width="26%"><strong>Email Address :</strong> &nbsp;&nbsp;
							  <input type="text" name="email_add" value="<?=$_REQUEST['email_add']?>" id="email_idd" /></td>
							<td width="19%"><strong> Last Name</strong>&nbsp;&nbsp;
							  <input type="text" name="lstname" id="lstname" value="<?=$_REQUEST['lstname'];?>" /></td>
							  <td valign="top" ><strong>Payment Method Selected  :</strong>&nbsp;</td>
							<td width="20%"><select name="payment" id="payment"  style="width:100px;">
								<option value="">Select</option>
								<option value="Check" <?php if($_REQUEST['payment'] == "Check"){?> selected="selected" <?php } ?>>Check </option>
								<option value="PayPal" <?php if($_REQUEST['payment'] == "PayPal"){?> selected="selected" <?php } ?>>PayPal</option>
							</select> </td> 
							
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
								<td width="27%"><strong>Date Registered Start    :</strong>&nbsp;&nbsp;
							<input type="text" name="ord_st_dt" id="ord_st_dt" value="<?=$_REQUEST['ord_st_dt']?>" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.srch_lname.ord_st_dt,'mm-dd-yyyy',this)" />
							</td>
							<td width="26%"><strong>Date Registered End    :</strong> &nbsp;&nbsp;
							  <input type="text" name="ord_end_dt" value="<?=$_REQUEST['ord_end_dt']?>" id="ord_end_dt" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.srch_lname.ord_end_dt,'mm-dd-yyyy',this)" /></td>
							
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
						<td width="27%"><strong> City</strong>&nbsp;&nbsp;
							  <input type="text" name="ocity" id="ocity" value="<?=$_REQUEST['ocity'];?>" /></td>
						<td width="26%"><strong> State </strong>&nbsp;&nbsp;
							  <input type="text" name="ostate" id="ostate" value="<?=$_REQUEST['ostate'];?>" /></td>
						<td width="19%"><strong> Country </strong>&nbsp;&nbsp;
							  <input type="text" name="ocountry" id="ocountry" value="<?=$_REQUEST['ocountry'];?>" /></td>
							 <td width="8%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td>
						</tr>
						</form>
						
						
					</table>
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Organizer Report</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						
						<td class="arial_13_bold">No.</td>
								<td   class="arial_13_bold">Date Registered</td>
								<td   class="arial_13_bold">Username</td>
								<td   class="arial_13_bold">Name</td>
								<td   class="arial_13_bold">Payment Methods</td>
								<td   class="arial_13_bold">City</td>
								<td   class="arial_13_bold">State</td>
								<td   class="arial_13_bold">Country</td>
								<td   class="arial_13_bold">Events Created</td>
								<td   class="arial_13_bold">Events Active</td>
								<td   class="arial_13_bold">Total Raised</td>
				</tr>
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
								$count++;
								
								$total_created_query = "select id from events where oid = '".$get->id."'";
								$total_created_result = hb_get_result($total_created_query) or die(mysql_error());
								$total_created_events = mysql_num_rows($total_created_result);
								$event_ids = '';
								while($total_created_data = mysql_fetch_array($total_created_result))
								{
									$event_ids .= ",".$total_created_data['id'];
								}
								$event_ids = ltrim($event_ids,",");
								if($event_ids !="")
								{
						 ?>	 
							 <tr>
							  
							 <td height="49" class="photo" style="border-left: 1px solid #D3E5ED;"><?=$count;?>.</td>
						 <?
						 	$organizer = new hb_organizer($get->id);
						 ?>
							  <td class="photo"><strong><? echo get_cplus_date(stripslashes($get->add_date)); ?></strong></td>
							  <td class="photo"> <a href="mailto:<?=$get->email;?>" class="report_link"><strong> <? echo stripslashes($get->email ); ?></strong></a></td>
							  <td class="photo"> <a href="view_user.php?id=<?=$get->id;?>" class="report_link"><strong> <? echo stripslashes($get->fname." ".$get->lname); ?></strong></a></td>
							<td class="photo"> <strong> <? echo stripslashes($get->payment_method); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->city); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->state); ?></strong></td>
							<td class="photo"> <strong> <? echo stripslashes($get->country); ?></strong></td>
							  <td class="photo"><a href="manage_events.php?event_ids=<?=$event_ids;?>" class="report_link"><strong><? echo $organizer->get_events_total_for_organizer();?></strong></a></td><td class="photo"> <strong> <? echo $organizer->get_active_events_total_for_organizer();?></strong></td>
							   <td class="photo"> <strong><? echo $organizer->get_net_funding_for_organizer();?></strong></td>
				   </tr>
                <? } 
				}?>			
				  
				
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
