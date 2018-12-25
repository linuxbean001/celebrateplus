<? 
$page_arr1=array(
array("Manage Accounts","manage_accounts.php",0),
array("Add Account","add_account.php?mode=add",0),);


$page_arr2=array(
array("Manage Events","manage_events.php",0),
array("Add Event","add_events.php?mode=add",0),);


$page_arr3=array(
array("Manage Attendees","manage_attendee.php",0),
array("Add Attendee","add_attendee.php?mode=add",0),);


$page_arr4=array(
array("Manage Users","manage_user.php",0),
array("Add User","add_user.php?mode=add",0),);

$Blog_cate=array(
array("Manage Resource Categories","manage_resource_categories.php",0),
array("Add Resource Category","add_resource_category.php?mode=add",0),);


$Blog_post=array(
array("Manage Resources","manage_resources.php",0),
array("Add Resources","add_resource.php?mode=add",0),);

$SubPage=array(
array("Manage Sub Pages","manage_subpage.php",0),
array("Add Sub Page","add_subpage.php?mode=add",0),);

$Home_Page=array(
array("Manage Home Page Features","manage_home_feature.php",0),
array("Add Home Page Features","add_home_feature.php?mode=add",0),);

$promos=array(
array("Manage Slides","manage_promo.php",0),
array("Add Slide","add_promo.php?mode=add",0),);

$promos1=array(
array("Manage Promos","manage_promos.php",0),
array("Add Promo","add_promos.php?mode=add",0),);

$maillistLink = array(
	array("Add eMail","add_maillist.php?mode=add",0),
	array("Manage eMail List","manage_maillist.php",0),
	//array("Send Newsletter","sendnewsletter.php",0)
);

$section_arr1=array (

array ("Accounts","manage_accounts.php",count($page_arr1),$page_arr1,"category.png"),

array ("Events","manage_events.php",count($page_arr2),$page_arr2,"category.png"),

array ("Attendees","manage_attendee.php",count($page_arr3),$page_arr3,"category.png"),

//array ("Users","manage_user.php",count($page_arr4),$page_arr4,"category.png"),
);

$Content = array (
array ("Resource Categories","manage_resource_categories.php",count($Blog_cate),$Blog_cate,"category.png"),

array ("Resources","manage_resources.php",count($Blog_post),$Blog_post,"category.png"),

array ("Sub Pages","manage_subpage.php",count($SubPage),$SubPage,"category.png"),

array ("Home Page Features","manage_home_feature.php",count($Home_Page),$Home_Page,"category.png"),

array ("Slides","manage_promo.php",count($promos),$promos,"category.png"),

array ("Content Promos","manage_promos.php",count($promos1),$promos1,"category.png"),

);

$section_arr2=array (

array ("Home","staticpage.php?id=1" ,0,"", "category.png"),

array ("How It Works","staticpage.php?id=2" ,0,"", "category.png"),

array ("Features","staticpage.php?id=3" ,0,"", "category.png"),

array ("About","staticpage.php?id=11" ,0,"", "category.png"),

array ("Find Event","staticpage.php?id=20" ,0,"", "category.png"),

array ("Advertise","staticpage.php?id=12" ,0,"", "category.png"),

array ("Help","staticpage.php?id=13" ,0,"", "category.png"),

array ("Signup","staticpage.php?id=4" ,0,"", "category.png"),

array ("Login","staticpage.php?id=26" ,0,"", "category.png"),

array ("Account Welcome","staticpage.php?id=15" ,0,"", "category.png"),

array ("Account Create Event","staticpage.php?id=16" ,0,"", "category.png"),

array ("Account Create Invitation","staticpage.php?id=21" ,0,"", "category.png"),

array ("Account Find An Event","staticpage.php?id=17" ,0,"", "category.png"),

array ("Account Events Attending","staticpage.php?id=18" ,0,"", "category.png"),

array ("Account Events Hosting","staticpage.php?id=19" ,0,"", "category.png"),

array ("Account Payment Setup","staticpage.php?id=22" ,0,"", "category.png"),

array ("Account Event Reminder","staticpage.php?id=25" ,0,"", "category.png"),

array ("Account","staticpage.php?id=5" ,0,"", "category.png"),

/*array ("User Signup","staticpage.php?id=6" ,0,"", "category.png"),

array ("User Account","staticpage.php?id=7" ,0,"", "category.png"),*/

array ("Resources","staticpage.php?id=8" ,0,"", "category.png"),

array ("Policies","staticpage.php?id=9" ,0,"", "category.png"),

array ("Terms Of Service","staticpage.php?id=14" ,0,"", "category.png"),

array ("Site Map","staticpage.php?id=10" ,0,"", "category.png"),

array ("Contribution Confirmation","staticpage.php?id=24" ,0,"", "category.png"),

);

$page_arr15=array(
array("Manage Sub Admins","manage_sub_admin.php",0),
array("Add Sub Admin","add_sub_admin.php?mode=add",0),);

$Change=array(
array("Change Password","changepass.php",0),
);

$advertiser=array(
array("Manage Advertisers","manage_advertiser.php",0),
array("Add Advertiser","add_advertiser.php?mode=add",0),);

$ad=array(
array("Manage Ads","manage_ad.php",0),
array("Add Ad","add_ad.php?mode=add",0),);

$section_arr3=array (

array ("Sub Admins","manage_sub_admin.php",count($page_arr15),$page_arr15,"category.png"),
array ("Change Password","changepass.php",count($Change),$Change,"category.png"),
array ("Commission Rate","commission_setup.php",count($Change),$Change,"category.png"),
array ("Advertisers","manage_advertiser.php",count($advertiser),$advertiser,"category.png"),
array ("Ads","manage_ad.php",count($ad),$ad,"category.png"),
array("eMail List","manage_maillist.php",count($maillistLink),$maillistLink,"contact_us.png"),
);
$Fund_event=array(
array("Funding by Event","funding_by_event.php",0),
);
$payment12=array(
array("Payments","payments.php",0),
);


