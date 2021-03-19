<?php
session_start();
include("dbconnect.php");
if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
   header("Location: ./index.php"); 
	die();
}
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
header("Content-Type: application/json");
if (isset($_POST['log']))
{
	$in_logactivity = $_POST['log'];
	$data = array(
	'sessionid' => $_SESSION['uniquekey'],
	'date' => date("Y-m-d"),
	'problemid' => 19,
	'problemname' => 'ba_logout',
	'problemstatus' => $in_logactivity
	);
	curl_logactivity($data);
	$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$in_logactivity." "."ba_logout";

	if ($in_logactivity == "Successful Attempt")
	{
		$data = array(
			'problemid' => 19,
			'username' => $_SESSION["username"],
			'answer' => "userinsessionwithoutlogin",
			'log' => $_SESSION["logactivity"],
			'sessionid' => $_SESSION['uniquekey'],
			'date' => date("Y-m-d")
		);
		curl_answer($data);
	}
}
?>