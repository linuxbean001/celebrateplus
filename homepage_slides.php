<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
<script src='http://malsup.github.io/jquery.cycle.all.js'></script>
<script src="mediaelement/mediaelement-and-player.min.js"></script>
<link rel="stylesheet" href="mediaelement/mediaelementplayer.css" />
<script>
//NEW CODE

var vid;

var nextMediaStr = "pic1";

function nextMedia(name)
{
	if(name == "pic1")
	{
		$("#mep_0").hide();
		$("#pic1").fadeIn();
		nextMediaStr = "vid2";
		setTimeout("nextMedia('vid2');",5000);
	}
	
	else if(name == "vid2")
	{
		nextMediaStr = "vid1";
		$("#pic1").hide();
        vid.setSrc('videos/CelebratePlus.mp4');
        vid.load();
        $("#mep_0").fadeIn();
        vid.play();
		
	}

	else if(name == "vid1")
	{
		$("#mep_0").hide();
		nextMediaStr = "pic1";
        vid.setSrc('videos/intro.mp4');
        vid.load();
        $("#mep_0").fadeIn();
        vid.play();
	}
}

function nextMedia2()
{
	nextMedia(nextMediaStr);
}

function eventClickTrigger() 
{
	$('.mejs-overlay').trigger('click');
}

$(document).ready(function() 
{
    /*$('#slides').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});*/

	vid = new MediaElementPlayer("#vid",{
		features: ['playpause','progress','current','duration','tracks','volume'],
     success: function (mediaElement, domObject) 
     {
     	//mediaElement.load();
		//mediaElement.play();

		//setTimeout('eventClickTrigger()', 1000);

		mediaElement.addEventListener('ended', function (e) {
			nextMedia(nextMediaStr);
		});
	 }
    });
});
</script>

<div class="na_slid_main">
  	<div class="na_slid_margin">
		<div class="middle"> 
		<div class="na_top_main">
		<?php 
			$slide_query = "select * from promo where active = 1 order by displayorder";
				$slide_result = hb_get_result($slide_query);
				$slide_total = mysql_num_rows($slide_result);
				if(false && $slide_total > 1)
				{
				?>
					<div id="mastheadouter">
        <div class="container">
          <div id="carousel">
            <div style="width: 2820px; left: -1880px;" class="carouselinner">
			<?php
				
					while($slide_data = mysql_fetch_array($slide_result))
					{
						$slide_id = stripslashes($slide_data['id']);
						$slide_header = stripslashes($slide_data['name']);
						$slide_sub_header = stripslashes($slide_data['banner_image_path']);
						$slide_image_path = stripslashes($slide_data['pimage']);
						$slide_content = stripslashes($slide_data['content']);
						$slide_image_dir = 'promo_images/';
			?>
              <div class="panel" style="background:  no-repeat scroll right top transparent; float: none; position: absolute; left: 0px; margin-bottom:0px;">
				<div class="na_top_min">
					<div class="na_slid_left">
						<?php if($slide_image_path != '' && file_exists($slide_image_dir.$slide_image_path)){ ?>
						<img src="<?php echo $slide_image_dir.$slide_image_path; ?>" border="0" width="492" height="355" />
						<?php }else{ echo "&nbsp;"; } ?>
					</div>
					<table border="0" cellpadding="0" cellspacing="0" height="305"> <tr><td valign="middle">
						<div class="na_slid_right">
						<div class="na_slid_top_tex">
							<div class="na_slid_top_hed"><em><strong><?php echo $slide_header; ?></strong></em></div>
							<div  class="na_slid_top_sub_hed"><em><strong><?php echo $slide_sub_header; ?></strong></em></div>
						</div>
						<div class="na_slid_top_text_14" style="font-size:12px;"><?php echo $slide_content; ?></div>
					</div>
					</td></tr></table>
				</div>
              </div>
			<?php
					}				
			?>
            </div>
          </div>
          <div id="carousel-paginate"> <img src="images/round.png" data-over="images/round2.png" data-select="images/round2.png" data-moveby="1" /> </div>
        </div>
      </div>
	  			<?php 
				}
				else if(false && $slide_total > 0)
				{
					$slide_data = mysql_fetch_array($slide_result);					
					$slide_id = stripslashes($slide_data['id']);
					$slide_header = stripslashes($slide_data['name']);
					$slide_sub_header = stripslashes($slide_data['banner_image_path']);
					$slide_image_path = stripslashes($slide_data['pimage']);
					$slide_content = stripslashes($slide_data['content']);
					$slide_image_dir = 'promo_images/';
					?>							
						<div class="na_top_min">
							<div class="na_slid_left">
								<?php if($slide_image_path != '' && file_exists($slide_image_dir.$slide_image_path)){ ?>
								<img src="<?php echo $slide_image_dir.$slide_image_path; ?>" border="0" width="492" height="355" />
								<?php }else{ echo "&nbsp;"; } ?>
							</div>
							<table border="0" cellpadding="0" cellspacing="0" height="350"> <tr><td valign="middle">
							<div class="na_slid_right">
								<div class="na_slid_top_tex">
									<div class="na_slid_top_hed"><em><strong><?php echo $slide_header; ?></strong></em></div>
									<div  class="na_slid_top_sub_hed"><em><strong><?php echo $slide_sub_header; ?></strong></em></div>
								</div>
								<div class="na_slid_top_text_14" style="font-size:12px;"><?php echo $slide_content; ?></div>
							</div>
							</td></tr></table>
						</div>						
					<?php
					
				}

				else
				{
					//NEW VERSION

					$slide_data = mysql_fetch_array($slide_result);					
					$slide_header = stripslashes($slide_data['name']);
					$slide_sub_header = stripslashes($slide_data['banner_image_path']);
					$slide_content = stripslashes($slide_data['content']);

					?>

					<div class="na_top_min">
							<div class="na_slid_left" style='width:500px;'>
								<!--<div id='slides'>
									<img src='promo_images/380home_slide1.jpg' />
									<img src='promo_images/business.jpg' />
								</div>-->
								<!--  Comment|Divakar: Commenting the videos and images on the main page
								<div id='videos'>
									<img id='pic1' style='display:none;' src='promo_images/380home_slide1.jpg' />
									  
									<video id='vid'  width="500" height="350" controls="controls" src='videos/intro.mp4' autoplay>
										
									</video> 
								</div>
                                -->


							</div>
							<table border="0" cellpadding="0" cellspacing="0" height="350"> <tr><td valign="middle">
							<div class="na_slid_right" style='margin-left:30px;'>
								<div class="na_slid_top_tex">
									<div class="na_slid_top_hed"><em><strong><?php echo $slide_header; ?></strong></em></div>
									<div  class="na_slid_top_sub_hed"><em><strong><?php echo $slide_sub_header; ?></strong></em></div>
								</div>
								<div class="na_slid_top_text_14" style="font-size:12px;">
									<?php echo $slide_content; ?>
								</div>
								<!-- Comment|Divakar: Commenting the image and link to go to the next image on the front page 
								<img src='images/forward-arrow.png' style='cursor:pointer;position:absolute;margin-top:-70px;margin-left:-529px;' onclick='nextMedia2();' /> 
								-->
							</div>
							</td></tr></table>
						</div>						
				<?php 
				}
			?>
	  </div>
	
  </div>
	</div>
  </div>