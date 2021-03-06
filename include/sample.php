<?php
//$path = "http://images.templatemonster.com/screenshots/".$_GET["nm"]; //---Sample String for other's site data


$path=$_GET["nm"];


$string = $_GET['text'];
$jpeg = fopen($path,"r");
while (!feof($jpeg)) {
  $data .= fread($jpeg, 8192);
}

$mwidth=$_GET["mwidth"];
$mheight=$_GET["mheight"];

define(MAX_WIDTH, $mwidth);
define(MAX_HEIGHT, $mheight);

$img = null;

$img = @imagecreatefromstring($data);

if ($img) {

    # Get image size and scale ratio
    $width = imagesx($img);
    $height = imagesy($img);
    $scale = min($mwidth/$width, $mheight/$height);

    # If the image is larger than the max shrink it
    if ($scale < 1) {
        $new_width = floor($scale*$width);
        $new_height = floor($scale*$height);

        # Create a new temporary image
        		
		$tmp_img = imagecreatetruecolor($new_width, $new_height);

		$bgColor = imagecolorallocate($tmp_img, 255,25,255);
		imagefill($tmp_img , 0,0 , $bgColor);

        # Copy and resize old image into new image
        imagecopyresampled($tmp_img, $img, 0, 0, 0, 0,
                         $new_width, $new_height, $width, $height);
				
        imagedestroy($img);
        $img = $tmp_img;
    }
}

# Create error image if necessary
if (!$img) {
    $img = imagecreate($mwidth, $mheight);
    imagecolorallocate($img,0,0,0);
    $c = imagecolorallocate($img,70,70,70);
    imageline($img,0,0,$mwidth,$mheight,$c2);
    imageline($img,$mwidth,0,0,$mheight,$c2);
}

# Display the image
header( "Content-type: image/jpeg");
$orange = imagecolorallocate($img, 220, 210, 60);
$px    = (imagesx($img) - 7.5 * strlen($string)) / 2;
imagestring($img, 3, $px, 9, $string, $orange);
imagejpeg($img);
imagedestroy($img);
imagedestroy($tmp_img); 
?>