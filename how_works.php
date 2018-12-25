<? 
    include("connect.php");
	$id=2;
	$promo_query="select * from content_promos where navigation like '%".$id."%'";
	$promo_result=mysql_query($promo_query);
	$total_promo_rows = mysql_num_rows($promo_result);
?>
<?
$pg_nm = "how_works";
$a = GetContent(2);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(2);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="">
        	<? include("header_new.php");?>
            <!-- Start banner -->
        <section class="banner" style="background:url(assets/img/banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>
        </section>

        <section class="how_it_works">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="border_line_center text-center"><?=$a[0]?></h1>
                    <?=$a[1]?>
                   
                    <div class="event_btn text-left">
                        <a href="login.php">Start an Event</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Start Did you know? section -->
    <section class="plan_expenses">
        <div class="container">
            <div class="row" style="margin-bottom:30px;">
                <div class="col-md-9">
                        <? include("right_content.php");?>
                </div>
            </div>
            
        </div>
    </section>
    <!-- End Did you know? section -->
    

        <!-- End banner -->
            <!--  <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg"><?=$a[0]?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_left" <?php if(!($total_promo_rows > 0)) {?> style="width:966px" <?php } ?>>
                            	<div class="tab_box_bg_inner_left_text" <?php if(!($total_promo_rows > 0)) {?> style="width:935px" <?php } ?>>
                                <?=$a[1]?>
                                </div>
                            </div>
							<?php if($total_promo_rows > 0) {?>
                        		<div class="tab_box_bg_inner_right">
									<? //include("right_content.php");?>
								</div>
							<?php } ?>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
                    </div>
                </div>
            </div>   -->
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
