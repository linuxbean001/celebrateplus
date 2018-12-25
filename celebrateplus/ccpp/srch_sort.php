<?
		//print_r($_REQUEST);
		if(isset($_REQUEST['org1_lname']) and $_REQUEST['org1_lname']!='-')
		{

			if($_REQUEST['org1_lname']=="asce")
			{
				$sel = "select organizer.lname,events.* from organizer,events where events.oid= organizer.id order by organizer.lname";
			}
			if($_REQUEST['org1_lname']=="desc")
			{
				$sel = "select organizer.lname,events.* from organizer,events where events.oid= organizer.id order by organizer.lname desc"; 
			}
		}
		else if(isset($_REQUEST['event_title']) and $_REQUEST['event_title']!='-')
		{
			
			if($_REQUEST['event_title']=="asce")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by title" ;
			}
			if($_REQUEST['event_title']=="desc")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by title desc" ;
			}
		}
		else if(isset($_REQUEST['create_date']) and $_REQUEST['create_date']!='-')
		{
			
			if($_REQUEST['create_date']=="new")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by add_date desc" ;
			}
			if($_REQUEST['create_date']=="old")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by add_date" ;
			}
		}
		else if(isset($_REQUEST['start_date']) and $_REQUEST['start_date']!='-')
		{
			
			if($_REQUEST['start_date']=="new")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by sdate desc" ;
			}
			if($_REQUEST['start_date']=="old")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by sdate" ;
			}
		}
		else if(isset($_REQUEST['end_date']) and $_REQUEST['end_date']!='-')
		{
			
			if($_REQUEST['end_date']=="new")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by edate desc" ;
			}
			if($_REQUEST['end_date']=="old")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by edate" ;
			}
		}
		else if(isset($_REQUEST['t_fund']) and $_REQUEST['t_fund']!='-')
		{
			
			if($_REQUEST['t_fund']=="new")
			{
				$sel= "select *,CAST(`fund_amt` AS DECIMAl) as result from events where title like '".$_GET["order"]."%' ORDER BY result desc" ;
			}
			if($_REQUEST['t_fund']=="old")
			{
				$sel= "select *,CAST(`fund_amt` AS DECIMAl) as result from events where title like '".$_GET["order"]."%' order by result" ;
			}
		}
		else if(isset($_REQUEST['c_fund']) and $_REQUEST['c_fund']!='-')
		{
			
			if($_REQUEST['c_fund']=="new")
			{
				$sel= "select *
					   from events 
					   where 
					   		title like '".$_GET["order"]."%'
					   order by 
					   		(select sum(gave_to_event_owner)
								 from attendee 
								where event_id = events.id
							) desc";
			}
			if($_REQUEST['c_fund']=="old")
			{
				$sel= "select *
					   from events 
					   where 
					   		title like '".$_GET["order"]."%'
					   order by 
					   		(select sum(gave_to_event_owner)
								 from attendee 
								where event_id = events.id
							)";
			}
		}
		else if(isset($_REQUEST['cls_date']) and $_REQUEST['cls_date']!='-')
		{
			
			if($_REQUEST['cls_date']=="new")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by fund_end_date desc" ;
			}
			if($_REQUEST['cls_date']=="old")
			{
				$sel= "select * from events where title like '".$_GET["order"]."%' order by fund_end_date" ;
			}
		}
		else if($_REQUEST['submit1'])
		{
			$sel = "select organizer.*,events.* from organizer, events where events.title like '%".$_REQUEST['evnt_title']."%' and organizer.username like '%".$_REQUEST['org_uname']."%' and organizer.email like '%".$_REQUEST['org_email']."%' and organizer.lname like '%".$_REQUEST['org_lname']."%' and events.loc_city like '%".$_REQUEST['city']."%' and events.loc_state like '%".$_REQUEST['state']."%' and events.loc_country like '%".$_REQUEST['country']."%' and events.oid=organizer.id"; 
		}
		else if($_REQUEST['org_id'] != '')
		{
			$sel = "select * from events where oid =".$_REQUEST['org_id'].""; 
		}
		else if($_REQUEST['event_ids'] != '')
		{
			$sel = "select * from events where id in (".$_REQUEST['event_ids'].")"; 
		}
		else
		{
			
			$sel= "select * from events where title like '".$_GET["order"]."%' order by add_date desc" ; 
		}
?>