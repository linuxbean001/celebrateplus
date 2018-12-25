<?									
include("connect.php");

$LeftLinkSection = 1;
$pagetitle="Attendee";

/* ---------------------- Declare Fields ---------------------- */

$etitle= "";
$org_id= "";
$event_id= "";
$user_id= "";
$ufname= "";
$ulname= "";
$uemail= "";
$esdate= "";
$estime= "";
$eedate= "";
$eetime= "";
$ecity= "";
$estate= "";
$cdate= "";
$tot_addendees= "";
$comments= "";
$funding= "";

/* ---------------------- Initialize Fields ---------------------- */

if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
	$id = $_REQUEST["id"];											
	$fetchquery = "select * from attendee where id=".$id;
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				$etitle= stripslashes($row['etitle']);
				$org_id= stripslashes($row['org_id']);
				$event_id= stripslashes($row['event_id']);
				$user_id= stripslashes($row['user_id']);
				$ufname= stripslashes($row['ufname']);
				$ulname= stripslashes($row['ulname']);
				$uemail= stripslashes($row['uemail']);
				$etitle= stripslashes($row['etitle']);
				$esdate= convert_us(stripslashes($row['esdate']));
				$estime= stripslashes($row['estime']);
				$eedate= convert_us(stripslashes($row['eedate']));
				$eetime= stripslashes($row['eetime']);
				$ecity= stripslashes($row['ecity']);
				$estate= stripslashes($row['estate']);
				$cdate= get_cplus_date(stripslashes($row['cdate']));
				$tot_addendees= stripslashes($row['tot_addendees']);
				$comments= stripslashes($row['comments']);
				$funding= stripslashes($row['funding']);
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

if(isset($_REQUEST['Submit']))
{
		$etitle= addslashes($_REQUEST['etitle']);
		$org_id= addslashes($_REQUEST['org_id']);
		$event_id= addslashes($_REQUEST['event_id']);
		$user_id= addslashes($_REQUEST['user_id']);
		$ufname= addslashes($_REQUEST['ufname']);
		$ulname= addslashes($_REQUEST['ulname']);
		$uemail= addslashes($_REQUEST['uemail']);
		$etitle= addslashes($_REQUEST['etitle']);
		$esdate= convert_db(addslashes($_REQUEST['esdate'])); 
		$estime= addslashes($_REQUEST['estime']);
		$eedate= convert_db(addslashes($_REQUEST['eedate']));
		$eetime= addslashes($_REQUEST['eetime']);
		$ecity= addslashes($_REQUEST['ecity']);
		$estate= addslashes($_REQUEST['estate']);
		$cdate= addslashes(get_database_date($_REQUEST['cdate']));
		$tot_addendees= addslashes($_REQUEST['tot_addendees']);
		$comments= addslashes($_REQUEST['comments']);
		$funding= addslashes($_REQUEST['funding']);
		
		$event_max_cap = GetValue("events","max_cap","id",$event_id);
			if(isset($_REQUEST['mode']))
		{
			switch($_REQUEST['mode'])
			{
				case 'add' :
					
					
					
					$query = "insert into attendee 
					set display_order='$display_order',etitle='$etitle',org_id='$org_id',event_id='$event_id',user_id='$user_id',ufname='$ufname',ulname='$ulname',uemail='$uemail',esdate='$esdate',estime='$estime',eedate='$eedate',eetime='$eetime',ecity='$ecity',estate='$estate',cdate='$cdate',tot_addendees='$tot_addendees',comments='$comments',funding='$funding'"; 
					hb_get_result($query) or die(mysql_error());
				if($event_max_cap !="")
				{
					hb_get_result("update events set 	space_available = space_available-$tot_addendees where id=$event_id");
				}
					location("manage_attendee.php?msg=1");
				break;
				
				case 'edit' :
					
					$query = "update attendee set etitle='$etitle',org_id='$org_id',event_id='$event_id',user_id='$user_id',ufname='$ufname',ulname='$ulname',uemail='$uemail',esdate='$esdate',estime='$estime',eedate='$eedate',eetime='$eetime',ecity='$ecity',estate='$estate',cdate='$cdate',tot_addendees='$tot_addendees',comments='$comments',funding='$funding'"; 
					$query.=" where id=".$_REQUEST['id']; 
					hb_get_result($query) or die(mysql_error());
					if($event_max_cap !="")
					{
						hb_get_result("update events set 	space_available = space_available-$tot_addendees where id=$event_id");
					}
					location("manage_attendee.php?msg=2");
				break;
				
			}	
		}
		
}	
if(isset($_REQUEST['mode']))
{
	switch($_REQUEST['mode'])
	{
		case 'delete' :
$query = "delete from attendee where id=".$_REQUEST['id'];     
			hb_get_result($query) or die(mysql_error());
			location("manage_attendee.php?msg=3");
		break;
	}	
}	

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
		alert("Enter client");
		document.addprod.name.select();
		return false;
	}
}
</script>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script language="JavaScript" type="text/javascript">
var xmlHttp
function top_GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
	{
	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
  catch (e)
	{
	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
  }
return xmlHttp;
}

