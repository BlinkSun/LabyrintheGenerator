<?php
$img = imagecreatefromjpeg("http://www.publicdomainpictures.net/pictures/60000/nahled/checkerboard-squares-black-white.jpg");
$pixel_x = imagesx($img);
$pixel_y = imagesy($img); 

$pixel_rgb = imagecolorat($img, 90, 30);
$r = ($pixel_rgb >> 16) & 0xFF;
$g = ($pixel_rgb >> 8) & 0xFF;
$b = $pixel_rgb & 0xFF;

var_dump($r, $g, $b);
echo $pixel_rgb . " ";
echo $pixel_x . "x" . $pixel_y;


?> 
