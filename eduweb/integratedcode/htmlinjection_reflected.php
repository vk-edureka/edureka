<?php
	session_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./index.php"); 
		die();
	}
	$problemid = "";
	$problemtitle = "";
	$problemdescription = "";
	

// create connection
	$conn = connectdb();

	$sql = "select * from problemtable where problemid=20";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$problemid = $row["problemid"];
			$problemtitle = $row["problemtitle"];
			$problemdescription = $row["problemdescription"];    
		}
	}
	$conn->close();	
?>
<html>
	<head>
		<title>Hack Me  - HTML INJECTION - REFLECTED</title>
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
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">		
	</head>

	<body>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3" style="padding-left: 10px;height: 100%;border-right: 1px solid black;">
					<div class="row">
						<a href="./" style="background-color: #f1f1f1; color: black;display: inline-block; padding: 8px 8px; border-radius: 5px;">&laquo; Go Back To Problem Set</a>
					</div>
					<div class="row" style="text-align: center;">
						<br><br><br><br>
						<h3 class="text-primary" style="text-align: center"><?php echo $problemid.".  ".$problemtitle."</br>"; ?></h3>
						<p style="text-align: center;"><?php echo $problemdescription; ?></p>
					</div>
					<br><br>
					<div class="row" style="text-align: center;">
						<br><br><br><br><br><br><br><br><br><br>
						<h3 class="text-primary" style="text-align:center">Enter your answer here</h3>
						<form method="post" style="align:center">
							<textarea placeholder="Enter the html code that you entered in the destination text box to reach the destination" rows="5" cols="30" name="answer" id="answer"></textarea>
							<br><br>
							<input type="submit" class="btn-upper btn btn-primary checkout-page-button" value="submit">
						</form>
						<?php
							if(isset($_POST['answer']))
							{
								$answer = $_POST['answer'];
								if(check_href_tag($answer) === true)
								{
									$answer ="hrefused";
								}
								else
								{
									$answer = "hrefnotused";
								}
								$data = array(
									'problemid' => $problemid,
									'username' => $_SESSION["username"],
									'answer' => $answer,
									'log' => $_SESSION["logactivity"],
									'sessionid' => $_SESSION['uniquekey'],
									'date' => date("Y-m-d")
								);
								curl_answer($data);
							}
						?>
					</div>
				</div>	
				<div class="col-md-9" style="border-left: 1px solid black;background-color: #E5E5E5; height: 100%">
					<div class="row top-bar">
						<div class="container">
							<div class="header-top-inner">
								<div class="cnt-account">
									<ul class="list-unstyled list-inline">
										<li><a href="blindinjection_stored.php"><i class="icon fa fa-user"></i>Feedback</a></li>
										<li><a href="logininjection.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
										<li><a href="searchget.php"><i class="icon fa fa-futbol-o"></i>Ball Store</a></li>
										<li><a href="xml_search.php"><i class="icon fa fa-film"></i>Movie Store</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<br><br><br>
					<div style="background-color: #FFFFFF;margin: -14px;"><h2 style="text-align:center"><br><i class="fa fa-globe fa-6" aria-hidden="true"></i> WELCOME TO EDUREKA TOURS AND TRAVELS <br><br></h2></div>
					<br><br>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-9">
							<div class="card" style="background-color: #FFFFFF; border-radius: 20px;">
								<br><br>
								<div class="card-body" style="text-align: center;">
									<h3 class="card-title">	Where would you like to go? </h3>
									<br>
									<div class="row card-text">
										<form method="post">
											<textarea type="text" rows="5" cols="40"  name="username" id="username" placeholder="Enter the destination where you want to go" required="required" size="30px" style="border-radius: 5px;"></textarea>
											
											<br><br>
											<div class="row" style="text-align: center;">
												<input type="submit" class="btn-upper btn btn-primary checkout-page-button" value="Let's GO">												
											</div>
											<br><br>
										</form>
									</div>
								</div>
							</div>
							<br>
							<div class="row" style="text-align: center; border: 1px solid black;">
								<h3>Reach your destination from here</h3>												
								<?php
									if(isset($_POST['username']))
									{
										$username = $_POST['username'];
										
										$objectiveresult="";
										if(check_form_tag($username) === true)
										{
											$objectiveresult = "Restricted Text";
											$username = sanitize_string($username);
											echo $objectiveresult;
										}
										else if ( $username == '' ) 
										{
											$objectiveresult = "Invalid Text";
											echo $objectiveresult;
										}
										else
										{
											echo "HEY, Your destination is: ".$username;
											$objectiveresult = "success";
										}
										
										$data = array(
										'sessionid' => $_SESSION['uniquekey'],
										'date' => date("Y-m-d"),
										'problemid' => $problemid,
										'problemname' => 'HtmlInjection(reflected)',
										'problemstatus' => $objectiveresult
										);
										curl_logactivity($data);
										$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."HtmlInjection(reflected)";
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</body>
</html>