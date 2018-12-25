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
	  	window.open("https://www.facebook.com/dialog/apprequests?app_id=342321239162728&message=Cplus&redirect_uri=<?=$SITE_URL;?>create_facebook_invitation.php",'','width=1000,height=650');	
	  }
	  // Function for opening the dialog box that sends friend request to multiple friends ended
</script>
<?php /*?> Facebook functions ended <?php */?>


<?php /*?> Linkedin functions started <?php */?>
<script language="javascript">
	function send_twitter_invite()
	{
		window.open("https://twitter.com/intent/tweet?original_referer=http://www.idealgrowthclients.com/kp/cplus/create_twitter_invitation.php?event_id=<?=$event_id;?>&amp;source=tweetbutton&amp;text=Join me at the event I created on CelebratePlus&amp;url=http://www.idealgrowthclients.com/kp/cplus/event_detail.php?eve_id=<?=$event_id;?>","","'width=500,height=450'");
	}
</script>
<?php /*?> Linkedin functions ended <?php */?>

<?php /*?> Twitter functions started <?php */?>
<script language="javascript">
	function send_linkedin_invite()
    {
    	window.open("http://www.linkedin.com/shareArticle?mini=true&url=http://www.idealgrowthclients.com/kp/cplus/create_twitter_invitation.php?event_id=<?=$event_id;?>&title=<?=$event_name;?>&summary=Join me at the event I created on CelebratePlus. http://www.idealgrowthclients.com/kp/cplus/event_detail.php?eve_id=<?=$event_id;?>&source=http://www.idealgrowthclients.com/kp/cplus/event_detail.php?eve_id=<?=$event_id;?>","","'width=550,height=500'");
    }
</script>
<?php /*?> Twitter functions ended <?php */?>


<script language="javascript">
	<? if($_REQUEST['msg'] == 1){ ?>
		alert("Your invitation has been sent successfully.");
	<? } ?>
</script>