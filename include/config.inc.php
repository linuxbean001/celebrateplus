<? 
include("secure_site.php");
define(Site_Name,"Welcome to cplus");
define(Site_Title,"Welcome to cplus");
$SITE_NAME="Welcome to cplus";
$SITE_URL="http://www.idxfresh.com/celebrateplus/";
$SITE_SECURE_URL="http://www.idxfresh.com/celebrateplus/"; 

$DBSERVER = "localhost";
$DATABASENAME = "celebrateplus";
$USERNAME = "root";
$PASSWORD = "divakar001";

$ADMIN_MAIL="";
$SITE_TITLE="Celebrate Plus";
$Site_title="Celebrate Plus";

$hb_site_url = "http://www.idxfresh.com/celebrateplus/";//http://www.celebrateplus.com/";

// All the files that needs login should be stored in this new array
$hb_login_needed = array();
$hb_login_needed[] = 'event_attending_confirmation.php';

//PayPal API Credentials
$API_UserName = "sbapi_1287090601_biz_api1.paypal.com"; //TODO
$API_Password = "1287090610"; //TODO
$API_Signature = "ANFgtzcGWolmjcm5vfrf07xVQ6B9AsoDvVryVxEQqezY85hChCfdBMvY"; //TOD0
	
//Default App ID for Sandbox	
$API_AppID = "APP-80W284485P519543T";

$API_RequestFormat = "NV";
$API_ResponseFormat = "NV";

$GBV_MONITOR_MAILS = false;				// put "true" if you need to monitor mails else put "false";
$GBV_MAILS_ENABLED = true;				// put "true" if you need mails enabled else put "false";

	$GLOBAL_API_KEY = 'eaty-te0-teyea';
	$GLOBAL_SECRET_NUMBER = '5';
?>