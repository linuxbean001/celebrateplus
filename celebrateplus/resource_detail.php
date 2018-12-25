<? include("connect.php");
header("Cache-Control: public");
?>
<? 
	$pg_nm = "resources";
	$resource_id = $_REQUEST['res_id'];
	$resour_qry = hb_get_result("select * from blog_posts where id = ".$resource_id."");
	$res_row = mysql_fetch_object($resour_qry);
	
	$res_name = stripslashes($res_row->blog_title);
	$res_post_date = stripslashes($res_row->post_date);
	$res_post_date = date("m-d-Y",strtotime($res_post_date));
	$res_full_content = stripslashes($res_row->full_content);
?>
<?
	if(isset($_REQUEST['Submit_Comment']))
	{
		include("securimage.php");
		$security_code = $_REQUEST['security_code'];
		$security_code_image = new Securimage();
		$valid = $security_code_image->check($security_code);
		if($valid != true) 
		{
			?>
				<script language="javascript">
					alert("The security code that you entered is incorrect. Please re-enter the security code.");
					window.history.go(-1);
				</script>
			<?
		}
		else
		{
			$desc = addslashes($_REQUEST['comment']);
			$name = addslashes($_REQUEST['name']);
			$email = $_REQUEST['email'];
			
			$in_comm = hb_get_result("insert into blog_post_comments set add_date=now(), post_id=".$resource_id.",description='".$desc."',name='".$name."',email='".$email."'");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(8);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg"><?=$res_name?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_left">
                            	<div class="tab_box_bg_inner_left_text">
                                <div class="date_mon"><?=$res_post_date?></div>
                                <?=$res_full_content?><br /><br /><br />
                                </div>
								<div class="blog_box_top_main">
                            
							<?
								$blog_comment_query="select * from blog_post_comments where post_id=$resource_id order by add_date desc";
																
								$blog_comment_result=hb_get_result($blog_comment_query);
								while($blog_comment_row=mysql_fetch_array($blog_comment_result))
								{
							?>	
							
							<div class="blogde_box_text_main">
                            	<div class="blogde_box_text_title"><?=$blog_comment_row["name"];?></div>
                                <div class="blogde_box_text_date">Posted On: <?=date("m-d-Y",strtotime($blog_comment_row["add_date"]));?></div>
                                <div class="blogde_box_text"><?=$blog_comment_row["description"];?></div>
                            </div>
							<?
								}
							?>
							
                         
                        </div>
						<div>&nbsp;</div>
								<form name="Comments" id="Comments" method="post" onSubmit="javascript: return gtg_check12()">
                                <div class="recous_form_main">
                                	<div class="recous_form_title">Submit a Comment:</div>
                                    <div class="recous_form_left">
                                    	<div class="recous_form_left_main">
                                        	<div class="recous_form_left_name">Name : <span>*</span></div>
                                            <div class="recous_form_left_input_box">
                                            	<div class="recous_form_left_input"><input type="text" name="name" id="name" /></div>
                                            </div>
                                        </div>
                                        <div class="recous_form_left_main">
                                        	<div class="recous_form_left_name">Email : <span>*</span></div>
                                            <div class="recous_form_left_input_box">
                                            	<div class="recous_form_left_input"><input type="text" id="email" name="email" /></div>
                                            </div>
                                        </div>
										<div class="recous_form_left_main" style="width:350px;">
                                        	<div class="recous_form_left_name" style="line-height:20px;">Security Code : <span>*</span></div>
                                            <div class="recous_form_left_input_box">
                                            	<div class="recous_form_left_input"><input type="text" name="security_code" id="security_code" />
												<img id="siimage" align="left" src="securimage_show.php?sid=<?php echo md5(time()) ?>" height="30" width="150" />&nbsp;
												<a tabindex="-1" href="#" onClick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img src="images/refresh.gif" border="0" height="30" width="30"></a>
												</div>
                                            </div>
                                        </div>
										
										
                                        <div class="recous_form_left_main" style="padding-top:36px;">
                                            <div class="recous_form_left_input_box">
                                            	<input type="submit" class="submit_btn" name="Submit_Comment" id="Submit_Comment" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recous_form_right">
                                    	<div class="recous_form_right_main">
                                        	<div class="recous_form_right_name">Comment : <span>*</span></div>
                                            <div class="recous_form_right_input_box">
                                            	<div class="recous_form_right_input"><textarea name="comment" id="comment"></textarea></div>
                                            </div>
                                        </div>
										 
                                    </div>
                                </div>
								</form>
                            </div>
                        	<div class="tab_box_bg_inner_right">
                            	<div class="tab_box_bg_inner_right_bg" style="min-height:469px;">
                                	<div class="tab_right_text_main">
                                    	<div class="tab_right_text_title">Select a Category</div>
                                        <div class="tab_right_text">
                                        	<div class="catg_link">
                                            	<ul>
                                                	<? $res_cat = hb_get_result("select * from blog_categories order by display_order");
													while($res_cat_row = mysql_fetch_object($res_cat))
													{
														$res_name = stripslashes($res_cat_row->category_name);
														$res_id = stripslashes($res_cat_row->id);
													?>
                                                	<li><a href="resources.php?cat_id=<?=$res_id?>"><?=$res_name;?></a></li>
                                                    <? }?>
                                                </ul>
                                            </div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
<script language="javascript" >
	function gtg_check12()
	{
				if(document.getElementById("name").value.split(" ").join("") == "")
				{
					alert("Please enter your name.");
					document.getElementById("name").focus();
					return false;
				}
				if(document.getElementById("email").value.split(" ").join("") == "")
				{
					alert("Please enter your email address.");
					document.getElementById("email").focus();
					return false;
				}	
				else
				{
					var emailPat=/^(.+)@(.+)$/
					var matchArray=document.getElementById("email").value.match(emailPat)
				
					if (matchArray==null) 
					{
						alert("Please enter valid email.")
					document.getElementById("email").focus();
					return false;
					}
			
				}
				if(document.getElementById("comment").value.split(" ").join("") == "")
				{
					alert("Please enter your comment.");
					document.getElementById("comment").focus();
					return false;
				}
				if(document.getElementById("security_code").value.split(" ").join("") == "")
				{
					alert("Please enter the security code displayed.");
					document.getElementById("security_code").focus();
					return false;
				}
				
				return true;	
	
	}

</script>
