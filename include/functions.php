<?php
	
	/*===================Password encryption - decryption function================================*/
	
	function is_attendee_by_email($email,$event_id)
	{
		$email = str_replace(" ","",$email);
		 $is_attendee_query = "select count(id) from attendee where uemail = '$email' and event_id = '$event_id'";
		$is_attendee_result = mysql_query($is_attendee_query) or die(mysql_error());
		 $is_attendee = mysql_result($is_attendee_result,0);
		if($is_attendee > 0)
		{
			$is_attendee = true;
		}
		else
		{
			$is_attendee = false;
		}
		return $is_attendee;
	}
		function encrypt($string, $key )
		{
			$result = '';
			for($i=0; $i<strlen($string); $i++)
			 {
				$char = substr($string, $i, 1);
				$keychar = substr($key, ($i % strlen($key))-1, 1);
				$char = chr(ord($char)+ord($keychar));
				$result.=$char;
			 }
		
			
			return base64_encode($result);
		}
		
		function decrypt($string, $key)
		{
			$result = '';
			$string = base64_decode($string);
			
			for($i=0; $i<strlen($string); $i++)
			{
				$char = substr($string, $i, 1);
				$keychar = substr($key, ($i % strlen($key))-1, 1);
				$char = chr(ord($char)-ord($keychar));
				$result.=$char;
			}
		
			return $result;
		} 
	/*=============================================================================================*/
	
	function Get_MetaData($id)
	{
		$static_qry = "select * from staticpage where id=$id";
		$static_res = mysql_query($static_qry);
		$static_row = mysql_fetch_array($static_res);
		$static_title = stripslashes($static_row['title']);
		$metakeyword =  stripslashes($static_row['meta_keywords']);
		$metadescription = stripslashes($static_row['meta_discription']);
		$static_data = '<title>'.$static_title.'</title>';
		$static_data .='<meta name="keywords" content="'.$metakeyword.'" />';
		$static_data .='<meta name="description" content="'.$metadescription.'" />';
		return $static_data;
	}
	function GetContent($static_id)
	{
		$content_qry = "select * from staticpage where id=$static_id";
		$content_res = mysql_query($content_qry);
		$content_row = mysql_fetch_array($content_res);
		$content = array();
		$content[0] = stripslashes($content_row['page_header']);
		$content[1] = stripslashes($content_row['content']);
		return $content;
		
	}
	function convert_us($date)
	{
		$date = explode("-",$date);
		return $final_date = $date[1]."-".$date[2]."-".$date[0];
	}
	function convert_db($date)
	{
		$date = explode("-",$date);
		return $final_date = $date[2]."-".$date[0]."-".$date[1];
	}
	function delete_image($image_directory,$image_table,$image_field_name,$condition_field_name,$condition_value=0)
	{
		$image_query = "select $image_field_name from $image_table where $condition_field_name = '$condition_value'";
		$image_result = mysql_query($image_query) or die(mysql_error());
		$image_total = mysql_num_rows($image_result);
		if($image_total > 0)
		{
			$image_data = mysql_fetch_array($image_result);
			$image_path = $image_data[$image_field_name];
			if($image_path != '' && file_exists($image_directory.$image_path))
			{
				unlink($image_directory.$image_path);
			}
		}
		unset($image_data);
		unset($image_result);
		unset($image_query);
	}
	function removep($string)
	{
		$string = str_replace("<p>&nbsp;</p>","",$string);
		$string = str_replace("<p>","",$string);
		$string = str_replace("</p>","",$string);				
		return $string;
	}
	function check_image($file_name_array,$redirect_url='',$valid_mime_types = array("image/gif", "image/jpeg", "image/png", "application/x-shockwave-flash"))
	{
		if($file_name_array['tmp_name'] != '')
		{
			
		$error = 0; 
		
		$blacklist = array(".php", ".phtml");
		foreach ($blacklist as $item) {
		   if(preg_match("/$item/i", $file_name_array['name'])) 
		   {
			   $error = 1;
		   }
		}
		
		if($error == 0)
		{
			$imageinfo = getimagesize($file_name_array['tmp_name']);
			$mime_type = $imageinfo['mime'];
			if(!in_array($mime_type, $valid_mime_types, true))
			{
				$error = 2;
			}
		}
		
		
		if($error != 0)
		{
			if($error == 1){ $msg="We do not allow uploading PHP files"; }
			if($error == 2){ $msg="Sorry, we only accept GIF,JPEG,PNG,SWF files"; }
			if($redirect_url != '')
			{
				?>
					<script language="javascript">
						alert("<?=$msg;?>");
						window.location.href='<?=$redirect_url;?>';
					</script>
				<?
			}
			else
			{	
				?>
					<script language="javascript" type="text/javascript">
						alert("<?=$msg;?>");
						window.history.go(-1);
					</script>
				<?
			}
			exit;
		}
		}
	}
	
	function check_doc($file_name_array,$redirect_url='')
	{
		if($file_name_array['tmp_name'] != '')
		{
			
		$error = 0; 
		if((($file_name_array["type"] == "application/pdf")|| ($file_name_array["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
	|| ($file_name_array["type"] == "text/plain")|| ($file_name_array["type"] == "application/msword")|| ($file_name_array["type"] == "text/rtf")|| ($file_name_array["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")|| ($file_name_array["type"] == "application/vnd.ms-excel")))
		{
			// $error will remain zero
		}
		else
		{
			$error = 1;
		}
		
		if($error != 0)
		{
			if($error == 1){ $msg="Sorry, invalid file type"; }
			if($redirect_url != '')
			{
				?>
					<script language="javascript">
						alert("<?=$msg;?>");
						window.location.href='<?=$redirect_url;?>';
					</script>
				<?
			}
			else
			{	
				?>
					<script language="javascript" type="text/javascript">
						alert("<?=$msg;?>");
						window.history.go(-1);
					</script>
				<?
			}
			exit;
		}
		}
		}
	
	
	function GTG_firewall($val)
	{
		return htmlspecialchars(strip_tags(mysql_real_escape_string($val)));
	}
	
	function checkReffer()
	{
		$ref=$_SERVER['HTTP_REFERER'];
		if(strpos($ref,"server/chris/ecomwholesale/")>0)
		{
			
		}
		else
		{
			echo "<script> window.location='//server/chris/ecomwholesale/index.php'; </script>";
			exit;
		}
	}
	
	if(!function_exists("checkNum")) {
	function checkNum($id)
	{
		return mysql_escape_string(intval($id));
	} }
	
	function GTG_security($val)
    {
	 return mysql_real_escape_string($val);
    }

	## 1 ##
	function GTG_is_dup_add($table,$field,$value)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".ads($value)."'"; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 2 ##
	function GTG_is_dup_add_id($table,$field,$value)
	{
		$q = "select ".$field." from ".$table." where ".$field." = ".ads($value).""; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 3 ##
	function GTG_is_dup_edit($table,$field,$value,$id)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."' and id != ".$id; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 4 ##
	function GTG_is_dup_edit_id($table,$field,$value,$id)
	{
		$q = "select ".$field." from ".$table." where ".$field." = ".$value." and id != ".$id; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 5 ##
	function GTG_maxid($table)
	{
		$q = "select max(id) as mid from ".$table; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_num_rows($r))
			{
				print $r1['mid']; exit;
				return $r1['mid'];
			}
		}
		else
		{
			return 0;
		}
	}
	
	## 6 ##
	function GTG_checkfordelete($targettable,$targetfield,$searchvalue)
	{
		$q = "select ".$targetfield." from ".$targettable." where ".$targetfield." = ".$searchvalue; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 7 ##
	function GTG_check_category_for_delete($searchvalue)
	{
		$q = "SELECT categoryid FROM product WHERE categoryid LIKE '%".$searchvalue."%'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	function GTG_check_subcategory_for_delete($searchvalue)
	{
		$q = "SELECT subcategory_id FROM product WHERE subcategory_id LIKE '%".$searchvalue."%'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 8 ##
	function GTG_arraytostr($array)
	{
		for($i=0;$i<count($array);$i++)
		{
			if($i == count($array)-1)
			{
				$str = $str.$array[$i];
			}
			else
			{
				$str = $str.$array[$i].",";
			}
		}
		return $str;
	}
	
	## 9 ##
	function GTG_strtoarray($str)
	{
		return explode(",",$str);
	}
	
	## 10 ##
	function GTG_valueinarray($array,$value)
	{
		for($i=0;$i<count($array);$i++)
		{
			if($array[$i]==$value)
			{
				return true;
			}
		}
		return false;
	}
	
	## 11 ##
	function GTG_addzero($n)
	{
		if($n < 10)
			return "0".$n;
		else
			return $n;
	}
	
	## 12 ##
	function GTG_addzero1($n)
	{
		if(strlen($n) == 1)
			return "0".$n;
		else
			return $n;
	}
	
	
	
	## 14 ##
	function GTG_checkbookdate($start,$end)
	{
		$start = '2007-3-1';
		$end = '2007-4-25';
		
		$a1 = explode("-",$start);
		$a2 = explode("-",$end);
		
		$sy = $a1[0];
		$ey = $a2[0];
		
		$sm = addzero1($a1[1]);
		$em = addzero1($a2[1]);
		
		$sd = addzero1($a1[2]);
		$ed = addzero1($a2[2]);
		
		$compare_end = $ey."-".$em."-".$ed;
		while($comparedate != $compare_end)
		{
			if($sd > 31)
			{
				$sd=1;
				$sm++;
			}
			if($sm > 13)
			{
				$sm=1;
				$sy++;
			}
			$comparedate = $sy."-".addzero1($sm)."-".addzero1($sd);
			$sd++;
			$datelist = $datelist.$comparedate.",";
		}
		$datelist = substr($datelist,0,strlen($datelist));
	}
	
	
	
	## 20 ##
	function GTG_add_to_cart($id,$q)
	{
		if(isset($_SESSION['P']))
		{
			$P = $_SESSION['P'];
			$Q = $_SESSION['Q'];
			$flag = 0;
			for($i=0;$i<count($P);$i++)
			{
				if($P[$i] == $id)
				{
					$Q[$i] = $Q[$i] + $q;
					$flag = 1;
				}
			}
			if($flag == 0)
			{
				$P[count($_SESSION['P'])]	= $id;
				$Q[count($_SESSION['Q'])] = $q;
			}
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
		}
		else
		{
			$P[0] = $id;
			$Q[0] = $q;
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
		}
	}
	
	## 21 ##
	function GTG_remove_from_cart($id)
	{
		if(isset($_SESSION['P']))
		{
			$P = $_SESSION['P'];
			$Q = $_SESSION['Q'];
			$P_temp;
			$Q_temp;
			for($i=0;$i<count($P);$i++)
			{
				if($P[$i] != $id)
				{
					$P_temp[$i] = $P[$i];
					$Q_temp[$i] = $Q[$i];
				}
			}
			$_SESSION['P'] = $P_temp;
			$_SESSION['Q'] = $Q_temp;
		}
	}
	
	## 22 ##
	function GTG_add_to_cart_individual($id,$q)
	{
		if(isset($_SESSION['P']))
		{
			$P = $_SESSION['P'];
			$Q = $_SESSION['Q'];
			$flag = 0;
			for($i=0;$i<count($P);$i++)
			{
				if($P[$i] == $id)
				{
					$Q[$i] = $q;
					$flag = 1;
				}
			}
			if($flag == 0)
			{
				$P[count($_SESSION['P'])]	= $id;
				$Q[count($_SESSION['Q'])] = $q;
			}
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
		}
		else
		{
			$P[0] = $id;
			$Q[0] = $q;
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
		}
	}
	
class get_pageing
{
var $record_per_page=10;
var	$pages=5;
var $tbl,$file_names,$order,$query;

///////// GET THE VALUE OF START VARIABLE////////////////
	function start()
	{
		if($_GET["start"])
			return	$start=$_GET["start"];
		else
			return	$start=0;
	}

	function file_names()
	{
		$pt=explode("/",$_SERVER['SCRIPT_FILENAME']);
		$totpt=count($pt);
		//return $this->file_names=$pt[$totpt-1];
		
		return "abc.php";
	}
//////////////  END OF FILE_NAME FUNCTION///////////////////

//////////////  DISPLAY THE NUMERIC PAGING WITHOUT RECORD DETAIL///////////////////
	function number_pageing_nodetail($query,$record_per_page='',$pages='')
	{
			return $this->number_pageing($query,$record_per_page,$pages,"N");
	}
	
	function number_pageing_bottom_nodetail($query,$record_per_page='',$pages='')
	{
			return $this->number_pageing($query,$record_per_page,$pages,"N","Y");
	}
	
	function number_pageing_bottom($query,$record_per_page='',$pages='')
	{
			return $this->number_pageing($query,$record_per_page,$pages,"","Y");
	}

//////////////  END OF NUMERIC PAGING FUNCTION ///////////////////	

	function runquery($query)
	{
		return	mysql_query($query);
	}
	
	
///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////
function number_pageing($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{
		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();

		//if($start>($totalrows-$record_per_page))	
		//	$start=$totalrows-$record_per_page;
		//if($start<0)
		//	$start=0;
			
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		
		
		

		$start_loop=($loop_counter*$this->pages-$this->pages)-2;
		if($start_loop<=0)
			$start_loop=1;
		$end_loop=($this->pages*$loop_counter)+4;
		
		
		//Remove this comment so it will display the page number as per ur defined gape like 1,2,3,4,5 then 6,7,8,9,10 likewise..
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;
		
		
		
		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start" and $V!="msg")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table   height='100%' border='0' cellpadding='1' cellspacing='1' class='paging_border'>";
		
		$this->tbl.="<tr><td align='center'  align='left'>";
		if($detail!="N" and $simple !="N")
			//$this->tbl.="<strong >Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
		$this->tbl.=$current_page." Page of ".$total_pages."&nbsp;&nbsp;";
		//$this->tbl.="</td><tr>";
		
		
		//$this->tbl.="<tr><td align='center'  align='left'>";	
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=0".$tmpva."' class='link2' onMouseOver=\"smsg('First Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">First</a>&nbsp;|&nbsp;"; 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."' class='link2' onMouseOver=\"smsg('Privious Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Prev</a>&nbsp;|&nbsp;"; 
		} 
		//$this->tbl.="</td>";
		//$this->tbl.="<td align='center'  align='left'>";
		if($simple!='N')
		{
			
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong class='link2'>".$i."</strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."' class='link2' onMouseOver=\"smsg('View Page Number $i');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$i."</a>&nbsp;&nbsp;"; 
				}
			}
			
			//$this->tbl.="Page ".$current_page." / ".$total_pages;
		}
		//$this->tbl.="</td>";
		//$this->tbl.="<td align='center'  align='left'>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="&nbsp;|&nbsp;";
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='link2' onMouseOver=\"smsg('Next Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Next</a>"; 
			$this->tbl.="&nbsp;|&nbsp;";
			$this->tbl.="<a href='".$this->file_names."?start=".(($total_pages-1)*$this->record_per_page).$tmpva."' class='link2' onMouseOver=\"smsg('Last Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Last</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;&nbsp;";
		$this->tbl.="</td></tr>";
		
		$this->tbl.="</table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				
				return $result;
			}
		}
	}	


function number_pageing222($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
	{
		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();

		//if($start>($totalrows-$record_per_page))	
		//	$start=$totalrows-$record_per_page;
		//if($start<0)
		//	$start=0;
			
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		
		
		

		$start_loop=($loop_counter*$this->pages-$this->pages)-2;
		if($start_loop<=0)
			$start_loop=1;
		$end_loop=($this->pages*$loop_counter)+4;
		
		
		//Remove this comment so it will display the page number as per ur defined gape like 1,2,3,4,5 then 6,7,8,9,10 likewise..
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;
		
		
		
		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start" and $V!="msg")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table   height='100%' border='0' cellpadding='1' cellspacing='1' class='table-heading3'>";
		
		$this->tbl.="<tr><td align='center'  align='left'>";
		if($detail!="N" and $simple !="N")
			//$this->tbl.="<strong >Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
		$this->tbl.=$current_page." Page of ".$total_pages."&nbsp;&nbsp;";
		//$this->tbl.="</td><tr>";
		
		
		//$this->tbl.="<tr><td align='center'  align='left'>";	
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=0".$tmpva."' class='table-heading2' onMouseOver=\"smsg('First Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">First</a>&nbsp;|&nbsp;"; 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."' class='table-heading2' onMouseOver=\"smsg('Privious Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Prev</a>&nbsp;|&nbsp;"; 
		} 
		//$this->tbl.="</td>";
		//$this->tbl.="<td align='center'  align='left'>";
		if($simple!='N')
		{
			
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong class='table-heading2'>".$i."</strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."' class='table-heading2' onMouseOver=\"smsg('View Page Number $i');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".$i."</a>&nbsp;&nbsp;"; 
				}
			}
			
			//$this->tbl.="Page ".$current_page." / ".$total_pages;
		}
		//$this->tbl.="</td>";
		//$this->tbl.="<td align='center'  align='left'>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="&nbsp;|&nbsp;";
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='table-heading2' onMouseOver=\"smsg('Next Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Next</a>"; 
			$this->tbl.="&nbsp;|&nbsp;";
			$this->tbl.="<a href='".$this->file_names."?start=".(($total_pages-1)*$this->record_per_page).$tmpva."' class='table-heading2' onMouseOver=\"smsg('Last Page');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">Last</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;&nbsp;";
		$this->tbl.="</td></tr>";
		
		$this->tbl.="</table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				
				return $result;
			}
		}
	}
