<?php
	include("connect.php");
	//include("admin.cookie.php");
	
	$query = "Select email from maillist order by email";
	$result =  hb_get_result($query);   
	$n = mysql_num_rows($result);
	$content = "Email \n";
	if($n > 0)
	{
		while($row = mysql_fetch_array($result))
		{
			$Email = str_replace(","," ",$row['email'])."\n";
			$content = $content.$Email;
		}
		mysql_free_result($result);
	}
	else
	{
		$content = "No Data Found !";
	}
	$tmp_file = "Exported_".date('m_d_Y').".csv";
	
	header("Content-Disposition: attachment; filename=$tmp_file");
	echo $content;
	exit();
?>



