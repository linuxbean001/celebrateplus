<? include("connect.php");
?>
<? $a = GetContent(20);?>
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
                    	<div class="inner_title_bg"><?=$a[0]?></div>
                    </div>
                    <div class="tab_box_bg_main">
                    	<div class="tab_box_bg_inner">
                        	<div class="tab_box_bg_inner_left">
                            	<div class="tab_box_bg_inner_left_text"><?=$a[1]?></div>
                                <div class="search_eve_main_evt">
                                	<div class="search_eve_name">Search Events :</div>
                                    <div class="search_eve_form_input_box">
                                    	<div class="search_eve_form_input"><input type="text" onBlur="if(this.value==''){this.value='Event Name or Host Name'}" onFocus="if(this.value=='Event Name or Host Name'){this.value=''}" value="Event Name or Host Name" /></div>
                                    </div>
                                    <div class="search_eve_form_btn_nain"><input type="submit" class="search_eve_form_btn" value="" /></div>
                                </div>
                            </div>
                        	<div class="tab_box_bg_inner_right">
                            	<div class="tab_box_bg_inner_right_bg">
                                	<div class="tab_right_text_main">
                                    	<div class="tab_right_text_title">Sub Header</div>
                                        <div class="tab_right_text">
                                        Sed imperdiet tempus neque non
                                        eleifend. Nunc pretium, dolor a ve
                                        stibulum dapibus, leo urna digniss
                                        im felis, non cursus risus quam at
                                        nunc. Aliquam eu risus sed sem la
                                        oreet eleifend. Etiam facilisis mole
                                        stie nulla vel gravida. Suspendisse
                                        vel velit orci, elementum mattis
                                        enim. Suspen disse nec ligula nisl.
                                        Vestibulum pretium, turpis ut auct
                                        or feugiat, urna urna elementum
                                        neque, non malesuada nisl eros te
                                        mpor enim. Pellentesque et
                                        dapibus est.
									</div>
                                    </div>
                                </div>
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
