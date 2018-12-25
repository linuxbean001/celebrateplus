<? include("connect.php");

	$event_dt = $_REQUEST['event_id'];
	$fetchquery = "select * from events where id=".$event_dt;
	$result = hb_get_result($fetchquery);
		$row = mysql_fetch_array($result);
		
				$etitle= stripslashes($row['title']);
				$esdate= convert_us(stripslashes($row['sdate']));
				$estime= stripslashes($row['stime']);
				$eedate= convert_us(stripslashes($row['edate']));
				$eetime= stripslashes($row['etime']);
				$ecity= stripslashes($row['loc_city']);
				$estate= stripslashes($row['loc_state']);
	
?>
				<table width="100%" cellpadding="3" cellspacing="3">
							<tr>
								  <td width="29%" align="right" class="f-c">Event Title :</td>
								  <td width="71%" class="f-c"><input  name="etitle" type="text" readonly="readonly" id="etitle" value="<?=$etitle; ?>" /></td>
							</tr>
							
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Date :</td>
								  <td width="71%" class="f-c"><input  name="esdate" type="text" readonly="readonly" id="esdate" value="<?=$esdate; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event Start Time :</td>
								  <td width="71%" class="f-c"><input  name="estime" type="text" id="estime" readonly="readonly" value="<?=$estime; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Date :</td>
								  <td width="71%" class="f-c"><input  name="eedate" type="text" id="eedate" readonly="readonly" value="<?=$eedate; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event End Time :</td>
								  <td width="71%" class="f-c"><input  name="eetime" type="text" id="eetime" readonly="readonly" value="<?=$eetime; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event City :</td>
								  <td width="71%" class="f-c"><input  name="ecity" type="text" id="ecity" readonly="readonly" value="<?=$ecity; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">Event State :</td>
								  <td width="71%" class="f-c"><input  name="estate" type="text" id="estate" readonly="readonly" value="<?=$estate; ?>" /></td>
							</tr>
					</table>