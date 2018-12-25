<?
	class hb_event
	{
		private $event_id;
		public function __construct($event_id)
		{
			$this->event_id = $event_id;
		}
		public function get_gross_donation_for_event()
		{
			$funded_amount_query = "select sum(`how_mch`) from attendee where `how_mch` > 0 and `event_id` = '".$this->event_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_net_commission_for_event()
		{
			$funded_amount_query = "select sum(`gave_to_site`) from attendee where `gave_to_site` > 0 and `event_id` = '".$this->event_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_net_donation_for_event()
		{
			$funded_amount_query = "select sum(`gave_to_event_owner`) from attendee where `gave_to_event_owner` > 0 and `event_id` = '".$this->event_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_attendees_total_for_event()
		{
			$funded_amount_query = "select sum(tot_addendees) from attendee where `event_id` = '".$this->event_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_donators_total_for_event()
		{
			$funded_amount_query = "select count(`id`) from attendee where `event_id` = '".$this->event_id."' and `how_mch` > 0";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
		public function get_attendees_names_for_event()
		{
			$funded_amount_query = "select user_id from attendee where `event_id` = '".$this->event_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$funded_amount_total = mysql_num_rows($funded_amount_result);
			if($funded_amount_total > 0)
			{
				while($funded_amount_data = mysql_fetch_array($funded_amount_result))
				{
					$attendee_id = $funded_amount_data['user_id'];
					if(trim(GetValue("organizer","email","id",$attendee_id)) != '')
					{
						$attendees .= trim(GetValue("organizer","email","id",$attendee_id)).",<br />";
					}
				}
				$attendees = rtrim($attendees,",<br />");
			}
			return $attendees;
		}
	}
?>