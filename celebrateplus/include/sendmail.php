<?php  
	function sendmail($to,$subject,$mailcontent,$from)
	{
		$array = split("@",$from,2);
		$SERVER_NAME = $array[1];
		$username =$array[0];
		$fromnew = "From: $username@$SERVER_NAME\nReply-To:$username@$SERVER_NAME\nX-Mailer: PHP";
		//$fromnew = "From: no-reply@celebrateplus.com\nReply-To:no-reply@celebrateplus.com\nX-Mailer: PHP";
		mail($to,$subject,$mailcontent,$fromnew);
	}
	function SendHTMLMail1($to1,$subject2,$mailcontent1,$from1,$cc="")
	{
		$limite = "_parties_".md5 (uniqid (rand()));
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from1\r\n";
		
		if($cc)
			$headers .= "Cc: $cc\r\n";
		
		//mail($to1,$subject2,$mailcontent1,$headers);
		
	}
	
	function hb_send_mail($to,$subject,$mail_body,$from,$cc="")
	{
		// Here I want to monitor all the mail that this site sends.
		// So fetch the global variable $monitor_mails here
		global $GBV_MONITOR_MAILS;
		global $GBV_MAILS_ENABLED;
		global $GBV_STOP_AFTER_MAIL_SENT;
		//$from = "no-reply@celebrateplus.com";
		if($GBV_MONITOR_MAILS == true)
		{
			echo "<br/>= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = ";
			echo "<br/>From		:	$from";
			echo "<br/>To		:	$to";
			echo "<br/>Subject	:	$subject";
			echo "<br/>Body		:	$mail_body";
			echo "<br/>= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = ";
		}
		$limite = "_parties_".md5 (uniqid (rand()));
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from\r\n";
		if($cc)
			$headers .= "Cc: $cc\r\n";
		
		if($GBV_MAILS_ENABLED == true)
		{
			mail($to,$subject,$mail_body,$headers) or hb_record_mail_error($to,$subject,$mail_body,$headers);
		}
		if($GBV_STOP_AFTER_MAIL_SENT == true)
		{
			exit;
		}
	}
	function hb_record_mail_error($mail_to,$mail_subject,$mail_body,$mail_from)
	{
		/* We should not only record the error but should also assign the user which experienced the user */
		global $global_user_id,$global_user_type;
		$file_name = addslashes($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
		$mail_to = addslashes($mail_to);
		$mail_subject = addslashes($mail_subject);
		$mail_body = addslashes($mail_body);
		$mail_from = addslashes($mail_from);
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$error_on = date('Y-m-d h:i:s');
		$hb_record_query = "insert into `mail_errors` set
								 `file_name` = '$file_name',
								 `mail_to` = '$mail_to',
								 `mail_subject` = '$mail_subject',
								 `mail_body` = '$mail_body',
								 `mail_from` = '$mail_from',
								 `ip_address` = '$ip_address',
								 `error_on` = '$error_on',
								 `user_id` = '$global_user_id',
								 `user_type` = '$global_user_type'";
		hb_get_result($hb_record_query) or die(mysql_error());
	}
?>