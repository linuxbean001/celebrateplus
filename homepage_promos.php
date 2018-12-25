<div class="na_slid_main1">
  	<div class="na_slid_margin">
		<div class="middle"> 
			<div class="na_sild_prod_main">
				<div class="na_sild_prod_min">
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
						if($promo_total > 0)
						{
							$promo_count = 0;
							while($promo_data = mysql_fetch_array($promo_result))
							{
								$promo_count++;
								$promo_id = stripslashes($promo_data['id']);
								$promo_header = stripslashes($promo_data['name']);
								$promo_image_path = stripslashes($promo_data['image_path']);
								$promo_content = stripslashes($promo_data['content']);
								$promo_image_dir = 'home_feature_images/';
								if(strlen($promo_content) < $max_content)
								{
									$padding = $max_content - strlen($promo_content);
									$promo_content = str_pad($promo_content,$padding);
								}
					?>
					<div class="na_sild_sub<?php if($promo_count % 3 == 0){ echo "1"; } ?>" >
						<div class="na_sild_sub_unb_img"><img src="images/tops_bg.png" border="0" /></div>
						<div class="na_sild_sub_unb" id="same_height_div<?=$promo_count;?>">
							<?php if($promo_image_path != '' && file_exists($promo_image_dir.$promo_image_path)){ ?>
							<div class="na_sild_sub_icon">								
								<img src="<?php echo $promo_image_dir.$promo_image_path; ?>" border="0" height="113" width="108" />							
							</div>
							<?php }?>
							<div class="na_sild_sub_title"><strong><em><?php echo $promo_header; ?></em></strong></div>
							<div class="na_sild_sub_tex"><?php echo $promo_content; ?></div>
						</div>
					</div>
					<?php
							}
						}
					?>
				</div>
				<div class="na_sild_prod_ad">
					<?
						$get_add_query = "select * from ad where location like '%Home Footer%' order by rand() limit 1";
						$get_add_result = hb_get_result($get_add_query) or die(mysql_error());
						if(mysql_num_rows($get_add_result) > 0)
						{
							while($get_add_row = mysql_fetch_array($get_add_result))
							{
								 
								 ?>
								 <a href="<?=$get_add_row['link'];?>" target="_blank"><img src="advertiser_images/<?=$get_add_row['image_path'];?>" width="923" height="90" border="0" /></a>
								 <?
							}
						}
					?>
				</div>
			</div>
  </div>
	</div>
  </div>
 <!--<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>-->
<script language="javascript">
 	$(function(){      
		div1 = $('#same_height_div1').height();
		div2 = $('#same_height_div2').height();
		div3 = $('#same_height_div3').height();		
		largest = Math.max(div1,div2,div3);
		$('#same_height_div1').height(largest);
		$('#same_height_div2').height(largest);
		$('#same_height_div3').height(largest);
});
 </script>