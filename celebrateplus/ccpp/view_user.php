<?									
include("connect.php");

$LeftLinkSection = 1;
$pagetitle="User";

/* ---------------------- Declare Fields ---------------------- */

$add_date= "";
$username= "";
$password= "";
$cpassword= "";
$email= "";
$fname= "";
$lname= "";
$phone= "";
$city= "";
$state= "";

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
				$add_date= convert_us($row['add_date']);
				
				$password= stripslashes($row['password']);
				$cpassword= stripslashes($row['cpassword']);
				$email= stripslashes($row['email']);
				$fname= stripslashes($row['fname']);
				$lname= stripslashes($row['lname']);
				$phone= stripslashes($row['phone']);
				$city= stripslashes($row['city']);
				$state= stripslashes($row['state']);
				
		}
	}
	
}

/* ---------------------- Inser / Update Code ---------------------- */

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
</script></head>

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
		<td align="left" valign="top">
			<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
			 	<tr>
				<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
					  <td align="left" valign="middle" class="title_wrapper_middle"><? echo ($_GET["id"]>0)?"View":"View"; ?>
										User</td>
					  <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
					</tr>
				</table></td>
			  </tr>
			  <tr>
				<td align="left" valign="top" class="middle_right_bg">
					<TABLE  cellSpacing=0 cellPadding=0  border=0 width="95%" align="center">									
					<tr>
					  <td class="a-l" ><span style="color:#CC6600;">
						<?php 
								$msg = $_REQUEST['msg'];
								if($msg == 1)
									echo "<span style='color:#CC6600;'>User Added Successfully.</span>";	 
								elseif($msg == 2)
									echo "<span style='color:#CC6600;'>User Updated Successfully.</span>";	 
								elseif($msg == 3)
									echo "<span style='color:#CC6600;'>User Deleted Successfully.</span>";	 
								elseif($msg == 4)
									echo "<span style='color:#CC6600;'>User with this name is already exists.</span>";	 
									
								if($gmsg == 1)
									echo "Please enter all the information."; 
							?>
						</span></td>
					</tr>
					<TR>
					  <TD>
							<form action="add_user.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return keshav_check();">
							<input type="hidden" name="mode" id="mode" value="<?= $_REQUEST['mode']; ?>" >
							<table width="100%" border="0" align="left" cellpadding="3" cellspacing="3" class="solidinput">
							<tr>
							<td colspan="2" align="right" class="menu-a"><span class="a-l">* indicates required field</span>&nbsp;&nbsp;</td>
							</tr> 
							<tr>
							<td align="right" class="menu-a"><span class="a-l"><strong>Basic User Information :</strong></span>&nbsp;&nbsp;</td>
							</tr>
							  <tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Date Registered :</td>
								  <td width="71%" class="f-c"><?=$add_date; ?></td>
							 </tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c"><span style="color:#FF0000;">*</span>Email Address :</td>
								  <td width="71%" class="f-c"><?=$email; ?></td>
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
								  <td width="29%" align="right" class="f-c">Phone Number :</td>
								  <td width="71%" class="f-c"><?=$phone; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">City :</td>
								  <td width="71%" class="f-c"><?=$city; ?></td>
							</tr>
				
							<tr>
								  <td width="29%" align="right" class="f-c">State :</td>
								  <td width="71%" class="f-c"><?=$state; ?></td>
							</tr>
				 
					</table>
				</form>
			</TD>
			</TR>
		 </TABLE>
		</td>
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
		</table>
					</td>
					</tr>
				</table> 
			</td>
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
			
			
			/* -------------- Email Address Validation --------------------- */
			if(document.getElementById("email").value.split(" ").join("") == "" || document.getElementById("email").value.split(" ").join("") == "0")
			{
				alert("Please enter Email Address.");
				document.getElementById("email").focus();
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
			
			
}
</script>
</body>
</html>