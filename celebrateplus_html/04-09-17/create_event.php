<? include("connect.php");
//include("login_check.php");

	/*------------------------------ Validate User to create event ---------------*/
	
		$event_result_array = sh_get_validate_user_to_create_event_vars();
		$total_funding_event = $event_result_array['total_funding_event'];
		$total_fund_active_event = $event_result_array['total_fund_active_event'];
		
	/*----------------------------------------------------------------------------*/
?>
<? 
	$acc_pg_name='create_event';
$a = GetContent(16);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
	.save_without_creating_invitation
	{
		background: url("images/save_without_creating_invit.png") no-repeat scroll 0 0 transparent;
		border: medium none;
		cursor: pointer;
		float: left;
		height: 33px;
		width: 274px;
	}
	.cplus_acctcreateevent .reg_wid_form_name
	{
		width:155px;
	}
</style>

<script type="text/javascript" src="js/jquery-1.10.1.js"></script>

<script type="text/javascript" src="js/zebra_datepicker.js"></script>
<script type="text/javascript" src="js/formee.js"></script>
<script type="text/javascript" src="js/image-picker.js"></script>
<script type="text/javascript" src="js/jquery.lightbox_me.js"></script>
<link rel="stylesheet" href="css/formee-structure.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/formee-style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/image-picker.css" type="text/css" media="screen" />



