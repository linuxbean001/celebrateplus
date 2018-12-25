<? include("connect.php"); 
				$org_id = $_REQUEST['search_id'];  
			   ?>
			  <select name="event_id" id="event_id" onchange="show_event_data123(this.value)" >
										<option value="">Please Select</option>
										<?	
																
										$add_result = hb_get_result("select * from events where oid=$org_id and deleted != 1") ;
										while($add_row = mysql_fetch_array($add_result))
										{	
										?>
										<option value="<?=$add_row['id']?>" <? if($event_id!="" && $add_row['id']==$event_id){ echo 'selected="selected"'; } ?>><?=$add_row['title']?></option>
										
										<?
										}										
										?> 
										</select>