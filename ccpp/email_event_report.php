<?									
include("connect.php");
$LeftLinkSection = 5;
$sel = "select events.*,organizer.id as organizer_id,organizer.username as organizer_name from events left join organizer on events.oid=organizer.id";
$result=$prs_pageing->number_pageing($sel,20,10,'N','Y');

$mail_body .=  '<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="10" align="left" valign="top">&nbsp;</td>
						  <td align="left" valign="middle" class="title_wrapper_middle" style="background:none; color:#000000; line-height:50px;">Event Report</td>
						  <td width="10" align="left" valign="top">&nbsp;</td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="2">
				
				<tr>
						
						<td  style="background-color:#E1E1E1; color:#333333">No.</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event Title</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event Start Date</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event End Date</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event City</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event State</td>
								<td    style="background-color:#E1E1E1; color:#333333">Organizer Name</td>
								<td    style="background-color:#E1E1E1; color:#333333">Funding Goal</td>
								<td    style="background-color:#E1E1E1; color:#333333">Funded Amount</td>
								<td    style="background-color:#E1E1E1; color:#333333"># of Donators</td>
								<td    style="background-color:#E1E1E1; color:#333333"># of Attendees</td>
						</tr>';
						   $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
								$count++;
						 	 
							 $mail_body .=  '<tr>
							  
							 <td height="49" style="background-color:#E1E1E1; color:#333333">'.$count.'.</td>
						 
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->title).'</strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->sdate).'</strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->edate).'</strong></td>
							<td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->loc_city).'</strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->loc_state).'</strong></td>
							  <td style="background-color:#E1E1E1; color:#333333">  <strong> '. stripslashes($get->organizer_name).'</strong></td>
							<td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->fund_amt).'</strong></td>
							<td style="background-color:#E1E1E1; color:#333333"> <strong> '. stripslashes($get->current_fund).'</strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong>';  
							  	$donator_query = "select count(id) from attendee where user_id = '".$get->id."' and funding = 'Yes'";
								$donator_result = hb_get_result($donator_query) or die(mysql_error());
								$total_donators = mysql_result($donator_result,0);
								 
							$mail_body .=  $total_donators.'</strong></td><td style="background-color:#E1E1E1; color:#333333"> <strong>';  
							  	$attendee_query = "select count(id) from attendee where user_id = '".$get->id."'";
								$attendee_result = hb_get_result($attendee_query) or die(mysql_error());
								$total_attendees = mysql_result($attendee_result,0);
								
							   $mail_body .=  $total_attendees.'</strong></td></tr>';			  
				   
                 } 			
				  
				
				 $mail_body .=  '<input type="hidden" name="count" id="count" value="<?=$count;?>" />   
						 </table></td>
								</tr>
								<tr><td height="5px"></td></tr>
							</table></td>
						  </tr>
						</table>';
	$to = "support@idealgrowth.com";
	$from="Celebrate Plus";
	$reply_to="info@cplus.com";
	$subject = "Event report from Celebrate Plus";
	SendHTMLMail1($to,$subject,$mail_body,$from,$reply_to);
	?>
	<script>
		alert("Event report mailed successfully.");
		window.close();
	</script>