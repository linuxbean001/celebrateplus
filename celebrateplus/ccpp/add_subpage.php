<?									
include("connect.php");

$LeftLinkSection = 4;
$pagetitle="Sub Page";
	$mode = "";
	$id = 0;
	$query = "";
	$redirect = "";
	$cid = "";
	$type = addslashes($_REQUEST['type']);
	$fetchquery = "select count(*) as c from subpage";
	$result = hb_get_result($fetchquery);
	$row = mysql_num_rows($result);
	if($row > 0)
	{
		while($row = mysql_fetch_array($result))
		{
			$c = stripslashes($row['c']);	
			$c = $c + 1;
		}
	}
	
	
	if(isset($_POST['Submit']))
	{
		$type = addslashes(GTG_firewall($_POST['type']));
		$linkname = addslashes(GTG_firewall($_POST['linkname']));
		$page_header = addslashes(GTG_firewall($_POST['page_header']));
		$browserbar = addslashes(GTG_firewall($_POST['browserbar']));
		$metadescription = GTG_firewall($_POST['metadescription']);
		$content1 = addslashes($_REQUEST['content1']);
		$metakeyword = GTG_firewall($_POST['metakeyword']);
		$url = addslashes(GTG_firewall($_POST['url']));
		$target = addslashes(GTG_firewall($_POST['target']));
		$navigation=$_POST['navigation'];	
			
		$image_path="";
	check_image($_FILES["image_path"]);	
	if ($_FILES["image_path"]["error"] > 0)
	{
		//echo "Error: " . $_FILES["full"]["error"] . "<br />";
	}
	else
	{
		 $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
		 move_uploaded_file($_FILES["image_path"]["tmp_name"],"../subpage_images/".$image_path);
	}	
	$map_path = "";
	check_doc($_FILES["map_path"]);
	if ($_FILES["map_path"]["error"] > 0)
	{
		//echo "Error: " . $_FILES["full"]["error"] . "<br />";
	}
	else
	{
		 $map_path = rand(1,999).trim($_FILES["map_path"]["name"]); 
		 move_uploaded_file($_FILES["map_path"]["tmp_name"],"../subpage_images/".$map_path);
	}
		
		$mode=GTG_firewall($_POST['mode']);
		$id=checkNum(GTG_firewall($_POST['id']));
		if($mode!="")
			{
				switch($mode)
				{
				case 'add' :
					
					
					$query = "insert into subpage set
					type ='".$type."',
					navigation ='".$navigation."',
					linkname='".$linkname."',
					page_header='".$page_header."',
					browserbar='".$browserbar."',
					metakeyword='".$metakeyword."',
					image_path='".$image_path."',
					content1='".$content1."',
					url='".$url."',
					target='".$target."',
					map_path='".$map_path."',
					displayorder='".$c."',
					metadescription='".$metadescription."'";
					hb_get_result($query) or die(mysql_error());
					location("manage_subpage.php?msg=1");				
				break;

				
				case 'edit' :
					
					

					$query = "update subpage set
					type ='".$type."',
					navigation ='".$navigation."',
					linkname='".$linkname."',
					page_header='".$page_header."',
					browserbar='".$browserbar."',
					metakeyword='".$metakeyword."',
					content1='".$content1."',
					url='".$url."',
					target='".$target."',
					metadescription='".$metadescription."'";
					if($image_path!="")
					{
						deletefull1($_REQUEST['id']);
						$query.=" , image_path='$image_path'";
					}
					if($map_path!="")
					{
						deletefull2($_REQUEST['id']);
						$query.=" , map_path='$map_path'";
					}
					$query.= " where id=".checkNum($_REQUEST['id']);	
					hb_get_result($query) or die(mysql_error());
					location("manage_subpage.php?msg=2"); 
				break;
				
			}
			
			
			
		}	
	}
	$id=checkNum(GTG_firewall($_GET['id']));
	if($id!=0)
	{
		
		if($id > 0)
		{
			$fetchquery = "select * from subpage where id=".$id;
			$result = hb_get_result($fetchquery);
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_array($result))
				{
					if($_REQUEST['type'] == "")
					{				
					$type = stripslashes($row['type']);
					}
					$navigation = stripslashes($row['navigation']);
					$linkname = stripslashes($row['linkname']);
					$page_header = stripslashes($row['page_header']);
					$browserbar = stripslashes($row['browserbar']);
					$metadescription = stripslashes($row['metadescription']);
					$metakeyword = stripslashes($row['metakeyword']);
					$content1 = stripslashes($row['content1']);	
					$image_path = stripslashes($row['image_path']);	
					$url = stripslashes($row['url']);
					$target = stripslashes($row['target']);
					$map_path = stripslashes($row['map_path']);
					$sub_id = stripslashes($row['id']);
								
				}
			}
		}
	}
	
	
	
	$mode=GTG_firewall($_GET['mode']);
	if($mode!="")
	{
		switch($mode)
		{
			case 'delete' :

					deletefull1($id);
		deletefull2($id);
				$query = "delete from subpage where id=".$id;
			
				hb_get_result($query) or die(mysql_error());
				location("manage_subpage.php?msg=3");
			break;
		}
		
	}	
	