//////////////  SIMPLE NEXT-PRI PAGING ///////////////////	
	function pageing($query,$record_per_page="",$pages="")
	{
			return $this->number_pageing($query,$record_per_page,$pages,'','','N');
	}
//////////////  END OF SIMPLE PAGING FUNCTION///////////////////	

//////////////  WRITE ALL,A TO Z CHARACTER WITH CURRENT PAGE LINK ///////////////////
	function order()
	{
		$this->file_names();
		$this->order.="<TR><TD><a class=la href='$file_names?order=' onMouseOver=\"smsg('View All Records');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">All</a></TD><TD class=lg>|</TD>";
		for($i=65;$i<91;$i++)
		{		
			$this->order.="<TD><a class=la href='$file_names?order=".chr($i)."' onMouseOver=\"smsg('View By ".chr($i)."');return document.prs_return\" onMouseOut=\"nosmsg('Done');return document.prs_return\">".chr($i)."</a></TD><TD class=lg>|</TD>";
		}
		return $this->order.="</TR>";
	}
	
	function MakeCombo($query,$value="",$fill_value,$comboname,$selected="")
	{
		if($value=="")
			$value=$fill_value;
		$run=$this->runquery($query);
		$totlist=mysql_affected_rows();
		$Combo="<select name='$comboname'>";
		$Combo.="<option value=''>-----Select-----</option>";
		for($i=0;$i<$totlist;$i++)
		{
			$get=mysql_fetch_object($run);
			$Combo.="<option value='".$get->$value."'";
			if($selected==$get->$value)
			{
				$Combo.="selected='selected'";
			}
			$Combo.=">".$get->$fill_value."</option>";
		}
		$Combo.="</select>";
		echo $Combo;
	}
}

