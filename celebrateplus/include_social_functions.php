<?php /*?> Facebook functions started <?php */?>
<div id="fb-root"></div>
<script src="js/facebook_all.js"></script>
<script language="javascript">
	FB.init({
        appId  : '342321239162728',
        status : true,
        cookie : true,
        oauth : true
      });

       function sendRequestViaMultiFriendSelector() {
        FB.ui({method: 'apprequests',
          message: 'Join me at the event I created on CelebratePlus. http://www.idealgrowthclients.com/kp/cplus/event_detail.php?eve_id=<?=$event_id;?>'
        }, requestCallback);
      }
      
      function requestCallback(response) {
	  window.location.href="<?=$current_file_redirect_uri;?>&msg=1";
      }
	  // Function for opening the dialog box that sends app request to multiple friends started
	  function hb_sending_friend_request_to_multiple_friends()
	  {
	  	var x=screen.availWidth-950;
		var y=screen.availHeight-100;
		window.open("https://www.facebook.com/dialog/apprequests?app_id=342321239162728&message=Select the Facebook friends that you would like to invite below.&redirect_uri=<?=$SITE_URL.$redirect_link_after_invitation_complate;?>",'','width=900,height=650,left='+x+',top='+y);	
	  }
	  
	 <!-- code for custom text sharing in facebook started  From PRN-->
	 function hb_sharing_a_text($link,$event_title,$site_logo,$message)
	 {
	 	var x=screen.availWidth-950;
		var y=screen.availHeight-100;
		$feed_url = "https://www.facebook.com/dialog/feed?";
		$feed_url = $feed_url + "app_id=342321239162728";
		$feed_url = $feed_url + "&link="+$link;
		$feed_url = $feed_url + "&picture="+$site_logo;
		$feed_url = $feed_url + "&caption="+$event_title;
		$feed_url = $feed_url + "&description="+$message+" <b>"+$event_title+"</b> on CelebratePlus.";
		$feed_url = $feed_url + "&redirect_uri=<?=$SITE_URL.$redirect_link_after_invitation_complate;?>?msg=1";
		window.open($feed_url,'','width=900,height=650,left='+x+',top='+y);
	 }
	<!-- code for custom text sharing in facebook ended -->
	
	 function hb_sharing_a_text_new($link,$event_title,$site_logo,$message)
	  {
	  	var x=screen.availWidth-950;
		var y=screen.availHeight-100;
		window.open("http://www.facebook.com/dialog/send?app_id=342321239162728&link="+$link+"&message="+$message+"&redirect_uri=<?=$SITE_URL.$redirect_link_after_invitation_complate;?>?msg=2",'','width=900,height=650,left='+x+',top='+y);	
	  }

	  
	  // Function for opening the dialog box that sends friend request to multiple friends ended
</script>
<?php /*?> Facebook functions ended <?php */?>


<?php /*?> Linkedin functions started <?php */?>
<script language="javascript">
	function send_twitter_invite()
	{
		var x=screen.availWidth-950;
		var y=screen.availHeight-500;
		window.open("https://twitter.com/intent/tweet?original_referer=<?=$SITE_URL;?>event_reminder.php?event_id=<?=$event_id;?>&source=tweetbutton&text=Join me at the event I created on CelebratePlus&url=<?=$SITE_URL;?>event_detail.php?eve_id=<?=$event_id;?>","twitter","width=500,height=450,left="+x+",top="+y);
	}
</script>
<?php /*?> Linkedin functions ended <?php */?>

<?php /*?> Twitter functions started <?php */?>
<script language="javascript">
	function send_linkedin_invite()
    {
		var x=screen.availWidth-950;
		var y=screen.availHeight-500;
 	window.open("http://www.linkedin.com/shareArticle?mini=true&url=<?=$SITE_URL;?>event_reminder.php?event_id=<?=$event_id;?>&title=<?=$event_name;?>&summary=Join me at the event I created on CelebratePlus. <?=$SITE_URL;?>event_detail.php?eve_id=<?=$event_id;?>&source=<?=$SITE_URL;?>event_detail.php?eve_id=<?=$event_id;?>","Linkedin","width=780,height=350,left="+x+",top="+y);
	
<?php /*?>	window.open("http://www.linkedin.com/shareArticle?mini=true&url=<?=$SITE_URL;?>create_twitter_invitation.php?event_id=<?=$event_id;?>&title=<?=$event_name;?>&summary=Join me at the event I created on CelebratePlus. <?=$SITE_URL;?>event_detail.php?eve_id=<?=$event_id;?>&source=<?=$SITE_URL;?>event_detail.php?eve_id=<?=$event_id;?>&callbackUrl=http://www.google.com","","'width=550,height=500'");<?php */?>
    }
</script>
<?php /*?> Twitter functions ended <?php */?>


<script language="javascript">
	<? if($_REQUEST['msg'] == 1){ ?>
		alert("Your invitation has been sent successfully.");
	<? } ?>
</script>