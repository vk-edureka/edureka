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

// create connection
$conn = connectdb();

$username = sanitize_string_encode($_POST['userlogin']);
$userpwd = sanitize_string($_POST['userpwd']);

$usernamewhere = " and userlogin = '" . $username . "'";
$userpwdwhere = " where userpwd = '" . $userpwd . "'";

$uniquesessionkey = $_POST['uniquekey'];

$sql = "SELECT * from userlist  " . $userpwdwhere . $usernamewhere;

$responsejson = "";
$logactivity = "";

if(sql_command_check3($username) === true)
{
    $responsejson = "{\"loginstatus\": \"Restricted SQL Attempt failure\"}";
	$logactivity = "Restricted SQL Attempt failure";
}
else if(sql_command_check5($userpwd) === true)
{
    $responsejson = "{\"loginstatus\": \"Restricted SQL Attempt failure\"}";
	$logactivity = "Restricted SQL Attempt failure";
}
else if((comment_check($username) ===true) || (comment_check($userpwd)===true))
{
	$responsejson = "{\"loginstatus\": \"Restricted SQL Attempt failure\"}";
	$logactivity = "Restricted SQL Comment Attempt failure";
}
else
{

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $responsejson = "{\"loginstatus\" : \"Success\" ";
        while($row = $result->fetch_assoc()) {
            $responsejson  .= ",\"userlogin\" : \"" . $row["userlogin"] . "\"";
            $responsejson  .= ",\"userid\" : \"" . $row["userid"] . "\"";
            $responsejson  .= ",\"username\" : \"" . $row["username"] . "\"";
            $responsejson  .= ",\"userpwd\" : \"" . $row["userpwd"] . "\"";
            $responsejson  .= ",\"aadharnumber\" : \"" . $row["aadharnumber"] . "\"";
            $responsejson  .= ",\"pannumber\" : \"" . $row["pannumber"] . "\"";
            $responsejson  .= ",\"age\" : \"" . $row["age"] . "\"";
            $responsejson  .= ",\"uniquesessionkey\" : \"" . $uniquesessionkey . "\"";
            $responsejson  .= ",\"favoriteanimal\" : \"" . $row["favoriteanimal"] . "\"";        
        }
        $responsejson .= "}";
		$logactivity = "Succesful query";
    } else {
        $responsejson = "{\"loginstatus\": \"Incorrect Username or Password Attempt Failure\"}";
		$logactivity = "Incorrect Username or Password";
    }
    
}

$data = array(
'sessionid' => $_SESSION['uniquekey'],
'date' => date("Y-m-d"),
'problemid' => 7,
'problemname' => 'SQL Login forms',
'problemstatus' => $logactivity
);
// curl_logactivity($data);
// $_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$logactivity." "."SQL Login forms";
echo $responsejson;

$conn->close();



?>