
	<?php 
		$promo_query="select * from content_promos where navigation like '%".$id."%'";
		$promo_result=mysql_query($promo_query);
		while($promo_rows=mysql_fetch_array($promo_result))
		{
			?>
				<div class="">
					<?php if($promo_rows['dont_display_title'] != 1) { ?>
						<h1><?php echo stripslashes($promo_rows['title']);?></h1>
					<?php } ?>
					<div class="">
				  <?php echo stripslashes($promo_rows['content']);?>
				</div>
				</div>

	  <?php }?>
