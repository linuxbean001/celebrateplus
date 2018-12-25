<? 
	include("connect.php");
	$id=3;
	$promo_query="select * from content_promos where navigation like '%".$id."%'";
	$promo_result=mysql_query($promo_query);
	$total_promo_rows = mysql_num_rows($promo_result);
?>
<? 
	$pg_nm = "feature";
	$id=3;
$a = GetContent(3);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(3);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="">
        <? include("header_new.php");?>
       
        <!-- Start banner -->
    <section class="banner" style="background:url(assets/img/feature_banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End banner -->
    
    <!-- Start resources section -->
    <section class="resource feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="border-line-left"><?=$a[0]?></h1>
                     <?=$a[1]?>
                    <!-- <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p>
                    <ul>
                        <li><img src="assets/img/arrow_icon.png">CelebratePlus has been designed as a tool for you, the person who wants to have a special celebration and thinks that resources are scarce and the best way to use it is to involve friends and family and ask for their collaboration in crowd funding your event.</li>
                        <li><img src="assets/img/arrow_icon.png">We want you to concentrate in having a good time and leave to CelebratePlus the task to invite your guests, collect the funds to pay for your event, sent reminders and give you access to your funds.</li>
                        <li><img src="assets/img/arrow_icon.png">You will have a dashboard to see the progress of your event campaign. We will be sending the reminders and collecting the funds on your behalf so you don’t have that hassle.</li>
                        <li><img src="assets/img/arrow_icon.png">We have designed tools to incentivize the collaboration of your guests by –optionally- giving certain levels of sponsorship, that can be accessed by your guests, if you want.</li>
                        <li><img src="assets/img/arrow_icon.png">We are working with companies to offer you discounts and special access to everything you need for your special celebration and beyond.</li>
                        <li><img src="assets/img/arrow_icon.png">We have designed and built CelebratePlus thinking of you, your money, your needs and how to help save that money and time. If there is any question or comments that you want to share with us, or just to say “hello” send us a message to: <a href="#">Contact@CelebratePlus.com</a></li>
                    </ul> -->
                    <div class="event_btn text-left">
                        <a href="login.php">Start an Event</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End resources section -->
    
    <!-- Start From our insiders! section -->
    <section class="plan_expenses">
        <div class="container">
            <div class="row" style="margin-bottom:30px;">
              
                 <div class="col-md-9">
                   <? include("right_content.php");?>
                    <!-- <h1>From our insiders!</h1>
                    <p>"Studies show that a shorter campaign, no less than 30 days and no more than 60 days, has 35% more chance of success"</p>
                    <p>"Studies show that if you share your campaign on facebook and twitter your chances of success grow exponentially!"</p> -->
                </div>
            </div>
          <!--   <div class="row">
                <div class="col-md-9">
                    <h1>Plan your expenses</h1>
                    <p>"Crowdfunding money for your event is not considered a loan, is considered a gift or a donation and the organizer is responsible for efficiently spending the money raised"</p>
                </div>
            </div> -->
        </div>
    </section>
    <!-- End From our insiders! section -->
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
