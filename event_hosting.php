<? 
	include("connect.php");
	include("login_check.php");
	if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == "delete")
	{
		$del_query="update events set deleted = 1 where id=".$_REQUEST['eve_id'];
		hb_get_result($del_query) or die(mysql_error());
		?>
        	<script language="javascript">
				window.location.href="event_hosting.php";
			</script>
        <?php 		
		exit;
	}
	$acc_pg_name='event_hosting';	
	$a = GetContent(19);
	$eve_res = hb_get_result("select * from events where oid=".$_SESSION['SESS_USER_ID']." and deleted != 1 order by sdate desc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Events I’m Hosting</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
                                <div class="find_btn_main">
                                	<div class="find_btn"><a href="create_event.php"><img src="images/start_event.png" /></a></div>
                                    <div class="find_btn">
										<a href="payment_setup.php"><img src="images/setup_mypemp.png" /></a>
									</div>
                                </div>
                                <div class="events_page_main">
                                 <div class="table-responsive">
									<table class="table">
									<thead>
										<tr>
											<th ></th>
											<th>Event Name</th>
											<th>Date</th>
											<th>Location</th>
											<th>Attendees</th>
											<th>Funded</th>
											<th></th>
										</tr>
									</thead> 
									<tbody>
									<?
										if(mysql_num_rows($eve_res) > 0)
										{
										while($event_row = mysql_fetch_object($eve_res))
										{
											$eve_title = $event_row->title;
											$eve_sdate = convert_us($event_row->sdate);
											$eve_edate = convert_us($event_row->edate);
											$eve_loc = $event_row->loc_name;
											$eve_id = $event_row->id;
											$eve_fund_amt = $event_row->fund_amt;
											$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '$eve_id'";
$funded_amount_result = hb_get_result($funded_amount_query) or die(mysql_error());
$currently_funded_amount = mysql_result($funded_amount_result,0);
$currently_funded_amount = number_format($currently_funded_amount,2);

											//$eve_attende = GetValue("attendee","tot_addendees","event_id",$eve_id);
											$eve_space_available= $event_row->space_available;
											$eve_max_cap = $event_row->max_cap;
											//$eve_attende = $eve_max_cap  -  $eve_space_available;
											$ev = hb_get_result("select SUM(tot_addendees) as ett from attendee where event_id=".$eve_id) or die(mysql_error());
											$eve_attende = mysql_result($ev,0);
											
									?>
                                    	<tr>
											<td></td>
											<td>
												<a href="edit_event.php?edit_id=<?=$eve_id;?>"><?=str_replace("\\","",$eve_title);?></a>
											</td>
											<td>
												<?
													if($eve_sdate != "00-00-0000")
													{
														echo $eve_sdate;
													}
													?> - <?
													if($eve_edate != "00-00-0000")
													{
														echo $eve_edate;
													}
												?>
											</td>
											<td><?=str_replace("\\","",$eve_loc);?></td>
											<td><?=$eve_attende?></td>
											<td>$<?=$currently_funded_amount;?></td>
											<td><select name="action" onChange="implement_access(this.value,'<?=$eve_id;?>')" >
                                                    <option value="">Actions</option>
                                                    <option value="Edit Event">Edit Event</option>
                                                    <option value="Attendees">Attendees</option>
													<option value="Invitees">Invitees</option>
													<option value="Funding">Funding</option>
                                                    <option value="Delete">Delete</option>
													<option value="View Event Profile">View Event Profile</option>
                                                </select></td>
										</tr>
                                   	 <? }
									 }?> 
									</tbody> 									
									</table> 
									</div>                                     
                                </div>
                            </div>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
        	<? include("footer.php");?>
        </div>
    </body>
</html>
<script language="javascript">
	function implement_access(action,event_id)
	{
		if(action == "Edit Event")
		{
			window.location.href="edit_event.php?edit_id="+event_id;
			return;
		}
		else if(action == "Invitees")
		{
			window.location.href="event_invitees.php?edit_id="+event_id;	
			return;
		}
		else if(action == "Attendees")
		{
			window.location.href="event_attendees.php?edit_id="+event_id;	
			return;
		}
		else if(action == "Funding")
		{
			window.location.href="event_funding.php?event_id="+event_id;	
			return;
		}
		else if(action == "Delete")
		{
			result=confirm("Are you sure that you would like to delete this event?");
			if (result==true)
		    {
		      	window.location.href="event_hosting.php?mode=delete&eve_id="+event_id;
				return;
		  	}
			return;
		}
		else if(action == "View Event Profile")
		{
			window.location.href="acc_event_detail.php?eve_id="+event_id;	
			return;
		}
	}
</script>