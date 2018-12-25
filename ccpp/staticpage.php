<?php 
include("connect.php");


$LeftLinkSection = 3;
$pagetitle="Static Page Management";
?>
<?php
	$content = "";
	$name = "";
	$mode = "";
	$id = 0;
	$query = "";
	$redirect = "";
	
	$id=checkNum($_GET['id']);
	if($id!=0)
	{
		
		if($id > 0)
		{
			$fetchquery = "select * from staticpage where id=".$id;
			$result = hb_get_result($fetchquery);
			if(mysql_num_rows($result) > 0)
			{
				while($row = mysql_fetch_array($result))
				{
					$content1 = stripslashes($row['content']); 
					$title = stripslashes($row['title']); 
					$meta_keywords = stripslashes($row['meta_keywords']); 
					$meta_discription = stripslashes($row['meta_discription']); 
					$image_path = stripslashes($row['image_path']);
					$page_header = stripslashes($row['page_header']);
					$alt = stripslashes($row['alt']);					
				}
			}
		}
	}
	
	if(isset($_POST['Submit']))
	{
	
	    $image_path="";
		
		if ($_FILES["image_path"]["error"] > 0)
		{
			//echo "Error: " . $_FILES["full"]["error"] . "<br />";
		}
		else
		{
			 $image_path = rand(1,999).trim($_FILES["image_path"]["name"]); 
			 move_uploaded_file($_FILES["image_path"]["tmp_name"],"../staticpage_images/".$image_path);
		}
		
		$title = addslashes($_POST['title']);
		
		$page_header = addslashes($_POST['page_header']);
		$meta_keywords = addslashes($_POST['meta_keywords']); 
		$meta_discription = addslashes($_POST['meta_discription']);		
		$content = addslashes($_REQUEST['content1']);
		$alt = addslashes($_POST['alt']);
		 				
		
		
		
			$id=checkNum($_POST['id']);				
		$query = "update staticpage set title='".$title."',content='".$content."',meta_keywords='".$meta_keywords."',meta_discription='".$meta_discription."',page_header='".$page_header."',alt='".$alt."'";
	    if($image_path!="")
		{
		deletefull($id);
		$query.=" , image_path='".$image_path."'";
		}
		$query.=" where id=".$id;
		$redirect = "<script language='javascript'>location.href='staticpage.php?id=".$id."&msg=1'</script>";
		hb_get_result($query) or die(mysql_error());
		print $redirect;
			
	}	
