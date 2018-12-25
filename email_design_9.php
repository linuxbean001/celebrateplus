<?
$mail_body='
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#bcb0b4">
  <tr>
    <td align="left" valign="top" style="padding:30px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="middle" style="font-family:Georgia, Times New Roman, Times, serif; font-size:60px; color:#FFFFFF;">'.$event_mail_header.'</td>
          </tr>
          <tr>
            <td align="center" valign="middle"><a href="https://www.celebrateplus.com/event_detail.php?eve_id='.$event_id.'" style="font-family:Georgia, Times New Roman, Times, serif; font-size:42px; color:#54454a; font-style:italic; text-decoration:none;">'.$event_name.'</a></td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top" style="font-family:Georgia, Times New Roman, Times, serif; font-size:16px; color:#000000; line-height:25px; padding:15px;">'.$invitation_message.'</td>
            <td width="370" rowspan="2" align="center" valign="top"><img src="'.$SITE_SECURE_URL.'images/email/img1.jpg" alt="" width="370" height="344" /></td>
          </tr>';
if($event_mail_IR == "Invitation")
{
$mail_body.='
		  <tr>
			<td align="center" valign="top" style="padding:20px 0 0 0px; line-height:24px;">
			<a href="https://www.celebrateplus.com/event_detail.php?eve_id='.$event_id.'" style="font-family:Georgia, Times New Roman, Times, serif; font-size:16px; color:#FFFFFF; text-decoration:none;">View Event</a>
			</td>
		  </tr>';
}
else if($event_mail_IR == "Reminder")
{
 $mail_body.='<tr>
				<td align="center" valign="top" style="padding:20px 0 0 0px; line-height:24px; font-family:Georgia, Times New Roman, Times, serif; font-size:16px;">
				'.$organizer_first_name.' '.$organizer_last_name.' would like to remind you about '.$event_name.'. To view the event details <a href="https://www.celebrateplus.com/event_detail.php?eve_id='.$event_id.'" style="color:#FFFFFF; text-decoration:none;">click here</a>.
				</td>
			  </tr>';
}
$mail_body.='
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
  	<td align="right" style="padding:5px;"><a href="http://www.celebrateplus.com/" target="_blank"><img src="'.$SITE_SECURE_URL.'images/logo_invite_email.png" border="0"></a></td>
  </tr>
</table>';
?>



