<?php
	session_start();
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./myshop.php"); 
		die();
	}
	include("function_check.php");
	$captcha = generate_random_string();
	$_SESSION["captcha"] = $captcha;
	echo "<h1>".$captcha."</h1>";
	/*
	header('Content-type: image/jpeg');
	$image = imagecreatefromjpeg('product_images/captcha.jpg');
	$red = imagecolorallocate($image, 255, 0, 0);
	$font = "arial.ttf";
	imagettftext($image, 20, 0, 75, 38, $red, $font, $captcha);
	imagejpeg($image);
	imagedestroy($image);*/
?>