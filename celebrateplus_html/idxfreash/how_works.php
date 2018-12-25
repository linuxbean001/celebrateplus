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
                    <div class="row step1_row">
                        <div class="col-md-3 left_bg">
                            <div class="step1_left">
                                <p>#01</p>
                                <h3>Invite!</h3>
                            </div>
                        </div>
                        <div class="col-md-4 step1_bg">
                            
                        </div>
                        <div class="col-md-5 right_step1_div">
                            <div class="clearfix right_step1_txt">
                                <p>Create and send an invitation for your guests for that special event that you are carefully planning.</p>
                                <p>CelebratePlus will help you design a beautiful invitation to share with your guests and will also give you a dashboard where you can see and control who has already funded your event.</p>
                                <p>CelebratePlus will help you make a fun, competitive campaign for your funds. You will be able to assign different levels of rewards to your sponsors and you are in complete control to share it or keep it private.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row step1_row">
                        
                        <div class="col-md-3 step2_bg">
                            
                        </div>
                        <div class="col-md-6 right_step1_div right_step2_div">
                            <div class="clearfix right_step1_txt right_step2_txt">
                                <p>Are you paying for your special event? How about getting some help from the people more interested in your happiness. How about if you let us raise money on your behalf, so you can spend that money on the celebration expenses or in all your new needs. That is CelebratePlus: An opportunity to be practical with money, maintaining your lifestyle and traditions intact.</p>
                                <p>We will ask your guests to collaboratively fund your event to help you collect money to cover your expenses. We will take care of collecting the money in your name, so you don’t have to bother. We will never touch your money since is directed transferred to your PayPal account.</p>
                                <p>You are able to suggest a minimum necessary contribution or leave the option open to your guests. We will give you fun tools to incentivize the contributions. Also you have complete control if you want to make public or private the people who have contributed. You can share your invitation in facebook or twitter to reach more of your friends.</p>
                            </div>
                        </div>
                        <div class="col-md-3 left_bg left_bg2">
                            <div class="step1_left step2_left">
                                <p>#02</p>
                                <h3>Get Funded!</h3>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="row step1_row">
                        <div class="col-md-3 left_bg left_bg3">
                            <div class="step1_left step3_left">
                                <p>#03</p>
                                <h3>Celebrate!</h3>
                            </div>
                        </div>
                        <div class="col-md-4 step3_bg">
                            
                        </div>
                        <div class="col-md-5 right_step1_div right_step3_div">
                            <div class="clearfix right_step1_txt right_step3_txt">
                                <p>With the money received in your account in advance to the event you can pay for whatever you need. This way you can enjoy your celebration and have extra resources to set up your house, pay debt, or whatever you need!</p>
                            </div>
                        </div>
                    </div>
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
                    <h1>Did you know?</h1>
                    <p>"Did you know that thanks to our platform you can raise even more than your stated goal!?"</p>
                    <p>"Did you know that even if you don't reach your goal all the money raised is yours for your event!?"</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <h1>Reach out to a friend!</h1>
                    <p>"More people everyday reach for the support of friends and family to finance their special celebrations so they can spend their money on a new home, or a car, that special trip, etc!"</p>
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