$prs_pageing= new get_pageing;
	


function writeHrsSelect($timeString)
{

    $hrs = array(
            "00:00:00", "00:30:00", "01:00:00", "01:30:00", "02:00:00", "02:30:00",
            "03:00:00", "03:30:00", "04:00:00", "04:30:00", "05:00:00", "05:30:00",
            "06:00:00", "06:30:00", "07:00:00", "07:30:00", "08:00:00", "08:30:00",
            "09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00", 
            "12:00:00", "12:30:00", "13:00:00", "13:30:00", "14:00:00", "14:30:00",
            "15:00:00", "15:30:00", "16:00:00", "16:30:00", "17:00:00", "17:30:00", 
            "18:00:00", "18:30:00", "19:00:00", "19:30:00", "20:00:00", "20:30:00",
            "21:00:00", "21:30:00", "22:00:00", "22:30:00", "23:00:00", "23:30:00"
            );
    
    $strSelect ="";
    foreach($hrs as $time)
    {
        $formatTime = date("g:i a",strtotime($time));
        $strSelect .="<option value='".$time."'".($time==$timeString ? " selected" : "").">".$formatTime."</option>";
    }
    return $strSelect;
}

function returnDate($tmpDate1)
{
	$output ="";
	$daySelFlg1 ="";
	for($i = 1 ; $i <= 31 ; $i++)
	{
		$daySelFlg1 ="";
		if(intval($i) == intval($tmpDate1))
			$daySelFlg1 =" selected " ;				  						
	
			$output .="<option $daySelFlg1 value=\"$i\">$i</option>";
	}
	return $output;
}

