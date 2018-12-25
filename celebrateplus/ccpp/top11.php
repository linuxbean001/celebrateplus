<? include("linkvars.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="117" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="85%" align="left" valign="top"><a href="deskboard.php"><img src="images/mainlogo.gif" width="336" height="117" hspace="12" border="0" /></a></td>
            <td width="15%" align="right" valign="top" class="top_right_brd"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="14" align="left" valign="top"></td>
                </tr>
                <tr>
                  <td height="22" align="left" valign="top" class="arial_12">Welcome <? echo $_COOKIE['UsErOfAdMiN']; ?></td>
                </tr>
                 <tr>
                  <td align="left" valign="top" class="arial_12" >
                  <SCRIPT language=javascript> 
					datetoday = new Date(); timenow=datetoday.getTime(); datetoday.setTime(timenow); 
					thehour = datetoday.getHours(); if (thehour > 18) display = "Evening"; 
					else if (thehour >12) display = "Afternoon"; else display = "Morning"; 
					var greeting = ("Good " + display + "!"); document.write(greeting); </SCRIPT>
            		</SPAN>
                  </td>
                </tr>
                <tr><td height="4px"></td></tr>  
                <tr>
                  <td height="19" align="left" valign="top" class="arial_11">&nbsp;<a href="changepass.php" class="login">My account</a> | <a href="logout.php" class="login">Log out</a></td>
              </tr>
                
               
            </table></td>
          </tr>
        </table></td>
      </tr>
       
      <tr>
      	<td>    
	      <div id="div_top_submenu">   
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="42" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="85%" align="left" valign="top"><table width="99%" border="0" align="left" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="11" height="53" align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="bottom">
                       
                        <div id="left_menu">
                            <div id="gnav">
                              <ul style="padding-left:0px;">
                              <?
							  		$DEFAULT_TOP_MENU="Website";
									if($_REQUEST["menu_name"])
									{
										$DEFAULT_TOP_MENU=$_REQUEST["menu_name"];
									}
									else
									{
										for($i=1;$i<count($HeadLinksArray);$i++)
										{
											if($LeftLinkSection==$i)
											{
												$DEFAULT_TOP_MENU=$HeadLinksArray[$i][0];
											}
										}
									}									
                                    for($i=1;$i<count($HeadLinksArray);$i++)
                                    {
										
                                        if($HeadLinksArray[$i][0]==$DEFAULT_TOP_MENU) 										
                                        {
                                ?>
                                            <li><a id="menu_<?=ereg_replace(" ","&nbsp;",$HeadLinksArray[$i][0]);?>" href="?menu_name=<? echo $HeadLinksArray[$i][0]; ?>"  class="bg_1_act"><b><? echo ereg_replace(" ","&nbsp;",$HeadLinksArray[$i][0]); ?></b></a></li>  
                                <? 
                                        }										
                                        else
                                        {
                                        ?>
                                        <li><a id="menu_<?=ereg_replace(" ","&nbsp;",$HeadLinksArray[$i][0]);?>" href="?menu_name=<? echo $HeadLinksArray[$i][0]; ?>"  class="bg_1"><span><? echo ereg_replace(" ","&nbsp;",$HeadLinksArray[$i][0]); ?></span></a></li> 
                                        <?
                                        }
                                    }
                                ?>  
                               
                              </ul>
                            </div>
                        </div>
                        </td>
                      </tr>
                    </table></td>
                    <td width="15%" height="51" align="left" valign="top" >&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
    		  <tr>
                <td height="42" align="left" valign="top" class="sub_button_bg"> 
                    <div id="wrapper">
                      <div id="horiz-menu">
                        <ul style="overflow: visible;" class="nav" id="horiznav">                
                        <?
                                for($i=1;$i<count($HeadLinksArray);$i++)
                                {
                                    if($HeadLinksArray[$i][0]==$DEFAULT_TOP_MENU)
                                    {
                                        $LeftLinkAry1 = $HeadLinksArray[$i][2];
                                        for($LeftLinkCount=0;$LeftLinkCount<count($LeftLinkAry1);$LeftLinkCount++)
                                        {
                                        ?>
                                        <li>	
                                                <img src="images/more.jpg" width="11" height="11" />&nbsp;<a href="<? echo $LeftLinkAry1[$LeftLinkCount][1] ?>" class="sub"><? echo $LeftLinkAry1[$LeftLinkCount][0] ?></a>
                                                
                                                  <? 
                                                    $LeftLinkAry2 = $LeftLinkAry1[$LeftLinkCount][3];
                                                    if(count($LeftLinkAry2) > 1 )
                                                    {
                                                        ?>
                                                        <ul style="overflow: hidden; visibility: visible; opacity: 1; padding-top:7px; padding-bottom:7px; padding-left:10px; background-color:#319ecf; border-right:4px solid #267fa8; border-left:1px solid #267fa8; border-bottom:1px solid #267fa8; text-align:right;" >
                                                        <?
                                                            for($LeftLinkCount2=0;$LeftLinkCount2<count($LeftLinkAry2);$LeftLinkCount2++)
                                                            {
                                                            ?>
                                                              <li><img src="images/chat.jpg" width="12" height="11" align="left" style="padding-top:8px" /><a href="<? echo $LeftLinkAry2[$LeftLinkCount2][1] ?>"><? echo $LeftLinkAry2[$LeftLinkCount2][0]; ?></a></li>
                                                            <? 
                                                            }
                                                            ?>
                                                         </ul>   
                                                        <?
                                                     }
                                                  ?>
                                              
                                           </li>
                                        <?
                                        }
                                    }
                                }
                          ?>          
                          
                        </ul>
                      </div>
                  </div>
                </td>
              </tr>
      		</table>
	     </div>
       </td>  
     </tr>
    </table>