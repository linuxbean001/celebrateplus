<?									
include("connect.php");

$LeftLinkSection = 1;
$pagetitle="Organizer";

/* ---------------------- Declare Fields ---------------------- */

$add_date= "";
$username= "";
$password= "";
$cpassword= "";
$fname= "";
$lname= "";
$email= "";
$phone= "";
$payment_method= "";
$mstreet_address= "";
$mapartment= "";
$mcity= "";
$mstate= "";
$mzip= "";
$mcountry= "";
$mcomments= "";
$paypalid= "";
$city= "";
$state= "";
$country= "";
$find_us= "";
$acc_notes= "";

/* ---------------------- Initialize Fields ---------------------- */

if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
	$id = $_REQUEST["id"];											
	$fetchquery = "select * from organizer where id=".$id;
	$result = hb_get_result($fetchquery);
	if(mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_array($result))
		{
				$add_date= stripslashes($row['add_date']);
				$username= stripslashes($row['username']);
				$password= stripslashes($row['password']);
				$cpassword= stripslashes($row['cpassword']);
				$fname= stripslashes($row['fname']);
				$lname= stripslashes($row['lname']);
				$email= stripslashes($row['email']);
				$phone= stripslashes($row['phone']);
				$payment_method= stripslashes($row['payment_method']);
				$mstreet_address= stripslashes($row['mstreet_address']);
				$mapartment= stripslashes($row['mapartment']);
				$mcity= stripslashes($row['mcity']);
				$mstate= stripslashes($row['mstate']);
				$mzip= stripslashes($row['mzip']);
				$mcountry= stripslashes($row['mcountry']);
				$mcomments= stripslashes($row['mcomments']);
				$paypalid= stripslashes($row['paypalid']);
				$city= stripslashes($row['city']);
				$state= stripslashes($row['state']);
				$country= stripslashes($row['country']);
				$find_us= stripslashes($row['find_us']);
				$acc_notes= stripslashes($row['acc_notes']);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

if(isset($_REQUEST['Submit']))
{
		$add_date= addslashes($_REQUEST['add_date']);
		$username= addslashes($_REQUEST['username']);
		$password= addslashes($_REQUEST['password']);
		$cpassword= addslashes($_REQUEST['cpassword']);
		$fname= addslashes($_REQUEST['fname']);
		$lname= addslashes($_REQUEST['lname']);
		$email= addslashes($_REQUEST['email']);
		$phone= addslashes($_REQUEST['phone']);
		$payment_method= addslashes($_REQUEST['payment_method']);
		$mstreet_address= addslashes($_REQUEST['mstreet_address']);
		$mapartment= addslashes($_REQUEST['mapartment']);
		$mcity= addslashes($_REQUEST['mcity']);
		$mstate= addslashes($_REQUEST['mstate']);
		$mzip= addslashes($_REQUEST['mzip']);
		$mcountry= addslashes($_REQUEST['mcountry']);
		$mcomments= addslashes($_REQUEST['mcomments']);
		$paypalid= addslashes($_REQUEST['paypalid']);
		$city= addslashes($_REQUEST['city']);
		$state= addslashes($_REQUEST['state']);
		$country= addslashes($_REQUEST['country']);
		$find_us= addslashes($_REQUEST['find_us']);
		$acc_notes= addslashes($_REQUEST['acc_notes']);
			if(isset($_REQUEST['mode']))
		{
			switch($_REQUEST['mode'])
			{
				case 'add' :
					if(GTG_is_dup_add('organizer','username',$username))
					{
						unset($_REQUEST['Submit']);	
						location("add_organizer.php?mode=add&msg=4");
						return;
					}
					
					$display_order=sam_get_display_order("organizer","");
					
					$query = "insert into organizer 
					set display_order='$display_order',add_date='$add_date',username='$username',password='$password',cpassword='$cpassword',fname='$fname',lname='$lname',email='$email',phone='$phone',payment_method='$payment_method',mstreet_address='$mstreet_address',mapartment='$mapartment',mcity='$mcity',mstate='$mstate',mzip='$mzip',mcountry='$mcountry',mcomments='$mcomments',paypalid='$paypalid',city='$city',state='$state',country='$country',find_us='$find_us',acc_notes='$acc_notes'"; 
					hb_get_result($query) or die(mysql_error());
					location("manage_organizer.php?msg=1");
				break;
				
				case 'edit' :
					if(GTG_is_dup_edit('organizer','username',$username,$_REQUEST['id']))
					{
						unset($_REQUEST['Submit']);	
						location("add_organizer.php?mode=edit&id=".$_REQUEST['id']."&msg=4");	
						return;
					}
					$query = "update organizer set add_date='$add_date',username='$username',password='$password',cpassword='$cpassword',fname='$fname',lname='$lname',email='$email',phone='$phone',payment_method='$payment_method',mstreet_address='$mstreet_address',mapartment='$mapartment',mcity='$mcity',mstate='$mstate',mzip='$mzip',mcountry='$mcountry',mcomments='$mcomments',paypalid='$paypalid',city='$city',state='$state',country='$country',find_us='$find_us',acc_notes='$acc_notes'"; 
					$query.=" where id=".$_REQUEST['id'];
					hb_get_result($query) or die(mysql_error());
					location("manage_organizer.php?msg=2");
				break;
				
			}	
		}
		
}	
if(isset($_REQUEST['mode']))
{
	switch($_REQUEST['mode'])
	{
		case 'delete' :
$query = "delete from organizer where id=".$_REQUEST['id'];     
			hb_get_result($query) or die(mysql_error());
			location("manage_organizer.php?msg=3");
		break;
	}	
}	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
	d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

</script>
<script type="text/javascript" src="js/switchcontent.js"></script>
<link href="css/rokmoomenu.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/rokmoomenu.js"></script>
<script type="text/javascript">
window.addEvent('domready', function() {
		new Rokmoomenu($E('ul.nav'), {
			bgiframe: false,
			delay: 500,
			animate: {
				props: ['opacity', 'width', 'height'],
				opts: {
					duration: 500,
					fps: 100,
					transition: Fx.Transitions.Expo.easeOut
				}
			}
		});
	});
</script>
<SCRIPT language=javascript src="body.js"></SCRIPT>
<script>
function valid()
{
	if(document.addprod.name.value=="")
	{
		alert("Enter client");
		document.addprod.name.select();
		return false;
	}
}
</script>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script language="JavaScript" type="text/javascript">
var xmlHttp
function top_GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
	{
	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
  catch (e)
	{
	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
  }
return xmlHttp;
}

function sam_GetSelectedItem(field_id)
{
var tmp=document.getElementById(field_id);
var len = tmp.length
var i = 0
var chosen = ","

for (i = 0; i < len; i++) {
if (tmp[i].selected) {
chosen = chosen +  tmp[i].value + ","
} 
}

return chosen
}
</script>
</head>
<body onload="MM_preloadImages('images/main_controls.jpg','images/server_settings_o.jpg','images/product_o.jpg','images/usear_o.jpg','images/seo._o.jpg','images/static_page_o.jpg','images/inactive_tab_o.jpg','images/product_buttom_o.jpg','images/last_one_o.jpg')">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><? include("top.php"); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="middle_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="23" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top" width="17%"><? include("left.php"); ?></td>
                <td align="left" valign="top"><table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
                                  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"View":"View"; ?> Organizer</td>
                                  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" class="middle_right_bg"><TABLE  cellSpacing=0 cellPadding=0  border=0 width="95%" align="center">
                                <tr>
                                  <td class="a-l" ><span style="color:#CC6600;">
                                    <?php 
								$msg = $_REQUEST['msg'];
								if($msg == 1)
									echo "<span style='color:#CC6600;'>Organizer Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>Organizer Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>Organizer Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>Organizer with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
                                    </span></td>
                                </tr>
                                <TR>
                                  <TD><form action="add_organizer.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
                                      <input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
                                      <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
                                        <tr>
                                          <td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td  align="right" class="menu-a"><span class="a-l"><strong>Basic Organizer Information :</strong></span></td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Date Registered :</td>
                                          <td width="71%" class="f-c"><?=$add_date; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Username :</td>
                                          <td width="71%" class="f-c"><?=$username; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Password :</td>
                                          <td width="71%" class="f-c"><?=$password; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Confirm Password :</td>
                                          <td width="71%" class="f-c"><?=$cpassword; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>First Name :</td>
                                          <td width="71%" class="f-c"><?=$fname; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Last Name :</td>
                                          <td width="71%" class="f-c"><?=$lname; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Email Address :</td>
                                          <td width="71%" class="f-c"><?=$email; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Phone Number :</td>
                                          <td width="71%" class="f-c"><?=$phone; ?></td>
                                        </tr>
                                        <tr>
                                          <td  align="right" class="menu-a"><span class="a-l"><strong>Payment Information :</strong></span></td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Preferred Payment Method :</td>
                                          <td width="71%" class="f-c"><?  echo $payment_method;?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="left">
										  <table width="100%" id="check_id" style="display:none; padding-left:140px; ">
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Mailing Street Address :</td>
                                                <td width="71%" class="f-c"><?=$mstreet_address; ?></td>
                                              </tr>
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Mailing Apt / Suite :</td>
                                                <td width="71%" class="f-c"><?=$mapartment; ?></td>
                                              </tr>
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Mailing City :</td>
                                                <td width="71%" class="f-c"><?=$mcity; ?></td>
                                              </tr>
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Mailing State :</td>
                                                <td width="71%" class="f-c"><?=$mstate; ?></td>
                                              </tr>
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Mailing Zip / Postal :</td>
                                                <td width="71%" class="f-c"><?=$mzip; ?></td>
                                              </tr>
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Mailing Country  :</td>
                                                <td width="71%" class="f-c"><?=$mcountry; ?></td>
                                              </tr>
                                              <tr>
                                                <td width="29%" align="right" class="f-c">Comments :</td>
                                                <td width="71%" class="f-c"><?=$mcomments; ?></td>
                                              </tr>
                                            </table>
											</td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="left">
										  <table width="100%" id="paypal_id" style="display:none; padding-left:190px;">
                                              <tr>
                                                <td width="29%" align="right" class="f-c">PayPal ID :</td>
                                                <td width="71%" class="f-c"><?=$paypalid; ?></td>
                                              </tr>
                                            </table>
										 </td>
                                        </tr>
										 <tr>
                                          <td  align="right" class="menu-a"><span class="a-l"><strong>Location  Information :</strong></span></td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c">City :</td>
                                          <td width="71%" class="f-c"><?=$city; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c">State :</td>
                                          <td width="71%" class="f-c"><?=$state; ?></td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c">Country :</td>
                                          <td width="71%" class="f-c"><?=$country; ?></td>
                                        </tr>
									<tr>
                                          <td  align="right" class="menu-a"><span class="a-l"><strong>Additional Information :</strong></span></td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c">How Did You Find Us :</td>
                                          <td width="71%" class="f-c"><? echo $find_us;?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="29%" align="right" class="f-c">Account Notes :</td>
                                          <td width="71%" class="f-c"><?php echo $acc_notes;?>
                                          </td>
                                        </tr>
                                        
                                      </table>
                                    </form></TD>
                                </TR>
                              </TABLE></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="10" align="left" valign="top"><img src="images/scb_left.png" width="10" height="10" /></td>
                                  <td align="left" valign="top" class="scb">&nbsp;</td>
                                  <td width="10" align="left" valign="top"><img src="images/scb_right.png" width="10" height="10" /></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><? include("footer.php"); ?></td>
  </tr>
</table>
<script language="javascript">
function keshav_check()
{
			/* -------------- Date Registered Validation --------------------- */
			if(document.getElementById("add_date").value.split(" ").join("") == "" || document.getElementById("add_date").value.split(" ").join("") == "0")
			{
				alert("Please enter Date Registered.");
				document.getElementById("add_date").focus();
				return false;
			}
			
			
			/* -------------- Username Validation --------------------- */
			if(document.getElementById("username").value.split(" ").join("") == "" || document.getElementById("username").value.split(" ").join("") == "0")
			{
				alert("Please enter Username.");
				document.getElementById("username").focus();
				return false;
			}
			
			
			/* -------------- Password Validation --------------------- */
			if(document.getElementById("password").value.split(" ").join("") == "" || document.getElementById("password").value.split(" ").join("") == "0")
			{
				alert("Please enter Password.");
				document.getElementById("password").focus();
				return false;
			}
			
			
			/* -------------- Confirm Password Validation --------------------- */
			if(document.getElementById("cpassword").value.split(" ").join("") == "" || document.getElementById("cpassword").value.split(" ").join("") == "0")
			{
				alert("Please enter Confirm Password.");
				document.getElementById("cpassword").focus();
				return false;
			}
			
			
			/* -------------- First Name Validation --------------------- */
			if(document.getElementById("fname").value.split(" ").join("") == "" || document.getElementById("fname").value.split(" ").join("") == "0")
			{
				alert("Please enter First Name.");
				document.getElementById("fname").focus();
				return false;
			}
			
			
			/* -------------- Last Name Validation --------------------- */
			if(document.getElementById("lname").value.split(" ").join("") == "" || document.getElementById("lname").value.split(" ").join("") == "0")
			{
				alert("Please enter Last Name.");
				document.getElementById("lname").focus();
				return false;
			}
			
			
			/* -------------- Email Address Validation --------------------- */
			if(document.getElementById("email").value.split(" ").join("") == "" || document.getElementById("email").value.split(" ").join("") == "0")
			{
				alert("Please enter Email Address.");
				document.getElementById("email").focus();
				return false;
			}
			
			
			/* -------------- Phone Number Validation --------------------- */
			if(document.getElementById("phone").value.split(" ").join("") == "" || document.getElementById("phone").value.split(" ").join("") == "0")
			{
				alert("Please enter Phone Number.");
				document.getElementById("phone").focus();
				return false;
			}
			
			
				/* -------------- Preferred Payment Method Validation --------------------- */
				if(document.getElementById("payment_method").value.split(" ").join("") == "" || document.getElementById("payment_method").value.split(" ").join("") == "0" || document.getElementById("payment_method").value.split(" ").join("") == "-")
				{
					alert("Please Select Preferred Payment Method.");
					document.getElementById("payment_method").focus();
					return false;
				}
				
				
}
function test(meth)
{
	
	if(meth=="Check")
	{
		document.getElementById("check_id").style.display='block';
		document.getElementById("paypal_id").style.display='none';
	}
	if(meth=="PayPal")
	{
		document.getElementById("paypal_id").style.display='block';
		document.getElementById("check_id").style.display='none';
	}
}

</script>
</body>
</html>