<style type="text/css">
* {margin:0;padding:0;}
/* fix  ff bugs */
form:after, div:after, ol:after, ul:after, li:after, dl:after {
    content:".";
    display:block;
    clear:both;
    visibility:hidden;
    height:0;
    overflow:hidden;
}
form {clear:both;}
.container {margin:0 auto; height:100%;padding:0 40px;}
.footer, .footer a {color:#fff;}
.left {float:left;}
.right {float:right;}
.topbar {
    background: #fafafa;
    padding: 10px 30px;
  border-bottom:1px solid #e9e9e9;
}
.topbar a{
    color:#777;
    font-size:1.4em;
    text-decoration: none;
}
.topbar a:hover{
    color:#69a4d0;
    text-decoration: underline;
}
.formeebar {
    background: #f5f5f5;
    padding:30px;
  border-bottom:1px solid #e9e9e9;
  margin-bottom:40px;
}
.formeebar a {color:#fff;font-size:1.4em;text-decoration: none;}
.formeebar h1 {
  clear:both;
  float:left;
}
.formeebar h1 a{
  background: transparent url(img/formee-logo.png) no-repeat left top;
  text-indent:-9999px;
  overflow: hidden;
  width:147px;
  height: 50px;
  display: block;
}
.formeebar h2 {
    color:#520026;
    font-size:2.4em;
    font-weight:normal;
     float:right;
     display:inline;
     margin-top:20px;
}

.link-to {
    font-size:2.4em;
    letter-spacing:-.02em;
    line-height:1em;
    color:#EA0076;
    float:right;
    margin-bottom:2em;
}

.sendViaField
{
  width:160px;
  margin-left:0 !important;
  margin-bottom:18px !important;
}

.stepHeader
{
  font-size:26px;
  text-align:center;
  font-weight:bold;
  line-height: 1.3;
  margin-top:1em;
}
.moreLink
{
  float:right;text-decoration:underline;color:blue;cursor:pointer;
}

.fundingOptions
{
  display:none;
}

.addressDetail
{
  display: none
}

.sendViaLabel
{
  display:inline-block;width:60px;
  font-weight:normal;
}

/* footer */
.footer {background: #520026;padding:30px 0;margin-top:40px;color:#fff;}
.footer p {line-height:1.1em; font-size:1.2em; margin-bottom:.3%;}
.footer a {color:#F0CF73;font-size:1.4em;text-decoration: none;}
</style>



<?php include_once("google_analytics.php");?>
</head>
    <body>
      <div id='loginDiv' style='display:none;background-color:#FFF;width:300px;'>
        <img src="img/close-button.png" style="cursor:pointer;position:absolute;z-index:999;" class='close'>
        <form id='loginForm' class='formee'>
          <div class='grid-2-12 clear'></div>
          <div class='grid-8-12 '>
            <label>Email:</label>
            <input type='text' name='email' />
          </div>
          <div class='grid-2-12 clear'></div>
          <div class='grid-8-12 '>
            <label>Password:</label>
            <input type='password' name='password' />
          </div>
          <div class='grid-2-12 clear'></div>
          <div class='grid-8-12 '>
            <input type='button' value='Login' onclick='loginUser();' />
          </div>
        <input type='hidden' name='f' value='login' />
        </form>
      </div>

    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Create An Event</div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_regconf"> <!-- style="min-height:470px; padding-top:10px;" -->
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
								<?php  
								if($total_funding_event >= 3)
								{
									?>
									<div class="tab_box_bg_inner_left_text_regconf" style="padding-top:10px; color:#FF0000;">Due to money laundering policies upheld by CelebratePlus, we can only allow you to host 3 events which collect funding per year. The year period is determined based on your signup date.<br /><br />
									 You can still add events to your account, however you can not have more than three events which have accepted funding per year.</div>	
									<?php
								}
								else if($total_fund_active_event >= 2) { ?>
								<div class="tab_box_bg_inner_left_text_regconf" style="padding-top:10px; color:#FF0000;">You currently have two events active and collecting funding. Due to money laundering policies that CelebratePlus upholds, you can only have two events active and collecting funding at the same time. <br /><br />
								You can still add events to your account, however you can not have more than two events which accept funding.</div>
								<?php } ?>
								
                                <form id='form' class="formee" name="CREATE_EVENT" id="CREATE_EVENT" enctype="multipart/form-data" action="save_event.php" method="post" onsubmit="javascript:return crt_event_chk()"> <!---->
    <fieldset>
    <div class='stepHeader grid-12-12 clear'>
      Step 1: Invite<br/><hr>
      <span style='font-size:18px;font-weight:normal;'>Tell Others About Your Event</span>
    </div>

        <div class='grid-6-12 clear'>
          <label id='selectInvitationLabel' class='invitationGroup'>Select Invitation Design or Upload Picture</label>
          <span style='text-decoration:underline;color:blue;cursor:pointer;' id='inviteToggle' onclick='inviteToggle();'>Invite Later</span><br/><br/>
          <div id='invitationDesignDiv' class='invitationGroup'>
            <a href='view_invitation_design.php' target=_blank >View Reminder Design Options</a><br/>
            <select id='invitiationDesign' name='invitation_design_style' style="display: none;">
              <option value='1' data-img-src='invitation_design_images/image_design1.png' />
              <option value='2' data-img-src='invitation_design_images/image_design2.png' />
              <option value='3' data-img-src='invitation_design_images/image_design3.png' />
              <option value='4' data-img-src='invitation_design_images/image_design4.png' />
              <option value='5' data-img-src='invitation_design_images/image_design5.png' />
              <option value='6' data-img-src='invitation_design_images/image_design6.png' />
              <option value='7' data-img-src='invitation_design_images/image_design7.png' />
              <option value='8' data-img-src='invitation_design_images/image_design8.png' />
              <option value='9' data-img-src='invitation_design_images/image_design9.png' />
              <option value='10' data-img-src='invitation_design_images/image_design10.png' />
              <option value='11' data-img-src='invitation_design_images/image_design11.png' />
              <option value='12' data-img-src='invitation_design_images/image_design12.png' />
            </select>
            <ul class="thumbnails image_picker_selector"><li><div class="thumbnail selected"><img class="image_picker_image" src="invitation_design_images/image_design1.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design2.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design3.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design4.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design5.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design6.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design7.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design8.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design9.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design10.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design11.png"></div></li><li><div class="thumbnail"><img class="image_picker_image" src="invitation_design_images/image_design12.png"></div></li></ul>
            

          </div>
        </div>

        <div class='grid-6-12 invitationGroup' id='designPreviewGroup'>
        <div id='designPreviewDiv'>
          <br/><br/><br/>
          <img id ='designPreview' src='invitation_design_images/image_design1.png' style='max-height:250px;' />
        </div>

        <div id='personal_photo_div'>
          <label>Custom Image</label>
          <input type='file' id='customImage' name='personal_photo' />
        </div>
        </div>

        <div class="grid-6-12 clear" >
            <label>Event Title *</label>
            <input name="title" type="text" id="title" value="Our wonderful day!" class='placeholder' />
            <span class='moreLink' onclick='toggleEventDetails();'>set more event details</span>
        </div>

        <div class="grid-1-12 addressDetail"></div>
        <div class="grid-4-12 addressDetail">
            <label>Street Address</label>
            <input name="loc_street" type="text" id="loc_street" value="" />
          </div>



        <div id='moreEventDetails' style='display:none;'>
          <div class="grid-4-12 clear">
            <label>Location Name</label>
            <input name="loc_name" type="text" id="loc_name" value="" />
          </div>

          <div class="grid-1-12 addressDetail"></div>
          <div class="grid-4-12 addressDetail">
            <label>Suite # or Apt #</label>
            <input name="loc_suite" type="text" id="loc_suite" value="" />
          </div>

            <div class="grid-1-12 clear">
              <br/><br/>
              <label>Start</label>
            </div>

            <div class="grid-1-12" style='width:9.5%;'>
              <label>Date</label>
              <input name="sdate" type="text" id="sdate" class='datepicker' />
            </div>

             <div class="grid-1-12" style='width:9.5%;'>
              <label>Time</label>
              <input name="stime" type="text" id="stime" value="" />
            </div>


          <div class="grid-1-12 addressDetail"></div>
          <div class="grid-4-12 addressDetail">
            <label>City</label>
            <input name="loc_city" type="text" id="loc_city" value="" />
          </div>

            <div class="grid-1-12 clear" >
              <br/><br/>
              <label>End</label>
            </div>

            <div class="grid-1-12" style='width:9.5%;'>
              <label>Date</label>
              <input name="edate" type="text" id="edate" value="" class='datepicker'/>
            </div>

             <div class="grid-1-12" style='width:9.5%;'>
              <label>Time</label>
              <input name="etime" type="text" id="etime" value="" />
            </div>

            <div class="grid-1-12 addressDetail"></div>
            <div class="grid-3-12 addressDetail" style='width:13.5%'>
            <label>State/Province</label>
            <input name="loc_state" type="text" id="loc_state"  value="" />
          </div>

          <div class="grid-3-12 addressDetail" style='width:13.5%'>
            <label>Zip/Postal Code</label>
            <input name="loc_zip" type="text" id="loc_zip" value="" />
          </div>


        <div class='grid-5-12 clear'>
          <input name="searchable" id="searchable" value="yes" type='checkbox' />
          <label style='display:inline-block; margin-left:3px;width:285px;'>Allow this event to be searchable</label>
          <img src='img/help.png' style='vertical-align:middle;' title='Help your friends to find your event on our search engine if they forget the name of your event' />
        </div>

        <div class="grid-4-12 addressDetail">
            <label>Country</label>
            <input name="loc_country" type="text" id="loc_country" value="" />
          </div>

        <div class='grid-5-12 clear'>
          <input type='checkbox' name="display_fund" id="display_fund" value="yes" />
          <label style='display:inline-block; margin-left:3px;width:285px;'>Display funding details on event details page</label>
          <img src='img/help.png' style='vertical-align:middle;' title='Encourage participation by showing how much people are contributing to your event' />
        </div>


          <div class="grid-4-12 addressDetail">
            <label>Map Link</label>
            <input type="text" value="" name='map_link' />
          </div>

          <div class='grid-1-12 addressDetail' style='margin:left;margin-left:5px;margin-top:25px;'>
          <img src='img/help.png' style='vertical-align:middle;' title='Help your guests find the location of your event' />
        </div>

        <div class='grid-5-12 clear'>
          <input type='checkbox' name="attendee_list_public" id="attendee_list_public" value="yes" />
          <label style='display:inline-block; margin-left:3px;width:285px;'>Make attendee list public</label>
          <img src='img/help.png' style='vertical-align:middle;' title='Encourage assistance by showing who has confirmed to your event' />
        </div>

        <div class="grid-4-12 clear">
          <label>Maximum Capacity</label>
          <input name="max_cap" type="text" id="max_cap" onkeyup="javascript:calculate_mindonation(document.getElementById('fund_amt').value,this.value)"  value="" />
        </div>

        <div class='grid-1-12' style='margin:left;margin-left:5px;margin-top:25px;'>
          <img src='img/help.png' style='vertical-align:middle;' title='You can establish a maximum capacity if you want to make your event exclusive. If not, leave blank.' />
        </div>

        <div class="grid-4-12 clear">
          <label>Location Web Page</label>
          <input type="text" value="" />
        </div>

        <div class='grid-1-12' style='margin:left;margin-left:5px;margin-top:25px;'>
          <img src='img/help.png' style='vertical-align:middle;' title='Include the link to your location or any other site you want' />
        </div>

        <div class="grid-4-12 clear">
          <label>Image for Your Event Page</label>
          <input type="file" name="image_path" id="image_path"  value="" />
          <span class='moreLink' onclick='toggleAddress();'>set location street address</span>
        </div>

        <div class='grid-1-12' style='margin:left;margin-left:5px;margin-top:25px;'>
          <img src='img/help.png' style='vertical-align:middle;' title='You can include an image to represent your event. This will be shown on your event dashboard.' />
        </div>

        

          </div>

        <div class="grid-6-12 clear">
          <label>Your Personal Message</label>
          <textarea name="description121" id="description121" cols="30" rows="10" class='placeholder'>You are invited to our wedding!</textarea>
        </div>

         <div class="grid-6-12" style='margin:0;padding:20px;'>
          <label style='text-align:center;font-size:20px;'>Examples</label><br/>
          <div style='font-size:12px; line-height:2;'>
            <b>Event Title:</b> Jones and Smith Wedding<br/>
            <b>Message:</b> Please help Dave Jones and Kelling Smith have a wedding!<br/>
            ------<br/>
            <b>Event Title:</b> Private Family Celebration Wedding<br/>
            <b>Message:</b> The Jones family would like to invite you to help us provide a wedding for Donna Smith and Frank Jones<br/>
            ------
          </div>
        </div>

        <div id='previewDiv' style='display:none;'>
          <img src="img/close-button.png" style="cursor:pointer;position:absolute;z-index:999;" class='close'>
          <div style='position:relative;'>
            <div style="position:absolute;top:0;left:0;width:825px;height:520px"></div>
            <iframe id='previewIframe' border=0 style='width:825px;height:520px;background-color:#FFF;'></iframe>
          </div>
        </div>

        <div class="grid-6-12 clear sendVia">
          <label>Send Via</label>
          <ul class="formee-list">
            <li class='sendViaField' style='width:170px;'>
              <input name="email" value='Email' type="checkbox" onchange='toggleEmailInvitesInput();' style='vertical-align:middle;' />
              <img style='vertical-align:middle;width:24px;height:24px;' src='images/email_envelope.png' />
              <label>
                <span class='sendViaLabel' style='width:45px;'>Email</span>
                <input type='button' id='emailPreview' value='Preview' class='previewButton' style='font-size:11px;padding:4px;text-transform:none;display:none;' />
              </label>
            </li>
            <li class='sendViaField' style='width:170px;'>
              <input name="twitter" value='Twitter' type="checkbox" style='vertical-align:middle;' onclick='$("#twitterPreview").fadeToggle();' />
              <img style='vertical-align:middle;width:24px;height:24px;' src='images/twitter.gif' />
              <label>
                <span class='sendViaLabel' style='width:45px;'>Twitter</span>
                <input type='button' id='twitterPreview' value='Preview' class='previewButton' style='font-size:11px;padding:4px;text-transform:none;display:none;' />
              </label>
            </li>
          </ul>
        </div>

        <div class='grid-6-12 sendVia' style='margin-left:20px;'>
          <label style='visibility:hidden;'>Send Via</label><ul class="formee-list"> 
            <ul class="formee-list">
            <li class='sendViaField' style='width:180px;'>
              <input name="facebook" value='Facebook' type="checkbox" onchange='toggleFacebookInput();' style='vertical-align:middle;' />
              <img style='vertical-align:middle;width:24px;height:24px;' src='images/facebook.gif' />
              <label>
                <span class='sendViaLabel'>Facebook</span>
                <input type='button' id='facebookPreview' value='Preview' class='previewButton' style='font-size:11px;padding:4px;text-transform:none;display:none;' />
              </label>
            </li>
            <li class='sendViaField' style='width:180px;'>
              <input name="linkedin" value='LinkedIn' type="checkbox" style='vertical-align:middle;' onclick='$("#linkedinPreview").fadeToggle();'/>
              <img style='vertical-align:middle;width:24px;height:24px;' src='images/linkedin.gif' />
              <label>
                <span class='sendViaLabel'>LinkedIn</span>
                <input type='button' id='linkedinPreview' value='Preview' class='previewButton' style='font-size:11px;padding:4px;text-transform:none;display:none;' />
              </label>
            </li>
          </ul>
          </ul>
        </div>

        <div id='emailInvitesInputDiv' class="grid-4-12 clear" style='display:none;'>
          <label>Email Addresses to Invite <img src='img/help.png' style='vertical-align:middle' title='Copy-Paste the email addresses of the people you want to invite'/></label>
          <textarea id="emailAddresses" name='invitees' cols="30" rows="10"></textarea>
        </div>

        <div id='facebookModeDiv' class='grid-4-12 clear' style='display:none'>
          <label>Facebook Invitation Type</label>
          <ul class="formee-list">
            <li class='sendViaField' style='width:275px;'><input type='radio' name='facebookType' value='Facebookpost' checked /><label>Post to Your Wall</label></li>
            <li class='sendViaField' style='width:275px;'><input type='radio' name='facebookType' value='Facebookmessage' /><label>Send a Message to Your Friends</label></li>
          </ul>
        </div>

      <div class='stepHeader grid-12-12 clear'>
        Step 2: Get Funded<br/><hr>
        <span style='font-size:18px;font-weight:normal;'>Raise Funds To Cover Your Event Expenses</span>
      </div>

      <div class='grid-5-12'>
        <label>Funding *</label>
        <ul class="formee-list">
          <li class='sendViaField' style='width:275px;'><input name="funding" type="radio" value='Yes' /><label style='font-weight:normal;'>I will accept funding</label></li>
          <li class='sendViaField' style='width:275px;'><input name="funding" type="radio" value='No'/><label style='font-weight:normal;'>I will not accept funding</label></li>
        </ul>
      </div>

      <div class='grid-3-12 fundingOptions'>
        <label>
          Target Funding Amount 
          <img src='img/help.png' style='float:right;position:absolute;margin-left:20px;' title="Whatever amount you're looking to raise to cover your event expenses" />
        </label>
        <input name="fund_amt" type="text" id="fund_amt" onkeyup="javascript:calculate_mindonation(this.value,document.getElementById('max_cap').value)" />
      </div>

      <div class='grid-3-12 fundingOptions'>
        <label>
          Minimum Donation Amount
          <img src='img/help.png' style='float:right;position:absolute;margin-left:3px;' title="The minimum amount that any people should donate to your event" />
        </label>
        <input name="max_don_amt" type="text" id="max_don_amt" />
      </div>

      <div class='grid-3-12 fundingOptions'>
        <label>
          Funding Close Date
          <img src='img/help.png' style='float:right;position:absolute;margin-left:15px;' title="You can establish a deadline before or after your event" />
        </label>
        <input name="fund_end_date" type="text" id="fund_end_date" />
      </div>

      <div class='grid-5-12 clear' id='paypalGroup' style='display:none;'>
        <label>PayPal ID * <img src='img/help.png' style='vertical-align:middle;' title='Your email address used with PayPal. This way people will pay you directly.' /><a style='display:inline-block;float:right;margin-top:10px;' class='moreLink' href="payment_setup.php" target=_blank>Don't have a PayPal account?</a></label>
        <input name="paypalid" type="text" id="paypalid" />
        <span id='fundingOptionsLink' class='moreLink' onclick='showFundingOptions();'>set more event funding options</span>
      </div>

      <div class='grid-6-12 fundingOptions'>
        <input type='checkbox' name="donate_to_attend" id="donate_to_attend" value="yes" />
        <label style='display:inline-block; margin-left:3px;'>All attendees must donate to attend</label><br/><br/>

        <input type='checkbox' name="define_donation_levels" id="define_donation_levels" onchange="javascript:show_defin_d_level();setDonationLevels();" value="yes" />
        <label style='display:inline-block; margin-left:3px;'>I would like to define donation levels</label>

        <div id="defin_d_level" style="display:none;">
          <div class='grid-3-12'>
            <label>Friend:</label>
            <input name="df_friends" type="text" id="df_friends" class='placeholder' />
          </div>

          <div class='grid-3-12'>
            <label>Bronze:</label>
            <input name="df_bronze" type="text" id="df_bronze" class='placeholder' />
          </div>

          <div class='grid-3-12'>
            <label>Silver:</label>
            <input name="df_silver" type="text" id="df_silver" class='placeholder'/>
          </div>

          <div class='grid-3-12 clear'>
            <label>Gold:</label>
            <input name="df_gold" type="text" id="df_gold" class='placeholder' />
          </div>

          <div class='grid-3-12'>
            <label>Platinum:</label>
            <input name="df_platinum" type="text" id="df_platinum" class='placeholder' />
          </div>

          <div class='grid-3-12'>
            <label>Benefactor:</label>
            <input name="df_benefactor" type="text" id="df_benefactor" class='placeholder' />
          </div>
        </div>

      </div>

      <?php
      if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0) {}
      else
      {
        ?>
      <div class='stepHeader grid-12-12 clear account'>
        Step 3: Celebrate!<br/><hr>
        <span style='font-size:16px;font-weight:normal;float:center;display:inline-block;text-decoration:none;float:none;' class='moreLink' >
          <span style='color:black;text-decoration:none;display:inline-block;'>Register or </span>
          <span onclick='showLoginForm();' style='text-decoration:underline;'>Click Here If You Already Have An Account</span>
        </span>
      </div>

      <div class='grid-4-12 account'>
        <label>Email *</label>
        <input type="text" name="email" id="email" />
      </div>

      <div class='grid-3-12 account'>
        <label>First Name *</label>
        <input type="text" name="fname" id="fname" />
      </div>

      <div class='grid-3-12 account'>
        <label>Last Name *</label>
        <input type="text" name="lname" id="lname" />
      </div>

      <div class='grid-4-12 clear account'>
        <label>Password *</label>
        <input type="password" name="password"  id="password" />
      </div>

      <div class='grid-3-12 account'>
        <label>Country *</label>
        <select name="country" id="country">
          <option value="">Select Country</option>
          <option value="United States of America">United States of America</option>
        </select>
      </div>

      <div class='grid-3-12 account'>
        <label>State *</label>
       <select name="state" id="state">
          <option value="">Select State</option>
          <?
            $q = "select * from keshavstate order by name";
            $r = mysql_query($q);
            while($r1 = mysql_fetch_array($r))
            {
              $name = ucfirst(stripcslashes($r1['name']));
              if($name != "I live outside of the U.S")
              {
                ?><option value="<?=$r1['name'];?>"><?=$name;?></option><?
              }
            }
          ?>
        </select>
      </div>

      <div class='grid-4-12 clear account'>
        <label>Confirm Password *</label>
        <input type="password" name="cpassword"  id="cpassword"  />
      </div>

      <div class='grid-3-12 account'>
        <label>
          Contact Phone Number
          <img src='img/help.png' style='float:right;position:absolute;margin-left:22px;' title="Optional. Just in case we need to contact you." />
        </label>
        <input type="text" name="phone" id="phone" />
      </div> 

      <div class='grid-9-12 clear account'>
        <input type="checkbox" name="opted_email" id="opted_email" value="true" />
        <label style='display:inline-block; margin-left:3px;'>
          I would like to receive special offers, notifications, and updates from CelebratePlus
          <img src='img/help.png' style='vertical-align:middle;' title="Stay in touch!!" />
        </label><br/><br/>
      </div>

      <?php } ?>

      <div class='grid-12-12 clear' style='text-align:center;'>
        <div style='font-size:18px;word-spacing:3px;margin-bottom:10px;font-weight:bold;margin-top:1em;'>Get Ready To Celebrate!</div><br/>
        <input type="submit" name="save_event" id="save_event" value='Launch My Event' />
      </div>
<input type="hidden" name="submitted" id="submitted" value="submitted" />

    </fieldset>
    </form>
                            </div>
                        </div>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
          <? include("footer.php");?>
        </div>
    </body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
   $(".thumbnails .thumbnail").on("click", "img", function () {
    $('.thumbnails .thumbnail').removeClass('selected');
    var link_name = $(this).attr('src');
    $(this).closest('.thumbnail').addClass('selected');
    $("img#designPreview").attr('src',link_name);
});
});

	function validate_monetary_value(obj,message)
	{
	   var temp_value = obj.value;
	
	   if (temp_value == "")
	   {
		 return true;
	   }
	   var Chars = "0123456789.,";
	   var str_length = temp_value.length;
	   for (var i = 0; i < str_length; i++)
	   {
		   if(i == str_length-1)
		   {
		   	Chars = "0123456789";
		   }
		   if (Chars.indexOf(temp_value.charAt(i)) == -1)
		   {
			   alert(message);
			   obj.focus();
			   return false;
		   }
		   if(temp_value.charAt(i) == '.' && Chars.indexOf(',') != -1)
		   {
		   		Chars = "0123456789";
		   }
	   }
	   return true;
	} 
	function crt_event_chk()
	{
		if(document.getElementById("title").value.split(" ").join("") == "")
		{
			alert("Please enter an event title.");
			document.getElementById("title").focus();
			return false;
		}
		if(document.getElementById("description121").value.split(" ").join("") == "")
		{
			alert("Please enter your personal message.");
			document.getElementById("description121").focus();
			return false;
		}
    if(!$('input[name=funding]:checked').val())
    {
      alert("Please select a funding mode");
      return false;
    }
		if(fundingMode == null)
		{
			alert("Please select whether you would like to accept funding for this event.");
			//document.getElementById("fund_allowed").focus();
			return false;
		}
		if(fundingMode == "fund_allowed")
		{
			if(document.getElementById("paypalid").value.split(" ").join("") == "")
			{
				alert("Please enter your PayPal ID so that you can receive donations directly to your PayPal account.");
				document.getElementById("paypalid").focus();
				return false;
			}
			else
			{
				var emailPat=/^(.+)@(.+)\.(.+)$/
				var matchArray=document.getElementById("paypalid").value.match(emailPat)
			
				if (matchArray==null) 
				{
					alert("Please enter a valid PayPal ID. Your PayPal ID must be the email address that is affiliated with your PayPal account.")
					document.getElementById("paypalid").focus();
					return false;
				}
			}
		}
		if(fundingMode == "fund_allowed")
		{			
			if(!validate_monetary_value(document.getElementById("fund_amt"),"Please enter a valid target funding amount.")){ return false; }
			if(!validate_monetary_value(document.getElementById("max_don_amt"),"Please enter a valid minimum donation amount.")){ return false; }
		}
		if(document.getElementById("define_donation_levels").checked == true)
		{
			if(!validate_monetary_value(document.getElementById("df_friends"),"Please enter a valid value for the donation level friend.")){ return false; }			
			if(!validate_monetary_value(document.getElementById("df_bronze"),"Please enter a valid value for the donation level bronze.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_silver"),"Please enter a valid value for the donation level silver.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_gold"),"Please enter a valid value for the donation level gold.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_platinum"),"Please enter a valid value for the donation level platinum.")){ return false; }
			if(!validate_monetary_value(document.getElementById("df_benefactor"),"Please enter a valid value for the donation level benefactor.")){ return false; }
		}

    if(inviteShow) return check_validationEmailInvite();
    if(!loggedIn) return gtg_check1();

		else return true;
	
	}