function sam_GetSelectedItem(field_id)
{
var tmp=document.getElementById(field_id);
var len = tmp.length
var i = 0
var chosen = ","

for (i = 0; i < len; i++) {
if (tmp[i].selected) {
chosen = chosen +  tmp[i].value + ","
} 
}

return chosen
}
	
function show_combo1(str)
{ 
	//alert(str);
	xmlHttp=top_GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }		   
	var url="ajax_get_events964.php";
	url=url+"?search_id="+str+"&simple_multi=0";
	
	xmlHttp.onreadystatechange=top_stateChanged1;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function top_stateChanged1() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	//tmp_txthint="txtHint1";
	//alert(xmlHttp.responseText);
	document.getElementById("div_events").innerHTML=xmlHttp.responseText;
	
	}
}

/*========= ajax for displyaing user data ==========================*/
function show_data12(str)
{ 

	
	xmlHttp=top_GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }		   
	var url="ajax_get_user_data.php";
	url=url+"?user_id="+str;
	
	xmlHttp.onreadystatechange=top_stateChanged2;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function top_stateChanged2() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	//tmp_txthint="txtHint1";
	
	document.getElementById("div_user_data").innerHTML=xmlHttp.responseText;
	
	}
}
/*=================ajax for displaying events data*/
function show_event_data123(str)
{ 
	
	xmlHttp=top_GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }		   
	var url="ajax_get_event_data.php";
	url=url+"?event_id="+str;
	
	xmlHttp.onreadystatechange=top_stateChanged3;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
function top_stateChanged3() 
{ 
	if (xmlHttp.readyState==4)
	{ 
	//tmp_txthint="txtHint1";
	
	document.getElementById("div_event_data").innerHTML=xmlHttp.responseText;
	
	}
}

