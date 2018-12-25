<? include("connect.php");

	$user_dt = $_REQUEST['user_id'];
	
	$fetchquery = "select * from organizer where id=".$user_dt;
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		
				
				$uemail= stripslashes($row['email']);
				$ufname= stripslashes($row['fname']);
				$ulname= stripslashes($row['lname']);
				
	}
?>						
					<table width="100%" cellpadding="3" cellspacing="3">
							<tr>
								  <td width="29%" align="right" class="f-c">User's First Name :</td>
								  <td width="71%" class="f-c"><input  name="ufname" type="text" readonly="readonly" id="ufname" value="<?=$ufname; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">User's Last Name :</td>
								  <td width="71%" class="f-c"><input  name="ulname" type="text" readonly="readonly" id="ulname" value="<?=$ulname; ?>" /></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">User's Email Address :</td>
								  <td width="71%" class="f-c"><input  name="uemail" type="text" readonly="readonly" id="uemail" value="<?=$uemail; ?>" /></td>
							</tr>
							</table>