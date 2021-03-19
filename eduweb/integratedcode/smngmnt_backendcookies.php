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

if(isset($_POST['userlogin']))
{
	$user = $_COOKIE['PHPSESSID'];
	$username = $_POST['userlogin'];
	$_SESSION["userasadmin"] = $username;

	$responsejson = "";
	$logactivity = "";

	if ($user == 'c4c8hdgd699dh8df7real6nnqf' && $username != 'administrator') {
		$responsejson = "{\"loginstatus\": \"Success\"}";
		$logactivity = "Admin login successful by another user";
	} else if($user == 'c4c8hdgd699dh8df7real6nnqf' && $username == 'administrator'){
		$responsejson = "{\"loginstatus\": \"AdminAccount\"}";
		$logactivity = "Admin login successful by admin";
	} else {
		$responsejson = "{\"loginstatus\": \"Notadmin\"}";
		$logactivity = "Not admin";
	}

	$data = array(
	'sessionid' => $_SESSION['uniquekey'],
	'date' => date("Y-m-d"),
	'problemid' => 25,
	'problemname' => 'smngmnt_cookies',
	'problemstatus' => $logactivity
	);
	curl_logactivity($data);
	$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$logactivity." "."smngmnt_cookies";
	
	if ($user == 'c4c8hdgd699dh8df7real6nnqf' && $username != 'administrator')
	{
		$data = array(
		'problemid' => 25,
		'username' => $_SESSION["username"],
		'answer' => "adminlogincookies",
		'log' => $_SESSION["logactivity"],
		'sessionid' => $_SESSION['uniquekey'],
		'date' => date("Y-m-d")
		);
		curl_answer_without_message($data);
	}
	echo $responsejson;
}



?>