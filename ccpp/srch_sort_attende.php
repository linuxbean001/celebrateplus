<?
		//print_r($_REQUEST);
		if(isset($_REQUEST['conf_date']) and $_REQUEST['conf_date']!='' and $_REQUEST['latest']=="conf_date")
		{

			if($_REQUEST['conf_date']=="old")
			{
				$sel = "select * from attendee where is_attendee = 1 order by cdate";
			}
			if($_REQUEST['conf_date']=="new")
			{
				$sel = "select * from attendee where is_attendee = 1 order by cdate desc";
			}
		}
		else if(isset($_REQUEST['event_title']) and $_REQUEST['event_title']!='' and $_REQUEST['latest']=="event_title")
		{
			
			if($_REQUEST['event_title']=="asce")
			{
				$sel= "select events.*,attendee.* from events,attendee where events.id= attendee.event_id and is_attendee = 1 order by events.title";
			}
			if($_REQUEST['event_title']=="desc")
			{
				$sel= "select events.*,attendee.* from events,attendee where events.id= attendee.event_id and is_attendee = 1 order by events.title desc";
			}
		}
		else if(isset($_REQUEST['start_date']) and $_REQUEST['start_date']!='' and $_REQUEST['latest']=="start_date")
		{
			
			if($_REQUEST['start_date']=="new")
			{
				$sel= "select events.*,attendee.* from events,attendee where events.id= attendee.event_id and is_attendee = 1 order by events.sdate desc";
			}
			if($_REQUEST['start_date']=="old")
			{
				$sel= "select events.*,attendee.* from events,attendee where events.id= attendee.event_id and is_attendee = 1 order by events.sdate";
			}
		}
		else if(isset($_REQUEST['end_date']) and $_REQUEST['end_date']!='' and $_REQUEST['latest']=="end_date")
		{
			
			if($_REQUEST['end_date']=="new")
			{
				$sel= "select events.*,attendee.* from events,attendee where events.id= attendee.event_id and is_attendee = 1 order by events.edate desc";
			}
			if($_REQUEST['end_date']=="old")
			{
				$sel= "select events.*,attendee.* from events,attendee where events.id= attendee.event_id and is_attendee = 1 order by events.edate";
			}
		}
		else if(isset($_REQUEST['filter_loc_city']) and $_REQUEST['filter_loc_city']!='')
		{
			
			$sel = "select organizer.*,attendee.* from attendee left join organizer on attendee.org_id = organizer.id where is_attendee = 1 and attendee.ecity='".$_REQUEST['filter_loc_city']."' order  by cdate desc";
		}
		else if(isset($_REQUEST['filter_loc_state']) and $_REQUEST['filter_loc_state']!='')
		{
			
			$sel = "select organizer.*,attendee.* from attendee left join organizer on attendee.org_id = organizer.id where is_attendee = 1 and attendee.estate='".$_REQUEST['filter_loc_state']."' order  by cdate desc";
		}
		else if(isset($_REQUEST['filter_funding']) and $_REQUEST['filter_funding']!='')
		{
			
			$sel = "select organizer.*,attendee.* from attendee left join organizer on attendee.org_id = organizer.id where is_attendee = 1 and attendee.funding='".$_REQUEST['filter_funding']."' order  by cdate desc";
		}
		else if($_REQUEST['submit1'])
		{
			$sel = "select 
						organizer.*,
						attendee.* 
					from 
						attendee left join organizer 
					on 
						attendee.org_id = organizer.id 
					where 
						is_attendee = 1";
				
			if($_REQUEST['evnt_title'] != "")
			{
				$sel .= " and attendee.etitle like '%".$_REQUEST['evnt_title']."%' ";			
			}
			if($_REQUEST['city'] != "")
			{
				$sel .= " and attendee.ecity like '%".$_REQUEST['city']."%' ";			
			}
			if($_REQUEST['state'] != "")
			{
				$sel .= " and attendee.estate like '%".$_REQUEST['state']."%' ";			
			}
			if($_REQUEST['uemail'] != "")
			{
				$sel .= " and attendee.uemail like '%".$_REQUEST['uemail']."%' ";			
			}
			if($_REQUEST['ulname'] != "")
			{
				$sel .= " and attendee.ulname like '%".$_REQUEST['ulname']."%' ";			
			}
			if($_REQUEST['org_email'] != "")
			{
				$sel .= " and organizer.email like '%".$_REQUEST['org_email']."%' ";			
			}
			if($_REQUEST['org_lname'] != "")
			{
				$sel .= " and organizer.lname like '%".$_REQUEST['org_lname']."%' ";			
			}
			$sel .= "  order  by cdate desc";
			
			
			/***************------------------on 10th Septemeber 2012 ----------------------------********/
			/*
			$event_error = 0;	
			if($_REQUEST['evnt_title'] != "")
			{
				$event_id_list1=sh_get_eid_list("select id from events where title like '%".$_REQUEST['evnt_title']."%'","id");
				if($event_id_list1 == "")
				{ $event_error = 1; }
				$final_eid_list = $event_id_list1;
			}
			if($_REQUEST['city'] != "")
			{
				if($event_id_list1 != "")
				{ 
					$cleared_id_list = sh_get_cleared_list($event_id_list1);
					$query = "select id from events where loc_city like '%".$_REQUEST['city']."%' and id in (".$cleared_id_list.")";
				}
				else
				{ $query = "select id from events where loc_city like '%".$_REQUEST['city']."%'"; }
				$event_id_list2 = sh_get_eid_list($query,"id");
				if($event_id_list2 == "")
				{ $event_error = 1; }
				$final_eid_list = $event_id_list2;
				
			}
			if($_REQUEST['state'] != "")
			{
				if($event_id_list1 != "" || $event_id_list2 != "")
				{ 
					$cleared_id_list = sh_get_cleared_list($event_id_list1.",".$event_id_list2);
					$query = "select id from events where loc_state like '%".$_REQUEST['state']."%' and id in (".$cleared_id_list.")";
				}
				else
				{ $query = "select id from events where loc_state like '%".$_REQUEST['state']."%'"; }
				$event_id_list3 = sh_get_eid_list($query,"id");
				if($event_id_list3 == "")
				{ $event_error = 1; }
				$final_eid_list = $event_id_list3;
				
			}
			if($_REQUEST['country'] != "")
			{
				if($event_id_list1 != "" || $event_id_list2 != "" || $event_id_list3 != "")
				{ 
					$cleared_id_list = sh_get_cleared_list($event_id_list1.",".$event_id_list2.",".$event_id_list3);
					$query = "select id from events where loc_country like '%".$_REQUEST['country']."%' and id in (".$cleared_id_list.")";
				}
				else
				{ $query = "select id from events where loc_country like '%".$_REQUEST['country']."%'"; }
				$event_id_list3 = sh_get_eid_list($query,"id");
				if($event_id_list3 == "")
				{ $event_error = 1; }
				$final_eid_list = $event_id_list4;
			}
			if($final_eid_list != "")
			{ $sel .= " and attendee.event_id in (".$final_eid_list.") "; }*/
			/***************----------------------------------------------------------------------------------********/	
		}
		else
		{
			
			//echo $sel= "select user.lname,attendee.* from user,attendee where user.lname like '".$_GET["order"]."%' and attendee.user_id = user.id order by cdate desc" ; 
			$sel = "select organizer.*,attendee.* from attendee left join organizer on attendee.org_id = organizer.id where is_attendee = 1  order  by cdate desc";
		}
		//echo $sel;
		
		
?>