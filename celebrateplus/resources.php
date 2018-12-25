<? include("connect.php");

	$res_cat = hb_get_result("select * from blog_categories order by display_order");
	$total_category_rows = mysql_num_rows($res_cat);

	$id=8;
	$promo_query="select * from content_promos where navigation like '%".$id."%'";
	$promo_result=mysql_query($promo_query);
	$total_promo_rows = mysql_num_rows($promo_result);
	
	$allow_full_width = false;
	if(!($total_category_rows > 0) && !($total_promo_rows > 0))
	{ $allow_full_width = true; }

?>
<? 
$pg_nm = "resources";
$a = GetContent(8);?>
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
                    	<div class="inner_title_bg"><?=$a[0]?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_left" <?php if($allow_full_width) {?> style="width:966px" <?php } ?>>
                            	<div class="tab_box_bg_inner_left_text" <?php if($allow_full_width) {?> style="width:935px" <?php } ?>>
                                <?=$a[1]?>
								<br /><br />
								
								<?
									if($_REQUEST['cat_id'] > 0)
									{
									 	$resour_qry = hb_get_result("select * from blog_posts where category_id = ".$_REQUEST['cat_id']."");
									}
									else
									{
										$resour_qry = hb_get_result("select * from blog_posts");
									}
								   while($get_dt = mysql_fetch_object($resour_qry))
								   {
								   		$res_nm = stripslashes($get_dt->blog_title);
										$res_sum = stripslashes($get_dt->post_summary);
										$res_id = stripslashes($get_dt->id);
								   ?>
                                <div class="res_blog_main">
                                <div class="recous_form_title"><a href="resource_detail.php?res_id=<?=$res_id?>"><?=$res_nm?></a></div>
                                <?=$res_sum?>
                                <div class="shra_main">
                                	<div class="shra_main_link">
                                    <a href="resource_detail.php?res_id=<?=$res_id?>" style="padding-left:0;">Read Full Story</a>|
                                    <a href="#">View Comments (#)</a>|
                                    <a href="#">Share</a>
                              	</div>
                                </div>
                                </div>
								<? }?>
                           
                                </div>
                            </div>
							<?php if($total_promo_rows > 0) {?>
                        		<div class="tab_box_bg_inner_right">
									<? include("right_content.php");?>
								</div>
							<?php } ?>
							<?php if($total_category_rows > 0) {?>
                        	<div class="tab_box_bg_inner_right">
                            	<div class="tab_box_bg_inner_right_bg_right_content">
                                	<div class="tab_right_text_main">
                                    	<div class="tab_right_text_title">Select a Category</div>
                                        <div class="tab_right_text">
                                        	<div class="catg_link">
                                            	<ul>
												<? 
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
					<?
					$get_add_query = "select * from ad where location like '%Resources Right Column%' order by rand() limit 1";
					$get_add_result = hb_get_result($get_add_query) or die(mysql_error());
					if(mysql_num_rows($get_add_result) > 0)
					{
					?>
					<div style="float:left; text-align:center; width:256px; padding:15px 0px 15px 0px; ">
					<?
					
						while($get_add_row = mysql_fetch_array($get_add_result))
						{
							 
							 ?>
							 <a href="<?=$get_add_row['link'];?>" target="_blank"><img src="advertiser_images/<?=$get_add_row['image_path'];?>" width="180" height="150" border="0" /></a>
							 <?
						}
					
					?>
				
					</div>
					<?
					}
					?>
                                    </div>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
				<?
				$get_add_query2 = "select * from ad where location like '%Resources Footer%' order by rand() limit 1";
					$get_add_result2 = hb_get_result($get_add_query2) or die(mysql_error());
					if(mysql_num_rows($get_add_result2) > 0)
					{
				?>
				<div class="promo_title" style="padding-top:20px; height:90px;">
				<?
					
						while($get_add_row2 = mysql_fetch_array($get_add_result2))
						{
							 
							 ?>
							 <a href="<?=$get_add_row2['link'];?>" target="_blank">
							 <img src="advertiser_images/<?=$get_add_row2['image_path'];?>" width="923" height="90" border="0" />
							 </a>
							 <?
						}
				?>
				</div>
				<?
				}
				?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
