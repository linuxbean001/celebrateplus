<?									
include("connect.php");
include("FCKeditor/fckeditor.php") ;
$LeftLinkSection = 4;
$pagetitle="Blog Post";

/* ---------------------- Declare Fields ---------------------- */

$blog_title= "";
$category_id= "";
$post_date= "";
$post_summary= "";
$full_content= "";

/* ---------------------- Initialize Fields ---------------------- */

if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
	$id = $_REQUEST["id"];											
	$fetchquery = "select * from blog_posts where id=".$id;
	$result = mysql_query($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				$blog_title= stripslashes($row['blog_title']);
				$category_id= stripslashes($row['category_id']);
				$post_date= date("m-d-Y",strtotime(stripslashes($row['post_date'])));
				$post_summary= stripslashes($row['post_summary']);
				$full_content= stripslashes($row['full_content']);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

if(isset($_REQUEST['Submit']))
{
		$blog_title= addslashes($_REQUEST['blog_title']);
		$category_id= addslashes($_REQUEST['category_id']);
		$post_date= addslashes($_REQUEST['post_date']);
		$post_date= explode("-",$_REQUEST['post_date']);
		$post_date= $post_date[2]."-".$post_date[0]."-".$post_date[1];
		$post_summary= addslashes($_REQUEST['post_summary']);
		$full_content= addslashes($_REQUEST['full_content']);
			if(isset($_REQUEST['mode']))
			{
			switch($_REQUEST['mode'])
			{
				case 'add' :
					if(GTG_is_dup_add('blog_posts','blog_title',$blog_title))
					{
						unset($_REQUEST['Submit']);	
						location("add_blog_post.php?mode=add&msg=4");
						return;
					}
					
					$display_order=sam_get_display_order("blog_posts","");
					
					$query = "insert into blog_posts 
					set display_order='$display_order',blog_title='$blog_title',category_id='$category_id',post_date='$post_date',post_summary='$post_summary',full_content='$full_content'"; 
					mysql_query($query) or die(mysql_error());
					location("manage_blog_posts.php?msg=1");
				break;
				
				case 'edit' :
					if(GTG_is_dup_edit('blog_posts','blog_title',$blog_title,$_REQUEST['id']))
					{
						unset($_REQUEST['Submit']);	
						location("add_blog_post.php?mode=edit&id=".$_REQUEST['id']."&msg=4");	
						return;
					}
					$query = "update blog_posts set blog_title='$blog_title',category_id='$category_id',post_date='$post_date',post_summary='$post_summary',full_content='$full_content'"; 
					$query.=" where id=".$_REQUEST['id'];
					mysql_query($query) or die(mysql_error());
					location("manage_blog_posts.php?msg=2");
				break;
				
			}	
		}
		
}	
if(isset($_REQUEST['mode']))
{
	switch($_REQUEST['mode'])
	{
		case 'delete' :
$query = "delete from blog_posts where id=".$_REQUEST['id'];     
			mysql_query($query) or die(mysql_error());
			location("manage_blog_posts.php?msg=3");
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
					  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"Edit":"Add"; ?>
										Blog Post</td>
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
									echo "<span style='color:#CC6600;'>Blog Posts Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>Blog Posts Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>Blog Posts Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>Blog Posts with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
						</span></td>
					</tr>
					<TR>
					  <TD>
							<form action="add_blog_post.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
							<input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
							<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
							<tr>
							<td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
							</tr> 
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Blog Title :</td>
								  <td width="71%" class="f-c"><input  name="blog_title" type="text" id="blog_title" value="<?=$blog_title; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Assign to Category :</td>
								  <td width="71%" class="f-c"><select name="category_id" id="category_id" ><option value="-" <? if($category_id == '-'){ ?>selected="selected"<? } ?>>Please Select</option><? $tmp_cmb_array2 = split(",",$category_id); ?><?										
											$add_result2 = mysql_query("select * from blog_categories") or die(mysql_error());			
											while($add_row2 = mysql_fetch_array($add_result2))
											{	
											?>
											<option value="<?=$add_row2['id']?>" <? if($category_id!="" && in_array($add_row2['id'],$tmp_cmb_array2)){ echo 'selected="selected"'; } ?>><?=$add_row2['category_name']?></option>
											<?
											}										
											?> </select>
								 
								</td>
							   </tr>
			 
							  <tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Date :</td>
								  <td width="71%" class="f-c"><input  name="post_date" type="text" id="post_date" value="<?=$post_date; ?>" size="35" maxlength="50" readonly="true">&nbsp;<img src="calendar.jpg" width="24" height="24" align="absbottom"	onclick="displayCalendar(document.frm.post_date,'mm-dd-yyyy',this)" /></td>
							 </tr>
			   
							<tr>
							  <td width="29%" align="right" class="f-c">Post Summary :</td>
							  <td width="71%" class="f-c"> <?php
																$oFCKeditor4 = new FCKeditor('post_summary') ;
																$oFCKeditor4->BasePath = 'FCKeditor/';
																$oFCKeditor4->Value = $post_summary;
																$oFCKeditor4->Height = 500;
																$oFCKeditor4->Create() ;?>
							   </td>
							</tr>
			   
							<tr>
							  <td width="29%" align="right" class="f-c">Full Content :</td>
							  <td width="71%" class="f-c"> <?php
																$oFCKeditor5 = new FCKeditor('full_content') ;
																$oFCKeditor5->BasePath = 'FCKeditor/';
																$oFCKeditor5->Value = $full_content;
																$oFCKeditor5->Height = 500;
																$oFCKeditor5->Create() ;?>
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
			if(document.getElementById("blog_title").value.split(" ").join("") == "" || document.getElementById("blog_title").value.split(" ").join("") == "0")
			{
				alert("Please enter Blog Title.");
				document.getElementById("blog_title").focus();
				return false;
			}
			
			
				/* -------------- Assign to Category Validation --------------------- */
				if(document.getElementById("category_id").value.split(" ").join("") == "" || document.getElementById("category_id").value.split(" ").join("") == "0" || document.getElementById("category_id").value.split(" ").join("") == "-")
				{
					alert("Please assign to a category.");
					document.getElementById("category_id").focus();
					return false;
				}
				
				
			/* -------------- Date Validation --------------------- */
			if(document.getElementById("post_date").value.split(" ").join("") == "" || document.getElementById("post_date").value.split(" ").join("") == "0")
			{
				alert("Please enter Date.");
				document.getElementById("post_date").focus();
				return false;
			}
			
			
}
</script>
</body>
</html>