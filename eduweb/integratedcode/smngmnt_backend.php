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

if(isset($_POST['uid']))
{
	$userid = $_POST['uid'];
	$username = $_POST['uname'];
	$_SESSION["userasadmin"] = $username;

	$responsejson = "";
	$logactivity = "";

	if ($userid == '1') {
		$responsejson = "{\"loginstatus\": \"Success\"}";
		$logactivity = "Admin login successful";
	} else {
		$responsejson = "{\"loginstatus\": \"Notadmin\"}";
		$logactivity = "Not admin";
	}

	$data = array(
	'sessionid' => $_SESSION['uniquekey'],
	'date' => date("Y-m-d"),
	'problemid' => 24,
	'problemname' => 'smngmnt_admin',
	'problemstatus' => $logactivity
	);
	curl_logactivity($data);
	$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$logactivity." "."smngmnt_admin";
	
	if ($userid == '1')
	{
		$data = array(
		'problemid' => 24,
		'username' => $_SESSION["username"],
		'answer' => "adminlogin",
		'log' => $_SESSION["logactivity"],
		'sessionid' => $_SESSION['uniquekey'],
		'date' => date("Y-m-d")
		);
		curl_answer_without_message($data);
	}
	echo $responsejson;
}



?>