function show(fund_allowed)
{
	if(fund_allowed == 'Yes')
	{
		<?php 
			if($total_funding_event >= 3)
			{
				?>
					alert("Due to money laundering policies upheld by CelebratePlus, we can only allow you to host 3 events which collect funding per year. The year period is determined based on your signup date.");
					document.getElementById("fund_allowed").value = "";
				<?php 
			}
			else if($total_fund_active_event >= 2)
			{
				?>
					alert("Due to money laundering policies upheld by CelebratePlus, we can only allow 2 events to collect funding at the same time.");
					document.getElementById("fund_allowed").value = "";
				<?php 
			}
			else
			{
				?>
					document.getElementById("funding_attributes").style.display = 'block';
				<?php 
			}
		?>		
	}
	else
	{
		document.getElementById("funding_attributes").style.display = 'none';
	}
}
</script>

<script type="text/javascript">
	function calculate_mindonation(fund_amt,max_cap)
	{
		if(fund_amt != "" && max_cap != "")
		{
		var min_donation_amt = parseInt(fund_amt.replace(/,/gi,""))/parseInt(max_cap.replace(/,/gi,""));
		
		document.getElementById('min_donation').innerHTML="Minimum donation amount per attendee to meet your target funding amount: $"+min_donation_amt.toFixed(2);
		}
		else
		{
			document.getElementById('min_donation').innerHTML="";
		}
		
	}
	
	function show_defin_d_level()
	{
		
		if(document.getElementById("define_donation_levels").checked == true)
		{
			document.getElementById("defin_d_level").style.display = 'block';
		}
		else
		{
			document.getElementById("defin_d_level").style.display = 'none';
		}
	}

  function gtg_check1()
  {  
    if(document.getElementById("email").value.split(" ").join("") == "")
    {
      alert("Please enter your primary email address.");
      document.getElementById("email").focus();
      return false;
    }
    else
    {
      var emailPat=/^(.+)@(.+)$/
      var matchArray=document.getElementById("email").value.match(emailPat)

      if (matchArray==null) 
      {
        alert("Please enter a valid email address.")
        document.getElementById("email").focus();
        return false;
      }
    }

      var emailValid = false;
      var data = {'f':'emailCheck','email':document.getElementById("email").value};
      $.ajax({
        type: 'POST',
        url: "userCheck.php",
        data: data,
        async:false,
        success: function(result)
        {
          if(result == "false") result = false;
          else result = true;
          if(!result)
          {
            alert("Email address already taken.")
            document.getElementById("email").focus();
            return false;
          }
          emailValid = result;
        }
      });

      if(!emailValid) return false;

    if(document.getElementById("password").value.split(" ").join("") == "")
    {
      alert("Please enter your password.");
      document.getElementById("password").focus();
      return false;
    }
    if(document.getElementById("password").value.split(" ").join("") != document.getElementById("cpassword").value.split(" ").join(""))
    {
      alert("Your password and password confirmation do not match.");
      document.getElementById("cpassword").focus();
      return false;
    }
    if(document.getElementById("fname").value.split(" ").join("") == "")
    {
      alert("Please enter your first name.");
      document.getElementById("fname").focus();
      return false;
    }
    if(document.getElementById("lname").value.split(" ").join("") == "")
    {
      alert("Please enter your last name.");
      document.getElementById("lname").focus();
      return false;
    }
    if(document.getElementById("country").value.split(" ").join("") == "")
    {
      alert("Please select a country.");
      document.getElementById("country").focus();
      return false;
    }
    if(document.getElementById("state").value.split(" ").join("") == "")
    {
      alert("Please select a state.");
      document.getElementById("state").focus();
      return false;
    }
    return emailValid;
  }

  function check_validationEmailInvite()
  {
    if(!inviteShow) return true;
    if(document.getElementById("invitiationDesign").value.split(" ").join("") == "")
    {
      alert("Please select a design style for the invitation that you are sending.");
      document.getElementById("invitiationDesign").focus();
      return false;
    }
    if(usingPersonalPhoto)
    {
      if(document.getElementById("customImage").value == '')
      {
        alert("Please upload your photo.");
        document.getElementById("customImage").focus();
        return false;
      }
    }
    if(document.getElementById("emailAddresses").value.split(" ").join("") == "" && usingEmailInvite)
    {
      alert("Please enter at least one email address.");
      document.getElementById("emailAddresses").focus();
      return false;
    }
    if(usingEmailInvite)
    {
      var invitees = document.getElementById("invitees").value;
      var email_array = invitees.split(",");
      for(var i = 0; i < email_array.length; i++)
      {
        var emailPat=/^(.+)@(.+)\.(.+)$/
        var matchArray=email_array[i].match(emailPat)
      
        if (matchArray==null) 
        {
          alert("Please enter a valid email address.")
          document.getElementById("invitees").focus();
          return false;
        }
      }
    }
   
    return true;
  }