</script></head>

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
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
			 	<tr>
				<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
					  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"Edit":"Add"; ?>
										Attendee</td>
					  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
					</tr>
				</table></td>
			  </tr>
			  <tr>
				<td align="left" valign="top" class="middle_right_bg">
					<TABLE  cellSpacing=0 cellPadding=0  border=0 width="95%" align="center">									
					<tr>
					  <td class="a-l" ><span style="color:#CC6600;">
						<?php 
								$msg = $_REQUEST['msg'];
								if($msg == 1)
									echo "<span style='color:#CC6600;'>Attendee Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>Attendee Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>Attendee Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>Attendee with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
						</span></td>
					</tr>
					<TR>
					  <TD>
							<form action="add_attendee.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
							<input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
							<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
							<tr>
							<td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
							</tr> 
							<?php /*?><tr>
								  <td width="29%" align="right" class="f-c">Event Title :</td>
								  <td width="71%" class="f-c"><input  name="etitle" type="text" id="etitle" value="<?=$etitle; ?>" /></td>
							</tr><?php */?>
				
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Event Organizer :</td>
								  <td width="71%" class="f-c">
								  <select name="org_id" id="org_id" onchange="show_combo1(this.value)">
								  <option value="-" <? if($org_id == '-'){ ?>selected="selected"<? } ?>>Please Select</option>
								  <? $tmp_cmb_array2 = split(",",$org_id); ?>
								  <?										
											$add_result2 = hb_get_result("select * from organizer");			
											while($add_row2 = mysql_fetch_array($add_result2))
											{	
											?>
											<option value="<?=$add_row2['id']?>" <? if($org_id!="" && in_array($add_row2['id'],$tmp_cmb_array2)){ echo 'selected="selected"'; } ?>><?=$add_row2['fname']?>&nbsp;<?=$add_row2['lname']?> </option>
											<?
											}										
											?> </select>
								 
								</td>
							   </tr>
			 
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Event Attending :</td>
								  <td width="71%" class="f-c">
									<div id="div_events">
									<select name="event_id" id="event_id" onchange="show_event_data123(this.value)" >
										<option value="">Please Select</option>
										<?	
																
										$add_result = hb_get_result("select * from events where oid=$org_id and deleted != 1");
										while($add_row = mysql_fetch_array($add_result))
										{	
										?>
										<option value="<?=$add_row['id']?>" <? if($event_id!="" && $add_row['id']==$event_id){ echo 'selected="selected"'; } ?>><?=$add_row['title']?></option>
										
										<?
										}										
										?> 
										</select>
								
									</div> 
								</td>
							   </tr>
			 
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Attendee :</td>
								  <td width="71%" class="f-c">
								  <select name="user_id" id="user_id" >
								  <option value="-" <? if($user_id == '-'){ ?>selected="selected"<? } ?>>Please Select</option>
								  
								  <?										
											$add_result4 = hb_get_result("select * from organizer") ;			
											while($add_row4 = mysql_fetch_array($add_result4))
											{	
											?>
											<option value="<?=$add_row4['id']?>" <? if($user_id!="" && $add_row4['id']==$user_id){ echo 'selected="selected"'; } ?>><?=$add_row4['fname']?>&nbsp;<?=$add_row4['lname']?></option>
											<?
											}										
											?> </select>
								 
								</td>
							   </tr>
							  <tr>
							  	<td colspan="2">
									
			 			<?php /*?><div id="div_user_data">
						<table width="100%" cellpadding="3" cellspacing="3">
							<tr>
								  <td width="29%" align="right" class="f-c">User's First Name :</td>
								  <td width="71%" class="f-c"><input  name="ufname" type="text" id="ufname" readonly="readonly" value="<?=$ufname; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">User's Last Name :</td>
								  <td width="71%" class="f-c"><input  name="ulname" type="text" id="ulname" readonly="readonly" value="<?=$ulname; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">User's Email Address :</td>
								  <td width="71%" class="f-c"><input  name="uemail" type="text" id="uemail" readonly="readonly" value="<?=$uemail; ?>" /></td>
							</tr>
							</table>
					</div><?php */?>
					</td></tr>
					<tr>
							  	<td colspan="2">
									
			 			<div id="div_event_data">
						<table width="100%" cellpadding="3" cellspacing="3">
						
							<tr>
								  <td width="29%" align="right" class="f-c">Event Title :</td>
								  <td width="71%" class="f-c"><input  name="etitle" type="text" readonly="readonly" id="etitle" value="<?=$etitle; ?>" /></td>
							</tr>
							
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Date :</td>
								  <td width="71%" class="f-c"><input  name="esdate" type="text" readonly="readonly" id="esdate" value="<?=$esdate; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Time :</td>
								  <td width="71%" class="f-c"><input  name="estime" type="text" readonly="readonly" id="estime" value="<?=$estime; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Date :</td>
								  <td width="71%" class="f-c"><input  name="eedate" type="text" readonly="readonly" id="eedate" value="<?=$eedate; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Time :</td>
								  <td width="71%" class="f-c"><input  name="eetime" type="text" readonly="readonly" id="eetime" value="<?=$eetime; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event City :</td>
								  <td width="71%" class="f-c"><input  name="ecity" type="text" readonly="readonly" id="ecity" value="<?=$ecity; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event State :</td>
								  <td width="71%" class="f-c"><input  name="estate" type="text" readonly="readonly" id="estate" value="<?=$estate; ?>" /></td>
							</tr>
					</table>
					</div>
					</td>
					</tr>
							  <tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Confirmation Date  :</td>
								  <td width="71%" class="f-c"><input  name="cdate" type="text" id="cdate" value="<?=$cdate; ?>" size="35" maxlength="50" readonly="true">&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.frm.cdate,'mm/dd/yyyy',this)" /></td>
							 </tr>
			   
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Total Attendees :</td>
								  <td width="71%" class="f-c"><input  name="tot_addendees" type="text" id="tot_addendees" value="<?=$tot_addendees; ?>" /></td>
							</tr>
				
							<tr>
							  <td width="29%" align="right" class="f-c">Confirmation Comments :</td>
							  <td width="71%" class="f-c"><textarea name="comments" id="comments" cols="50" rows="7"><?=$comments?></textarea></td>
							</tr>
			   
							<tr>
							  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Funding  :</td>
							  <td width="71%" class="f-c">
									 <select name="funding" id="funding">
										  <option value="-" <? if($funding == '-'){ ?>selected="selected"<? } ?>>Please Select</option>
										  <option value="Yes" <? if($funding!="" and $funding=="Yes"){ echo 'selected="selected"'; } ?>>Yes</option>
										  <option value="No" <? if($funding!="" and $funding=="No"){ echo 'selected="selected"'; } ?>>No</option>
									 </select>
							</td>
						  </tr>
			  
						<tr>
						  <td>&nbsp;
							<input type="hidden" value="<?=$_GET["id"]; ?>" name="id"></td>
						  <td><?php if($_REQUEST['mode'] == 'add') { ?>
							<input name="Submit" type="submit" value="Add" class="send_form"  />
							<?php } else { ?>
							<input name="Submit" type="submit" value="Edit" class="send_form" /></td>
						  <?php } ?>
						</tr>
					</table>
				</form>
			</TD>
			</TR>
		 </TABLE>
		</td>
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
<script language="javascript">
function keshav_check()
{
				/* -------------- Event Organizer Validation --------------------- */
				if(document.getElementById("org_id").value.split(" ").join("") == "" || document.getElementById("org_id").value.split(" ").join("") == "0" || document.getElementById("org_id").value.split(" ").join("") == "-")
				{
					alert("Please select an event organizer.");
					document.getElementById("org_id").focus();
					return false;
				}
				
				
				/* -------------- Event Attending Validation --------------------- */
				if(document.getElementById("event_id").value.split(" ").join("") == "" || document.getElementById("event_id").value.split(" ").join("") == "0" || document.getElementById("event_id").value.split(" ").join("") == "-")
				{
					alert("Please select an event.");
					document.getElementById("event_id").focus();
					return false;
				}
				
				
				/* -------------- User's Account Validation --------------------- */
				if(document.getElementById("user_id").value.split(" ").join("") == "" || document.getElementById("user_id").value.split(" ").join("") == "0" || document.getElementById("user_id").value.split(" ").join("") == "-")
				{
					alert("Please select an attendee.");
					document.getElementById("user_id").focus();
					return false;
				}
				
				
			/* -------------- Confirmation Date  Validation --------------------- */
			if(document.getElementById("cdate").value.split(" ").join("") == "" || document.getElementById("cdate").value.split(" ").join("") == "0")
			{
				alert("Please enter a confirmation date.");
				document.getElementById("cdate").focus();
				return false;
			}
			
			
			/* -------------- Total Attendees Validation --------------------- */
			if(document.getElementById("tot_addendees").value.split(" ").join("") == "" || document.getElementById("tot_addendees").value.split(" ").join("") == "0")
			{
				alert("Please enter the total number of attendees.");
				document.getElementById("tot_addendees").focus();
				return false;
			}
			
			
				/* -------------- Funding  Validation --------------------- */
				if(document.getElementById("funding").value.split(" ").join("") == "" || document.getElementById("funding").value.split(" ").join("") == "0" || document.getElementById("funding").value.split(" ").join("") == "-")
				{
					alert("Please select a funding option.");
					document.getElementById("funding").focus();
					return false;
				}
				
				
}
</script>
</body>
</html>