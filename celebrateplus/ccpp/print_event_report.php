<?									
include("connect.php");
$LeftLinkSection = 5;
$sel = "select events.*,organizer.id as organizer_id,organizer.username as organizer_name from events left join organizer on events.oid=organizer.id";
$result=$prs_pageing->number_pageing($sel,20,10,'N','Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$SITE_TITLE;?></title>

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
		alert("Enter Password");
		document.addprod.name.select();
		return false;
	}
}
</script>


</head>

<body onload="MM_preloadImages('images/main_controls.jpg','images/server_settings_o.jpg','images/product_o.jpg','images/usear_o.jpg','images/seo._o.jpg','images/static_page_o.jpg','images/inactive_tab_o.jpg','images/product_buttom_o.jpg','images/last_one_o.jpg')" style=" background:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td height="23" align="left" valign="top">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td align="left" valign="top">
				<table width="95%" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr><td>&nbsp;</td></tr>
					<? if($_GET["msg"]) { ?>
					 <? } 					  
					?> 
					<tr>
						<td>
							<form name="frmNewsList" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="10" align="left" valign="top">&nbsp;</td>
						  <td align="left" valign="middle" class="title_wrapper_middle" style="background:none; color:#000000; line-height:50px;">Event Report</td>
						  <td width="10" align="left" valign="top">&nbsp;</td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td align="left" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="2">
				
				<tr>
						
						<td  style="background-color:#E1E1E1; color:#333333">No.</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event Title</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event Start Date</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event End Date</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event City</td>
								<td    style="background-color:#E1E1E1; color:#333333">Event State</td>
								<td    style="background-color:#E1E1E1; color:#333333">Organizer Name</td>
								<td    style="background-color:#E1E1E1; color:#333333">Funding Goal</td>
								<td    style="background-color:#E1E1E1; color:#333333">Funded Amount</td>
								<td    style="background-color:#E1E1E1; color:#333333"># of Donators</td>
								<td    style="background-color:#E1E1E1; color:#333333"># of Attendees</td>
						</tr>
						  <? $count=0; 
							 while($get=mysql_fetch_object($result[0])) 
							 {  
								$count++;
						 ?>	 
							 <tr>
							  
							 <td height="49" style="background-color:#E1E1E1; color:#333333"><?=$count;?>.</td>
						 
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->title); ?></strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->sdate); ?></strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->edate); ?></strong></td>
							<td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->loc_city); ?></strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->loc_state); ?></strong></td>
							  <td style="background-color:#E1E1E1; color:#333333">  <strong> <? echo stripslashes($get->organizer_name); ?></strong></td>
							<td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->fund_amt); ?></strong></td>
							<td style="background-color:#E1E1E1; color:#333333"> <strong> <? echo stripslashes($get->current_fund); ?></strong></td>
							  <td style="background-color:#E1E1E1; color:#333333"> <strong> <? 
							  	$donator_query = "select count(id) from attendee where user_id = '".$get->id."' and funding = 'Yes'";
								$donator_result = hb_get_result($donator_query) or die(mysql_error());
								$total_donators = mysql_result($donator_result,0);
								echo $total_donators;
							   ?></strong></td><td style="background-color:#E1E1E1; color:#333333"> <strong> <? 
							  	$attendee_query = "select count(id) from attendee where user_id = '".$get->id."'";
								$attendee_result = hb_get_result($attendee_query) or die(mysql_error());
								$total_attendees = mysql_result($attendee_result,0);
								echo $total_attendees;
							   ?></strong></td>			  
				   </tr>
                <? } ?>			
				  
				
				 <input type="hidden" name="count" id="count" value="<?=$count;?>" />   
						 </table></td>
								</tr>
								<tr><td height="5px"></td></tr>
							</table></td>
						  </tr>
						</table>
						</form>
						<script>
							function chkSelectAll()
							{
								totchk=document.getElementById("count").value;
								if(document.getElementById("chkAll").checked==true)
								{
									for(a=1;a<=totchk;a++)
									{
										chkname="chk"+a;
										document.getElementById(chkname).checked=true;
									}
								}
								else
								{
									for(a=1;a<=totchk;a++)
									{
										chkname="chk"+a;
										document.getElementById(chkname).checked=false;
									}
								}
							}
							function chkDelete()
							{
								return confirm("Are you sure that you want to delete the selected Organizer.");
							}
						  </script>								</td>
							</tr>
						</table>				</td>
				  </tr>
				</table></td>
			  </tr>
			</table>
</body>
</html>
