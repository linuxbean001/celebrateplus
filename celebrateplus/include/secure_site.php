<?
	 // The variables that should be allowed skipping from prsona_security() should be assigned to following array.
	$allowed_variables = array();
	$allowed_variables[] = 'acc_notes';
	$allowed_variables[] = 'content';
	$allowed_variables[] = 'summary';
	$allowed_variables[] = 'description';
	$allowed_variables[] = 'post_summary';
	$allowed_variables[] = 'full_content';
	$allowed_variables[] = 'content1';
	$allowed_variables[] = 'description121';
	$allowed_variables[] = 'summary121';

		
	// The variables that should be allowed skipping from checkNum() function should be assigned to following array.
	$allowed_ids = array();
	$allowed_ids[] = 'paypalid';
	
	// The file variables that should be allowed skipping from security should be assigned to following array.
	$allowed_files = array();
	
	// The files that should be checked as image should be store in $image_files array
	$image_files = array();
	$image_files[] = 'image_path';
	$image_files[] = 'img_path';
	
	// The files that should be checked as doc should be stored in $doc_files array
	$doc_files = array();
	$doc_files[] = 'map_path';	

if(!function_exists("checkNum")) {
function checkNum($id)
{
	return mysql_escape_string(intval($id));
}}

function hb_remove_unexpected($value)
{
	$custom_harmless = array();
	$custom_harmless[] = '#';
	$custom_harmless[] = '&';
	$custom_harmless[] = '_';
	$custom_harmless[] = ' ';
	$custom_harmless[] = '@';
	$custom_harmless[] = '.';
	$custom_harmless[] = '-';
	
	$numerics = array();
	$numerics[] = 48;
	$numerics[] = 49;
	$numerics[] = 50;
	$numerics[] = 51;
	$numerics[] = 52;
	$numerics[] = 53;
	$numerics[] = 54;
	$numerics[] = 55;
	$numerics[] = 56;
	$numerics[] = 57;	
	
	$string_length = strlen($value);
	for($i = 0;$i < $string_length;$i++)
	{
		$harmless = false;
		$character = $value{$i};
		if(in_array((ord($character)),$numerics))
		{
			$harmless = true;
		}
		else if(ctype_alpha($character))
		{
			$harmless = true;
		}
		else if(in_array($character,$custom_harmless))
		{
			$harmless = true;
		}
		//echo "<br/>Character : $character	Status : $harmless";
		if($harmless == false)
		{
			$value{$i} = '';
		}
	}
	
	$harmful_words = array();
	$harmful_words[] = 'select';
	$harmful_words[] = 'insert';
	$harmful_words[] = 'update';
	$harmful_words[] = 'from';
	$value = str_ireplace($harmful_words,"",$value);
	$value = trim($value);
	
	return $value;
}
function hb_string_security($value)
{
	if($value != '')
	{
		//return htmlspecialchars(strip_tags(mysql_escape_string($value)));
		$value = strval($value);
		$without_escape_string = mysql_escape_string($value);
		$without_tags = strip_tags($without_escape_string);
		$without_special_characters = htmlspecialchars($without_tags);
		$without_slashes = stripslashes($without_special_characters);
		return $without_slashes;
	}
}
function hb_secure_request($allowed_variables = array())
{
	global $allowed_ids;
	// Only variables that are listed in $allowed_variables should be allowed to go as it is in the database. others should be sent through prsona_security()
	if(is_array($_REQUEST))
	{
		foreach($_REQUEST as $current_variable_name=>$current_variable_value)
		{
			if(!(is_array($current_variable_value)))							// The value of the variable should not be an array
			{
				if(!(in_array($current_variable_name,$allowed_variables)))		// The name of the variable should not be an array
				{
					$_REQUEST[$current_variable_name] = hb_string_security($current_variable_value);
					if($_REQUEST[$current_variable_name] == $_GET[$current_variable_name])
					{
						$_REQUEST[$current_variable_name] = hb_remove_unexpected($current_variable_value);
						$_GET[$current_variable_name] = hb_remove_unexpected($current_variable_value);
					
						if(stristr($current_variable_name,'id'))
						{
							if(!(in_array($current_variable_name,$allowed_ids)))
							{
								$_REQUEST[$current_variable_name] = checkNum($current_variable_value);
								$_GET[$current_variable_name] = checkNum($current_variable_value);
							}
						}
					}
				}
			}
		}
	}
	if(is_array($_POST))
	{
		foreach($_POST as $current_variable_name=>$current_variable_value)
		{
			if(!(is_array($current_variable_value)))							// The value of the variable should not be an array
			{
				if(!(in_array($current_variable_name,$allowed_variables)))		// The name of the variable should not be an array
				{
					$_POST[$current_variable_name] = hb_string_security($current_variable_value);
				}
			}
		}
	}
	if(is_array($_GET))
	{
		foreach($_GET as $current_variable_name=>$current_variable_value)
		{
			if(!(is_array($current_variable_value)))							// The value of the variable should not be an array
			{
				if(!(in_array($current_variable_name,$allowed_variables)))		// The name of the variable should not be an array
				{
					$_GET[$current_variable_name] = hb_string_security($current_variable_value);
					if($_REQUEST[$current_variable_name] == $_GET[$current_variable_name])
					{
						$_REQUEST[$current_variable_name] = hb_remove_unexpected($current_variable_value);
						$_GET[$current_variable_name] = hb_remove_unexpected($current_variable_value);
					
						if(stristr($current_variable_name,'id'))
						{
							if(!(in_array($current_variable_name,$allowed_ids)))
							{
								$_REQUEST[$current_variable_name] = checkNum($current_variable_value);
								$_GET[$current_variable_name] = checkNum($current_variable_value);
							}
						}
					}
				}
			}
		}
	}
}
function hb_check_image($file_name_array,$redirect_url='',$valid_mime_types = array("image/gif", "image/pjpeg", "image/jpeg", "image/jpg", "image/png", "application/x-shockwave-flash"))
{
	if($file_name_array['tmp_name'] != '')
	{
		
	$error = 0; 
	
	// If any file has more than one extension then we should not allow that file.
	$separated_file_name = explode(".",$file_name_array['name']);
	$total_parts = count($separated_file_name);
	if($total_parts > 2)
	{
		$error = 3;
	}
	
	$blacklist = array(".php", ".phtml");
	foreach ($blacklist as $item) {
	   if(preg_match("/$item/i", $file_name_array['name'])) 
	   {
		   $error = 1;
	   }
	}
	
	if($error == 0)
	{
		$imageinfo = getimagesize($file_name_array['tmp_name']);
		$mime_type = $imageinfo['mime'];
		if(!in_array($mime_type, $valid_mime_types, true))
		{
			$error = 2;
		}
	}
	
	
	if($error != 0)
	{
		if($error == 1){ $msg="We do not allow uploading PHP files."; }
		if($error == 2){ $msg="Sorry, we only accept GIF,JPEG,PNG,SWF files."; }
		if($error == 3){ $msg="Sorry, we only accept files containing only one extension."; }
		if($redirect_url != '')
		{
			?>
				<script language="javascript">
					alert("<?=$msg;?>");
					window.location.href='<?=$redirect_url;?>';
				</script>
			<?
		}
		else
		{	
			?>
				<script language="javascript" type="text/javascript">
					alert("<?=$msg;?>");
					window.history.go(-1);
				</script>
			<?
		}
		exit;
	}
	}
}
function hb_check_doc($file_name_array,$redirect_url='')
{
	if($file_name_array['tmp_name'] != '')
	{
		
	$error = 0; 
	
	// If any file has more than one extension then we should not allow that file.
	$separated_file_name = explode(".",$file_name_array['name']);
	$total_parts = count($separated_file_name);
	if($total_parts > 2)
	{
		$error = 3;
	}
	
	$blacklist = array(".php", ".phtml");
	foreach ($blacklist as $item) {
	   if(preg_match("/$item/i", $file_name_array['name'])) 
	   {
		   $error = 1;
	   }
	}
	
	if($error == 0)
	{
	if((
	($file_name_array["type"] == "text/plain") || 
	($file_name_array["type"] == "application/msword") || 
	($file_name_array["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || 
	($file_name_array["type"] == "application/vnd.ms-excel") || 
	($file_name_array["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") || 
	($file_name_array["type"] == "application/vnd.ms-powerpoint") || 
	($file_name_array["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation") || 
	($file_name_array["type"] == "text/rtf") || 
	($file_name_array["type"] == "application/pdf") || 
	($file_name_array["type"] == "image/gif") || 
	($file_name_array["type"] == "image/pjpeg") || 
	($file_name_array["type"] == "image/jpeg") || 
	($file_name_array["type"] == "image/jpg") || 
	($file_name_array["type"] == "image/png") || 
	($file_name_array["type"] == "application/x-shockwave-flash")
	))
	{}
	else
	{
		$error = 2;
	}
	}
	
	if($error != 0)
	{
		if($error == 1){ $msg="We do not allow uploading PHP files."; }
		if($error == 2){ $msg="Sorry, please enter a valid file."; }
		if($error == 3){ $msg="Sorry, we only accept files containing only one extension."; }
		if($redirect_url != '')
		{
			?>
				<script language="javascript">
					alert("<?=$msg;?>");
					window.location.href='<?=$redirect_url;?>';
				</script>
			<?
		}
		else
		{	
			?>
				<script language="javascript" type="text/javascript">
					alert("<?=$msg;?>");
					window.history.go(-1);
				</script>
			<?
		}
		exit;
	}
	}
}
function hb_secure_files($allowed_files)
{
	global $image_files;
	global $doc_files;
	if(is_array($_FILES))
	{
		foreach($_FILES as $current_variable_name=>$current_variable_value)
		{
				if(!(in_array($current_variable_name,$allowed_files)))		// The name of the file variable should not be in array
				{
					if(in_array($current_variable_name,$image_files))
					{
						hb_check_image($current_variable_value);
					}
					else if(in_array($current_variable_name,$doc_files))
					{
						hb_check_doc($current_variable_value);
					}
					else
					{
						hb_check_image($current_variable_value);
					}
				}
		}
	}
}
hb_secure_request($allowed_variables);
hb_secure_files($allowed_files);
?>
