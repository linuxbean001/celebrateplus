<?php 
include("connect.php");
//include("function.php");
$LeftLinkSection = 4;
$pagetitle="Slide";
?>
<?php
	$title = "";
	$detail = "";
	
	$mode = "";
	$id = 0;
	$query = "";
	$redirect = "";
	
	$total = "select count(*) from promo";
	$result = hb_get_result($total) or die(mysql_error());
	$c = mysql_result($result,0);
	$c++;
	
	if(isset($_REQUEST['Submit']))
	{
		
		$id = $_REQUEST['id'];		
		$title = addslashes($_REQUEST['title']);
		$summary = addslashes($_REQUEST['summary']);
		$description = addslashes($_REQUEST['description']);
		
		$scid_array=$_REQUEST['navigation'];
		$navigation="";
		for($j=0;$j<count($scid_array);$j++)
		{
			if($navigation=="")
			{
				$navigation=$scid_array[$j];
			}
			else
			{
				$navigation.=",".$scid_array[$j];
			}
		}
		$navigation = ",".$navigation.",";
		
		$url= $_REQUEST['url'];
		$target= $_REQUEST['target'];
		$banner_image_path= $_REQUEST['banner_image_path'];
		$image_path='';
		if ($_FILES["image_path"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["full"]["error"] . "<br />";
		}
		else
		{
			  $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
			 copy($_FILES["image_path"]["tmp_name"],"../promo_images/".$image_path);
			 $ext=", pimage='".$image_path."'";
		}
		
		if(isset($_REQUEST['mode']))
		{
				
					
			switch($_REQUEST['mode'])
			{
				case 'add' :
					if(GTG_is_dup_add('promo','name',$title))
					{
						unset($_REQUEST['Submit']);	
						print "<script language='javascript'>location.href='add_promo.php?mode=add&msg=2'</script>";
						return;
					}
					
					 $query = "insert into promo (name,	pimage,banner_image_path,url,target,content,displayorder) values('".$title."','".$image_path."','".$banner_image_path."','".$url."','".$target."','".$description."','".$c."');";
					
					$redirect = "<script language='javascript'>location.href='manage_promo.php?msg=1'</script>";
				
				break;
				
				case 'edit' :
					
					if(GTG_is_dup_edit('promo','name',$title,$id))
					{
						unset($_REQUEST['Submit']);	
						print "<script language='javascript'>location.href='add_promo.php?mode=edit&id=".$_REQUEST['id']."&msg=2'</script>";	
						return;
					}
					$query = "update promo set name='".$title."',url='".$url."',target='".$target."',content='".$description."',content='".$description."',banner_image_path='".$banner_image_path."'";
					if($image_path!="")
						{
							deletefull($id);
							$query.=" ,	pimage='".$image_path."'";
						}
					$query.= " where id=".$_REQUEST['id'];	
					
					$redirect = "<script language='javascript'>location.href='manage_promo.php?msg=2'</script>"; 
				break;
				
			}
			
			hb_get_result($query) or die(mysql_error());
			print $redirect;
		}	
	}
	if(isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
		if($id > 0)
		{
			$id = $_REQUEST['id'];
			$fetchquery = "select * from promo where id=".$id;
			$result = hb_get_result($fetchquery);
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_array($result))
				{
					$promo_id = stripslashes($row['id']);
					$title = stripslashes($row['name']);					
					$image_path = stripslashes($row['pimage']);
					$banner_image_path = stripslashes($row['banner_image_path']);
					$url = stripslashes($row['url']);
					$target = stripslashes($row['target']);
					$description = stripslashes($row['content']);
					$navigation = stripslashes($row['navigation']);
																		
				}
			}
		}
	}
	
	if(isset($_REQUEST['mode']))
	{
		switch($_REQUEST['mode'])
		{
			case 'delete' :
				deletefull($id);
				deletefull2($id);
				$query = "delete from promo where id=".$_REQUEST['id'];
				$redirect = "<script language='javascript'>location.href='manage_promo.php?msg=3'</script>";
				hb_get_result($query) or die(mysql_error());
				print $redirect;
			break;
		}
		
	}	
	
