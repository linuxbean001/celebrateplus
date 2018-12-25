<?
	class hb_organizer
	{
		private $organizer_id;
		public $today;
		public function __construct($organizer_id)
		{
			$this->organizer_id = $organizer_id;
			$this->today = date("Y-m-d");
		}
		public function get_events_total_for_organizer()
		{
			$funded_amount_query = "select count(`id`) from events where `oid` = '".$this->organizer_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_active_events_total_for_organizer()
		{
			$funded_amount_query = "select count(`id`) from events where `oid` = '".$this->organizer_id."' and edate > '".$this->today."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_events_names_for_organizer()
		{
			$funded_amount_query = "select title from events where `oid` = '".$this->organizer_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$funded_amount_total = mysql_num_rows($funded_amount_result);
			if($funded_amount_total > 0)
			{
				while($funded_amount_data = mysql_fetch_array($funded_amount_result))
				{
					$event_title = $funded_amount_data['title'];
					if(trim($event_title) != '')
					{
						$event_titles .= trim($event_title).",<br />";
					}
				}
				$event_titles = rtrim($event_titles,",<br />");
			}
			return $event_titles;
		}
		public function get_active_events_names_for_organizer()
		{
			$funded_amount_query = "select title from events where `oid` = '".$this->organizer_id."' and edate > '".$this->today."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$funded_amount_total = mysql_num_rows($funded_amount_result);
			if($funded_amount_total > 0)
			{
				while($funded_amount_data = mysql_fetch_array($funded_amount_result))
				{
					$event_title = $funded_amount_data['title'];
					if(trim($event_title) != '')
					{
						$event_titles .= trim($event_title).",<br />";
					}
				}
				$event_titles = rtrim($event_titles,",<br />");
			}
			return $event_titles;
		}
		public function get_gross_funding_for_organizer()
		{
			$funded_amount_query = "select sum(`how_mch`) from attendee where `how_mch` > 0 and `org_id` = '".$this->organizer_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_net_funding_for_organizer()
		{
			$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `org_id` = '".$this->organizer_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_net_commission_for_organizer()
		{
			$funded_amount_query = "select sum(`gave_to_site`) from attendee where `gave_to_site` > 0 and `org_id` = '".$this->organizer_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
	}
?>