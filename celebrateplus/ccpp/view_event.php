<?									
include("connect.php");

$LeftLinkSection = 1;
$pagetitle="Event";

/* ---------------------- Declare Fields ---------------------- */

$oid= "";
$add_date= "";
$title= "";
$stime= "";
$edate= "";
$etime= "";
$max_cap= "";
$summary= "";
$description= "";
$loc_name= "";
$loc_street= "";
$loc_suite= "";
$loc_city= "";
$loc_state= "";
$loc_zip= "";
$loc_country= "";
$fund_amt= "";
$current_fund= "";
$fund_end_date= "";
$payment= "";

/* ---------------------- Initialize Fields ---------------------- */

if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
	$id = $_REQUEST["id"];											
	$fetchquery = "select * from events where id=".$id;
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				$oid= stripslashes($row['oid']);
				$add_date= stripslashes($row['add_date']);
				$title= stripslashes($row['title']);
				$sdate= stripslashes($row['sdate']);
				$stime= stripslashes($row['stime']);
				$edate= stripslashes($row['edate']);
				$etime= stripslashes($row['etime']);
				$max_cap= stripslashes($row['max_cap']);
				$space_available= stripslashes($row['space_available']);
				$summary= stripslashes($row['summary']);
				$description= stripslashes($row['description']);
				$loc_name= stripslashes($row['loc_name']);
				$loc_street= stripslashes($row['loc_street']);
				$loc_suite= stripslashes($row['loc_suite']);
				$loc_city= stripslashes($row['loc_city']);
				$loc_state= stripslashes($row['loc_state']);
				$loc_zip= stripslashes($row['loc_zip']);
				$loc_country= stripslashes($row['loc_country']);
				$fund_amt= stripslashes($row['fund_amt']);
				$current_fund= stripslashes($row['current_fund']);
				$fund_end_date= stripslashes($row['fund_end_date']);
				$payment= stripslashes($row['payment']);
				
				$currently_funded_amount = 0;
				$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '$id'";
				$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
				$currently_funded_amount = mysql_result($funded_amount_result,0);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

