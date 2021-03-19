<?php
	include("function_check.php");
	function connectdb()
	{
		$dbServerName = "db";
		$dbUsername = "khalid";
		$dbPassword = "khalid123";
		$dbName = get_dbname();
		
		return new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);
	}
?>
