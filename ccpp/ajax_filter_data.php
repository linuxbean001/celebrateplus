<?
	include("connect.php");
	$fltr_opt = $_REQUEST['fltr'];
	$state = $_REQUEST['state'];
	
	if($fltr_opt=="event_city")
	{
		$flt = mysql_query("select * from events");?>
		<select name="load" id="load">
		<option value="">Select</option>
		<?
		while($flt_r = mysql_fetch_array($flt))
		{?>
			<option value="<?=$flt_r['loc_city']?>" <? if($state==$flt_r['loc_city']){?> selected="selected" <? }?>><?=$flt_r['loc_city']?></option>
		<? }
		?>
		</select>
	<?  }
	
	if($fltr_opt=="event_state")
	{
		$flt = mysql_query("select * from events");?>
		<select name="load" id="load">
		<option value="">Select</option>
		<?
		while($flt_r = mysql_fetch_array($flt))
		{?>
			<option value="<?=$flt_r['loc_state']?>" <? if($state==$flt_r['loc_state']){?> selected="selected" <? }?>><?=$flt_r['loc_state']?></option>
		<? }
		?>
		</select>
	<?  }
?>