function returnMonth($tmpMon1)
{
	$output ="";
	$monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	for($i = 1 ; $i <= 12 ; $i++)
	{
		$monSelFlg1 ="";
		if(intval($i) == intval($tmpMon1))
			$monSelFlg1 =" selected ";
				
			$output .="<option $monSelFlg1 value=\"$i\">" . $monthNames[$i-1] . "</option>";	
		}
	return $output;	
}

function returnYear($startYear,$tmpYear1,$endyear)
{
	$output ="";
	for($i = $startYear ; $i <= $endyear ; $i++)
	{
		$yearSelFlg1 ="";
		if($i == $tmpYear1)
			$yearSelFlg1 =" selected ";			
		
			$output .="<option $yearSelFlg1 value=\"$i\">$i</option>";
	}
	return $output;
}

function ads($str)
{
	return $newstr=htmlentities($str,ENT_QUOTES);
}
function rms($str)
{
	return $newstr=stripslashes($str);
}



function checkSecurityImage($referenceid, $enteredvalue)
{
	$referenceid = mysql_escape_string($referenceid);
	$enteredvalue = mysql_escape_string($enteredvalue);
	$tempQuery = mysql_query("SELECT ID FROM security_images WHERE
	referenceid='".$referenceid."' AND hiddentext='".$enteredvalue."'");
	
	if (mysql_num_rows($tempQuery)!=0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function location($path)
	{
		header("Location: ".$path."");
	}
	
	
	function GTG_get_pagenm($id)
	{
		$q = "select `page_header` from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['page_header']));
			}
		}
	}
	
	function GTG_get_pagecontent($id)
	{
		$q = "select `content` from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['content']));
			}
		}
	}
	function GTG_get_pagecontent1($id)
	{
		$q = "select `lcontent` from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['lcontent']));
			}
		}
	}
	function GTG_get_url($id)
	{
		$q = "select `url` from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['url']));
			}
		}
	}
	function GTG_get_target($id)
	{
		$q = "select `target` from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['target']));
			}
		}
	}
	function GTG_get_pagecontent2($id)
	{
		$q = "select `rcontent` from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['rcontent']));
			}
		}
	}
	function GTG_get_cat_name($id)
	{
		$q = "select `name` from `category` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['name']));
			}
		}
	}
	
	function GTG_get_videocat_name($id)
	{
		$q = "select `name` from `videocategory` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['name']));
			}
		}
	}
	
	
	function GTG_get_distributor_cat_name($id)
	{
		$q = "select `name` from `dcategory` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['name']));
			}
		}
	}
	
	function GTG_get_cat_meta($id)
	{
		$q = "select `meta_tag` from `category` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['meta_tag']));
			}
		}
	}
	function GTG_get_cat_content($id)
	{
		$q = "select `desc1` from `category` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['desc1']));
			}
		}
	}
	function GTG_get_subcat_name($id)
	{
		$q = "select `name` from `subcategory` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['name']));
			}
		}
	}
	function GTG_get_subcat_meta($id)
	{
		$q = "select `meta_tag` from `subcategory` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['meta_tag']));
			}
		}
	}
	function GTG_get_subcat_content($id)
	{
		$q = "select `desc1` from `subcategory` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['desc1']));
			}
		}
	}
	function GTG_get_subsubcat_meta($id)
	{
		$q = "select `meta_tag` from `subsubcategory` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return stripslashes(trim($r1['meta_tag']));
			}
		}
	}
	
  function GTG_get_images($id)
	{
		$q = "select `image_path` from `staticpage` WHERE `id`='".$id."'";
		$rs = mysql_query($q);
		if(mysql_num_rows($rs) > 0)
		{
			while($row = mysql_fetch_array($rs))
			{  
			    
				if($row["image_path"]!="" && file_exists("product_images/".stripslashes($row["image_path"])))
				{
				return stripslashes(trim($row['image_path']));
				}
				 
			}
		}
	}	
	
	
	function GTG_getpagename()
	{
		$page = split("/",strrev($_SERVER['PHP_SELF']));
		return strrev($page[0]);
	}
	
	function GTG_getpagecontent($case)
	{
		$page = split("/",strrev($_SERVER['PHP_SELF']));
		$pname = trim(strrev($page[0]));
		
		if($pname != "")
		{
			$q = "select * from pagedata where name like '".$pname."'";
			$r = mysql_query($q);
			while($r1 = mysql_fetch_array($r))
			{
				if($case == 1)
				{
					return trim(stripslashes($r1['title1']));
				}
				else if($case == 2)
				{
					return trim(stripslashes($r1['meta1']));
				}
				else if($case == 3)
				{
					return trim(stripslashes($r1['meta2']));
				}
				else
				{
					return "";
				}
			}
		}
	}
	
	function jbj_get_images($id)
	{
		$q = "select `image_path` from `staticpage` WHERE `id`='".$id."'";
		$rs = mysql_query($q);
		if(mysql_num_rows($rs) > 0)
		{
			while($row = mysql_fetch_array($rs))
			{  
			    
				if($row["image_path"]!="" && file_exists("product_images/".stripslashes($row["image_path"])))
				{
				return stripslashes(trim($row['image_path']));
				}
				 
			}
		}
	}	
	function GetValue($table,$field,$where,$condition)
	{
		$qry="SELECT $field from $table where $where='".mysql_escape_string($condition)."'";
		$res=mysql_query($qry);
		if(mysql_affected_rows()>0)
		{
			$row=mysql_fetch_array($res);
			return $row[$field];
		}
		else
		{
			return "";
		}
	}
	function sh_GetValue($table,$field,$where,$condition)
	{
		$qry="SELECT $field from $table where $where='".$condition."'";
		$res=mysql_query($qry);
		if(mysql_affected_rows()>0)
		{
			$row=mysql_fetch_array($res);
			return $row[$field];
		}
		else
		{
			return "";
		}
	}
	function GetValueCustom($table,$field,$where,$operator,$condition)
	{
		$qry="SELECT $field from $table where $where $operator '".mysql_escape_string($condition)."'";
		$res=mysql_query($qry);
		if(mysql_affected_rows()>0)
		{
			$row=mysql_fetch_array($res);
			return $row[$field];
		}
		else
		{
			return "";
		}
	}
