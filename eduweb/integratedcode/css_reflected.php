<?php
	session_start();
	ob_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./index.php"); 
		die();
	}
	setcookie($cookie_name2, $cookie_value2	, time() + (10), "/");
	$problemid = "";
	$problemtitle = "";
	$problemdescription = "";
	

// create connection
	$conn = connectdb();

	$sql = "select * from problemtable where problemid=12";
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
		<title>Hack Me  - SQL Injection STORED</title>
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
					<div class="row">
						<div class="col-md-12" style="align:center;text-align:center;">
							<br><br><br><br><br><br><br><br><br><br>
							<h3 class="text-primary" style="text-align:center">Enter Answer</h3>
							<p>Enter Cookie name and value separated by =(like abc=def) without any semicolon, comma etc. Enter your answer other than PHPSESSID</p>
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
									setcookie($cookie_name2, ""	, time() -3600,"/");
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-9" style="border-left: 1px solid black;background-color: #ffffff; height: 100%">
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
					<br><br><br>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-6" style="text-align: center;">
							<div class="card" style="background-color: #d3d3d3; border-radius: 20px;">
								<br><br>
								<div class="card-body">
									<h3 class="card-title">	Please select the issue that you faced </h3>
									<br><br>
									<div class="row card-text">
										<form method="post">
											<div class="row">
												<input type="text" name="username" id="username" placeholder="Your Username" required="required" size="30px" style="border-radius: 5px;">
											</div>
											<br/>
											<div class="row">
												<select name="searchterm" id="searchterm" required="required">
													<option value="" selected disabled hidden>Choose Issue Category here</option>
													<option value="Basketballs">Payment Issue</option>
													<option value="Volleyballs">People Issue</option>
													<option value="Footballs">Product Issue</option>
													<option value="Foods">All of the above</option>
												</select>
											</div>
											<br><br>
											<div class="row" style="text-align: center;">
												<input type="submit" class="btn-upper btn btn-primary checkout-page-button" value="submit">												
											</div>
											<br><br>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<?php
								if(isset($_POST['username']))
								{
									$username = $_POST['username'];
									for ($x = 0; $x <= 1; $x++) {
										$username = replace_script_tag($username);
									}
									
									$objectiveresult="";
									if ( $username == '' ) 
									{
										$objectiveresult = "Invalid Username";
										echo $objectiveresult;
									}
									else
									{
										echo "Welcome ".$username;
										$objectiveresult = "success";
									}
									
									$data = array(
									'sessionid' => $_SESSION['uniquekey'],
									'date' => date("Y-m-d"),
									'problemid' => $problemid,
									'problemname' => 'css(reflected)',
									'problemstatus' => $objectiveresult
									);
									curl_logactivity($data);
									$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."css(reflected)";
								}
								//setcookie($cookie_name2, ""	, time() -3600);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</body>
</html>