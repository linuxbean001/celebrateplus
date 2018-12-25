<?php 
	$ruri=explode("/",$_SERVER['REQUEST_URI']);	
	
	unset($ruri[count($ruri)-1]);
	unset($ruri[count($ruri)-1]);
	unset($ruri[strpos("",$ruri)]);
	
	$ruri=implode("/",$ruri);
	$url="http://".$_SERVER['HTTP_HOST']."/".$ruri;
	
	header("Location:".$url);
	
?>

