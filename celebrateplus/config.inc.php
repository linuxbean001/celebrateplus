<? 
//include("secure_site.php");
define(Site_Name,"Welcome to cplus");
define(Site_Title,"Welcome to cplus");
$SITE_NAME="Welcome to cplus";
$SITE_URL="http://www.celebrateplus.com";
$SITE_SECURE_URL="https://www.celebrateplus.com";

$DBSERVER = "localhost";
$DATABASENAME = "celebrateplus";
$USERNAME = "root";
$PASSWORD = "divakar001";

$ADMIN_MAIL="";
$SITE_TITLE="Celebrate Plus";
$Site_title="Celebrate Plus";

$hb_site_url = "";

// All the files that needs login should be stored in this new array
$hb_login_needed = array();
$hb_login_needed[] = 'event_attending_confirmation.php';

//PayPal API Credentials
$API_UserName = ""; //TODO
$API_Password = ""; //TODO
$API_Signature = ""; //TOD0
	
//Default App ID for Sandbox	
$API_AppID = "";

$API_RequestFormat = "NV";
$API_ResponseFormat = "NV";

$GBV_MONITOR_MAILS = false;				// put "true" if you need to monitor mails else put "false";
$GBV_MAILS_ENABLED = true;				// put "true" if you need mails enabled else put "false";

	$GLOBAL_API_KEY = 'eaty-te0-teyea';
	$GLOBAL_SECRET_NUMBER = '5';
?>