<?
	class hb_attendee
	{
		private $attendee_id;
		public function __construct($attendee_id)
		{
			$this->event_id = $attendee_id;
		}
		public function get_gross_donation_for_event()
		{
			$funded_amount_query = "select sum(`how_mch`) from attendee where `how_mch` > 0 and `event_id` = '".$this->event_id."'";
			$funded_amount_result = mysql_query($funded_amount_query) or die(mysql_error());
			$currently_funded_amount = mysql_result($funded_amount_result,0);
			return $currently_funded_amount;
		}
	}
?>