function deletefull($iid)
{
	$dquery = "select pimage from promo where id='".$iid."'";
	$dresult = hb_get_result($dquery);
	while($drow = mysql_fetch_array($dresult))
	{
		$dfile = $drow['pimage'];
		if($dfile != "")
		{
			if(is_file("../promo_images/".$dfile.""))
			{
				unlink("../promo_images/".$dfile."");
			}
		}
	}
	mysql_free_result($dresult);
}
function deletefull2($iid)
{
	$dquery = "select banner_image_path from promo where id='".$iid."'";
	$dresult = hb_get_result($dquery);
	while($drow = mysql_fetch_array($dresult))
	{
		$dfile = $drow['banner_image_path'];
		if($dfile != "")
		{
			if(is_file("../promo_images/".$dfile.""))
			{
				unlink("../promo_images/".$dfile."");
			}
		}
	}
	mysql_free_result($dresult);
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_NAME?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script type="text/javascript">
<!--
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
//-->
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
                                            <?=$pagetitle?></td>
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
                                                        echo "<span style='color:#CC6600;'>slide Added Successfully.</span>";	 
                                                    elseif($msg == 2)
                                                        echo "<span style='color:#CC6600;'>slide Updated Successfully.</span>";	 
                                                    elseif($msg == 3)
                                                        echo "<span style='color:#CC6600;'>slide Deleted Successfully.</span>";	 
                                                    elseif($msg == 4)
                                                        echo "<span style='color:#CC6600;'>slide with this name is already exists.</span>";	 
                                                        
                                                    if($gmsg == 1)
                                                        echo "Please enter all the information."; 
                                                ?>
                                            </span></td>
                                        </tr>
                                        <TR>
                                          <TD><form action="add_promo.php" enctype="multipart/form-data" method="post" name="frm" onSubmit="javascript:return gtg_check();">
                                              <input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
                                              <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
                                                <tr>
                                                  <td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
                                                </tr>                                                
                                               <tr>
												  <td width="17%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Slide Header :</td>
												  <td width="83%" class="f-c"><input name="title" id="title" type="text" size="35" value="<?=stripslashes($title); ?>"></td>
												</tr>
												
												 <tr>
												  <td width="17%" align="right" class="f-c">Slide Sub Header :</td>
												  <td width="83%" class="f-c"><input name="banner_image_path" id="banner_image_path" type="text" size="35" value="<?=stripslashes($banner_image_path); ?>"></td>
												</tr>
										<tr>
                                          <td width="29%" align="right" class="f-c" valign="top">Slide Image :</td>
                                          <td width="71%" class="f-c"><input name="image_path" type="file" id="image_path" />
                                            <?  //echo $image_path;
												
												if($image_path!="" && file_exists("../promo_images/".$image_path))
												{ 
											?>
                                            <img alt="image" src="../include/sample.php?nm=../promo_images/<?=$image_path;?>&mwidth=150&mheight=88" border="0" />
                                            <?											
												}
											?>
                                          </td>
                                        </tr>
										<tr>
                                          <td width="29%" align="right" class="f-c" valign="top">Slide Content   :</td>
                                          <td width="71%" class="f-c">
										  	<?php
												/*$oFCKeditor = new FCKeditor('description') ;
												$oFCKeditor->BasePath = 'FCKeditor/';
												$oFCKeditor->Value = $description;
												$oFCKeditor->Height = 300;
												$oFCKeditor->Create() ;*/
											?>
											
											<textarea name="description" style="width:100%;height:300PX"> <?=$description?>
</textarea> 
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
											<?php /*?><tr>
											  <td width="26%" align="right" class="f-c" valign="top"><span style="color:#FF0000;"></span>Assign to Pages  :</td>
											  <td width="80%" class="f-c" valign="top">
												<label>
												<select style="font-size:12px;" name="navigation[]" id="navigation" multiple="multiple" value="<?=$navigation; ?>" size="7">
																	 <option value="">Select</option>  										
																		<?
																
																echo $q = "select * from staticpage order by id";
																$r = hb_get_result($q);
																$pages_temp_array = split(",",$navigation);
																while($r1 = mysql_fetch_array($r))
																{
																	$page_header1 = stripslashes($r1['page_header']);
																	
																	?>
																		<option value="<?=$r1['id'];?>"<? if(in_array($r1['id'],$pages_temp_array)) { echo 'selected="selected"'; } ?>>
																		  <?=$page_header1;?>
															  </option>
																		<?
																}
																 
															
															?>
												</select>
											  </label></td>
											</tr><?php */?>
                                                  <td>&nbsp;
                                                    <input type="hidden" value="<?=$_GET["id"]; ?>" name="id"></td>
                                                  <td><?php if($_REQUEST['mode'] == 'add') { ?>
                                                    <input name="Submit" type="submit" value="Add" class="send_form"  />
                                                    <?php } else { ?>
                                                    <input name="Submit" type="submit" value="Edit" class="send_form" /></td>
                                                  <?php } ?>
                                                </tr>
                                              </table>
                                              <script language="javascript">
                                                                function gtg_check()
                                                                {	
                                                                    if(document.getElementById("title").value.split(" ").join("") == "")
                                                                    {
                                                                        alert("Please enter the slide title.");
                                                                        document.getElementById("title").focus();
                                                                        return false;
                                                                    }
																	 if(document.getElementById("add_date").value.split(" ").join("") == "")
                                                                    {
                                                                        alert("Please Select Date.");
                                                                        document.getElementById("add_date").focus();
                                                                        return false;
                                                                    }
                                                                    
                                                                }
                                                            </script>
                                            </form></TD>
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
</body>
</html>