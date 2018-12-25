<?php
function createEmailInvitation($event_id, $invitation_design_style, $invitation_message, $invitees,$SITE_SECURE_URL)
{
	//echo "$event_id $invitation_design_style $invitation_message $invitees";
	$event_mail_IR="Invitation";
	$event_mail_header="You are invited to";
	$event_name = GetValue("events","title","id",$event_id);

	$create_invitation_query = "insert into invitations set
						  `event_id` = '$event_id',
						  `invitation_date` = now(),
						  `design_style` = '$invitation_design_style',
						  `invitation_message` = '$invitation_message'";
						 
	$create_invitation_result = hb_get_result($create_invitation_query) or die(mysql_error());
	
	$invitations_id = mysql_insert_id();
	
	// Mail Sending Started
	// Separate all the invitees with the comma
	$invitees_array = explode(",",$invitees);
	foreach($invitees_array as $invitee)
	{
		$mail_to = trim($invitee," ");
		//echo "mailTo: $mail_to";
		
		$invit_email_q = "insert into invitations_email set
						event_id = $event_id,
						invitations_id = $invitations_id,
						add_date= now(),
						email = '$mail_to'";
						hb_get_result($invit_email_q) or die(mysql_error()); 
		// *** where it says "Event Name", it should populate with the name of the event that the user created when sending out the invitation mails.
		// So find here the name of the event
		$event_name = GetValue("events","title","id",$event_id);
		$mail_subject = "You have been invited to attend $event_name";
		
		
		// So first get here the id of organizer
		$organizer_id = GetValue("events","oid","id",$event_id);
		$organizer_first_name = GetValue("organizer","fname","id",$organizer_id);
		$organizer_last_name = GetValue("organizer","lname","id",$organizer_id);

		if($_SESSION['personal_photo'] == '' && isset($_FILES))
		{
			$personal_photo="";
			
			if ($_FILES["personal_photo"]["error"] > 0)
			{
				//echo "Error: " . $_FILES["full"]["error"] . "<br />";
			}
			else
			{
			   
			   $personal_photo = rand(1,999).trim($_FILES["personal_photo"]["name"]); 
			   move_uploaded_file($_FILES["personal_photo"]["tmp_name"],"uploads/".$personal_photo);
			   $_SESSION['personal_photo'] = $personal_photo;
			   
			   if($invitation_design_style == 11)
			   {
					$width = 386;
			   }
			   else if($invitation_design_style == 12)
			   {
					$width = 600;
			   }
				$thumb_image_path = "thumb_".$personal_photo;
				include_once('SimpleImage.php');
				$image = new SimpleImage();
				$image->load('uploads/'.$personal_photo);
				$image->resizeToWidth($width);
				$image->save('uploads/'.$thumb_image_path);
				$_SESSION['personal_photo'] = $thumb_image_path;
			}
		}
		
		if($invitation_design_style == "1")
		{
			include('email_design_1.php');
		}
		if($invitation_design_style == "2")
		{
			include('email_design_2.php');
		}
		if($invitation_design_style == "3")
		{
			include('email_design_3.php');
		}
		if($invitation_design_style == "4")
		{
			include('email_design_4.php');
		}
		if($invitation_design_style == "5")
		{
			include('email_design_5.php');
		}
		if($invitation_design_style == "6")
		{
			include('email_design_6.php');
		}
		if($invitation_design_style == "7")
		{
			include('email_design_7.php');
		}
		if($invitation_design_style == "8")
		{
			include('email_design_8.php');
		}
		if($invitation_design_style == "9")
		{
			include('email_design_9.php');
		}
		if($invitation_design_style == "10")
		{
			include('email_design_10.php');
		}
		if($invitation_design_style == "11")
		{
			include('email_design_11.php');
		}
		if($invitation_design_style == "12")
		{
			include('email_design_12.php');
		}
		
		// Now get the organizer email
		$mail_from = GetValue("organizer","fname","id",$organizer_id)." ".GetValue("organizer","lname","id",$organizer_id)."<".GetValue("organizer","email","id",$organizer_id).">";

		//echo $mail_to . $mail_subject . $mail_body . $mail_from;
		
		hb_send_mail($mail_to,$mail_subject,$mail_body,$mail_from);
	
	}
}