<?php 
require_once("connect.php");


$LeftLinkSection = 4;
$pagetitle="Blog Detail";
?>
<?php
	
	$description = "";
	$img_path="";
	$post_id=0;
	
	$mode = "";
	$id = 0;
	$query = "";
	$redirect = "";
	
	
	
	$post_id=addslashes($_REQUEST["post_id"]);
	
	if($_REQUEST["mode"]=="delete")
	{	
		mysql_query("delete from blog_post_comments where id=".$_REQUEST["id"]);
	}
	else if($_REQUEST["id"]>0)
	{
		//$query = "udpate blog_post_comments set description='".$description."' where id=".$_REQUEST["id"];
		$result=mysql_query("select * from blog_post_comments where id=".$_REQUEST["id"]);
		$row=mysql_fetch_array($result);
		$description = stripslashes($row['description']);
	}
	
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Add')
	{
		$id = $_REQUEST['id'];
		
		if(isset($_REQUEST['mode']))
		{
			$description = addslashes($_REQUEST['description']);
				
			$query = "insert into blog_post_comments (description,post_id,name,add_date) values('".$description."','".$post_id."','Admin',now());";
				
			mysql_query($query) or die(mysql_error());
			$q1 = "select * from blog_posts where id=".$_REQUEST['post_id'];
			
			$r = mysql_query($q1);
			$ro = mysql_fetch_array($r);
			
			$blog_title = stripslashes($ro["blog_title"]);
			
			
			
			
			
			
			print $redirect;
		}	
	}
	if($_REQUEST['comment_id'] > 0)
	{
		$description = GetValue("blog_post_comments","description","id",$_REQUEST['comment_id']);
	}
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Edit')
	{
		$comment_id = $_REQUEST['comment_id'];
		$post_id = $_REQUEST['post_id'];
		
		if(isset($_REQUEST['mode']))
		{
			$description = addslashes($_REQUEST['description']);
				
			$query = "update blog_post_comments set
					 `description` = '$description'
					 where `id` = '$comment_id' and `post_id` = '$post_id'";
					 				
			mysql_query($query) or die(mysql_error());
			$q1 = "select * from blog_posts where id=".$_REQUEST['post_id'];
			
			$r = mysql_query($q1);
			$ro = mysql_fetch_array($r);
			
			$blog_title = stripslashes($ro["blog_title"]);
			location("blog_detail.php?post_id=".$_REQUEST['post_id']);
		}	
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
                                                        echo "<span style='color:#CC6600;'>Blog Added Successfully.</span>";	 
                                                    elseif($msg == 2)
                                                        echo "<span style='color:#CC6600;'>Blog Updated Successfully.</span>";	 
                                                    elseif($msg == 3)
                                                        echo "<span style='color:#CC6600;'>Blog Deleted Successfully.</span>";	 
                                                    elseif($msg == 4)
                                                        echo "<span style='color:#CC6600;'>Blog with this name already exists.</span>";	 
                                                        
                                                    if($gmsg == 1)
                                                        echo "Please enter all the information."; 
                                                ?>
                                            </span></td>
                                        </tr>
					<? 
						$forum_detail=mysql_query("select * from blog_posts where id='".$post_id."' order by blog_title desc") or die(mysql_error());
						while($forum_row=mysql_fetch_array($forum_detail))
						{
					?>
										<tr><td>&nbsp;</td></tr>
										<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="pm_table" style="border-color: #333333;
border-style: solid;
border-width: 1px;">
									<tr class="menu-a" style="background-color: #FF781E;
color: #FFFFFF;
font-weight: bold;
height: 25px;
padding: 0 0 0 10px;
text-transform: uppercase;">
										<td style="padding-left:5px">
											<font color="#FFFFFF"><strong><?=stripslashes($forum_row["blog_title"]);?> ( By :</strong> <? if($forum_row["posted_by"]==0) { echo "Admin"; } 
										else { 
												$user_result=mysql_query("select * from subscriber where id=".$forum_row["posted_by"]);
												$user_row=mysql_fetch_array($user_result);
												echo stripslashes($user_row["email"])." (".stripslashes($user_row["email"])." )";
											 } ?> )</font>
										</td>
										<td align="right" style="padding-right:5px">
											<font color="#FFFFFF"><strong>Date :</strong> <?=date('Y-m-d',strtotime(stripslashes($forum_row["add_date"])))?><font color="#FFFFFF">
										</td>
									</tr>
									<tr>
										<td height="15px">
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-left:5px; padding-right:5px"><p align="justify">
										<?=stripslashes($forum_row["full_content"])?>
										</p>
										</td>
									</tr>
									
									
									<tr>
										<td height="15px">
										</td>
									</tr>
								</table></td></tr>
					<?	} ?>
					<?
						$forum_detail=mysql_query("select *,DATE_FORMAT(add_date,'%b, %d %Y %h:%m:%s') AS add_date1 from blog_post_comments where post_id=".$post_id." order by add_date desc");
						while($forum_row=mysql_fetch_array($forum_detail))
						{
					?>
										<tr><td>&nbsp;</td></tr>
										<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="pm_table" style="border-color: #333333;
border-style: solid;
border-width: 1px;">
									<tr class="menu-a" style="background-color: #37A2DA;
color: #FFFFFF;
font-weight: bold;
height: 25px;
padding: 0 0 0 10px;
text-transform: uppercase;">
										<td style="padding-left:5px">
											<font color="#FFFFFF"><strong>Replied By :</strong><?=stripslashes($forum_row["name"]);?></font>
										</td>
										<td align="right" style="padding-right:5px">
											<font color="#FFFFFF"><strong>Date :</strong> <?=stripslashes($forum_row["add_date1"])?></font>
										</td>
									</tr>
									<tr>
										<td height="15px">
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-left:5px; padding-right:5px"><p align="justify">
										<?=stripslashes($forum_row["description"])?>
										</p>
										</td>
									</tr>
									<? if($forum_row["img_path"]!="" && file_exists("../ticket_images/".stripslashes($forum_row["img_path"])) ) { ?>
									<tr>
										<td align="right" colspan="2" style="padding-left:5px; padding-right:5px">
										<a href="<? echo "../ticket_images/".stripslashes($forum_row["img_path"])?>" target="_blank">Click Here</a> to download attached file.
										</td>
									</tr>
									<? } ?>
									<tr>
										<td colspan="2" align="right" style="padding-right:10px">
											  <input name="edit_button" type="button" class="send_form" onClick="window.location.href='blog_detail.php?post_id=<?=$_REQUEST['post_id'];?>&comment_id=<?=$forum_row['id'];?>'" value="Edit">
											  <input name="button2" type="button" class="send_form" onClick="deleteconfirm('Are you sure you want to delete this comment?. \n','blog_detail.php?mode=delete&post_id=<?=$_REQUEST["post_id"]?>&id=<?php echo($forum_row["id"]); ?>');" value="Delete"> 
										</td>
									</tr>
									<tr>
										<td height="15px">
										</td>
									</tr>
								</table></td></tr>
					<?	} ?>
										<tr><td>&nbsp;</td></tr>	
                                        <TR>
                                          <TD><form method="post" enctype="multipart/form-data" name="frm">

				  <input type="hidden" name="post_id" id="post_id" value="<?= $_REQUEST['post_id']; ?>" >
				  <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput" style="border-color: #333333;
border-style: solid;
border-width: 1px;">
					<tr>
					  <td colspan="2" align="right" class="menu-a" style="background-color: #37A2DA;
color: #FFFFFF;
font-weight: bold;
height: 25px;
padding: 0 0 0 10px;
text-transform: uppercase;"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
					</tr>
					<tr>
					  <td class="H4" colspan="2" align="left"><?=$pagetitle?>
						Information </td>
					</tr>
					<tr>
					  <td width="11%" align="right" class="f-c" valign="top">Description :</td>
					  <td width="89%" class="f-c">
					  <?php /*?><?php
				  	
						$oFCKeditor = new FCKeditor('description') ;
						$oFCKeditor->BasePath = 'FCKeditor/';
						$oFCKeditor->Value = $description;
						$oFCKeditor->Height = 500;
						$oFCKeditor->Create() ;
						
					  ?><?php */?>
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
					<? /*
					<tr>
					  <td width="11%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Image :</td>
					  <td width="89%" class="f-c"><input name="img_path" type="file" id="img_path"> &nbsp;</td>
					</tr>
					<?php if($img_path!="" && file_exists('../ticket_images/'.$img_path)) { ?>
					<tr>
						<TD>&nbsp;</TD>
						<TD>
						
						<img style="padding-left:25px;" src="../include/sample.php?nm=<? echo '../ticket_images/'.$img_path; ?>&mwidth=200&mheight=200" border="0" hspace="8" />
						</TD>
					</tr>
					<?php } ?>			
					*/ ?>
					<tr>
					  <td>&nbsp;
					   </td>
					  <td>
					  	<?
							if($_REQUEST['comment_id'] > 0)
							{
						?>
							<input name="Submit" type="submit" class="send_form" value="Edit" onClick="return sam_check();"/>  
							<input type="hidden" name="mode" id="mode" value="Edit" >                  
						<?
							}
							else
							{
						?>
							<input name="Submit" type="submit" class="send_form" value="Add" onClick="return sam_check();"/> 
							<input type="hidden" name="mode" id="mode" value="Add" >                                     
						<?
							}
						?>
					  </td>
					</tr>
				  </table>
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
<script language="javascript" type="text/javascript">
	function sam_check()
	{
		if(document.getElementById("cid").value == "")
		{
			alert("Please select a blog category.");
			document.getElementById("cid").focus();
			return false;
		}
		if(document.getElementById("title").value == "")
		{
			alert("Please enter the header of blog post.");
			document.getElementById("title").focus();
			return false;
		}
		if(document.getElementById("add_date").value == "")
		{
			alert("Please select the posting date.");
			document.getElementById("add_date").focus();
			return false;
		}
		return true;
	}
	
</script>
</body>
</html>