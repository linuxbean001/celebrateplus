<? include("connect.php"); ?>
<? $a = GetContent(1);?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/SpryTabbedPanels.js" type="text/javascript"></script>
<!-- Slide Show Starts -->
<link rel="stylesheet" href="css/screen.css" media="screen, projection">

<!--<script src="js/jquery-latest.js"></script>-->

<!--<script src="js/stepcarousel.js"></script>
<script src="js/stepcarousel_002.js"></script>-->
<!-- Slide Show Ends -->
<?php include_once("google_analytics.php");?>
</head>
<body>
<div class="">
<?php include("header_new.php"); ?>
	<!-- Start slider section -->
	<?php 

			$slide_query = "select * from promo where active = 1 order by displayorder";

				$slide_result = hb_get_result($slide_query);

				$slide_total = mysql_num_rows($slide_result);

				if(false && $slide_total > 1)
				{

					while($slide_data = mysql_fetch_array($slide_result))
					{
						 $slide_id = stripslashes($slide_data['id']);
						 $slide_header = stripslashes($slide_data['name']);
						 $slide_sub_header = stripslashes($slide_data['banner_image_path']);
						 $slide_image_path = stripslashes($slide_data['pimage']);
						 $slide_content = stripslashes($slide_data['content']);
						 $slide_image_dir = 'promo_images/';
						

					}
				} 
				else if(false && $slide_total > 0)
				{
						 $slide_id = stripslashes($slide_data['id']);
						 $slide_header = stripslashes($slide_data['name']);
						 $slide_sub_header = stripslashes($slide_data['banner_image_path']);
						 $slide_image_path = stripslashes($slide_data['pimage']);
						 $slide_content = stripslashes($slide_data['content']);
						 $slide_image_dir = 'promo_images/';
						

				}
				else
				{
					//NEW VERSION
					 $slide_data = mysql_fetch_array($slide_result);
						$slide_header = stripslashes($slide_data['name']);
					 $slide_sub_header = stripslashes($slide_data['banner_image_path']);
					$slide_content = stripslashes($slide_data['content']);

					

				}
				?>
	<section class="slider">
		<div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
				<li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
				<li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
			</ol>


				
			<!-- Wrapper For Slides -->
			<div class="carousel-inner" role="listbox">



				

				<!-- First Slide -->
				<div class="item active">

					<!-- Slide Background -->
					<img src="assets/img/s1.jpg" alt="Bootstrap Touch Slider"  class="slide-image"/>
					<div class="bs-slider-overlay"></div>
					<!-- Slide Text Layer -->
					<div class="slide-text slide_style_left">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<h1 data-animation="animated fadeInDown">
										
										<p class="font_head"><?php echo $slide_header; ?></p>

										<strong class="text-uppercase"><?php echo $slide_sub_header; ?></strong>
									</h1>
									<p data-animation="animated fadeInLeft"><?php echo $slide_content; ?></p>
									<a href="login.php" target="_blank" class="btn btn-default" data-animation="animated fadeInUp">Start an Event</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				
									
			
				<!-- End of Slide -->
				
				<!-- Second Slide -->
				<div class="item">

					<!-- Slide Background -->
					<img src="assets/img/s2.jpg" alt="Bootstrap Touch Slider"  class="slide-image"/>
					<div class="bs-slider-overlay"></div>
					<!-- Slide Text Layer -->
					<div class="slide-text slide_style_left">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<h1 data-animation="animated fadeInDown">
										<p class="font_head"><?php echo $slide_header; ?></p>
										<strong class="text-uppercase"><?php echo $slide_sub_header; ?></strong>
									</h1>
									<p data-animation="animated fadeInLeft"><?php echo $slide_content; ?></p>
									<a href="login.php" target="_blank" class="btn btn-default" data-animation="animated fadeInUp">Start an Event</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Slide -->
				
				
				<!-- third Slide -->
				<div class="item">

					<!-- Slide Background -->
					<img src="assets/img/s3.jpg" alt="Bootstrap Touch Slider"  class="slide-image"/>
					<div class="bs-slider-overlay"></div>
					<!-- Slide Text Layer -->
					<div class="slide-text slide_style_left">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<h1 data-animation="animated fadeInDown">
										<p class="font_head"><?php echo $slide_header; ?></p>

										<strong class="text-uppercase"><?php echo $slide_sub_header; ?></strong>
									</h1>
									<p data-animation="animated fadeInLeft"><?php echo $slide_content; ?></p>
									<a href="login.php" target="_blank" class="btn btn-default" data-animation="animated fadeInUp">Start an Event</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Slide -->
				
					
			</div><!-- End of Wrapper For Slides -->

		</div> <!-- End  bootstrap-touch-slider Slider -->
				
	</section>
	<!-- End slider section -->

	
	<?php //include("header.php"); ?>
</div>

<!-- conted -->

	<?php //include_once("homepage_slides.php"); ?>
	<?php //include_once("homepage_promos.php"); ?>
	<?php
						$promo_query_initial = "select CHAR_LENGTH(content) as content from home_feature order by displayorder";
						$promo_result_initial = hb_get_result($promo_query_initial);
						$promo_total_initial = mysql_num_rows($promo_result_initial);
						$promo_contents = array();
						if($promo_total_initial > 0)
						{
							$promo_count_initial = 0;
							while($promo_data_initial = mysql_fetch_array($promo_result_initial))
							{
								$promo_count_initial++;
								$promo_contents[] = stripslashes($promo_data_initial['content']);
							}
						}
						$max_content = max($promo_contents);
						
						$promo_query = "select * from home_feature order by displayorder";
						$promo_result = hb_get_result($promo_query);
						$promo_total = mysql_num_rows($promo_result);
						?>
						<section class="vs_middle_grid">
									<div class="container">

						<?
						if($promo_total > 0)
						{
							$promo_count = 1;
							while($promo_data = mysql_fetch_array($promo_result))
							{
								
								 $promo_id = stripslashes($promo_data['id']);
								$promo_header = stripslashes($promo_data['name']);
								$promo_image_path = stripslashes($promo_data['image_path']);
								$promo_content = stripslashes($promo_data['content']);
								$promo_image_dir = 'home_feature_images/';

								if($promo_count == 1){ $img="/Friends-invite.jpg"; }; 
								if($promo_count == 2){ $img="/Finance.png"; }; 
								if($promo_count == 3){ $img="/celebre_icon.png"; }; 

								?>

								
										<div class="row demo<?php echo $promo_count; ?>" style="margin-bottom:40px;">
											<div class="col-md-4 img_div">
												<img class="pull-left" src="assets/img<? echo $img;?>">
											</div>
											<div class="col-md-8 img_div">
												<div class="grid_box_middle">
													<h3><?php echo $promo_header;?></h3>
													<?php echo $promo_content;?>
												</div>
											</div>
										</div>
								


								<?php
								$promo_count++;
							}
						}		
					?>
						</div>
								</section>

					
  
  
  
<!-- bottem -->
	<?php include("footer.php"); ?>
	
</body>
</html>