$Funding=array (

array ("Funding by Event","funding_by_event.php",count($Fund_event),$Fund_event,"category.png"),
array ("Payments","payments.php",count($payment12),$payment12,"category.png"),

);
$event_report=array(
array("Event Report","event_report.php",0),
);
$organizer_report=array(
array("Organizer Report","organizer_report.php",0),
);
$user_attendee_report=array(
array("User Attendee Report","user_attendee_report.php",0),
);

$Reports = array (
array ("Event Report","event_report.php",count($event_report),$event_report,"category.png"),
array ("Organizer Report","organizer_report.php",count($organizer_report),$organizer_report,"category.png"),
array ("User Attendee Report","user_attendee_report.php",count($user_attendee_report),$user_attendee_report,"category.png"),
);


$HeadLinksArray = array (

array("USERS",count($section_arr1),$section_arr1),

array("FUNDING - PAYMENTS",count($Funding),$Funding),

array("PAGES",count($section_arr2),$section_arr2),

array("CONTENT",count($Content),$Content),

array("REPORTS",count($Reports),$Reports),

array("SYSTEM",count($section_arr3),$section_arr3),
		
);
 ?>
<script language="javascript" type="text/javascript">	
	
	var NoOffFirstLineMenus=<? echo count($HeadLinksArray).";"; ?>	//Total No. Of Main Sections Specify Here Too
	var LowBgColor='#FFFFFF';		
	var LowSubBgColor='#FFFFFF';		
	var HighBgColor='#7B9045';		
	var HighSubBgColor='#666666';	
	var FontLowColor='#333333';		
	var FontSubLowColor='#333333';	
	var FontHighColor='White';		
	var FontSubHighColor='White';	
	var BorderColor='#333333';		
	var BorderSubColor='#333333';	
	var BorderWidth=1;				
	var BorderBtwnElmnts=1;			
	var FontFamily="Verdana,Arial"	
	var FontSize=9;					
	var FontBold=1;					
	var FontItalic=0;				
	var MenuTextCentered='center';	
	var MenuCentered='center';		
	var MenuVerticalCentered='top';	
	var ChildOverlap=.0;			
	var ChildVerticalOverlap=.0;	
	var StartTop=94;				
	var StartLeft=0;				
	var VerCorrect=0;				
	var HorCorrect=0;				
	var LeftPaddng=3;				
	var TopPaddng=3;				
	var FirstLineHorizontal=1;		
	var MenuFramesVertical=0;		
	var DissapearDelay=75;			
	var TakeOverBgColor=0;			
	var FirstLineFrame='navig';		
	var SecLineFrame='navig';		
	var DocTargetFrame='navig';		
	var TargetLoc='';				
	var HideTop=0;					
	var MenuWrap=0;					
	var RightToLeft=0;				
	var UnfoldsOnClick=0;			
	var WebMasterCheck=0;			
	var ShowArrow=0;				
	var KeepHilite=1;				
	var Arrws=['../images/tri.gif',3,10,'../images/tridown.gif',6,4,'../images/trileft.gif',5,10];	// Arrow source, width and height
	
function BeforeStart(){return}
function AfterBuild(){return}
function BeforeFirstOpen(){return}
function AfterCloseAll(){return}

<?
	for($LinkCount=1;$LinkCount<=count($HeadLinksArray);$LinkCount++)
	{
		////////// FOR MAIN MENU (IE) 1ST LEVEL OF MENU (HEADING)/////////////////////
		/*echo 'Menu'.$LinkCount.' = new Array("'.$HeadLinksArray[$LinkCount-1][0].'","'.$HeadLinksArray[$LinkCount-1][5].'","",'.$HeadLinksArray[$LinkCount-1][1].','.$HeadLinksArray[$LinkCount-1][2].','.$HeadLinksArray[$LinkCount-1][3].');';*/
			
			$TempChildAry = $HeadLinksArray[$LinkCount-1][4];
			if(is_array($TempChildAry))
			{
				for($LinkCount2=1;$LinkCount2<=count($TempChildAry);$LinkCount2++)
				{
					////////// FOR SUB OF THE MENU (IE) 2ND LEVEL OF MENU/////////////////////
					/*echo "\n Menu".$LinkCount."_".$LinkCount2." = new Array('".$TempChildAry[$LinkCount2-1][0]."','".$TempChildAry[$LinkCount2-1][1]."','".$TempChildAry[$LinkCount2-1][2]."',".$TempChildAry[$LinkCount2-1][3].",".$TempChildAry[$LinkCount2-1][4].",".$TempChildAry[$LinkCount2-1][5].");";*/
					
							
							$TempChildAry2 = $TempChildAry[$LinkCount2-1][6];
							
							if(is_array($TempChildAry2))
							{
								////////// FOR SUB - SUB OF THE MENU (IE) 3RD LEVEL OF MENU///////////////////// 							
								for($LinkCount3=1;$LinkCount3<=count($TempChildAry2);$LinkCount3++)
								{
										/*echo "\n Menu".$LinkCount."_".$LinkCount2."_".$LinkCount3." = new Array('".$TempChildAry2[$LinkCount3-1][0]."','".$TempChildAry2[$LinkCount3-1][1]."','".$TempChildAry2[$LinkCount3-1][2]."',".$TempChildAry2[$LinkCount3-1][3].",".$TempChildAry2[$LinkCount3-1][4].",".$TempChildAry2[$LinkCount3-1][5].");";*/
										
								}
							}
					
				}
			}
		
	}
?>
</script>