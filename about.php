<? include("connect.php");
$id=11;
$promo_query="select * from content_promos where navigation like '%".$id."%'";
$promo_result=mysql_query($promo_query);
$total_promo_rows = mysql_num_rows($promo_result);
?>
<? $a = GetContent(11);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?=Get_MetaData(11);?>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <?php include_once("google_analytics.php");?>
</head>
<body>
    <div class="">
        <? include("header_new.php");?>
        <section class="banner" style="background:url(assets/img/event11.jpg); background-position: center !important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </section>
        <!-- End banner -->
        <section class="about_us">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="about_img">
                            <img src="assets/img/gallery-img7.jpg">
                        </div>
                        <h1 class="border-line-left"><?=$a[0]?></h1>
                        <?=$a[1]?>
                        <div class="event_btn text-left">
                            <a href="login.php">Start an Event</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Start Personal relationships -->
        <section class="plan_expenses">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <? include("right_content.php");?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Personal relationships -->
    </div>
    <div class="bottom">
        <? include("footer.php");?>
    </div>
</body>
</html>
