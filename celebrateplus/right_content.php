<div class="tab_box_bg_inner_right_bg_right_content">
	<?php 
		$promo_query="select * from content_promos where navigation like '%".$id."%'";
		$promo_result=mysql_query($promo_query);
		while($promo_rows=mysql_fetch_array($promo_result))
		{
			?>
				<div class="tab_right_text_main">
					<?php if($promo_rows['dont_display_title'] != 1) { ?>
						<div class="tab_right_text_title"><?php echo stripslashes($promo_rows['title']);?></div>
					<?php } ?>
					<div class="tab_right_text">
				  <?php echo stripslashes($promo_rows['content']);?>
				</div>
				</div>

	  <?php }?>
</div>