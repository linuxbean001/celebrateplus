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


$LeftLinkSection = 2;
$pagetitle="Funding by Event";
if($_REQUEST['submit1'])
{
	$sel = "select organizer.*,events.* from organizer, events where events.title like '%".$_REQUEST['event_title']."%' and organizer.fname like '%".$_REQUEST['org_uname']."%' and organizer.email like '%".$_REQUEST['org_email']."%' and organizer.lname like '%".$_REQUEST['org_lname']."%' and events.oid=organizer.id"; 
}
else 
{
	$sel= "select * from events where title like '".$_GET["order"]."%' order by add_date desc" ;  
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
							<td width="19%"><strong>Event Title :</strong>&nbsp;&nbsp;
							<input type="text" name="event_title" id="event_title" value="<?=$_REQUEST['event_title']?>" />
							</td>
							<td width="25%"><strong> Organizer's Email Address</strong>&nbsp;
							  <input type="text" name="org_email" id="org_email" value="<?=$_REQUEST['org_email'];?>" /></td>
							 <td width="25%"><strong>Organizer's First name :</strong> &nbsp;&nbsp;
							  <input type="text" name="org_uname" value="<?=$_REQUEST['org_uname']?>" id="org_uname" /></td>
							  <td width="24%"><strong> Organizer's Last Name</strong>&nbsp;&nbsp;
							  <input type="text" name="org_lname" id="org_lname" value="<?=$_REQUEST['org_lname'];?>" /></td>
							 <td width="7%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td>
						</tr>
						<tr></tr>
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Funding by Event</td>
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
						<td width="33" class="arial_13_bold">No.</td>
								<td width="92"   class="arial_13_bold">Order Date </td>
								<td width="90"   class="arial_13_bold">Event Title </td>
								<td width="202"   class="arial_13_bold">Organizer's Email Address </td>
								<td width="153"   class="arial_13_bold">Organizer's Last Name</td>
							<!--<td width="181" align="center" class="arial_13_bold">User's Email Address </td>-->
							<td width="115" align="center" class="arial_13_bold">Target Funding</td>
							<td width="201" align="center" class="arial_13_bold">Amount Paid to Organizer </td>
							<td width="107" align="center" class="arial_13_bold">Status </td>
	  					
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
								$count++;
								$tot = $tot + $get->fund_amt;
								$tot_pd_org = $tot_pd_org + $get->amt_paid_org;
						 ?>	 
						<? 
							   		$usr_qry = "select * from attendee where org_id =".$get->oid;
									$usr_res = hb_get_result($usr_qry);
									while($usr_row = mysql_fetch_array($usr_res))
									{
										$user_id = $user_id.",".$usr_row['user_id'];
									}
									$user_id = explode(",",$user_id);
									$tot_at = count($user_id);
							   ?>
							 <tr>
							  <td height="49" class="photo">
							  <input type="hidden" name="pid<?=$count;?>" id="pid<?=$count;?>" value="<?=$get->id;?>" />
							  <input type="checkbox" name="chk<?=$count;?>" id="chk<?=$count;?>" value="<?=$count;?>" /></td>
							 <td height="49" class="photo"><?=$count;?>.</td>
						 		 <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->add_date)); ?></strong></td>
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
							<td class="photo">
							<? 
							$field_result2=hb_get_result("select * from organizer where id in (".$get->oid.") order by id");				
							$field_value_list21="";
							while($field_row2=mysql_fetch_array($field_result2))
							{
								if($field_value_list21=="")
								{
									$field_value_list21=stripslashes($field_row2["lname"]);
								}
								else
								{
									$field_value_list21 .= ",".stripslashes($field_row2["lname"]);
								}
							}
							echo $field_value_list21;
							?>
							</td>
							  <?php /*?><td class="photo"> <strong>
							   <? 
							   		$usr_qry = "select * from attendee where org_id =".$get->oid;
									$usr_res = hb_get_result($usr_qry);
									while($usr_row = mysql_fetch_array($usr_res))
									{
										$user_id = $user_id.",".$usr_row['user_id'];
									}
									$user_id = explode(",",$user_id);
									for($i=0;$i<count($user_id);$i++)
									{
										echo GetValue("user","email","id",$user_id[$i]);
										echo '<br/>';
									}
							   ?>
							   </strong></td><?php */?>
							   <td class="photo"> <strong> <?php if ($get->fund_amt > 0) {  echo "$".number_format(str_replace(",","",$get->fund_amt),2); } ?></strong></td>
							   <td class="photo"> <strong> 
							   <?
							   	$currently_funded_amount = 0;
								$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '".$get->id."'";
								$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
								$currently_funded_amount = mysql_result($funded_amount_result,0);
								echo $currently_funded_amount;
							   ?></strong></td>
							   <td class="photo"> <strong> <? echo stripslashes($get->order_status); ?></strong></td>
							
				  
				   </tr>
                <? } ?>			
				  
				
				 <input type="hidden" name="count" id="count" value="<?=$count;?>" />   
						 </table></td>
								</tr>
								<tr><td height="20px">&nbsp;</td></tr>
								<tr><td class="arial_13_bold" style="color:#406F85; padding-left:100px;">
									<div style="float:left; width:175px;"><strong>Total Funding Target </strong></div>
									<div style="float:left; width:150px; text-align:left; font-weight:normal;">: $<?=number_format(GetValue("events","sum(REPLACE(fund_amt, ',', ''))",1,1),0);?></div>
								</td></tr>
								<tr><td class="arial_13_bold" style="color:#406F85;padding-left:100px;">
									<div style="float:left; width:175px;"><strong>Total Paid to Organizers</strong></div>
									<div style="float:left; width:150px; text-align:left; font-weight:normal;">: $<?=number_format(GetValue("events","sum(amt_paid_org)",1,1),0);?></div>
								 </td></tr>
								<tr><td class="arial_13_bold" style="color:#406F85;padding-left:100px;">
									<div style="float:left; width:175px;"><strong>Total Users Attending</strong></div>
									<?php 
										$tot_attend_res=hb_get_result("select id from attendee where is_attendee = 1 group by user_id");
										$tot_at1=mysql_num_rows($tot_attend_res);
									?>
									<div style="float:left; width:150px; text-align:left; font-weight:normal;">: <?=number_format($tot_at1,0);?></div>
								 </td></tr>
								<tr>
								  <td  valign="middle">
									<table width="98%" border="0" cellpadding="2" cellspacing="2" align="center">
										<tr>
											<td align="center" width="20"><input type="submit" name="btnDelete" id="btnDelete" value="DELETE" class="red" onclick="return chkDelete();" /></td>
											<td align="center" width="1">&nbsp;</td>
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
								return confirm("Are you sure that you want to delete the selected events?");
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
