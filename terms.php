<? include("connect.php");
	$id=14;
	$promo_query="select * from content_promos where navigation like '%".$id."%'";
	$promo_result=mysql_query($promo_query);
	$total_promo_rows = mysql_num_rows($promo_result);
?>
<? 
$pg_nm = "how_works";
$a = GetContent(14);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(14);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="">
        	<? include("header_new.php");?>
        <section class="banner" style="background:url(assets/img/feature_banner.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="resource feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h1 class="border-line-left"><?=$a[0]?></h1>
                  <?=$a[1]?>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- End resources section -->
           
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
