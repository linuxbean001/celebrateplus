<?php 
include("connect.php");

$LeftLinkSection =6;
$pagetitle="Advertiser";
?>
<?php
	$title = "";	
	$content = "";
	$link_name = "";
	$content_id = 0;
	$mode = "";
	$id = 0;
	$query = "";
	$redirect = "";
	$c = 0;
	$fetchquery = "select count(*) as c from advertiser";
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
			$c = stripslashes($row['c']);	
			$c = $c + 1;
		}
	}
	if(isset($_REQUEST['id']))
	{
		$id = checkNum($_REQUEST['id']);
		if($id > 0)
		{
			$id = checkNum($_REQUEST['id']);
			$fetchquery = "select * from advertiser where id=".$id;
			$result = hb_get_result($fetchquery);
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_array($result))
				{
					$name = stripslashes($row['name']);	
					$content = stripslashes($row['content']);	
					$image_path = stripslashes($row['image_path']);	
					
				}
			}
		}
	}
	
	if(isset($_REQUEST['Submit']))
	{
		$name = addslashes($_REQUEST['name']); 
		$content = addslashes($_REQUEST['content']);	
		
			
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
										
						$query = "insert into advertiser(name,image_path,content,displayorder) values('".$name."','".$image_path."','".$content."','".$c."')";  
						
						hb_get_result($query) or die(mysql_error());
						?>
                       <script language="javascript"> location.href='manage_advertiser.php?msg=1'; </script>
<?
						exit;
					break;
					
					case 'edit' :
						
						$query = "update advertiser set name='".$name."',content='".$content."'"; 
						
						  
						if($image_path!="")
						{
						deleteimage(checkNum($_REQUEST['id']));
						$query.=" , image_path='".$image_path."'";
						}
						$query.=" where id=".checkNum($_REQUEST['id']);
						hb_get_result($query) or die(mysql_error());
						
						?>
                       <script language="javascript"> location.href='manage_advertiser.php?msg=2'; </script>
<?
						exit;
					break;
				
				}	
			}
	
	}	
	
	if(isset($_REQUEST['mode']))
	{
		switch($_REQUEST['mode'])
		{
			case 'delete' :
			    deleteimage(checkNum($_REQUEST['id']));
			    $query = "delete from advertiser where id=".checkNum($_REQUEST['id']);     
				hb_get_result($query) or die(mysql_error());
				?>
<script language="javascript"> location.href='manage_advertiser.php?msg=3'; </script>
<?
				exit;		
			break;
		}
		
	}	
	
function deleteimage($iid)
	{
		$dquery = "select image_path from advertiser where id=".$iid;
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE?></title>
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

<body onLoad="MM_preloadImages('images/main_controls.jpg','images/server_settings_o.jpg','images/product_o.jpg','images/usear_o.jpg','images/seo._o.jpg','images/static_page_o.jpg','images/inactive_tab_o.jpg','images/product_buttom_o.jpg','images/last_one_o.jpg')">
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
                                                        echo "<span style='color:#CC6600;'>Resource Category Added Successfully.</span>";	 
                                                    elseif($msg == 2)
                                                        echo "<span style='color:#CC6600;'>Resource Category Updated Successfully.</span>";	 
                                                    elseif($msg == 3)
                                                        echo "<span style='color:#CC6600;'>Resource Category Deleted Successfully.</span>";	 
                                                    elseif($msg == 4)
                                                        echo "<span style='color:#CC6600;'>Resource Category with this name already exists.</span>";	 
                                                        
                                                    if($gmsg == 1)
                                                        echo "Please enter all the information."; 
                                                ?>
                                            </span></td>
                                        </tr>
                                        <TR>
                                          <TD><form action="add_advertiser.php" method="post" enctype="multipart/form-data" onSubmit="return gtg_check();" name="frm">
              <input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
              <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
                <tr>
                  <td class="H4" colspan="2" align="left"><?=$name?></td>
                </tr>            
			
                <tr>
                  <td width="26%" align="right" class="f-c"><strong><span style="color:#FF0000;">*</span>Advertiser Name</strong> :</td>
                  <td width="74%" class="f-c"><input type="text" name="name" id="name" size="30" value="<?=$name;?>" />                  </td>
                </tr>
				
				<?php /*?><tr>
                  <td width="26%" align="right" class="f-c"><strong>Promotion Image</strong> :</td>
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
                </tr><?php */?>
                <?php /*?><tr>
                  <td width="26%" align="right" class="f-c"><strong>Image</strong> :</td>
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
                </tr><?php */?>
				<tr>
                  <td width="26%" align="right" valign="top" class="f-c"><strong>Advertiser Notes </strong> :</td>
                  <td width="74%" colspan="2" class="f-c">
				 <?php /*?> <?php
						$oFCKeditor = new FCKeditor('content') ;
						$oFCKeditor->BasePath = 'FCKeditor/';
						$oFCKeditor->Value = $content;
						$oFCKeditor->Height = 300;
						$oFCKeditor->Create() ;	
					?><?php */?>
					<textarea name="content" style="width:100%;height:300PX"> <?=$content?></textarea> 
					<script type="text/javascript">
					//<![CDATA[

					var editor = CKEDITOR.replace( 'content' ,{

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
                  <td>&nbsp;
                    <input type="hidden" value="<?=$_REQUEST["id"]; ?>" name="id"></td>
                  <td><?php if($_REQUEST['mode'] == 'add') { ?>
                    <input name="Submit" type="submit" class="add_new" value="Add" />
                    <?php } else { ?>
                    <input name="Submit" type="submit" class="add_new" value="Edit" /></td>
                  <?php } ?>
                </tr>
              </table>
              <script language="javascript">
								function gtg_check()
								{
									
									if(document.getElementById("name").value.split(" ").join("") == "")
									{
										alert("Please enter an advertiser name.");
										document.getElementById("name").focus();
										return false;
									}
									
								/*if(document.getElementById("plink").value.split(" ").join("") == "")
									{
										alert("Please enter Promotion Link.");
										document.getElementById("plink").focus();
										return false;
									}									
								if(document.getElementById("link_target").value.split(" ").join("") == "")
									{
										alert("Please enter Promotion Link Target.");
										document.getElementById("link_target").focus();
										return false;
									}*/								
								
								
									
									return true;
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