<?									
include("connect.php");

$LeftLinkSection = 6;
$pagetitle="Blog Post";

/* ---------------------- Declare Fields ---------------------- */

$blog_title= "";
$advertiser_id= "";
$post_date= "";
$post_summary= "";
$full_content= "";

/* ---------------------- Initialize Fields ---------------------- */

if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
	$id = $_REQUEST["id"];											
	$fetchquery = "select * from ad where id=".$id;
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				$location= stripslashes($row['location']);
				$advertiser_id= stripslashes($row['advertiser_id']);
				
				$image_path= stripslashes($row['image_path']);
				$link= stripslashes($row['link']);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

if(isset($_REQUEST['Submit']))
{
		$location= $_REQUEST['location'];
		if(is_array($location))
		{
		$location=implode(",",$location);
		}
		$advertiser_id= addslashes($_REQUEST['advertiser_id']);
		$type= $_REQUEST['type'];
		
		$link= addslashes($_REQUEST['link']);
		
		$image_path="";
		
    	if ($_FILES["image_path"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["full"]["error"] . "<br />";
		}
		else
		{
		   
		   $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
		   move_uploaded_file($_FILES["image_path"]["tmp_name"],"../advertiser_images/".$image_path);
		  }
				
				
			if(isset($_REQUEST['mode']))
			{
			switch($_REQUEST['mode'])
			{
				case 'add' :
					if(GTG_is_dup_add('blog_posts','blog_title',$blog_title))
					{
						unset($_REQUEST['Submit']);	
						location("add_ad.php?mode=add&msg=4");
						return;
					}
					
					$display_order=sam_get_display_order("blog_posts","");
					
					$query = "insert into ad 
					set location='$location',advertiser_id='$advertiser_id',image_path='$image_path',link='$link'"; 
					hb_get_result($query) or die(mysql_error());
					location("manage_ad.php?msg=1");
				break;
				
				case 'edit' :
					if(GTG_is_dup_edit('blog_posts','blog_title',$blog_title,$_REQUEST['id']))
					{
						unset($_REQUEST['Submit']);	
						location("add_ad.php?mode=edit&id=".$_REQUEST['id']."&msg=4");	
						return;
					}
					$query = "update ad set location='$location',advertiser_id='$advertiser_id',link='$link'";
					if($image_path!="")
						{
						deleteimage(checkNum($_REQUEST['id']));
						$query.=" , image_path='".$image_path."'";
						}
					$query.=" where id=".$_REQUEST['id'];
					hb_get_result($query) or die(mysql_error());
					location("manage_ad.php?msg=2");
				break;
				
			}	
		}
		
}	
if(isset($_REQUEST['mode']))
{
	switch($_REQUEST['mode'])
	{
		case 'delete' :
$query = "delete from ad where id=".$_REQUEST['id'];     
			hb_get_result($query) or die(mysql_error());
			location("manage_ad.php?msg=3");
		break;
	}	
}	
function deleteimage($iid)
	{
		$dquery = "select image_path from ad where id=".$iid;
		$dresult = hb_get_result($dquery);
		while($drow = mysql_fetch_array($dresult))
		{
			$dfile = $drow['image_path'];
			if($dfile != "")
			{
				if(file_exists("../advertiser_images/".$dfile.""))
				{
					unlink("../advertiser_images/".$dfile."");
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
					  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"Edit":"Add"; ?> Ad</td>
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
									echo "<span style='color:#CC6600;'>Ad Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>Ad Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>Ad Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>Ad with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
						</span></td>
					</tr>
					<TR>
					  <TD>
							<form action="add_ad.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
							<input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
							<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
							<tr>
							<td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
							</tr> 
                            <tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Assign to Advertiser  :</td>
								  <td width="71%" class="f-c"><select name="advertiser_id" id="advertiser_id" >
                                  <option value="-">Please Select</option>
								  <?										
											$add_result2 = hb_get_result("select * from advertiser") or die(mysql_error());			
											while($add_row2 = mysql_fetch_array($add_result2))
											{	
											?>
											<option value="<?=$add_row2['id']?>" <? if($advertiser_id == $add_row2['id']){ echo 'selected="selected"'; } ?>><?=$add_row2['name'].$advertiser_id;?></option>
											<?
											}										
											?> </select>
								 
								</td>
							   </tr>
							<tr>
								  <td width="29%" align="right" class="f-c">Ad Location :</td>
								  <td width="71%" class="f-c">
                                  	<select name="location[]" id="location" multiple="multiple" style="width:325px; height:200px;">
                                    <?php $location=explode(",",$location);?>
                                    	<option value="">Please Select</option>
                                        <option value="Home Footer" <?php if(in_array("Home Footer",$location)) {?> selected="selected"<?php } ?>>Home Footer</option>
										
										<option value="Resources Footer" <?php if(in_array("Resources Footer",$location)) {?> selected="selected"<?php } ?>>Resources Footer</option>
										
										<option value="Resources Right Column" <?php if(in_array("Resources Right Column",$location)) {?> selected="selected"<?php } ?>>Resources Right Column</option>
										
										<option value="Find an Event Footer" <?php if(in_array("Find an Event Footer",$location)) {?> selected="selected"<?php } ?>>Find an Event Footer</option>
										
										<option value="Help Footer" <?php if(in_array("Help Footer",$location)) {?> selected="selected"<?php } ?>>Help Footer</option>
										
										<option value="Help Right Column" <?php if(in_array("Help Right Column",$location)) {?> selected="selected"<?php } ?>>Help Right Column</option>
										
										<option value="Sub Page Footer" <?php if(in_array("Sub Page Footer",$location)) {?> selected="selected"<?php } ?>>Sub Page Footer</option>
										
										<option value="Sub Page Right Column" <?php if(in_array("Sub Page Right Column",$location)) {?> selected="selected"<?php } ?>>Sub Page Right Column</option>
										
										<option value="Event Details Page Left Column" <?php if(in_array("Event Details Page Left Column",$location)) {?> selected="selected"<?php } ?>>Event Details Page Left Column</option>
										
										<option value="Login Footer" <?php if(in_array("Login Footer",$location)) {?> selected="selected"<?php } ?>>Login Footer</option>
                                        
                                    </select>
                                  
                                  </td>
							</tr>
				
							<?php /*?><tr>
								  <td width="29%" align="right" class="f-c">Ad Type :</td>
								  <td width="71%" class="f-c">
                                  	<select name="type[]" id="type" multiple="multiple">
                                     <?php $type=explode(",",$type);?>
                                    	<option value="">Please Select</option>
                                        <option value="Type 1" <?php if(in_array("Type 1",$type)) {?> selected="selected"<?php } ?>>Type 1</option>
                                        <option value="Type 2" <?php if(in_array("Type 2",$type)) {?> selected="selected"<?php } ?>>Type 2</option>
                                        <option value="Type 3" <?php if(in_array("Type 3",$type)) {?> selected="selected"<?php } ?>>Type 3</option>
                                    </select>
                                 
                                  </td>
							</tr><?php */?>
				
			 				<tr>
                              <td width="26%" align="right" class="f-c">Ad Image :</td>
                              <td width="74%" class="f-c"><input type="file" name="image_path" id="image_path" value="<?=$image_path;?>">
                              <? 
                                                        if($image_path!="" && file_exists("../advertiser_images/".$image_path))
                                                        {
                                                        ?>
                                <img alt="image" src="../include/sample.php?nm=../advertiser_images/<?=$image_path;?>&mwidth=88&mheight=131" border="0" >
                                <?											
                                                        }
                                                    ?>
                              
                                                        
                                                      </td>
                            </tr>
                
							  <tr>
								  <td width="29%" align="right" class="f-c">Ad Link :</td>
								  <td width="71%" class="f-c">
                                  	<input  name="link" type="text" id="link" value="<?=$link; ?>" size="35" maxlength="50" >
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
			/* -------------- Blog Title Validation --------------------- */
			/*if(document.getElementById("blog_title").value.split(" ").join("") == "" || document.getElementById("blog_title").value.split(" ").join("") == "0")
			{
				alert("Please enter Blog Title.");
				document.getElementById("blog_title").focus();
				return false;
			}*/
			
			
				/* -------------- Assign to Category Validation --------------------- */
				if(document.getElementById("advertiser_id").value.split(" ").join("") == "" || document.getElementById("advertiser_id").value.split(" ").join("") == "0" || document.getElementById("advertiser_id").value.split(" ").join("") == "-")
				{
					alert("Please select an advertiser.");
					document.getElementById("advertiser_id").focus();
					return false;
				}
				
				
			/* -------------- Date Validation --------------------- */
			/*if(document.getElementById("post_date").value.split(" ").join("") == "" || document.getElementById("post_date").value.split(" ").join("") == "0")
			{
				alert("Please enter Date.");
				document.getElementById("post_date").focus();
				return false;
			}*/
			
			
}
</script>
</body>
</html>