<div class="top">
            	<div class="logo"><a href="index.php"><img src="images/logo.png" /></a></div>
                <div class="menu_main" style="width:150px;">
                	<div class="menu" style="width:150px;">
                    	<ul>
                        	<?php /*?><li><div class="menu_fea"><a href="features.php" <? if($pg_nm=="feature"){?>class="act"<? }?>></a></div></li><?php */?>
                            <li><div class="menu_how"><a href="how_works.php" <? if($pg_nm=="how_works"){?>class="act"<? }?> ></a></div>
                            	<ul>
                                    <li><a href="how_works.php">How It Works</a></li>
								    <li><a href="features.php">Features</a></li>
                                    <li><a href="resources.php">Resources</a></li>
                                </ul>
                            </li>
                            <?php /*?><li><div class="menu_res"><a href="resources.php" <? if($pg_nm=="resources"){?>class="act"<? }?> ></a></div></li><?php */?>
                        </ul>
                    </div>	
                </div>
                <div class="login_res_main">
                	<?php /*?><div class="log_re_main">
					<? if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0){?>
						<a href="logout.php">Logout</a>|
						<a href="account_welcome.php">My Account</a>
					<? } else {?>
                    	<a href="login.php">Login</a>|
                        <a href="register.php">Register</a>
					<? }?>
                    </div><?php */?>
					<? 	if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
						{
							$href = "account_find_event.php";
							$href1 = "create_event.php";
						}
						else
						{
							$href = "find_event.php";
							$href1 = "create_event.php";
						}
						
					?>
					
                	<a href="<?=$href;?>"><img src="images/login.png" /></a>
                    <a href="<?=$href1;?>"><img src="images/start_an_evn.png" /></a> &nbsp; &nbsp;
                    <div class="log_re_main1">
                    <? if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0){?>
						<a href="logout.php">Logout </a> &nbsp; |  &nbsp;
						<a href="account_welcome.php"> My Account</a>
					<? } else {?>
                    	<a href="login.php">Login </a> &nbsp; |  &nbsp;
                        <a href="register.php"> Register</a>
					<? }?>
                    </div>
                </div>
            </div>