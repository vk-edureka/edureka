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

	$sql = "select * from problemtable where problemid=9";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$problemid = $row["problemid"];
			$problemtitle = $row["problemtitle"];
			$problemdescription = $row["problemdescription"];    
		}
	}
	$conn->close();
	
	$framesrc = "";
	$framewidth = "";
	$frameheight = "";
	if ($_GET)
	{
		$framesrc = $_GET['framesrc'];
		$framewidth = $_GET['framewidth'];
		$frameheight = $_GET['frameheight'];
		
	}
?>
<html>
	<head>
		<title>Hack Me - Select(Get) Injection</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
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
		<script type="text/javascript" src="./js/links.js"></script>
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
				</div>
				<div class="col-md-9" style="border-left: 1px solid black;">
					<div class="row top-bar">
						<div class="container">
							<div class="header-top-inner">
								<div class="cnt-account">
									<ul class="list-unstyled list-inline">
										<li><a href="searchget.php"><i class="icon fa fa-futbol-o"></i>Ball Store</a></li>
										<li><a href="logininjection.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
										<li><a href="htmlinjection_reflected.php"><i class="icon fa fa-truck"></i>Order Tracking</a></li>
										<li><a href="xml_search.php"><i class="icon fa fa-film"></i>Movie Store</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="text-align: center;background-color: #ffffff;">
							<div class="row">
								<br>
								<div class="col-md-2"></div>
								<div class="col-md-6">
									<div class="card" style="background-color: #d3d3d3; border-radius: 20px;">
										<br>
										<div class="card-body">
											<br><br>
											<b>Enter Your Comments</b>
											<br/>
											<div class="row card-text">
												<form method="post" target="child_frame" action="good.php">
													<div class="row">
														<textarea rows="6" cols="50" name="userinput" id="userinput" placeholder="Your comments" required="required" style="border-radius: 5px;"></textarea>
													</div>
													<div>
														<input type="hidden" name="framesrc" id="framesrc" value="<?php echo $framesrc; ?>">
													</div>
													<div class="row">
														<input id="frameheight" name="frameheight" type="hidden" value="250">
													</div>
													<div class="row">
														<input id="framewidth" name="framewidth" type="hidden" value="400">
													</div>
													<br><br>
													<div class="row" style="text-align: center;">
														<input type="submit" class="btn-upper btn btn-primary checkout-page-button" value="submit">												
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br><br>
							<div class="row">								
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-6">
										<div class="card" style="background-color: #d3d3d3; border-radius: 20px;">
											<h3 style="text-align:center"><br>RESULT</h3>
											<iframe name="child_frame" frameborder="0" src="<?php echo $framesrc; ?>" height="<?php echo $frameheight; ?>" width="<?php echo $framewidth ?>" ></iframe>
										</div>
									</div>
								</div>
							</div>
							<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>	

</html>