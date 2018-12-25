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
				$add_date= get_cplus_date(stripslashes($row['add_date']));
				$title= stripslashes($row['title']);
				$sdate= get_cplus_date(stripslashes($row['sdate']));
				$stime= stripslashes($row['stime']);
				$edate= get_cplus_date(stripslashes($row['edate']));
				$etime= stripslashes($row['etime']);
				$max_cap= stripslashes($row['max_cap']);
				$summary= stripslashes($row['summary']);
				$description= stripslashes($row['description']);
				$loc_name= stripslashes(str_replace("\\","",$row['loc_name']));
				$loc_street= stripslashes($row['loc_street']);
				$loc_suite= stripslashes($row['loc_suite']);
				$loc_city= stripslashes($row['loc_city']);
				$loc_state= stripslashes($row['loc_state']);
				$loc_zip= stripslashes($row['loc_zip']);
				$loc_country= stripslashes($row['loc_country']);
				$fund_amt= stripslashes($row['fund_amt']);
				$current_fund= stripslashes($row['current_fund']);
				$fund_end_date= get_cplus_date(stripslashes($row['fund_end_date']));
				$payment= stripslashes($row['payment']);
				$max_don_amt= stripslashes($row['max_don_amt']);
				$donate_to_attend = stripslashes($row['donate_to_attend']);
				$searchable = stripslashes($row['searchable']);
				$display_fund = stripslashes($row['display_fund']);
				$space_available = stripslashes($row['space_available']);
				$image_path = stripslashes($row['image_path']);
				$define_donation_levels = stripslashes($row['define_donation_levels']);
				$df_friends = $row['df_friends'];
				$df_bronze = $row['df_bronze'];
				$df_silver = $row['df_silver'];
				$df_gold = $row['df_gold'];
				$df_platinum = $row['df_platinum'];
				$df_benefactor = $row['df_benefactor'];
				
				
				$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '$id'";
$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
$currently_funded_amount = mysql_result($funded_amount_result,0);
$currently_funded_amount = number_format($currently_funded_amount,2);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

