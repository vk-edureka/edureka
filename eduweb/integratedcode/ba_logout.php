<?php
	session_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./index.php"); 
		die();
	}
	if (!isset($_SESSION["login"]) || empty($_SESSION["login"]) || !isset($_SESSION["ba_ll_token"]) || empty($_SESSION["ba_ll_token"]))
	{
		header("Location: ba_logout_login.php");
		die();
	}
	if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
	{
		$ref = $_SERVER['HTTP_REFERER'];
		if (strpos($ref, 'ba_logout_login.php') !== false)
		{
			$_SESSION["attempt"]=$_SESSION["attempt"] + 1;
		}
		if ($_SESSION["attempt"] >= 2 )
		{
			header("Location: ./ba_logout_login.php"); 
			die();
		}
	}
?>
<html>
	<head>
		<title>Hack Me -  BROKEN AUTHENTICATION Logout Management</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<script src="assets/js/jquery-1.11.1.min.js"></script>
		
		<script src="assets/js/bootstrap.min.js"></script>
		
		<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>
		
		<script src="assets/js/echo.min.js"></script>
		<script src="assets/js/jquery.easing-1.3.min.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script>
	    <script src="assets/js/jquery.rateit.min.js"></script>
	    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
	    <script src="assets/js/bootstrap-select.min.js"></script>




	    <script src="assets/js/wow.min.js"></script>
		<script src="assets/js/scripts.js"></script>


		
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">


	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="./js/links.js"></script>
	</head>

	<body>
		<br><br><br>
		<h3 class="text-primary" style="text-align:center;"><?php echo "WELCOME ".$_SESSION["login"]; ?></h3>
		<h4 class="text-success" style="text-align:center">Click <a href="ba_logout_login.php" onclick="return confirm('Are you sure you want to Logout?');">here</a> to logout.</h4>
		<script>
			var x = document.referrer;
			var loginstatus = "";
			if (x.indexOf(logouturl) !== -1 || x.indexOf("ba_logout_login.php") !== -1)
			{
				loginstatus = "Not Successful Attempt";
			}
			else
			{
				loginstatus = "Successful Attempt";
			}
			if(loginstatus == "Successful Attempt")
			{
				alert("Successful Attempt, your answer has been recorded. please move to next question or attempt");
			}
			var params = {
			log:loginstatus
			};
			var fd = new FormData();

			for(var i in params){
			fd.append(i,params[i]);
			}

			fetch(logoutbackend, {
				method: "POST",
				body: fd
			})
		</script>
	</body>
</html>