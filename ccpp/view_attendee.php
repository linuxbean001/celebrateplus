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
				$esdate= convert_us($row['esdate']);
				$estime= stripslashes($row['estime']);
				$eedate= convert_us($row['eedate']);
				$eetime= stripslashes($row['eetime']);
				$ecity= stripslashes($row['ecity']);
				$estate= stripslashes($row['estate']);
				$cdate= convert_us($row['cdate']);
				$tot_addendees= stripslashes($row['tot_addendees']);
				$comments= stripslashes($row['comments']);
				$funding= stripslashes($row['funding']);
				$commission_rate= stripslashes($row['commission_rate']);
				$gave_to_site= stripslashes($row['gave_to_site']);
				$gave_to_event_owner= stripslashes($row['gave_to_event_owner']);
				$how_mch= stripslashes($row['how_mch']);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */


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
	
	document.getElementById("div_events").innerHTML=xmlHttp.responseText;
	
	}
}

/*========= ajax for displyaing user data ==========================*/
function show_data(str)
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
					  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"View":"View"; ?>
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
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event Organizer :</td>
								  <td width="71%" class="f-c">
								  <a href="view_user.php?id=<?=$org_id?>" style="text-decoration:none;">
                                <?
									echo GetValue("organizer","fname","id",$org_id);
								?>&nbsp;
								<?
									echo GetValue("organizer","lname","id",$org_id);
								?>								
								</a></td>
							   </tr>
			 
							<tr>
								  <td width="29%" align="right" class="f-c">Event Attending :</td>
								  <td width="71%" class="f-c">
									<div id="div_events">
										<?=stripslashes(GetValue("events","title","id",$event_id))?>								
									</div>								</td>
							   </tr>
			 
							<tr>
								  <td width="29%" align="right" class="f-c">Attendee :</td>
								  <td width="71%" class="f-c">
								  <a href="view_user.php?id=<?=$org_id?>" style="text-decoration:none;">
								  <?
								  	echo GetValue("organizer","fname","id",$user_id)."&nbsp;".GetValue("organizer","lname","id",$user_id)
								  ?>							</a>	</td>
							   </tr>
							  <tr>
							  	<td colspan="2">
									
			 								</td></tr>
					<tr>
							  	<td colspan="2">
									
			 			<div id="div_event_data">
						<table width="100%" cellpadding="3" cellspacing="3">
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Date :</td>
								  <td width="71%" class="f-c"><?=$esdate; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Time :</td>
								  <td width="71%" class="f-c"><?=$estime; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Date :</td>
								  <td width="71%" class="f-c"><?=$eedate; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Time :</td>
								  <td width="71%" class="f-c"><?=$eetime; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event City :</td>
								  <td width="71%" class="f-c"><?=$ecity; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event State :</td>
								  <td width="71%" class="f-c"><?=$estate; ?></td>
							</tr>
					</table>
					</div>					</td>
					</tr>
							  <tr>
								  <td width="29%" align="right" class="f-c">Confirmation Date  :</td>
								  <td width="71%" class="f-c"><?=$cdate; ?></td>
							 </tr>
			   
							<tr>
								  <td width="29%" align="right" class="f-c">Total Attendees :</td>
								  <td width="71%" class="f-c"><?=$tot_addendees; ?></td>
							</tr>
				
							<tr>
							  <td width="29%" align="right" class="f-c">Confirmation Comments :</td>
							  <td width="71%" class="f-c"><?=$comments?></td>
							</tr>
			   
							<tr>
							  <td width="29%" align="right" class="f-c">Funding  :</td>
							  <td width="71%" class="f-c">
									 
										  <? if($how_mch > 0){ echo 'Yes'; } ?>
										  <? if($how_mch <= 0){ echo 'No'; } ?>							</td>
						  </tr>
						  <tr>
							  <td width="29%" align="right" class="f-c" valign="top">How Much :</td>
							  <td width="71%" class="f-c"><?=$how_mch;?>
</td>
							</tr>
							<tr>
							  <td width="29%" align="right" class="f-c" valign="top">Commission :</td>
							  <td width="71%" class="f-c">$<?=$gave_to_site;?></td>
							</tr>
							<tr>
							  <td width="29%" align="right" class="f-c" valign="top">Event Donation :</td>
							  <td width="71%" class="f-c">$<?=$gave_to_event_owner;?></td>
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
					alert("Please Select Event Organizer.");
					document.getElementById("org_id").focus();
					return false;
				}
				
				
				/* -------------- Event Attending Validation --------------------- */
				if(document.getElementById("event_id").value.split(" ").join("") == "" || document.getElementById("event_id").value.split(" ").join("") == "0" || document.getElementById("event_id").value.split(" ").join("") == "-")
				{
					alert("Please Select Event Attending.");
					document.getElementById("event_id").focus();
					return false;
				}
				
				
				/* -------------- User's Account Validation --------------------- */
				if(document.getElementById("user_id").value.split(" ").join("") == "" || document.getElementById("user_id").value.split(" ").join("") == "0" || document.getElementById("user_id").value.split(" ").join("") == "-")
				{
					alert("Please Select User's Account.");
					document.getElementById("user_id").focus();
					return false;
				}
				
				
			/* -------------- Confirmation Date  Validation --------------------- */
			if(document.getElementById("cdate").value.split(" ").join("") == "" || document.getElementById("cdate").value.split(" ").join("") == "0")
			{
				alert("Please enter Confirmation Date .");
				document.getElementById("cdate").focus();
				return false;
			}
			
			
			/* -------------- Total Attendees Validation --------------------- */
			if(document.getElementById("tot_addendees").value.split(" ").join("") == "" || document.getElementById("tot_addendees").value.split(" ").join("") == "0")
			{
				alert("Please enter Total Attendees.");
				document.getElementById("tot_addendees").focus();
				return false;
			}
			
			
				/* -------------- Funding  Validation --------------------- */
				if(document.getElementById("funding").value.split(" ").join("") == "" || document.getElementById("funding").value.split(" ").join("") == "0" || document.getElementById("funding").value.split(" ").join("") == "-")
				{
					alert("Please Select Funding .");
					document.getElementById("funding").focus();
					return false;
				}
				
				
}
</script>
</body>
</html>