if(isset($_REQUEST['Submit']))
{
		$oid= addslashes($_REQUEST['oid']);
		$add_date= addslashes(get_database_date($_REQUEST['add_date']));
		$title= addslashes($_REQUEST['title']);
		$sdate= addslashes(get_database_date($_REQUEST['sdate']));
		$stime= addslashes($_REQUEST['stime']);
		$edate= addslashes(get_database_date($_REQUEST['edate']));
		$etime= addslashes($_REQUEST['etime']);
		$max_cap= addslashes($_REQUEST['max_cap']);
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
		$fund_end_date= addslashes(get_database_date($_REQUEST['fund_end_date']));
		$payment= addslashes($_REQUEST['payment']); 
		$max_don_amt= addslashes($_REQUEST['max_don_amt']);
		$donate_to_attend= addslashes($_REQUEST['donate_to_attend']);
		$searchable= addslashes($_REQUEST['searchable']);
		$display_fund= addslashes($_REQUEST['display_fund']);
		$define_donation_levels= addslashes($_REQUEST['define_donation_levels']);
		
		$df_friends= addslashes($_REQUEST['df_friends']);
		$df_bronze= addslashes($_REQUEST['df_bronze']);
		$df_silver= addslashes($_REQUEST['df_silver']);
		$df_gold= addslashes($_REQUEST['df_gold']);
		$df_platinum= addslashes($_REQUEST['df_platinum']);
		$df_benefactor= addslashes($_REQUEST['df_benefactor']);
		
		$tot_addendees_qry = hb_get_result("select sum(tot_addendees) from attendee where  event_id=".$_REQUEST['id']);
		$total_attendees = mysql_result($tot_addendees_qry,0);
		$space_available = $max_cap - $total_attendees; 
		
		
		$image_path="";
		
    	if ($_FILES["image_path"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["full"]["error"] . "<br />";
		}
		else
		{
		   
		   $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
		   move_uploaded_file($_FILES["image_path"]["tmp_name"],"../event_images/".$image_path);
		}
		
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
					set 
					display_order='$display_order',
					oid='$oid',
					add_date='$add_date',
					title='$title',
					sdate='$sdate',
					stime='$stime',
					edate='$edate',
					etime='$etime',
					max_cap='$max_cap',
					summary='$summary',
					description='$description',
					loc_name='$loc_name',
					loc_street='$loc_street',
					loc_suite='$loc_suite',
					loc_city='$loc_city',
					loc_state='$loc_state',
					loc_zip='$loc_zip',
					loc_country='$loc_country',
					fund_amt='$fund_amt',
					current_fund='$current_fund',
					fund_end_date='$fund_end_date',
					payment='$payment',
					max_don_amt='$max_don_amt',
					donate_to_attend='$donate_to_attend',
					display_fund='$display_fund',
					searchable='$searchable',
					space_available='$space_available',
					define_donation_levels='$define_donation_levels',
					df_friends='$df_friends',
					df_bronze='$df_bronze',
					df_silver='$df_silver',
					df_gold='$df_gold',
					df_platinum='$df_platinum',
					df_benefactor='$df_benefactor',
					image_path='$image_path'"; 
					hb_get_result($query) or die(mysql_error());
					location("manage_events.php?msg=1");
				break;
				
				case 'edit' :
					
					$query = "update events
					set 
					oid='$oid',
					add_date='$add_date',
					title='$title',
					sdate='$sdate',
					stime='$stime',
					edate='$edate',
					etime='$etime',
					max_cap='$max_cap',
					summary='$summary',
					description='$description',
					loc_name='$loc_name',
					loc_street='$loc_street',
					loc_suite='$loc_suite',
					loc_city='$loc_city',
					loc_state='$loc_state',
					loc_zip='$loc_zip',
					loc_country='$loc_country',
					fund_amt='$fund_amt',
					current_fund='$current_fund',
					fund_end_date='$fund_end_date',
					payment='$payment',
					max_don_amt='$max_don_amt',
					donate_to_attend='$donate_to_attend',
					display_fund='$display_fund',
					searchable='$searchable',
					define_donation_levels='$define_donation_levels',
					df_friends='$df_friends',
					df_bronze='$df_bronze',
					df_silver='$df_silver',
					df_gold='$df_gold',
					df_platinum='$df_platinum',
					df_benefactor='$df_benefactor',
					space_available='$space_available'";
					
					if($image_path!="")
					{
						deleteimage(checkNum($_REQUEST['id']));
						$query.=" , image_path='".$image_path."'";
					} 
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
function deleteimage($iid)
	{
		$dquery = "select image_path from events where id=".$iid;
		$dresult = hb_get_result($dquery);
		while($drow = mysql_fetch_array($dresult))
		{
			$dfile = $drow['image_path'];
			if($dfile != "")
			{
				if(file_exists("../event_images/".$dfile.""))
				{
					unlink("../event_images/".$dfile."");
				}
			}
		}
		mysql_free_result($dresult);
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
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>
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
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
			 	<tr>
				<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
					  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"Edit":"Add"; ?>
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
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Assign to Account  :</td>
								  <td width="71%" class="f-c">
								  <select name="oid" id="oid" >
								  <option value="-" <? if($oid == '-'){ ?>selected="selected"<? } ?>>Please Select</option>
								  	<? $tmp_cmb_array1 = split(",",$oid); ?><?										
											$add_result1 = hb_get_result("select * from organizer") or die(mysql_error());			
											while($add_row1 = mysql_fetch_array($add_result1))
											{	
											?>
											<option value="<?=$add_row1['id']?>" <? if($oid!="" && in_array($add_row1['id'],$tmp_cmb_array1)){ echo 'selected="selected"'; } ?>><?=$add_row1['fname']." ".$add_row1['lname']?></option>
											<?
											}										
											?> </select>
								 
								</td>
							   </tr>
			 
							  <tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Creation Date :</td>
								  <td width="71%" class="f-c"><input  name="add_date" type="text" id="add_date" value="<?=$add_date; ?>"  maxlength="50" readonly="true">&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.frm.add_date,'mm/dd/yyyy',this)" /></td>
							 </tr>
			   
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Event Title :</td>
								  <td width="71%" class="f-c"><input  name="title" type="text" id="title" value="<?=$title; ?>" /></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Date :</td>
								  <td width="71%" class="f-c"><input  name="sdate" type="text" id="sdate" value="<?=$sdate; ?>" s  readonly="true">&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.frm.sdate,'mm/dd/yyyy',this)" /></td>
							 </tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Time :</td>
								  <td width="71%" class="f-c"><input  name="stime" type="text" id="stime" value="<?=$stime; ?>" /></td>
							</tr>
				
							  <tr>
								  <td width="29%" align="right" class="f-c">Event End Date :</td>
								  <td width="71%" class="f-c"><input  name="edate" type="text" id="edate" value="<?=$edate; ?>"  readonly="true">&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.frm.edate,'mm/dd/yyyy',this)" /></td>
							 </tr>
			   
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Time :</td>
								  <td width="71%" class="f-c"><input  name="etime" type="text" id="etime" value="<?=$etime; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Maximum Capacity :</td>
								  <td width="71%" class="f-c"><input  name="max_cap" type="text" id="max_cap" value="<?=$max_cap; ?>" /></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Space Available :</td>
								  <td width="71%" class="f-c"><input  name="space_available" type="text" id="space_available" value="<?=$space_available; ?>" disabled="disabled" /></td>
							</tr>
							<tr>
                  <td width="26%" align="right" class="f-c">Event Image :</td>
                  <td width="74%" class="f-c"><input type="file" name="image_path" id="image_path" value="<?=$image_path;?>">
				  <? 
											if($image_path!="" && file_exists("../event_images/".$image_path))
											{
											?>
                    <img alt="image" src="../include/sample.php?nm=../event_images/<?=$image_path;?>&mwidth=88&mheight=131" border="0" >
                    <?											
											}
										?>
                  
				                            
							              </td>
                </tr>
							<tr>
							  <td width="29%" align="right" class="f-c">Event Summary :</td>
							  <td width="71%" class="f-c"> 
							 <?php /*?> <?php
								$oFCKeditor8 = new FCKeditor('summary') ;
								$oFCKeditor8->BasePath = 'FCKeditor/';
								$oFCKeditor8->Value = $summary;
								$oFCKeditor8->Height = 500;
								$oFCKeditor8->Create() ;?><?php */?>
								
					<textarea name="summary" style="width:100%;height:300PX"> <?=$summary?></textarea> 
					<script type="text/javascript">
					//<![CDATA[

					var editor = CKEDITOR.replace( 'summary' ,{

					filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
					filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
					filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
					filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',


					filebrowserWindowWidth : '1000',
					filebrowserWindowHeight : '700'
					//	uiColor= 'blue';
					
					});
					CKFinder.setupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
					</script>
							   </td>
							</tr>
			   
							<tr>
							  <td width="29%" align="right" class="f-c">Event Description :</td>
							  <td width="71%" class="f-c"> 
							 <?php /*?> <?php
								$oFCKeditor9 = new FCKeditor('description') ;
								$oFCKeditor9->BasePath = 'FCKeditor/';
								$oFCKeditor9->Value = $description;
								$oFCKeditor9->Height = 500;
								$oFCKeditor9->Create() ;?><?php */?>
					<textarea name="description" style="width:100%;height:300PX"> <?=$description?></textarea> 
					<script type="text/javascript">
					//<![CDATA[

					var editor = CKEDITOR.replace( 'description' ,{

					filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
					filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
					filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
					filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',


					filebrowserWindowWidth : '1000',
					filebrowserWindowHeight : '700'
					//	uiColor= 'blue';
					
					});
					CKFinder.setupCKEditor( editor, 'ckeditor/ckfinder/' ) ;
					</script>
							   </td>
							</tr>
			   				<tr>
								  <td  align="right" class="menu-a"><span class="a-l"><strong>Event Location :</strong></span></td>
								  <td>&nbsp;</td>
								</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Location Name :</td>
								  <td width="71%" class="f-c"><input  name="loc_name" type="text" id="loc_name" value="<?=$loc_name; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Street Address :</td>
								  <td width="71%" class="f-c"><input  name="loc_street" type="text" id="loc_street" value="<?=$loc_street; ?>" /></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Suite / Apt #  :</td>
								  <td width="71%" class="f-c"><input  name="loc_suite" type="text" id="loc_suite" value="<?=$loc_suite; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>City :</td>
								  <td width="71%" class="f-c"><input  name="loc_city" type="text" id="loc_city" value="<?=$loc_city; ?>" /></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>State / Province  :</td>
								  <td width="71%" class="f-c">
								  <input  name="loc_state" type="text" id="loc_state" value="<?=$loc_state; ?>" />
								  <?php /*?><select name="loc_state" id="loc_state">
									  <option value="">Select State</option>
									  <?
											$q = "select * from keshavstate order by name";
											$r = mysql_query($q);
											while($r1 = mysql_fetch_array($r))
											{
												$name = ucfirst(stripcslashes($r1['name']));
												if($name != "I live outside of the U.S")
												{
													?><option value="<?=$r1['name'];?>" <?php if($loc_state == $r1['name']) { ?> selected="selected" <?php } ?>><?=$name;?></option><?
												}

											}
									  ?>
									</select><?php */?>
								</td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Zip / Postal Code :</td>
								  <td width="71%" class="f-c"><input  name="loc_zip" type="text" id="loc_zip" value="<?=$loc_zip; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Country :</td>
								  <td width="71%" class="f-c"><input  name="loc_country" type="text" id="loc_country" value="<?=$loc_country; ?>" /></td>
							</tr>
							<tr>
								  <td  align="right" class="menu-a"><span class="a-l"><strong>Funding Details :</strong></span></td>
								  <td>&nbsp;</td>
								</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Minimum Donation Amount :</td>
								  <td width="71%" class="f-c"><input  name="max_don_amt" type="text" id="max_don_amt" value="<?=$max_don_amt; ?>" /></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Target Funding Amount :</td>
								  <td width="71%" class="f-c"><input  name="fund_amt" type="text" id="fund_amt" value="<?=$fund_amt; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Currently Funded Amount :</td>
								  <td width="71%" class="f-c"><input  name="current_fund" type="text" id="current_fund" disabled="disabled" value="<?=$currently_funded_amount; ?>" /></td>
							</tr>
				
							  <tr>
							  <?
							  	if($fund_end_date == '12/31/1969')
								{
									$fund_end_date = '';
								}
							  ?>
								  <td width="29%" align="right" class="f-c">Funding Close Date :</td>
								  <td width="71%" class="f-c"><input  name="fund_end_date" type="text" id="fund_end_date" value="<?=$fund_end_date; ?>" readonly="true">&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.frm.fund_end_date,'mm/dd/yyyy',this)" /></td>
							 </tr>
							 <tr>
								  <td width="29%" align="right" class="f-c">All attendees must donate to attend :</td>
								  <td width="71%" class="f-c"><input type="checkbox" name="donate_to_attend" <? if($donate_to_attend=='yes'){?> checked="checked"<? }?> id="donate_to_attend" value="yes"  /></td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">I would like to define donation levels :</td>
								  <td width="71%" class="f-c">
								  <input type="checkbox" name="define_donation_levels" id="define_donation_levels" onchange="javascript:show_defin_d_level();" <? if($define_donation_levels == 'yes'){ ?> checked="checked" <? } ?> value="yes" />
								  </td>
							</tr>
							<tr>
								  <td width="29%" align="right" class="f-c">I would like to define donation levels :</td>
								  <td width="71%" class="f-c">
								  <input type="checkbox" name="define_donation_levels" id="define_donation_levels" onchange="javascript:show_defin_d_level();" <? if($define_donation_levels == 'yes'){ ?> checked="checked" <? } ?> value="yes" />
								  </td>
							</tr>
							<tr>
								  <td width="29%" height="191" align="right" valign="top" class="f-c">Donation Levels :</td>
								  <td width="71%" class="f-c">
								  <table width="100%" height="174" cellpadding="0" cellspacing="0">
								  <tr>
								  	<td width="12%" align="right">Friend :&nbsp;</td>
									<td width="88%"><input name="df_friends" type="text" id="df_friends" value="<?=$df_friends;?>" /></td>
								  </tr>
								  <tr>
								  	<td width="12%" align="right">Bronze :&nbsp;</td>
									<td width="88%"><input name="df_bronze" type="text" id="df_bronze"  value="<?=$df_bronze;?>"/></td>
								  </tr>
								  <tr>
								  	<td width="12%" align="right">Silver :&nbsp;</td>
									<td width="88%"><input name="df_silver" type="text" id="df_silver" value="<?=$df_silver;?>" /></td>
								  </tr>
								  <tr>
								  	<td width="12%" align="right">Gold :&nbsp;</td>
									<td width="88%"><input name="df_gold" type="text" id="df_gold" value="<?=$df_gold;?>" /></td>
								  </tr>
								  <tr>
								  	<td width="12%" align="right">Platinum :&nbsp;</td>
									<td width="88%"><input name="df_platinum" type="text" id="df_platinum" value="<?=$df_platinum;?>"/></td>
								  </tr>
								  <tr>
								  	<td width="12%" align="right">Benefactor :&nbsp;</td>
									<td width="88%"><input name="df_benefactor" type="text" id="df_benefactor" value="<?=$df_benefactor;?>"/></td>
								  </tr>
								  </table>
								  
								  </td>
							</tr>
			   
							<tr>
										  <td width="29%" align="right" class="f-c">Payment Method Selected :</td>
										  <td width="71%" class="f-c">
										 
										  <select name="payment" id="payment">
											  <option value="-" <? if($payment == '-'){ ?>selected="selected"<? } ?>>Please Select</option>
											  <option value="Check" <? if($payment == "Check"){ echo 'selected="selected"'; } ?>>Check</option>
											  <option value="PayPal" <? if($payment =="PayPal"){ echo 'selected="selected"'; } ?>>PayPal</option>
										 </select>
							</td>
						  </tr>
						  <tr>
								  <td  align="right" class="menu-a"><span class="a-l"><strong>Event Privacy :</strong></span></td>
								  <td>&nbsp;</td>
								</tr>
							<tr>
		 <tr>
			  <td width="29%" align="right" class="f-c">Allow this event to be searchable :</td>
			  <td width="71%" class="f-c"><input type="checkbox" name="searchable" <? if($searchable=='yes'){?> checked="checked"<? }?> id="searchable" value="yes"  /></td>
		</tr>
		 <tr>
			  <td width="29%" align="right" class="f-c">Display funding details on event details page :</td>
			  <td width="71%" class="f-c"><input type="checkbox" name="display_fund" <? if($display_fund=='yes'){?> checked="checked"<? }?> id="display_fund" value="yes"  /></td>
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
				/* -------------- Assign to Organizer Validation --------------------- */
				if(document.getElementById("oid").value.split(" ").join("") == "" || document.getElementById("oid").value.split(" ").join("") == "0" || document.getElementById("oid").value.split(" ").join("") == "-")
				{
					alert("Please select an organizer.");
					document.getElementById("oid").focus();
					return false;
				}
				
				
			/* -------------- Creation Date Validation --------------------- */
			if(document.getElementById("add_date").value.split(" ").join("") == "" || document.getElementById("add_date").value.split(" ").join("") == "0")
			{
				alert("Please enter a creation date.");
				document.getElementById("add_date").focus();
				return false;
			}
			
			
			/* -------------- Event Title Validation --------------------- */
			if(document.getElementById("title").value.split(" ").join("") == "" || document.getElementById("title").value.split(" ").join("") == "0")
			{
				alert("Please enter an event title.");
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