</script>
   <script>
var fundingMode = "No";
var loggedIn = false;
var usingPersonalPhoto = false;
$(document).ready(function()
{
  $(".log_re_main1").hide();
  userLoggedIn();

  $("#invitiationDesign").imagepicker();
   $("input[name='funding']").change(function()
   {
    fundingMode = $("input[name='funding']:checked").val();
    if(fundingMode == "Yes") $("#paypalGroup").show();
    else $("#paypalGroup").hide();
   });

   $("#invitiationDesign").change(function()
   {
    var val = $(this).val();
    $("#designPreview").attr('src','invitation_design_images/image_design' + val + ".png");
    if(val == "11" || val == "12") {$("#personal_photo_div").show(); usingPersonalPhoto = true;}
    else {$("#personal_photo_div").hide(); usingPersonalPhoto = false;}
   });

   $("#emailPreview").click(function(e)
   {
      $("#previewIframe").attr('src','emailPreview.php?style=' + $("#invitiationDesign").val() + "&message=" + $("#description121").val());
      $("#previewDiv").lightbox_me({closeClick:false});
      e.preventDefault();
   });

   $("#twitterPreview").click(function(e)
   {
    $("#previewIframe").attr('src','twitterPreview.html');
    $("#previewDiv").lightbox_me({closeClick:false});
    e.preventDefault();
   });

   $("#linkedinPreview").click(function(e)
   {
    $("#previewIframe").attr('src','linkedinPreview.html');
    $("#previewDiv").lightbox_me({closeClick:false});
    e.preventDefault();
   });

   $("#facebookPreview").click(function(e)
   {
    $("#previewIframe").attr('src','facebookPreview.html');
    $("#previewDiv").lightbox_me({closeClick:false});
    e.preventDefault();
   });

   $('.placeholder').focus(function() {
    var input = $(this);
    input.val('');
    input.removeClass("placeholder");
  });

   $("#max_don_amt").change(function()
   {
    setDonationLevels();
  });
});

