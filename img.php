<?php

session_start();



$num = "0123456789 abcdefghijklmnopqrstuvwxyz";

$rand = substr(str_shuffle($num), 0, 4);


$_SESSION['image_random_value'] = md5($rand);



$image = imagecreatefromjpeg("images/img.jpg");



$textColor = imagecolorallocate ($image, white, white, white);


imagestring ($image, 5, 5, 8, $rand, $textColor); 



header("Expires: Mon, 26 Jul 2020 05:00:00 GMT");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

header("Cache-Control: no-store, no-cache, must-revalidate");

header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");





header('Content-type: image/jpeg');

imagejpeg($image);

imagedestroy($image);



?>