if(isset($_REQUEST['Submit']))
{
		$oid= addslashes($_REQUEST['oid']);
		$add_date= addslashes($_REQUEST['add_date']);
		$title= addslashes($_REQUEST['title']);
		$sdate= addslashes($_REQUEST['sdate']);
		$stime= addslashes($_REQUEST['stime']);
		$edate= addslashes($_REQUEST['edate']);
		$etime= addslashes($_REQUEST['etime']);
		$max_cap= addslashes($_REQUEST['max_cap']);
		$space_available= addslashes($_REQUEST['space_available']);
		$summary= addslashes($_REQUEST['summary']);
		$description= addslashes($_REQUEST['description']);
		$loc_name= addslashes($_REQUEST['loc_name']);
		$loc_street= addslashes($_REQUEST['loc_street']);
		$loc_suite= addslashes($_REQUEST['loc_suite']);
		$loc_city= addslashes($_REQUEST['loc_city']);
		$loc_state= addslashes($_REQUEST['loc_state']);
		$loc_zip= addslashes($_REQUEST['loc_zip']);
		$loc_country= addslashes($_REQUEST['loc_country']);
		$fund_amt= addslashes($_REQUEST['fund_amt']);
		$current_fund= addslashes($_REQUEST['current_fund']);
		$fund_end_date= addslashes($_REQUEST['fund_end_date']);
		$payment= addslashes($_REQUEST['payment']);
			if(isset($_REQUEST['mode']))
		{
			switch($_REQUEST['mode'])
			{
				case 'add' :
					if(GTG_is_dup_add('events','title',$title))
					{
						unset($_REQUEST['Submit']);	
						location("add_events.php?mode=add&msg=4");
						return;
					}
					
					$display_order=sam_get_display_order("events","");
					
					$query = "insert into events 
					set display_order='$display_order',oid='$oid',add_date='$add_date',title='$title',sdate='$sdate',,stime='$stime',edate='$edate',etime='$etime',max_cap='$max_cap',summary='$summary',description='$description',loc_name='$loc_name',loc_street='$loc_street',loc_suite='$loc_suite',loc_city='$loc_city',loc_state='$loc_state',loc_zip='$loc_zip',loc_country='$loc_country',fund_amt='$fund_amt',current_fund='$current_fund',fund_end_date='$fund_end_date',payment='$payment'"; 
					hb_get_result($query) or die(mysql_error());
					location("manage_events.php?msg=1");
				break;
				
				case 'edit' :
					if(GTG_is_dup_edit('events','title',$title,$_REQUEST['id']))
					{
						unset($_REQUEST['Submit']);	
						location("add_events.php?mode=edit&id=".$_REQUEST['id']."&msg=4");	
						return;
					}
					$query = "update events set oid='$oid',add_date='$add_date',title='$title',sdate='$sdate',stime='$stime',edate='$edate',etime='$etime',max_cap='$max_cap',summary='$summary',description='$description',loc_name='$loc_name',loc_street='$loc_street',loc_suite='$loc_suite',loc_city='$loc_city',loc_state='$loc_state',loc_zip='$loc_zip',loc_country='$loc_country',fund_amt='$fund_amt',current_fund='$current_fund',fund_end_date='$fund_end_date',payment='$payment'"; 
					$query.=" where id=".$_REQUEST['id'];
					hb_get_result($query) or die(mysql_error());
					location("manage_events.php?msg=2");
				break;
				
			}	
		}
		
}	
if(isset($_REQUEST['mode']))
{
	switch($_REQUEST['mode'])
	{
		case 'delete' :
$query = "delete from events where id=".$_REQUEST['id'];     
			hb_get_result($query) or die(mysql_error());
			location("manage_events.php?msg=3");
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
										Event</td>
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
									echo "<span style='color:#CC6600;'>Event Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>Event Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>Event Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>Event with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
						</span></td>
					</tr>
					<TR>
					  <TD>
							<form action="add_events.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
							<input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
							<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
							<tr>
							<td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
							</tr> 
								 <tr>
								  <td  align="right" class="menu-a"><span class="a-l"><strong>Basic Event Information :</strong></span></td>
								  <td>&nbsp;</td>
								</tr>
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Assign to Organizer :</td>
								  <td width="71%" class="f-c">
								  	<? echo GetValue("organizer","fname","id",$oid);?>&nbsp;<? echo GetValue("organizer","lname","id",$oid);?>								</td>
							   </tr>
			 
							  <tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Creation Date :</td>
								  <td width="71%" class="f-c"><?=convert_us($add_date); ?></td>
							 </tr>
			   
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Event Title :</td>
								  <td width="71%" class="f-c"><?=$title; ?></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Date :</td>
								  <td width="71%" class="f-c"><?=convert_us($sdate); ?></td>
							 </tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Time :</td>
								  <td width="71%" class="f-c"><?=$stime; ?></td>
							</tr>
				
							  <tr>
								  <td width="29%" align="right" class="f-c">Event End Date :</td>
								  <td width="71%" class="f-c"><?=convert_us($edate); ?></td>
							 </tr>
			   
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Time :</td>
								  <td width="71%" class="f-c"><?=$etime; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Maximum Capacity :</td>
								  <td width="71%" class="f-c"><?=$max_cap; ?></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Space Left :</td>
								  <td width="71%" class="f-c"><?=$space_available; ?></td>
							</tr>
							<tr>
							  <td width="29%" align="right" class="f-c">Event Summary :</td>
							  <td width="71%" class="f-c"> <?php echo $summary;?>							   </td>
							</tr>
			   
							<tr>
							  <td width="29%" align="right" class="f-c">Event Description :</td>
							  <td width="71%" class="f-c"> <?php echo $description;?>							   </td>
							</tr>
			   				<tr>
								  <td  align="right" class="menu-a"><span class="a-l"><strong>Event Location :</strong></span></td>
								  <td>&nbsp;</td>
								</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Location Name :</td>
								  <td width="71%" class="f-c"><?=$loc_name; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Street Address :</td>
								  <td width="71%" class="f-c"><?=$loc_street; ?></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Suite / Apt #  :</td>
								  <td width="71%" class="f-c"><?=$loc_suite; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>City :</td>
								  <td width="71%" class="f-c"><?=$loc_city; ?></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>State / Province  :</td>
								  <td width="71%" class="f-c"><?=$loc_state; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Zip / Postal Code :</td>
								  <td width="71%" class="f-c"><?=$loc_zip; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Country :</td>
								  <td width="71%" class="f-c"><?=$loc_country; ?></td>
							</tr>
							<tr>
								  <td  align="right" class="menu-a"><span class="a-l"><strong>Funding Details :</strong></span></td>
								  <td>&nbsp;</td>
								</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Target Funding Amount :</td>
								  <td width="71%" class="f-c"><?=$fund_amt; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Currently Funded Amount :</td>
								  <td width="71%" class="f-c"><?=$currently_funded_amount;?></td>
							</tr>
				
							  <tr>
								  <td width="29%" align="right" class="f-c">Funding Close Date :</td>
								  <td width="71%" class="f-c"><?=convert_us($fund_end_date); ?></td>
							 </tr>
			   
							<tr>
										  <td width="29%" align="right" class="f-c">Payment Method Selected :</td>
										  <td width="71%" class="f-c"><?=$payment;?></td>
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
				/* -------------- Assign to Organizer Validation --------------------- */
				if(document.getElementById("oid").value.split(" ").join("") == "" || document.getElementById("oid").value.split(" ").join("") == "0" || document.getElementById("oid").value.split(" ").join("") == "-")
				{
					alert("Please Select Assign to Organizer.");
					document.getElementById("oid").focus();
					return false;
				}
				
				
			/* -------------- Creation Date Validation --------------------- */
			if(document.getElementById("add_date").value.split(" ").join("") == "" || document.getElementById("add_date").value.split(" ").join("") == "0")
			{
				alert("Please enter Creation Date.");
				document.getElementById("add_date").focus();
				return false;
			}
			
			
			/* -------------- Event Title Validation --------------------- */
			if(document.getElementById("title").value.split(" ").join("") == "" || document.getElementById("title").value.split(" ").join("") == "0")
			{
				alert("Please enter Event Title.");
				document.getElementById("title").focus();
				return false;
			}
			if(document.getElementById("title").value.split(" ").join("") == "" || document.getElementById("title").value.split(" ").join("") == "0")
			{
				alert("Please enter Event Title.");
				document.getElementById("title").focus();
				return false;
			}
			if(document.getElementById("loc_city").value.split(" ").join("") == "" || document.getElementById("loc_city").value.split(" ").join("") == "0")
			{
				alert("Please enter city.");
				document.getElementById("loc_city").focus();
				return false;
			}
			if(document.getElementById("loc_state").value.split(" ").join("") == "" || document.getElementById("loc_state").value.split(" ").join("") == "0")
			{
				alert("Please enter State.");
				document.getElementById("loc_state").focus();
				return false;
			}
			
			
}
</script>
</body>
</html>