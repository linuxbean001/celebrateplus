<? include("connect.php");
?>
<? 
	include("login_check.php");
	$acc_pg_name='find_event';
$a = GetContent(20);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=Get_MetaData(20);?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php include_once("google_analytics.php");?>
</head>
    <body>
    	<div class="main">
        	<? include("header.php");?>
            <div class="middle_inner">
            	<div class="tab_box_main">
                	<div class="tab_box_title_main">
                    	<div class="inner_title_bg">Welcome to your CelebratePlus Account!</div>
                    </div>
                    <div class="tab_box_bg_main">
					<form name="Search_Events" id="Search_Events" action="acc_event_result.php" method="post" onsubmit="javascript: return acc_fnd_eve_chk()">
                    	<div class="tab_box_bg_inner">
                        	<div class="myacc_menu_main">
                        	<? include("account_menu.php");?>
                        </div>
                        	<div class="tab_box_bg_inner_regconf" style="min-height:470px; padding-top:10px;">
                            	<div class="tab_box_bg_inner_left_text_regconf"><?=$a[1]?></div>
                                <div class="search_eve_main">
                                	<div class="search_eve_name">Search Events :</div>
                                    <div class="search_eve_form_input_box">
                                    	<div class="search_eve_form_input"><input type="text" name="event_name" id="event_name" onBlur="if(this.value==''){this.value='Event Name or Host Name'}" onFocus="if(this.value=='Event Name or Host Name'){this.value=''}" value="Event Name or Host Name" /></div>
                                    </div>
                                    <div class="search_eve_form_btn_nain"><input type="submit" name="Submit_eve" id="Submit_eve" class="search_eve_form_btn" value="" /></div>
                                </div>
                            </div>
                        </div>
					</form>
                        <div class="tab_box_bottom"><img src="images/tab_box_bottom.png" /></div>
				<?
				$get_add_query2 = "select * from ad where location like '%Find an Event Footer%' order by rand() limit 1";
					$get_add_result2 = hb_get_result($get_add_query2) or die(mysql_error());
					if(mysql_num_rows($get_add_result2) > 0)
					{
				?>
				<div class="promo_title" style="padding-top:20px; height:90px;">
				<?
					
						while($get_add_row2 = mysql_fetch_array($get_add_result2))
						{
							 
							 ?>
							 <a href="<?=$get_add_row2['link'];?>" target="_blank">
							 <img src="advertiser_images/<?=$get_add_row2['image_path'];?>" width="923" height="90" border="0" />
							 </a>
							 <?
						}
				?>
				</div>
				<?
				}
				?>
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
			function acc_fnd_eve_chk()
			{
				
				if(document.getElementById("event_name").value == "Event Name or Host Name")
				{
					alert("Please enter an event name or host name.");
					document.getElementById("event_name").focus();
					return false;
				}
				return true;
			}
			
		</script>

