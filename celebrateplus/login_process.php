<?
    include("connect.php");	
    $email="";
	$password="";
	//print_r($_POST); 
	
	if($_POST['email']!="" && $_POST['password']!="")
	{
	    $email=GTG_security($_POST['email']);
	  
	   $password=$_POST['password'];	
		
       $log_query = "select * from organizer where email='".$email."' and password='".keshav_encrypt($password)."'";
	   

	   $log_result = hb_get_result($log_query);
	  //print_r($_REQUEST); exit;
	   if(mysql_num_rows($log_result))
	    { 
		  $log_row = mysql_fetch_array($log_result);		  
	    	$_SESSION['SESS_USER_ID'] = $log_row['id']; 	  
			
			if($_REQUEST['goto'] =="maybe")
			{
				
				$redirect="maybe.php?eve_id=".$_REQUEST['from_search']."&goto=maybe";
				
			}
			else if($_REQUEST['goto'] =="not_attending")
			{
				
				$redirect="not_attending.php?eve_id=".$_REQUEST['from_search']."&goto=not_attending";
				
			}
			else
			{
				if($_REQUEST['frm']!="")
				{
					$redirect="event_attending_confirmation.php?eve_id=".$_REQUEST['frm'];
				}
				else  if($_REQUEST['from_search'] !="")
				{
					$redirect="event_attending_confirmation.php?eve_id=".$_REQUEST['from_search'];
				}
				else  
				{
					$redirect="account_welcome.php";			
				}
			
				if($_SESSION['then_go'] != '')
				{
					// Now get the session into a local variable as we need to free it for other pages
					$then_go = $_SESSION['then_go'];
					
					
					// Now free the session
					unset($_SESSION['then_go']);
		
					$redirect = $then_go;	
				}
			}
		  
		}
		else
	    {
			
			
				$error='<script>alert("Invalid Username or Password.")</script>';
				$redirect="login.php";			
			
	    }		
    }
	else
	{ 
		
			$redirect="index.php";			
	}
	if($error!="")
	{
		echo $error;
	}
	//echo $redirect; exit;
	?>
	<script>
	location.href="<?=$redirect?>";
	</script>
	<?
 ?>