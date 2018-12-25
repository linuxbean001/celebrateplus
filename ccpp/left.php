<table width="235"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="9" align="left" valign="top"><img src="images/cal1.png" width="9" height="77" /></td>
                <td align="left" valign="top" class="cal2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="46" align="center" valign="bottom" class="white_34"><SCRIPT src="js/time.js"></SCRIPT>
                      </td>
                    </tr>
                    <tr>
                      <td height="22" align="center" class="grey_13"><?=date('l, dS F Y')?></td>
                    </tr>
                  </table></td>
                <td width="9" align="left" valign="top"><img src="images/cal3.png" width="9" height="77" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td class="celander_bot">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <? 
			 
			  	if($LeftLinkSection >0 && $LeftLinkSection!="" )
				{
					
					$LeftLinkSection-=1;
	
			  ?>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10" align="left" valign="top"><img src="images/title_wrapper_left.png" width="10" height="35" /></td>
                <td align="left" valign="middle" class="title_wrapper_middle"><? echo ucfirst($HeadLinksArray[$LeftLinkSection][0]); ?></td>
                <td width="10" align="left" valign="top"><img src="images/title_wrapper_right.png" width="10" height="35" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" class="sidebar_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?
								$LeftLinkAry1 = $HeadLinksArray[$LeftLinkSection][2];
								for($LeftLinkCount=0;$LeftLinkCount<count($LeftLinkAry1);$LeftLinkCount++)
								{
							?>
              <tr>
                <td height="30" align="left" valign="middle" class="sidebar_menu"><img src="images/left_arrow.jpg" width="3" height="5" style="padding-bottom:2px;"/>&nbsp;&nbsp;<a href="<? echo $LeftLinkAry1[$LeftLinkCount][1] ?>" class="sidebar_link"><strong><? echo $LeftLinkAry1[$LeftLinkCount][0] ?></strong></a></td>
              </tr>
              <?
									$LeftLinkAry2 = $LeftLinkAry1[$LeftLinkCount][3];
									for($LeftLinkCount2=1;$LeftLinkCount2<count($LeftLinkAry2);$LeftLinkCount2++)
									{	
							?>
              <tr>
                <td height="30" align="left" valign="middle" class="sidebar_menu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/left_arrow.jpg" width="3" height="5" style="padding-bottom:2px;"/>&nbsp;&nbsp;<a href="<? echo $LeftLinkAry2[$LeftLinkCount2][1] ?>" class="sidebar_link"><? echo $LeftLinkAry2[$LeftLinkCount2][0] ?></a></td>
              </tr>
              <?
									}			
								}
							?>
            </table></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10" align="left" valign="top"><img src="images/sidebar_bottom_1.png" width="10" height="10" /></td>
                <td align="left" valign="top" class="sidebar_bottom">&nbsp;</td>
                <td width="10" align="left" valign="top"><img src="images/sidebar_bottom_3.png" width="10" height="10" /></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <? 
			  	 }
				 					
				$LeftLinkSection+=1;
											
				?>
  <tr>
    <td align="left" valign="top" height="100px"></td>
  </tr>
</table>
