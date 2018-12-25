<? include("connect.php");
?>
<? 
	$acc_pg_name='find_event';
	$eve_nm = GTG_firewall($_REQUEST['event_name']);
	$eve_nm = trim($eve_nm); 
	
	$names = explode(" ",$eve_nm);
	
	if($names[0] !="" and $names[1]!="")
	{
		$fname = $names[0];
		$lname = $names[1];
	}
	else
	{
		$fname = $eve_nm;
		$lname = $eve_nm;
	}
	$eve_qry = "select events.*,organizer.fname,organizer.lname from events,organizer where (events.oid= organizer.id) and events.searchable='yes' and events.deleted != 1 and (events.title like '%".$eve_nm."%'
	or organizer.fname like '%".$fname."%' or organizer.lname like '%".$lname."%')";
	/*$eve_qry = "select title,sdate,edate,loc_name,oid,searchable,fname,events.id,lname
				from events 
				left join organizer on events.oid=organizer.id
				where events.searchable='yes' and (title like '%".$eve_nm."%' or fname like '%".$fname."%' or lname like '%".$lname."%')";*/
	$eve_res = hb_get_result($eve_qry) or die(mysql_error());
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
                    	<div class="inner_title_bg">Find An Event</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
						<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                                <div class="col-md-6">
                                	Event results for: <span><?=$eve_nm;?></span>
                                </div>
								
								<form name="Search_Events" id="Search_Events" action="acc_event_result.php" method="post" onsubmit="javascript: return login_chk()">
								<div class="col-md-6">
                                	<div class="">Search Events :</div>
                                    <div class="search_eve_form_input_box">
                                    	<input type="text" name="event_name" id="event_name" class="form-control" onBlur="if(this.value==''){this.value='Event Name or Host Name'}" onFocus="if(this.value=='Event Name or Host Name'){this.value=''}" value="Event Name or Host Name" />
                                    </div>
                                    <div class="search_eve_form_btn_nain"><input type="submit" class="search_eve_form_btn" name="Submit_eve" id="Submit_eve" value="" /></div>
                                </div>
								</form>	
                                <div class="table-responsive">
									<table class="table table-hover">
										<thead>
										<tr>
											<th>Event Name</th>
											<th>Date</th>
											<th>Location</th>
											<th>Host</th>
											<th></th>
										</tr> 
										</thead> 
										<tbody>
									<?
										while($event_row = mysql_fetch_object($eve_res))
										{
											$eve_title = $event_row->title;
											$eve_sdate = convert_us($event_row->sdate);
											$eve_edate = convert_us($event_row->edate);
											$eve_loc = $event_row->loc_name;
											$eve_fname = $event_row->fname;
											$eve_lname = $event_row->lname;
											$eve_id13 = $event_row->id;
									?>
										<tr>
											<td>
												<a href="acc_event_detail.php?eve_id=<?=$eve_id13;?>"><?=str_replace("\\","",$eve_title);?></a>
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
											<td><?=$eve_fname?>&nbsp;<?=$eve_lname?></td>
											<td><a href="acc_event_detail.php?eve_id=<?=$eve_id13;?>"><img src="images/vew_event.png" /></a></td>
										</tr>
                                    <? 	
										}
									?>	
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