function deletefull($iid)
{
	$dquery = "select image_path from staticpage where id=".$iid;
	$dresult = hb_get_result($dquery);
	while($drow = mysql_fetch_array($dresult))
	{
		$dfile = $drow['image_path'];
		if($dfile != "")
		{
			if(file_exists("../staticpage_images/".$dfile.""))
			{
				unlink("../staticpage_images/".$dfile."");
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
<title><?=$SITE_TITLE?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
		alert("Enter Password");
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
            <td align="left" valign="top" width="22%"><? include("left.php"); ?></td>
            <td width="78%" align="left" valign="top">
                <table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
                	
					<? if($_GET["msg"]) { ?>
                            <tr>
                                <TD align="center"><span style="color:#CC6600;">
                           
                            </span></TD>
                           </tr>
                     <? } 
                      if($msg != "")
                        {
                     ?> 
`                         <tr>
                             <TD  align="center">
                        <?
                                    
                        ?>
                             </TD>
                          </tr>
                        <?
                        }
                    ?> 
					<tr><td class="a-l" height="10" align="center"><span style="color:#CC6600;">
				<?php 
					$msg = $_REQUEST['msg'];
					if($msg == 1)
						echo "<span style='color:#CC6600;'>Page Updated Successfully.</span>";	 
					
				?></span></td></tr>
                	<tr>
                    	<td>
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
                          <td align="left" valign="middle" class="title_wrapper_middle"><?=$pagetitle?></td>
                          <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="middle_right_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="left" valign="top">
                          <TABLE  cellSpacing=0 cellPadding=0  border=0 width="90%" align="center">
							<TR><TD width="100%"  class=h1>&nbsp;</TD></TR>
							<TR><TD width="100%"  class=H1><?=utf8_encode($name)?></TD></TR>
							<TR><TD background="images/vdots.gif"></TD></TR>
					
					
					<TR>
					<TD>
						<form action="staticpage.php" method="post" enctype="multipart/form-data" name="frm" onSubmit="return jbj_check();">
					<input type="hidden" name="mode" id="mode" value="<?=GTG_firewall($_GET['mode']);?>" >
                       <input type="hidden" value="<?=checkNum($_GET['id'])?>" name="id">
							<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
								<tr>
									<td class="H4" colspan="2" align="left"><?=$name?></td>
								</tr>
								
								<? if($_REQUEST['id'] != 15 and $_REQUEST['id'] != 16 and $_REQUEST['id'] != 21 and $_REQUEST['id'] != 17 and $_REQUEST['id'] != 18 and $_REQUEST['id'] != 19 and $_REQUEST['id'] != 22 and $_REQUEST['id'] != 24 and $_REQUEST['id'] != 25) {?>
								<tr>
									<td width="25%" align="right" class="f-c"><strong><?php if($_REQUEST['id'] == 26){echo "Register";}else{echo "Page";}?> Header</strong> :</td>
									<td width="79%" class="f-c"><input type="text" name="page_header"  id="page_header" size="50" value="<?=$page_header;?>" >								  </td>
								</tr>
								
                                <tr>
									<td width="25%" align="right" class="f-c"><strong>Browser Bar Title</strong> :</td>
									<td width="79%" class="f-c"><input type="text" name="title"  id="title" size="50" value="<?=$title?>" >								  </td>
								</tr>
								
								<tr>
									<td width="25%" align="right" valign="top" class="f-c"><strong>Meta Keywords</strong> :</td>
									<td width="79%" class="f-c"><textarea name="meta_keywords" cols="60" rows="5"><?=$meta_keywords;?></textarea></td>
								</tr>
								<tr>
									<td width="25%" align="right" valign="top" class="f-c"><strong>Meta Description</strong> :</td>
									<td width="79%" class="f-c"><textarea name="meta_discription" cols="60" rows="5"><?=$meta_discription;?></textarea></td>
								</tr>
								<?php /*?><tr>
									<td width="25%" align="right" class="f-c"><strong>Manage Primary Image / Flash :</strong></td>
									<td width="79%" class="f-c"><input name="image_path" type="file" id="image_path" >
										<? 
											if($image_path!="" && file_exists("../staticpage_images/".$image_path))
											{
											  if(substr($image_path,-4)==".swf")
												{
												?>								 
												<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="400" height="131">
		  <param name="movie" value="../staticpage_images/<?=$image_path;?>">
		  <param name="quality" value="high">
		  <embed src="../staticpage_images/<?=$image_path;?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="88" height="131"></embed>
		</object>  <a href="delete_image.php?id=<?=$_REQUEST['id']?>&name=image_path" onClick="deleteconfirm('Are you sure you want to delete this Image')" >Delete</a>                         <?
		                                       }
											   else
											   	{
		                                    ?>
													<img alt="image" src="../include/sample.php?nm=../staticpage_images/<?=$image_path;?>&mwidth=88&mheight=131" border="0" ><a href="delete_image.php?id=<?=$_REQUEST['id']?>&name=<?=$image_path;?>" onClick="deleteconfirm('Are you sure you want to delete this Image')" >Delete</a>
											<?
												}											
											}
										?>								  </td>
								</tr><?php */?>
								<? }?>
								
                             <? if($_REQUEST['id'] != 1) {?>
								<tr>
								   <td width="25%" align="right" valign="top" class="f-c">
								   	<strong><?php if($_REQUEST['id'] == 26){echo "Register";}else{echo "Page";}?> Content :</strong></td>
									<td width="79%" colspan="2" align="left" class="f-c">
									
									<?php /*?><?php
											$oFCKeditor = new FCKeditor('content1') ;
											$oFCKeditor->BasePath = 'FCKeditor/';
											$oFCKeditor->Value = $content1;
											$oFCKeditor->Height = 300;
											$oFCKeditor->Create() ;
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
									</script>																		</td>
								</tr>
							
								<? }?>
							   								
								<tr>
								
									<td align="center" colspan="2" style="padding-right:400px">
										<input name="Submit" type="submit" class="send_form" value="Edit Page" />									</td>
								</tr> 
						  </table>
						  <script language="javascript">
								function jbj_check()
								{
									if(document.getElementById("title").value.split(" ").join("") == "")
									{
										alert("Please Enter Title.");
										document.getElementById("title").focus();
										return false;
									}
									if(document.getElementById("page_header").value.split(" ").join("") == "")
									{
										alert("Please Enter Page Header.");
										document.getElementById("page_header").focus();
										return false;
									}
									return true;
								}
							</script>
						
						</form>					</TD>
				</TR>
			</TABLE>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" valign="top">&nbsp;</td>
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