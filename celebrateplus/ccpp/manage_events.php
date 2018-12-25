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
		$disp = "disp".$i;	
		$pid = "pid".$i;
		
		if(isset($_REQUEST[$disp]))
		{
			$disp1 = $_REQUEST[$disp];
		}
		
		 $query = "update events set display_order=".$disp1." where id=".$_REQUEST[$pid];
		hb_get_result($query);

	}
		
		location("manage_events.php?msg=2");
}
$LeftLinkSection = 1;
$pagetitle="Events";
include("srch_sort.php");

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
                                            <tr><td style="color:#FF0000;"><strong>Sorting Options:</strong></td></tr>
                                            
                                                <tr>
                                                    <form name="Sorting_options_org1_lname" id="Sorting_options_org1_lname" action="" method="get">
													<td width="24%"><strong>By Organizer's Last Name  :</strong>&nbsp;&nbsp;
                                                    <select name="org1_lname" id="org1_lname" onchange="Sorting_options_org1_lname.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="asce" <? if($_REQUEST['org1_lname']=="asce"){?> selected="selected"<? }?>>A to Z</option>
                                                            <option value="desc" <? if($_REQUEST['org1_lname']=="desc"){?> selected="selected"<? }?>>Z to A</option>
                                                        </select>
                                                    </td>
													</form>
													<form name="Sorting_options_event_title" id="Sorting_options_event_title" action="" method="get">
                                                    <td width="22%"><strong>By Event Title :</strong> &nbsp;&nbsp;		
                                                    <select name="event_title" id="event_title" onchange="Sorting_options_event_title.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="asce" <? if($_REQUEST['event_title']=="asce"){?> selected="selected"<? }?>>A to Z</option>
                                                            <option value="desc" <? if($_REQUEST['event_title']=="desc"){?> selected="selected"<? }?>>Z to A</option>
                                                      </select>				
													 </td>
													 </form>
													 <form name="Sorting_options_create_date" id="Sorting_options_create_date" action="" method="get">
                                                     <td width="29%"><strong>By Creation Date  :</strong> &nbsp;&nbsp;		
                                                   	 <select name="create_date" id="create_date" onchange="Sorting_options_create_date.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['create_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
                                                            <option value="old" <? if($_REQUEST['create_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
                                                      </select>				
                                                     </td>
													 </form>
													 <form name="Sorting_options_start_date" id="Sorting_options_start_date" action="" method="get">
                                                     <td width="25%"><strong>By Start Date :</strong> &nbsp;&nbsp;		
                                                     <select name="start_date" id="start_date" onchange="Sorting_options_start_date.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['start_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
                                                            <option value="old" <? if($_REQUEST['start_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
                                                      </select>				
                                                     </td>
                                                     </form>
                                                </tr>
                                                </table>
                                                <table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">
                                                <tr>
													 <form name="Sorting_options_end_date" id="Sorting_options_end_date" action="" method="get">
                                                    <td width="24%"><strong>By End Date :</strong> &nbsp;&nbsp;		
                                                    <select name="end_date" id="end_date" onchange="Sorting_options_end_date.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['end_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
                                                            <option value="old" <? if($_REQUEST['end_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
                                                      </select>				
                                                     </td>
													 </form>
													 <form name="Sorting_options_t_fund" id="Sorting_options_t_fund" action="" method="get">
                                                     <td width="30%"><strong>By Target Funding Amount :</strong> &nbsp;&nbsp;		
                                                     <select name="t_fund" id="t_fund" onchange="Sorting_options_t_fund.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['t_fund']=="new"){?> selected="selected"<? }?>>Highest to Lowest</option>
                                                            <option value="old" <? if($_REQUEST['t_fund']=="old"){?> selected="selected"<? }?>>Lowest to Highest</option>
                                                      </select>				
                                                     </td>
													 </form>
													 <form name="Sorting_options_c_fund" id="Sorting_options_c_fund" action="" method="get">
                                                     <td width="32%"><strong>By Currently Funded Amount  :</strong> &nbsp;&nbsp;		
                                                    <select name="c_fund" id="c_fund" onchange="Sorting_options_c_fund.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['c_fund']=="new"){?> selected="selected"<? }?>>Highest to Lowest</option>
                                                            <option value="old" <? if($_REQUEST['c_fund']=="old"){?> selected="selected"<? }?>>Lowest to Highest</option>
                                                      </select>				
                                                     </td>
                                                     </form>
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr>
													 <form name="Sorting_options_cls_date" id="Sorting_options_cls_date" action="" method="get">
													<td width="14%"><strong>By Funding Close Date  :</strong> &nbsp;&nbsp;		
                                                    <select name="cls_date" id="cls_date" onchange="Sorting_options_cls_date.submit()">
                                                            <option value="-">Select</option>
                                                            <option value="new" <? if($_REQUEST['cls_date']=="new"){?> selected="selected"<? }?>>Newest to Oldest</option>
                                                            <option value="old" <? if($_REQUEST['cls_date']=="old"){?> selected="selected"<? }?>>Oldest to Newest</option>
                                                      </select>				
                                                     </td>
													 </form>
												</tr>
                                            </table>
                                            </td>
                                            </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td>
                                            <form name="Search_option" id="Search_option" action="" method="post">
                                            <table width="100%" cellpadding="1" cellspacing="1" border="0">
                                            <tr><td style="color:#FF0000;"><strong>Search Options :</strong></td></tr>
                                            
                                                <tr>
                                                    <td width="33%"><strong>Event Title :</strong>&nbsp;&nbsp;
                                                    <input type="text" name="evnt_title" id="evnt_title" value="<?=$_REQUEST['evnt_title']?>" />
                                                    </td>
                                                   <?php /*?> <td width="29%"><strong>Organizer's Username :</strong> &nbsp;&nbsp;
                                                      <input type="text" name="org_uname" value="<?=$_REQUEST['org_uname']?>" id="org_uname" /></td><?php */?>
                                                    <td width="31%"><strong> Organizer's Email Address :</strong>&nbsp;&nbsp;
                                                      <input type="text" name="org_email" id="org_email" value="<?=$_REQUEST['org_email'];?>" /></td>
                                                     
                                                </tr>
                                                
                                            </table>
                                            <table width="100%" cellpadding="1" cellspacing="1" border="0" style="padding-top:20px;">
                                                <tr>
                                                    <td width="29%"><strong>Organizer's Last Name :</strong>&nbsp;&nbsp;<br />
                                                    <input type="text" name="org_lname" id="org_lname" value="<?=$_REQUEST['org_lname']?>" />
                                                    </td>
                                                    <td width="29%"><strong>City :</strong> &nbsp;&nbsp;<br />
                                                      <input type="text" name="city" value="<?=$_REQUEST['city']?>" id="city" /></td>
                                                    <td width="29%"><strong>State :</strong>&nbsp;&nbsp;<br />
                                                      <input type="text" name="state" id="state" value="<?=$_REQUEST['state'];?>" /></td>
                                                      <td width="29%"><strong>Country :</strong>&nbsp;&nbsp;<br />
                                                      <input type="text" name="country" id="country" value="<?=$_REQUEST['country'];?>" /></td>
                                                    
                                                     
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr><td width="11%"><input type="submit" name="submit1" id="submit1" class="send_form" value="Search" /></td></tr>
                                                
                                                
                                            </table>
                                            </form>
                                            </td>
                                            </tr>
                                            <tr><td>&nbsp;</td></tr>
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
                                       </table></td>
  									 <td width="25%" valign="top" align="center">
                                      <table width="100%" border="0">
                                      <tr>
                                        <td style="font-size:20px; color:#3694DA" align="center">TOTAL EVENTS</td>
                                      </tr>
                                      <tr>
                                        <td align="center"><table width="100" border="0" height="50" bgcolor="#3694DA">
                                      <tr>
                                        <td style="color:#FFFFFF; font-size:26px; font-weight:bold" align="center" valign="middle">
                                            <?
                                               echo stripslashes(GetValue("events","count(*)",1,1)); 
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
						  <td align="left" valign="middle" class="title_wrapper_middle">Manage Events</td>
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
						<td class="arial_13_bold">Date Added</td>
								
								<td   class="arial_13_bold">Event Title</td>
								<td   class="arial_13_bold">Organizer</td>
								<td   class="arial_13_bold">Location</td>
								<td   class="arial_13_bold">Target Funding</td>
								<td   class="arial_13_bold">Currently Funded</td>
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
							  <td class="photo"> <strong> <? echo get_cplus_date(stripslashes($get->add_date)); ?></strong></td>
							  <td class="photo"> <strong> <? echo stripslashes($get->title); ?></strong></td>
					<td class="photo">
							<? 
							$field_result2=hb_get_result("select * from organizer where id =".$get->oid."");				
							
							$field_row2=mysql_fetch_array($field_result2);
									$field_value_list2=stripslashes($field_row2["lname"]);
									$field_value_list23=stripslashes($field_row2["fname"]);
								
							
							echo $field_value_list23." ".$field_value_list2;
							?>
							</td>
							  
							  <td class="photo"> <strong> <? echo stripslashes($get->loc_name); ?></strong></td>
							  <td class="photo"> <strong><?php if ($get->fund_amt > 0) {  echo "$".number_format(str_replace(",","",$get->fund_amt),2); } ?></strong></td>
							  <td class="photo"> <strong>$
							  <? 
                                $funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '".$get->id."'";
								$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
								$currently_funded_amount = mysql_result($funded_amount_result,0);
								echo number_format($currently_funded_amount,2);
							   ?>
							  </strong></td>
							<?php /*?><td align="center" class="photo"><input  size="3" type="textbox" name="disp<?=$count; ?>" value="<?=$get->display_order;?>" ></td><?php */?><td  align="center"nowrap class="photo" >				 
				  <input name="button" type="button" class="send_form" onClick="window.location.href='add_events.php?id=<?php echo ($get->id); ?>&mode=edit'" value=" EDIT ">
                    <input name="button2" type="button" class="send_form" onClick="deleteconfirm('Are you sure that you want to delete this event? \n','add_events.php?id=<?php echo($get->id); ?>&mode=delete');" value="DELETE">
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='view_event.php?id=<?php echo ($get->id); ?>'" value="VIEW EVENT DETAILS">			<br />
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='view_event.php?id=<?php echo ($get->id); ?>'" value="VIEW EVENT FUNDING">
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='view_attendee_list.php?event_att_id=<?php echo ($get->id); ?>'" value="VIEW ATTENDEE LISTS">
					<input name="button2" type="button" class="send_form_big" onClick="window.location.href='view_invitees.php?event_id=<?php echo ($get->id); ?>'" value="VIEW INVITEE LIST">
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
											<td align="center" width="20"><input type="button" name="button2" id="button2" value="ADD NEW" class="add_new" onclick="location.href='add_events.php?mode=add'" /></td>
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
								return confirm("Are you sure that you want to delete the selected event?");
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