function deletefull1($iid)
{
	$dquery = "select image_path from subpage where id=".$iid;
	$dresult = hb_get_result($dquery);
	while($drow = mysql_fetch_array($dresult))
	{
		$dfile = $drow['image_path'];
		if($dfile != "")
		{
			if(file_exists("../subpage_images/".$dfile.""))
			{
				unlink("../subpage_images/".$dfile."");
			}
		}
	}
	mysql_free_result($dresult);
}	
function deletefull2($iid)
{
	$dquery = "select map_path from subpage where id=".$iid;
	$dresult = hb_get_result($dquery);
	while($drow = mysql_fetch_array($dresult))
	{
		$dfile = $drow['map_path'];
		if($dfile != "")
		{
			if(file_exists("../subpage_images/".$dfile.""))
			{
				unlink("../subpage_images/".$dfile."");
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
										Sub Page</td>
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
									echo "<span style='color:#CC6600;'>Subpage Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>Subpage Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>Subpage Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>Subpage with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
						</span></td>
					</tr>
					<TR>
					  <TD>
							<form method="post"  name="frm" enctype="multipart/form-data" onSubmit="return gtg_check();">
                <input type="hidden" name="mode" id="mode" value="<?=GTG_firewall($_GET['mode']);?>" >
                       <input type="hidden" value="<?=checkNum(GTG_firewall($_GET['id']))?>" name="id">			  
              <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
                <tr>
                  <td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
                </tr>
                
                <?php /*?><tr>
                  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Category :</td>
                  <td width="71%" class="f-c"><select name="cid" id="cid" >
                      <option value="">Select</option>
                      <?php
						$q = "select * from category order by name"; 
						$r = hb_get_result($q);
						if(mysql_num_rows($r) > 0)
						{
							while($r1 = mysql_fetch_array($r))
							{
								if($_REQUEST['mode'] == 'edit' && $r1['id'] == $cid) 
								{ 
						?>
                      <option selected="selected" value="<?=$r1['id'];?>">
                      <?=$r1['name'];?>
                      </option>
                      <?php
								}
								else
								{
									?>
                      <option value="<?=$r1['id'];?>">
                      <?=$r1['name'];?>
                      </option>
                      <?php
								}
							}
						}
									?>
                    </select></td>
                </tr><?php */?>
				<tr>
                  <td align="right" class="f-c"><span style="color:#FF0000;">*</span> Type :</td>
				  <td class="f-c"><select onChange="frm.submit();" name="type" id="type">
				 
                      <option <? if($type  == "") { ?> selected="selected" <? } ?> value="Select">Select</option>
					  <option <? if($type  == "New Content") { ?> selected="selected" <? } ?> value="New Content">New Content</option>
                      <option <? if($type  == "Link") { ?> selected="selected" <? } ?> value="Link">Link</option>
                      <option <? if($type == "File") { ?> selected="selected" <? } ?> value="File">File</option>
                      
                      
                  </select></td>
			    </tr>
				<?php /*?><tr>
                  <td width="26%" align="right" class="f-c" valign="top"><span style="color:#FF0000;"></span>Primary Navigation  :</td>
                  <td width="80%" class="f-c" valign="top">
                    <label>
                    <select style="font-size:12px;" name="navigation" id="navigation"  value="<?=$navigation; ?>" >
									     <option value="">Select</option>  										
											<?						
									 $q = "select * from staticpage where id in(2,3,8)"; 
									$r = hb_get_result($q) or die(mysql_error());
									
									while($r1 = mysql_fetch_array($r))
									{
										$page_header1 = stripslashes($r1['page_header']);
										
										?>
											<option value="<?=$r1['id'];?>"<? if($r1['id']==$navigation) { echo 'selected="selected"'; } ?>>
											  <?=$page_header1;?>
								  </option>
											<?
									}
									 
								
								?>
                    </select>
                  </label></td>
                </tr><?php */?>
				
				 
				<tr>
                  <td width="26%" align="right" class="f-c" valign="top"><span style="color:#FF0000;">*</span>Page Link Name :</td>
                  <td width="80%" class="f-c" valign="top"><a onClick="javascript:popUpCalendar(this, frm.ct_date, 'mm-dd-yyyy');"></a><input name="linkname" type="text" id="linkname" value="<?=stripslashes($linkname); ?>" size="35"></td>
                </tr>
<?
				 if($_REQUEST['type']=="New Content" || $type=="New Content") 
				{
				?>

				<tr>
  <td width="26%" align="right" class="f-c">Front End URL :</td>
                  <td class="f-c"><a href="<?=$SITE_URL."sub_page.php?id=".$sub_id;?>" target="_blank"><?=$SITE_URL."sub_page.php?id=".$sub_id;?></a></td>
</tr>
		
<tr>
  <td width="26%" align="right" class="f-c">Page Header :</td>
                  <td class="f-c"><input name="page_header" type="text" id="page_header" value="<?=stripslashes($page_header); ?>" size="35"></td>
</tr>
												


				

                <tr>
                  <td width="26%" align="right" class="f-c" valign="top">Browser Bar Title  :</td>
                  <td width="80%" class="f-c" valign="top"><input name="browserbar" type="text" id="browserbar" value="<?=stripslashes($browserbar); ?>" size="35"></td>
                </tr>
				
				
				
				
				
				
				
				
                <tr>
                  <td align="right" class="f-c" valign="top">Meta Description   :</td>
                  <td class="f-c" valign="top"><label>
                    <textarea name="metadescription"  rows="5" cols="50" id="metadescription"><?=$metadescription;?></textarea>
                  </label></td>
                </tr>
                <tr>
                  <td align="right" class="f-c" valign="top">Meta Keywords   :</td>
                  <td class="f-c" valign="top"><textarea name="metakeyword" rows="5" cols="50" id="metakeyword"><?=$metakeyword;?></textarea></td>
                </tr>
                <?php /*?><tr>
                  <td align="right" class="f-c" valign="top">Page Image/Flash   :</td>
                  <td class="f-c" valign="top"><label>
                    <input name="image_path" type="file" id="image_path">
                    <? 
											if($image_path!="" && file_exists("../subpage_images/".$pimage_path))
											{
											  if(substr($image_path,-4)==".swf")
												{
												?>
                    <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','400','height','131','src','../subpage_images/<?=$image_path;?>','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','../subpage_images/<?=$image_path;?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="400" height="131">
                      <param name="movie" value="../subpage_images/<?=$image_path;?>">
                      <param name="quality" value="high">
                      <embed src="../subpage_images/<?=$image_path;?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="88" height="131"></embed>
                    </object></noscript>
                    
                    <?
		                                       }
											   else
											   {
		                                    ?>
                    <img alt="image" src="../include/sample.php?nm=../subpage_images/<?=$image_path;?>&mwidth=88&mheight=131" border="0" >  
                    <?
											 }											
											}
										?>
</label></td>
                </tr><?php */?>
                <tr>
                  <td align="right" class="f-c" valign="top">Page Content   :</td>
                  <td class="f-c" valign="top">
				 <?php /*?> <?php
					$oFCKeditor3 = new FCKeditor('content1') ;
					$oFCKeditor3->BasePath = 'FCKeditor/';
					$oFCKeditor3->Value = $content1;
					$oFCKeditor3->Height = 500;
					$oFCKeditor3->Create() ;
					?><?php */?>
					<textarea name="content1" style="width:100%;height:300PX"> <?=$content1?></textarea> 
					<script type="text/javascript">
					//<![CDATA[

					var editor = CKEDITOR.replace( 'content1' ,{

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
				<?
				}
				?>
				<?
				 if($_REQUEST['type']=="Link" || $type=="Link") 
				{
				?>
                <tr class="f-c">
                  <td align="right">URL : </td>
                  <td><input name="url" type="text" id="url" value="<?=stripslashes($url); ?>" size="35"></td>
                </tr>
                <tr class="f-c">
                  <td align="right">Target : </td>
                  <td><select  name="target" id="target">
                    <option  value="Select">Select</option>
					<option <? if($target == "_self") { ?> selected="selected" <? } ?>value="_self">Same</option>
                    <option <? if($target == "_blank") { ?> selected="selected" <? } ?> value="_blank">New</option>
                  </select></td>
                </tr>
				<?
				}
				?>
				<?
				 if($_REQUEST['type']=="File" || $type=="File") 
				{
				?>
                <tr class="f-c">
                  <td align="right">Upload File : </td>
                  <td><input name="map_path" type="file" id="map_path" >
                    <? 
											if($map_path!="" && file_exists("../subpage_images/".$map_path))
											{
											?>
                    <a href="../subpage_images/<?=$map_path;?>" style="text-decoration:none; font-weight:bold;">View</a>
                    <?											
											}
										?></td>
                </tr>
				<?
				}
				?>
                <tr>
                  <td>&nbsp;
                    </td>
                  <td><?php if($_REQUEST['mode'] == 'add') { ?>
                    <input name="Submit" type="submit" class="send_form" value="Add" />
                    <?php } else { ?>
                    <input name="Submit" type="submit" class="send_form" value="Edit"  />                  </td>
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
<script language="javascript" >
	function gtg_check()
	{
	if(document.getElementById("type").value.split(" ").join("") == "Select")
				{
					alert("Please select a sub page type.");
					document.getElementById("type").focus();
					return false;
				}
				
				if(document.getElementById("linkname").value.split(" ").join("") == "")
				{
					alert("Please Enter Link Name.");
					document.getElementById("linkname").focus();
					return false;
				}
		
	}
</script>
</body>
</html>