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

	$sql = "select * from problemtable where problemid=5";
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
					<br><br>
					<div class="row">
						<div class="col-md-12" style="align:center;text-align:center;">
							<br><br><br><br><br><br><br><br><br><br>
							<h3 class="text-primary" style="text-align:center">Enter Answer</h3>
							<form method="post">
								<input type="text" placeholder="Enter Your Answer Here" name="answer" id="answer" size="40" style="line-height: 20px;" />
								<br><br>
								<input type="submit" class="btn-upper btn btn-primary checkout-page-button" value="submit">
							</form>
							<?php
								if(isset($_POST['answer']))
								{
									$answer = $_POST['answer'];
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
				</div>
				<div class="col-md-9" style="border-left: 1px solid black;">
					<div class="row top-bar">
						<div class="container">
							<div class="header-top-inner">
								<div class="cnt-account">
									<ul class="list-unstyled list-inline">
										<li><a href="blindinjection_stored.php"><i class="icon fa fa-user"></i>Feedback</a></li>
										<li><a href="logininjection.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
										<li><a href="htmlinjection_reflected.php"><i class="icon fa fa-truck"></i>Order Tracking</a></li>
										<li><a href="xml_search.php"><i class="icon fa fa-film"></i>Movie Store</a></li>	
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row main-header">
						<div class="col-md-3">
							<h2 style="text-align: left;">Product Checker</h2>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 top-search-holder">
							<br><br>								
							<div class="search-area">
								<div class="control-group">
									<form method="get">
										<input class="search-field" placeholder="Search to check whether the product exists like Basketballs..." name="searchterm" id="searchterm" style="height:10px;font-size:10pt;"/>
										<button class="search-button" type="submit" name="search"></button> 
									</form>
								</div>
							</div>
						</div>	
						<br><br>					
					</div>
					<div class="row">
						<div class="col-md-3 sidebar">
							<div class="side-menu animate-dropdown outer-bottom-xs">
								<div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
								<nav class="yamm megamenu-horizontal" role="navigation">
									<ul class="nav">
										<li class="dropdown menu-item">
											<a href="blindinjection.php?searchterm=Footballs" class="dropdown-toggle"><i class="icon fa fa-futbol-o fa-fw"></i>Footballs</a>
											
										</li>
										<li class="dropdown menu-item">
											<a href="blindinjection.php?searchterm=Volleyballs" class="dropdown-toggle"><i class="icon fa fa-futbol-o fa-fw"></i>Volleyballs</a>
										</li>
										<li class="dropdown menu-item">
											<a href="blindinjection.php?searchterm=Basketballs" class="dropdown-toggle"><i class="icon fa fa-futbol-o fa-fw"></i>Basketballs</a>
										</li>
										<li class="dropdown menu-item">
											<a href="blindinjection.php?searchterm=Foods" class="dropdown-toggle"><i class="icon fa fa-futbol-o fa-fw"></i>Foods</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
						<div class="col-md-2"></div>
						<div class="col-md-7">
							<br/>
							<?php
								if (isset($_GET['searchterm']))
								{
									$conn = connectdb();

									$basesql = "select * from itemtypes ";

									$whereclause = " where 1=1";

									$itemtype = sanitize_string($_GET['searchterm']);

									if($itemtype == '')
									{

									}
									else
									{
										$whereclause .= " and itemtype like '" . $itemtype . "'";
									}
									$sql = $basesql . $whereclause;

									$objectiveresult = "";
									if(sql_command_check2($itemtype) === true)
									{
										$objectiveresult =  "Restricted SQL command injection";
									}
									else if(restricted_command_check($itemtype) === true)
									{
										$objectiveresult =  "Restricted item list";
									}
									else
									{
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											$objectiveresult =  "The Ball exists in the the database";
										}
										else {
											$objectiveresult =  "The Ball does not exist in the the database";
										}
									}

									echo $objectiveresult;
									$data = array(
									'sessionid' => $_SESSION['uniquekey'],
									'date' => date("Y-m-d"),
									'problemid' => $problemid,
									'problemname' => 'blindinjection(boolean)',
									'problemstatus' => $objectiveresult
									);
									curl_logactivity($data);
									$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."blindinjection(boolean)";
									$conn->close();
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>