function Image_Folder($name)
 {
  return $name."/";
 }
function h_get_metakey($id)
	{
		$q = "select * from `staticpage` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
			  
				return '
				<title>'.stripslashes(trim($r1['title'])).'</title>
				<meta name="Keywords" content="'.stripslashes(trim($r1['meta_keywords'])).'">
				<meta name="Description" content="'.stripslashes(trim($r1['meta_discription'])).'">';

			}
		}
	}
	
	function sam_get_display_order($tbl_name,$cond)
	{
		if($cond !="")
		{
			$q="select id from ".$tbl_name." where ".$cond;
		}
		else
		{
			$q="select id from ".$tbl_name;
		}	
		$r=mysql_query($q);		
		$val=mysql_num_rows($r);
		$val++;		
		return $val;
	}
	function get_cplus_date($database_date)
	{
		$cplus_date = date('m/d/Y',strtotime($database_date));
		return $cplus_date;
	}
	function get_database_date($cplus_date)
	{
		$database_date = split("/",$cplus_date);
		$database_date = $database_date[2]."-".$database_date[0]."-".$database_date[1];
		return $database_date;
	}
	
	// String security function started	
	/*function hb_string_security($value)
	{
		if($value != '')
		{
			//return htmlspecialchars(strip_tags(mysql_escape_string($value)));
			$value = strval($value);
			$without_escape_string = mysql_escape_string($value);
			$without_tags = strip_tags($without_escape_string);
			$without_special_characters = htmlspecialchars($without_tags);
			return $without_special_characters;
		}
	}
	function hb_secure_request($allowed_variables = array())
	{
		// Only variables that are listed in $allowed_variables should be allowed to go as it is in the database. others should be sent through prsona_security()
		if(is_array($_POST))
		{
			foreach($_POST as $current_variable_name=>$current_variable_value)
			{
				if(!(is_array($current_variable_value)))							// The value of the variable should not be an array
				{
					if(!(in_array($current_variable_name,$allowed_variables)))		// The name of the variable should not be an array
					{
						$_POST[$current_variable_name] = hb_string_security($current_variable_value);
					}
				}
			}
		}
		if(is_array($_GET))
		{
			foreach($_GET as $current_variable_name=>$current_variable_value)
			{
				if(!(is_array($current_variable_value)))							// The value of the variable should not be an array
				{
					if(!(in_array($current_variable_name,$allowed_variables)))		// The name of the variable should not be an array
					{
						$_GET[$current_variable_name] = hb_string_security($current_variable_value);
					}
				}
			}
		}
		if(is_array($_REQUEST))
		{
			foreach($_REQUEST as $current_variable_name=>$current_variable_value)
			{
				if(!(is_array($current_variable_value)))							// The value of the variable should not be an array
				{
					if(!(in_array($current_variable_name,$allowed_variables)))		// The name of the variable should not be an array
					{
						$_REQUEST[$current_variable_name] = hb_string_security($current_variable_value);
					}
				}
			}
		}
	}*/
	
	/* Encryption / Description function started here */
	function decrypt_api($global_api_key)
	{
		if($global_api_key == '')
		{
			echo 'Some error in $global_api_key';exit;
		}
		$decrypted_api = '';
		$api_array = explode("-",$global_api_key);
		foreach($api_array as $first_portion)
		{
			for($i=0;$i<strlen($first_portion);$i++)
			{
				$ascii = ord($first_portion{$i});
				if($ascii < 100 && $ascii > 0)
				{
					$decrypted_api = $ascii;
				}
			}
		}
		while($decrypted_api == '')
		{
			$distance = 100 - $ascii;
			$decrypted_api = abs($distance);
			if($decrypted_api > 99)
			{
				$distance = 100 - $decrypted_api;
				$decrypted_api = abs($distance);
			}
		}
		if($decrypted_api <1 || $decrypted_api >99)
		{
			echo 'Error found in data encryption';exit;
			//echo 'Some error in $global_api_key variable or decrypt_api($global_api_key) function.';exit;
		}
		return $decrypted_api;
	}
	function keshav_encrypt($original_string)
	{
		$encrypted_string = '';
		if($original_string != '')
		{
			global $GLOBAL_API_KEY;
			global $GLOBAL_SECRET_NUMBER;
			$api_key = decrypt_api($GLOBAL_API_KEY);
			for($i=0;$i<strlen($original_string);$i++)
			{
				$original_character = "";
				$original_character = $original_string{$i};
				$original_character_ascii = ord($original_character);
				$encrypted_character = ($original_character_ascii*$GLOBAL_SECRET_NUMBER)+$api_key;
				$encrypted_string = $encrypted_string.$encrypted_character." ";
			}
			$encrypted_string = rtrim($encrypted_string,' ');
			//$encrypted_string = $encrypted_string."#K$@S~!H%&@*+V".$GLOBAL_SECRET_NUMBER;
		}
		return $encrypted_string;
	}
	function keshav_decrypt($encrypted_string)
	{
		$original_string = '';
		if($encrypted_string != '')
		{
			global $GLOBAL_API_KEY;
			global $GLOBAL_SECRET_NUMBER;
			$api_key = decrypt_api($GLOBAL_API_KEY);
			//$encrypted_string_array = explode("#K$@S~!H%&@*+V",$encrypted_string);
			//$encrypted_string = explode(" ",$encrypted_string_array[0]);
			//$GLOBAL_SECRET_NUMBER = $encrypted_string_array[1];
			$encrypted_string = explode(" ",$encrypted_string);
			
			
			foreach($encrypted_string as $encrypted_character)
			{
				$encrypted_character = $encrypted_character-$api_key;
				$encrypted_character_ascii = $encrypted_character/$GLOBAL_SECRET_NUMBER;
				
				$encrypted_character = chr($encrypted_character_ascii);
				$original_string = $original_string.$encrypted_character;
			}
		}
		return stripslashes($original_string);
	}
	/* Encryption / Description function ended here */
	
	/* All of the url of a site should be controled from one place and that's why I'm developing this function */
	function hb_control_url($page_url)
	{
		// First of all we need to get the url of the site here so declare it a global
		global $hb_site_url;
		
		// Again if any files needs login then we need to pass it to login.php if the user has not logged in yet
		global $hb_login_needed;
		
		foreach($hb_login_needed as $login_needed_url)
		{
			if(strstr($page_url,$login_needed_url))
			{
				if(!($_SESSION['SESS_USER_ID'] > 0))
				{
					$_SESSION['then_go'] = $page_url;
					$page_url = 'login.php';
				}
			}
		}
		// Now with this concat the url of the page with this site url
		$page_url = $hb_site_url.$page_url;
		
		return $page_url;
	}
	function hb_get_select_result($hb_query)
	{
		$hb_result = hb_run_query($hb_query);
		return $hb_result;
	}
	function hb_get_update_result($hb_query)
	{
		$hb_result = hb_run_query($hb_query);
		return $hb_result;
	}
	function hb_get_delete_result($hb_query)
	{
		$hb_result = hb_run_query($hb_query);
		return $hb_result;
	}
	function hb_get_result($hb_query)
	{   
		/* Now get the type of query */
		/* 
			And for getting the type of the query we will first separate its first word from the whole query 
			Now if the first word is "select" then we will call the function related to select query
			else if the first word is "update" then we will call the function related to update query
			else if the first word is "delete" then we will call the function related to delete query
			else we will call the function "hb_run_query" for other type of queries
		*/
		$hb_query = ltrim($hb_query," ");
		$hb_query_array = explode(' ',trim($hb_query));
		$first_word = $hb_query_array[0];
		if(strtolower($first_word) == 'select')
		{
			$hb_result = hb_get_select_result($hb_query);
		}
		else if(strtolower($first_word) == 'update')
		{
			$hb_result = hb_get_update_result($hb_query);
		}
		else if(strtolower($first_word) == 'delete')
		{
			$hb_result = hb_get_delete_result($hb_query);
		}
		else
		{
			$hb_result = hb_run_query($hb_query);
		}
		return $hb_result;
	}
	function hb_run_query($hb_query)
	{
		global $global_show_errors;
		if($global_show_errors == true)
		{
		$hb_result = mysql_query($hb_query) or die("<span style='color:red; font-weight:bold;'>Error :</span> ".mysql_error().".<br/><br/><span style='color:green; font-weight:bold;'>Your Query :</span> ".$hb_query."");
		//$hb_result = hb_get_result($hb_query) or die(mysql_error());
		}
		else
		{
		$hb_result = mysql_query($hb_query);
		}
		return $hb_result;
	}
	function hb_get_payment_mode()
	{
		/* Payment Mode Operation Started */
		$payment_mode_query = "select paymentmode from payment_mode limit 1";
		$payment_mode_result = mysql_query($payment_mode_query) or die(mysql_error());
		$payment_mode_total = mysql_num_rows($payment_mode_result);
		if($payment_mode_total > 0)
		{
			$payment_mode_data = mysql_fetch_array($payment_mode_result);
			$x_Test_Request = $payment_mode_data['paymentmode'];
			if($x_Test_Request == 'TRUE')
			{
				// Do NOTHING
			}
			else if($x_Test_Request == 'FALSE')
			{
				// DO NOTHING
			}
			else
			{
				// make it 'FALSE'
				$update_query = "update payment_mode set paymentmode = 'FALSE'";
				$update_result = mysql_query($update_query) or die(mysql_error());
				$x_Test_Request = 'FALSE';
			}
		}
		else
		{
			// Insert a new record
			$insert_query = "insert into payment_mode set paymentmode = 'FALSE'";
			$insert_result = mysql_query($insert_query) or die(mysql_error());
			$x_Test_Request = 'FALSE';
		}
		/* Payment Mode Operation Ended */
		return $x_Test_Request;
	}
	function hb_set_payment_mode($payment_mode)
	{
		if($payment_mode != '')
		{
			$update_query = "update payment_mode set paymentmode = '$payment_mode'";
			$update_result = mysql_query($update_query) or die(mysql_error());
		}
		else
		{
			echo "Please enter payment mode.";
			exit;
		}
	}
	
	/*================ User Attandy report search 6th September 2012 ==========================*/
