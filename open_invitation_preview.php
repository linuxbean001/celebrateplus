<?php
include("connect.php");
if(isset($_REQUEST['submitted']))
{
	$event_mail_IR="Invitation";
	$event_mail_header="You are invited to";
	include("login_check.php");
	$event_id = $_REQUEST['event_id'];
	// First check whether this person has right to send invitation for this event
	if(GetValue("events","oid","id",$event_id) == $_SESSION['SESS_USER_ID'])
	{
		$invitation_design_style = $_REQUEST['invitation_design_style'];
		
		$invitation_message = $_REQUEST['invitation_message'];
		if($invitation_message == "")
		{
			$invitation_message="Your Personal Message Goes Here.";
		}
		$invitees = $_REQUEST['invitees'];
	
		$event_name = GetValue("events","title","id",$event_id);
		
		// So first get here the id of organizer
		$organizer_id = GetValue("events","oid","id",$event_id);
		$organizer_first_name = GetValue("organizer","fname","id",$organizer_id);
		$organizer_last_name = GetValue("organizer","lname","id",$organizer_id);
		
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
				include('SimpleImage.php');
				$image = new SimpleImage();
				$image->load('uploads/'.$personal_photo);
				$image->resizeToWidth($width);
				$image->save('uploads/'.$thumb_image_path);
				$_SESSION['personal_photo'] = $thumb_image_path;
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
		echo $mail_body;
		
	}
	else
	{
		location("index.php");
	}
}
else
{
	location("index.php");
}
?>