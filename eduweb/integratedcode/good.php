<?php
	session_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./index.php"); 
		die();
	}
	if ($_POST)
	{
		$frameinput = $_POST['userinput'];
		echo $frameinput;
	}
?>

