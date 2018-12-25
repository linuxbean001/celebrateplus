<? 
if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
{
}
else
{
	$eve = $_REQUEST['eve_id'];
	location("login.php?frm=$eve");
}

if(isset($_REQUEST['edit_id']))
{
$event_org_id = GetValue("events","oid","id",$_REQUEST['edit_id']);

	if($event_org_id == $_SESSION['SESS_USER_ID'])
	{
	
	}
	else
	{
		?>
		<script language="javascript">
			alert("You do not have permission to access this event.");
			window.location.href="account_welcome.php";
		</script>
		<?
		exit;
	}
}

if(isset($_REQUEST['event_id']))
{
$event_org_id = GetValue("events","oid","id",$_REQUEST['event_id']);

	if($event_org_id == $_SESSION['SESS_USER_ID'])
	{
	
	}
	else
	{
		?>
		<script language="javascript">
			alert("You do not have permission to access this event.");
			window.location.href="account_welcome.php";
		</script>
		<?
		exit;
	}
}

if(isset($_REQUEST['eve_id']))
{
$event_org_id = GetValue("events","oid","id",$_REQUEST['eve_id']);

	if($event_org_id == $_SESSION['SESS_USER_ID'])
	{
	
	}
	else
	{
		?>
		<script language="javascript">
			alert("You do not have permission to access this event.");
			window.location.href="account_welcome.php";
		</script>
		<?
		exit;
	}
}

?>