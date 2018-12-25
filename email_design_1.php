<?
$mail_body='
	<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
	
  <tr>
    <td align="left" valign="top" background="'.$SITE_SECURE_URL.'images/email/Balloons_Design_bg.jpg" style="padding:249px 0 0 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top" style="font-family:Impact; font-size:42px; color:#0092c3;">'.$event_mail_header.'<br />
          <a href="https://www.celebrateplus.com/event_detail.php?eve_id='.$event_id.'" style="font-family: Arial, Helvetica, sans-serif; font-size:42px; color:#88b130; text-decoration:none;">'.$event_name.'</a> <br /></td>
      </tr>
      <tr>
        <td align="center" valign="top" style="padding:36px 0 0 0px;font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#000;line-height:24px;">
		'.$invitation_message.'
		</td>
      </tr>';
	  if($event_mail_IR == "Invitation")
	  {
		  $mail_body.='<tr>
			<td align="center" valign="top" style="padding:36px 0 0 0px; line-height:24px;">
			<a href="https://www.celebrateplus.com/event_detail.php?eve_id='.$event_id.'" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#0092C3; text-decoration:none;">View Event</a>
			</td>
		  </tr>';
	  }
	  else if($event_mail_IR == "Reminder")
	  {
		   $mail_body.='<tr>
			<td align="center" valign="top" style="padding:36px 0 0 0px; line-height:24px; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
			'.$organizer_first_name.' '.$organizer_last_name.' would like to remind you about '.$event_name.'. To view the event details <a href="https://www.celebrateplus.com/event_detail.php?eve_id='.$event_id.'" style="color:#0092C3; text-decoration:none;">click here</a>.
			</td>
		  </tr>';
	  }
    $mail_body.='</table></td>
  </tr>
  <tr>
  	<td align="right" style="padding:5px;"><a href="http://www.celebrateplus.com/" target="_blank"><img src="'.$SITE_SECURE_URL.'images/logo_invite_email.png" border="0"></a></td>
  </tr>
</table>';
?>


