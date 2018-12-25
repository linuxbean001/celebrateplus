<?									
include("connect.php");
$LeftLinkSection = 5;

if($_REQUEST['submit1'])
{
		$sel = "select 
					events.*,
					organizer.id as organizer_id,
					organizer.fname as organizer_fname,
					organizer.lname as organizer_lname 
				from 
					events 
				left join organizer on events.oid=organizer.id 
				where 
					1";
		
		/************ ---------------------- Organization search ----------------- *****************/
		if($_REQUEST['org_lname'] != "" && $_REQUEST['org_email'] != "")
		{
			$oid_list=sh_get_id_list("organizer","id","lname",$_REQUEST['org_lname'],"email",$_REQUEST['org_email']);
			if($oid_list != "")
			{
				$sel .= " and events.oid in (".$oid_list.") ";
			}
			else
			{
				$sel .= " and events.oid = '' ";
			}
		}
		else if($_REQUEST['org_lname'] != "")
		{
			$oid_list=sh_get_id_list("organizer","id","lname",$_REQUEST['org_lname']);
			if($oid_list != "")
			{
				$sel .= " and events.oid in (".$oid_list.") ";
			}
			else
			{
				$sel .= " and events.oid = '' ";
			}
		}
		else if($_REQUEST['org_email'])
		{
			$oid_list=sh_get_id_list("organizer","id","email",$_REQUEST['org_email']);
			if($oid_list != "")
			{
				$sel .= " and events.oid in (".$oid_list.") ";
			}
			else
			{
				$sel .= " and events.oid = '' ";
			}
		}
		
		/************ ---------------------- Event search ----------------- *****************/
		if($_REQUEST['etitle'] != "")
		{
			$sel .= " and events.title like '%".$_REQUEST['etitle']."%' ";
		}
		if($_REQUEST['city'] != "")
		{
			$sel .= " and events.loc_city like '%".$_REQUEST['city']."%' ";
		}
		if($_REQUEST['state'] != "")
		{
			$sel .= " and events.loc_state like '%".$_REQUEST['state']."%' ";
		}
		if($_REQUEST['evnt_country'] != "")
		{
			$sel .= " and events.loc_country like '%".$_REQUEST['evnt_country']."%' ";
		}		
		
		/************ ---------------------- User-attendee search ----------------- *****************/
		$event_id_list_array = array();
		$error = 0;
		$final_event_id_list = "";
		if($_REQUEST['ulname'] != "")
		{
			$event_id_list1 = sh_get_eid_list("select event_id from attendee where ulname like '%".$_REQUEST['ulname']."%'","event_id");
			if($event_id_list1 == "")
			{ $error = 1; }
			else
			{
				$final_event_id_list = sh_get_cleared_list($event_id_list1);
			}
		}
		if($_REQUEST['uemail'] != "")
		{
			if($final_event_id_list != "")
			{ 				
				$query = "select event_id from attendee where uemail like '%".$_REQUEST['uemail']."%' and event_id in (".$final_event_id_list.")"; 
			}
			else
			{
				$query = "select event_id from attendee where uemail like '%".$_REQUEST['uemail']."%'";
			}
			$event_id_list2 = sh_get_eid_list($query,"event_id");
			if($event_id_list2 == "")
			{ $error = 1; }
			else
			{
				$final_event_id_list = sh_get_cleared_list($event_id_list2);
			}
		}
		if($_REQUEST['funding'] != "")
		{
			if($final_event_id_list != "")
			{ 				
				$query = "select event_id from attendee where funding like '%".$_REQUEST['funding']."%' and event_id in (".$final_event_id_list.")"; 
			}
			else
			{
				$query = "select event_id from attendee where funding like '%".$_REQUEST['funding']."%'";
			}
			$event_id_list3 = sh_get_eid_list($query,"event_id"); 
			if($event_id_list3 == "")
			{ $error = 1; }
			else
			{
				$final_event_id_list = sh_get_cleared_list($event_id_list3);
				if($_REQUEST['funding'] == "No")
				{
					$final_event_id_array = explode(",",$final_event_id_list);
					foreach ($final_event_id_array as $val)
					{
						if($val != "")
						{
							$temp_id=sh_get_eid_list("select event_id from attendee where funding = 'Yes' and event_id = '".$val."'","event_id");
							if($temp_id != "")
							{
								unset($final_event_id_array[array_search($val,$final_event_id_array)]);
							}
						}
					}
					$final_event_id_list = "";
					if(count($final_event_id_array) > 0)
					{ 
						$final_event_id_list = implode(",",$final_event_id_array);
						$final_event_id_list = sh_get_cleared_list($final_event_id_list);
					}
					else
					{
						$error = 1;
					}
				}
			}
		}
		if($_REQUEST['ord_st_dt'] != '' && $_REQUEST['ord_end_dt'] != '')
		{
				$a = convert_db($_REQUEST['ord_st_dt']);
				$b = convert_db($_REQUEST['ord_end_dt']);
				$sel .= " and events.sdate > '".$a."' and  events.edate < '".$b."'";
	 	}	
		else if($_REQUEST['ord_st_dt'] != '')
		{
				$a = convert_db($_REQUEST['ord_st_dt']);
				$sel .= " and events.sdate > '".$a."'";
	 	}	
		else if($_REQUEST['ord_end_dt'] != '')
		{
				$b = convert_db($_REQUEST['ord_end_dt']);
				$sel .= " and  events.edate < '".$b."'";
	 	}	
		/*if($_REQUEST['ord_st_dt'] != '' && $_REQUEST['ord_end_dt'] != '')
		{
			$a = convert_db($_REQUEST['ord_st_dt']);
			$b = convert_db($_REQUEST['ord_end_dt']);
			$event_id_list = sh_get_eid_list("select event_id from attendee where cdate between '".$a."' and  '".$b."'","event_id");
			if($event_id_list == "")
			{ $error = 1; }
			else
			{
				$eid_array = explode(",",$event_id_list);
				$event_id_list_array = array_merge($event_id_list_array,$eid_array);
			}
				
	 	}
		else if($_REQUEST['ord_st_dt'] != '')
		{
			$a = convert_db($_REQUEST['ord_st_dt']);
			$event_id_list = sh_get_eid_list("select event_id from attendee where cdate > '".$a."'","event_id");
			if($event_id_list == "")
			{ $error = 1; }
			else
			{
				$eid_array = explode(",",$event_id_list);
				$event_id_list_array = array_merge($event_id_list_array,$eid_array);
			}
		}	
		else if($_REQUEST['ord_end_dt'] != '')
		{
			$b = convert_db($_REQUEST['ord_end_dt']);
			$event_id_list = sh_get_eid_list("select event_id from attendee where cdate < '".$b."'","event_id");
			if($event_id_list == "")
			{ $error = 1; }
			else
			{
				$eid_array = explode(",",$event_id_list);
				$event_id_list_array = array_merge($event_id_list_array,$eid_array);
			}
		}*/	
		/*$event_id_list_array = array_unique($event_id_list_array);
		$key = array_search("",$event_id_list_array);
		if($key >= 0)
		{
			unset($event_id_list_array[$key]);
		}
		$event_id_final_list = "";
		if(count($event_id_list_array))
		{
			$event_id_final_list = implode(",",$event_id_list_array);
		}*/
		if($final_event_id_list != "" && $error != 1)
		{
			$sel .= " and events.id in(".$final_event_id_list.") ";
		}
		$sel .= " order by edate desc";
		if($error == 1)
		{
			$sel = "select * from events where 1=0";
		}
		
		/*$sel = "select organizer.*,organizer.fname as organizer_fname,organizer.lname as organizer_lname,events.*,attendee.*,user.* from organizer, events,attendee,user where attendee.funding like '%".$_REQUEST['funding']."%' and organizer.username like '%".$_REQUEST['org_uname']."%' and organizer.email like '%".$_REQUEST['org_email']."%' and organizer.lname like '%".$_REQUEST['org_lname']."%' and events.loc_city like '%".$_REQUEST['city']."%' and events.loc_state like '%".$_REQUEST['state']."%' and events.loc_country like '%".$_REQUEST['country']."%' and user.username like '%".$_REQUEST['uusrname']."%' and user.email like '%".$_REQUEST['uemail']."%' and user.lname like '%".$_REQUEST['ulname']."%'"; 
		
		if($_REQUEST['ord_st_dt'] != '' && $_REQUEST['ord_end_dt'] != '')
		{
				$a = convert_db($_REQUEST['ord_st_dt']);
				$b = convert_db($_REQUEST['ord_end_dt']);
				$sel .= " and attendee.cdate between '".$a."' and  '".$b."'";
	 	}		
		$sel.=" and attendee.event_id=events.id and attendee.org_id=organizer.id order by attendee.cdate desc"; */
			
}
else
{
	$sel = "select events.*,organizer.id as organizer_id,organizer.fname as organizer_fname,organizer.lname as organizer_lname from events left join organizer on events.oid=organizer.id order by edate desc";
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
					
					
						<tr>
					<td>
					<form name="Search_option" id="Search_option" action="" method="post">
					<table width="100%" cellpadding="1" cellspacing="1" border="0">
					<tr><td style="color:#FF0000;"><strong>Search Options :</strong></td></tr>
					
						<tr>
							<td width="25%"><strong>Organizer's Last Name :</strong>&nbsp;&nbsp;
							<input type="text" name="org_lname" id="org_lname" value="<?=$_REQUEST['org_lname']?>" />
							</td>
							<?php /*?><td width="27%"><strong>Organizer's Username :</strong> &nbsp;&nbsp;
							  <input type="text" name="org_uname" value="<?=$_REQUEST['org_uname']?>" id="org_uname" /></td><?php */?>
							<td width="59%"><strong> Organizer's Email Address :</strong>&nbsp;&nbsp;
							  <input type="text" name="org_email" id="org_email" value="<?=$_REQUEST['org_email'];?>" /></td>
							 
						</tr>
						
					</table>
					<table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">
						<tr>
							<?php /*?><td width="24%"><strong>User's Username :</strong>&nbsp;&nbsp;
							<input type="text" name="uusrname" id="uusrname" value="<?=$_REQUEST['uusrname']?>" />
							</td><?php */?>
							<td width="25%"><strong>User's Last Name :</strong>&nbsp;&nbsp;
							  <input type="text" name="ulname" id="ulname" value="<?=$_REQUEST['ulname'];?>" /></td>
							<td width="59%"><strong>User's Email Address :</strong> &nbsp;&nbsp;
							  <input type="text" name="uemail" value="<?=$_REQUEST['uemail']?>" id="uemail" /></td>
							
							  
							 
						</tr>						
					</table>
					<table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">
						<tr>
							<td width="27%"><strong>Event Title :</strong> &nbsp;&nbsp;
							  <input type="text" name="etitle" value="<?=$_REQUEST['etitle']?>" id="etitle" /></td>
							<td width="27%"><strong>Event City :</strong> &nbsp;&nbsp;
							  <input type="text" name="city" value="<?=$_REQUEST['city']?>" id="city" /></td>
							<td width="19%"><strong>Event State :</strong>&nbsp;&nbsp;
							  <input type="text" name="state" id="state" value="<?=$_REQUEST['state'];?>" /></td>
							<td width="30%"><strong>Event Country  :</strong>&nbsp;&nbsp;
							<input type="text" name="evnt_country" id="evnt_country" value="<?=$_REQUEST['evnt_country']?>" />
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td width="30%"><strong>Event Date Start   :</strong>&nbsp;&nbsp;
							<input type="text" name="ord_st_dt" id="ord_st_dt" value="<?=$_REQUEST['ord_st_dt']?>" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.Search_option.ord_st_dt,'mm-dd-yyyy',this)" />
							</td>
							<td width="30%"><strong>Event Date End   :</strong> &nbsp;&nbsp;
							  <input type="text" name="ord_end_dt" value="<?=$_REQUEST['ord_end_dt']?>" id="ord_end_dt" />&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.Search_option.ord_end_dt,'mm-dd-yyyy',this)" /></td>
							  <td width="24%"><strong>Funding :</strong>&nbsp;&nbsp;
							 <select name="funding" id="funding">
							 	<option value="">Select</option>
								<option value="Yes" <?php if($_REQUEST['funding'] == "Yes") {?> selected="selected" <?php } ?>>Yes</option>
								<option value="No" <?php if($_REQUEST['funding'] == "No") {?> selected="selected" <?php } ?>>No</option>
							 </select>
							  </td>
							  </tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td width="30%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td></tr>
						
						
					</table>
					</form>
					</td>
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Event User & Attendee Report</td>
						  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				
				<tr>
						
						<td width="3%" class="arial_13_bold">No.</td>
								<td width="6%"   class="arial_13_bold">Event Title</td>
								<td width="9%"   class="arial_13_bold">Event Start Date</td>
								<td width="9%"   class="arial_13_bold">Event End Date</td>
								<td width="6%"   class="arial_13_bold">Event City</td>
								<td width="7%"   class="arial_13_bold">Event State</td>
								<td width="9%"   class="arial_13_bold">Organizer Name</td>
								
								<td width="9%"   class="arial_13_bold">Total Attendees</td>
								<td width="10%"   class="arial_13_bold">Funding Amount</td>
	  					</tr>
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
							 	$event = new hb_event($get->id);  
								$count++;
								$currently_funded_amount = 0;
								$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '$get->id'";
								$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
								$currently_funded_amount = mysql_result($funded_amount_result,0);
									
						 ?>	 
							 <tr>
							  
							 <td height="49" class="photo" style="border-left: 1px solid #D3E5ED;"><?=$count;?>.</td>
						 
							  <td class="photo"> <a href="view_event.php?id=<? echo stripslashes($get->id); ?>" class="report_link"><strong> <? echo stripslashes($get->title); ?></strong></a></td>
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->sdate)); ?></strong></td>
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->edate)); ?></strong></td>
							<td class="photo"> <strong> <? echo stripslashes($get->loc_city); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->loc_state); ?></strong></td>
							  <td class="photo">  <a href="view_organizer_detail.php?id=<? echo stripslashes($get->organizer_id); ?>" class="report_link"><strong> <? echo stripslashes($get->organizer_fname); ?>&nbsp;<? echo stripslashes($get->organizer_lname); ?></strong></a></td>
							<?php /*?><td class="photo"> <strong>&nbsp;</strong></td>
							<td class="photo"> <strong>&nbsp;</strong></td>
							<td class="photo"> <strong>
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
										echo '<a href=add_user.php?id='.$user_id[$i].'&mode=edit>'.GetValue("user","fname","id",$user_id[$i])." ".GetValue("user","lname","id",$user_id[$i]).'</a>';
										echo '<br/>';
									}
							   ?>
							</strong></td><?php */?>
							  <td class="photo"> <strong><a href="manage_attendee.php?frm_reprt=<?=$get->id;?>"><? echo $event->get_attendees_total_for_event(); ?></a></strong></td>
							   <td class="photo"> <strong><? echo stripslashes($currently_funded_amount); ?></strong></td>
							   
				  
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
