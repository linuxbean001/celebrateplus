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
			
			
				
				
				$redirect="acc_event_detail.php?eve_id=".$_REQUEST['event_id'];
					  
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