function sh_get_id_list($table_name,$fetch_field,$condition_field,$condition_value,$condition_field2="",$condition_value2="")
{
	$id_list_array=array();
	$id_list="";
	$query="select ".$fetch_field." from ".$table_name." where ".$condition_field." like '%".$condition_value."%'";
	if($condition_field2 != "" && $condition_value2 != "")
	{
		$query .= " and ".$condition_field2." like '%".$condition_value2."%'";
	}
	$result=mysql_query($query) or die(mysql_error());
	while($row=mysql_fetch_array($result))
	{
		$id_list_array[]=$row[$fetch_field];
	}
	$id_list_array = array_unique($id_list_array);
	if(count($id_list_array))
	{
		$id_list = implode(",",$id_list_array);
	}
	return $id_list;
}
function sh_get_eid_list($query,$field)
{
	$id_list_array=array();
	$id_list="";	
	$result=mysql_query($query) or die(mysql_error());
	while($row=mysql_fetch_array($result))
	{
		$id_list_array[]=$row[$field];
	}
	$id_list_array = array_unique($id_list_array);
	if(count($id_list_array))
	{
		$id_list = implode(",",$id_list_array);
	}
	return $id_list;
}
function sh_get_cleared_list($id_list)
{
	//echo "<br>inside function".$id_list;
	if(stristr($id_list,","))
	{
		$id_array= explode(",",$id_list);	
		$id_array= array_unique($id_array);
		$key = array_search("",$id_array);
		if($key >= 0)
		{ 
			if($id_array[$key] == "") { unset($id_array[$key]); }
		}
		if(count($id_array) > 0)
		{ $cleared_id_list = implode(",",$id_array);}
	}
	else
	{ $cleared_id_list = $id_list;}
	return $cleared_id_list;
}
function sh_get_validate_user_to_create_event_vars ()
{
	$event_result_array = array();
	/*------------------------- Checking Of total funding event of the user in current year -------------------------------**/

		$org_sign_up_date = sh_GetValue("organizer","add_date","id",$_SESSION['SESS_USER_ID']);
		$year_end_date = $org_sign_up_date;
		do 
		{
			$year_end_date_prev = $year_end_date;
			$year_end_date =  date('Y-m-d',strtotime("$year_end_date_prev + 1 years"));
			
		} while($year_end_date <= date('Y-m-d'));
		$total_funding_event = sh_GetValue("events","count(*)","fund_allowed","Yes' and add_date > ".$year_end_date_prev." and oid = '".$_SESSION['SESS_USER_ID']);	
		$event_result_array['total_funding_event'] = $total_funding_event;
	
	/*-----------------------------------------------------------------------------------------------------------------------------*/
	
	/*------------------------- Checking Of total funding active event of the user in current year -------------------------------**/
	
		$total_fund_active_event = sh_GetValue("events","count(*)","fund_allowed","Yes' and fund_end_date >= now() and fund_end_date > ".$year_end_date_prev." and oid = '".$_SESSION['SESS_USER_ID']);	
		$event_result_array['total_fund_active_event'] = $total_fund_active_event;
	
	/*-----------------------------------------------------------------------------------------------------------------------------*/
	
	return $event_result_array;
}
?>
