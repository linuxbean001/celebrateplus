<?php
	include("connect.php");
	$table = $_REQUEST['table_name'];
	$field = $_REQUEST['field'];
	
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
	$numerics[] = 32;
	
	$special_chars_array = array();
	
	$query = "select $field from $table";
	$result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($result))
	{		
		$value = keshav_decrypt($row[$field]);
		$string_length = strlen($value);
		for($i = 0;$i < $string_length;$i++)
		{
			$harmless = false;
			$character = $value{$i};
			if(!(in_array((ord($character)),$numerics)) && !(ctype_alpha($character)))
			{
				$special_chars_array[] = $character;
			}			
		}
	}
	$special_chars_array=array_unique($special_chars_array);
	echo "Total characters:   ".count($special_chars_array);
	echo "<br><br>".implode(" &nbsp; ",$special_chars_array);
?>