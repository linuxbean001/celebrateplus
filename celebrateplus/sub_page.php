<? include("connect.php");
?>
<? 
	$sub_id = $_REQUEST['id'];
	$sub_qry = hb_get_result("select * from subpage where id= $sub_id");
	$sub_row = mysql_fetch_object($sub_qry);
	$sub_header = stripslashes($sub_row->page_header);
	$sub_content = stripslashes($sub_row->content1);
	$static_title = stripslashes($sub_row->browserbar);
	$metakeyword = stripslashes($sub_row->metakeyword);
	$metadescription = stripslashes($sub_row->metadescription);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$static_title?></title>
<meta name="keywords" content="<?=$metakeyword?>" />
<meta name="description" content="<?=$metadescription?>" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg"><?=$sub_header;?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_left">
                            	<div class="tab_box_bg_inner_left_text">
                                <?=$sub_content;?>
                                </div>
                            </div>
                        	<div class="tab_box_bg_inner_right">
                            	<div class="tab_box_bg_inner_right_bg">
                                	<div class="tab_right_text_main">
                                    	<div class="tab_right_text_title">Sub Header</div>
                                        <div class="tab_right_text">
                                        Sed imperdiet tempus neque non
                                        eleifend. Nunc pretium, dolor a ve
                                        stibulum dapibus, leo urna digniss
                                        im felis, non cursus risus quam at
                                        nunc. Aliquam eu risus sed sem la
                                        oreet eleifend. Etiam facilisis mole
                                        stie nulla vel gravida. Suspendisse
                                        vel velit orci, elementum mattis
                                        enim. Suspen disse nec ligula nisl.
                                        Vestibulum pretium, turpis ut auct
                                        or feugiat, urna urna elementum
                                        neque, non malesuada nisl eros te
                                        mpor enim. Pellentesque et
                                        dapibus est.
									</div>
									<?
					$get_add_query = "select * from ad where location like '%Sub Page Right Column%'  order by rand() limit 1";
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
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
						<?
				$get_add_query2 = "select * from ad where location like '%Sub Page Footer%' order by rand() limit 1";
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
