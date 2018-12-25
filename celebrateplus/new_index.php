<? include("connect.php"); ?>
<? $a = GetContent(1);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Celebrate Plus</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/SpryTabbedPanels.js" type="text/javascript"></script>
<!-- Slide Show Starts -->
<link rel="stylesheet" href="css/screen.css" media="screen, projection">
<script src="js/jquery-latest.js"></script>
<script src="js/stepcarousel.js"></script>
<script src="js/stepcarousel_002.js"></script>
<!-- Slide Show Ends -->
</head>
<body>
<div class="main">
	<?php include("header.php"); ?>
</div>

<!-- conted -->

	<?php include_once("homepage_slides.php"); ?>
	<?php include_once("homepage_promos.php"); ?>
  
  
  
<!-- bottem -->
	<?php include("footer.php"); ?>
</body>
</html>