function setDonationLevels()
{
  var val = parseInt($("#max_don_amt").val());
  if(val == "") return;
  if($('#define_donation_levels').is(':checked'))
  {
    var levelVal = parseInt(val);
    $("#df_friends").val(levelVal);

    levelVal = levelVal + val;
    $("#df_bronze").val(levelVal);

    levelVal = levelVal + val;
    $("#df_silver").val(levelVal);

    levelVal = levelVal + val;
    $("#df_gold").val(levelVal);

    levelVal = levelVal + val;
    $("#df_platinum").val(levelVal);

    levelVal = val * 10;
    $("#df_benefactor").val(levelVal);
  }

}

function userLoggedIn()
{
  var data = {'f':'loggedIn'};
  $.post('userCheck.php',data)
  .done(function(data) 
  {
    if(data == "true")
    {
      loggedIn = true;
      $(".account").hide();
    }
    else loggedIn = false;
  });
}

function toggleEventDetails()
{
  $("#moreEventDetails").fadeToggle();
  $('.datepicker').Zebra_DatePicker(
  {
    format: "m/d/Y"
  });
}

function toggleAddress()
{
  $(".addressDetail").fadeToggle();
}
var usingEmailInvite = false;
function toggleEmailInvitesInput()
{
  usingEmailInvite = !usingEmailInvite;
  $("#emailInvitesInputDiv").fadeToggle();
  $("#emailPreview").fadeToggle();
}

function toggleFacebookInput()
{
  $("#facebookModeDiv").fadeToggle();
  $("#facebookPreview").fadeToggle();
}

function showFundingOptions()
{
  $("#fundingOptionsLink").hide();
  $(".fundingOptions").fadeToggle();
   $("#fund_end_date").Zebra_DatePicker(
  {
    format: "m/d/Y"
  });
}

var inviteShow = true;
function inviteToggle()
{
  inviteShow = !inviteShow;
  if(inviteShow) $("#inviteToggle").html("Invite Later");
  else $("#inviteToggle").html("Invite Now");
  $(".invitationGroup").fadeToggle();
  $(".sendVia").fadeToggle();
}

function showLoginForm()
{
  $("#loginDiv").lightbox_me({closeClick:false});
}

function loginUser()
{
  $.ajax({
    type: 'POST',
    url: "userCheck.php",
    data: $("#loginForm").serialize(),
    async:false,
    success: function(result)
    {
      if(result == "true")
      {
        userLoggedIn();
        $("#loginDiv").trigger('close');
      }
      else alert("Username and/or password incorrect. Please try again.");

    }
  });
}



</script> 
