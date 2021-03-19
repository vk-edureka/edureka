<?php
	session_start();
	ob_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./index.php"); 
		die();
	}
	setcookie($cookie_name1, $cookie_value1	, time() + (10), "/");
	$problemid = "";
	$problemtitle = "";
	$problemdescription = "";
// create connection
	$conn = connectdb();

	$sql = "select * from problemtable where problemid=11";
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


<!--		
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
-->

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
						<center><p style="text-align: center;"><?php echo $problemdescription; ?></p></center>
					</div>
					<br><br>
					<div class="row">
						<div class="col-md-12" style="align:center;text-align:center;">
							<br><br><br><br><br><br><br><br><br><br>
							<h3 class="text-primary" style="text-align:center">Enter Answer</h3>
							<p>Enter Cookie name and value separated by = (like abc=def) without any semicolon, comma etc. Enter your answer other than PHPSESSID</p>
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
									setcookie($cookie_name1, ""	, time() -3600, "/");
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-9" style="border-left: 1px solid black;background-color: #FFFFFF; height: 100%">
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
									<h3 class="card-title">	Please provide your feedback </h3>
									<br><br>
									<div class="row card-text">
										<form method="post">
											<div class="row">
												<input type="text" name="username" id="username" placeholder="Your Username" required="required" size="30px" style="border-radius: 5px;">
											</div>
											<br/>
											<div class="row">
												<textarea rows="5" cols="30" name="comments" id="comments" placeholder="Your Feedback" style="border-radius: 5px;" required="required"></textarea>
											</div>
											<br><br>
											<div class="row" style="text-align: center;">
												<input type="submit" class="btn-upper btn btn-primary checkout-page-button" value="submit">												
											</div>
											<br><br>
										</form>
									</div>
									<div class="row">
										<form  method="post">
											<input type="submit" class="btn-upper btn btn-primary checkout-page-button" name="deletedb" value="Clear Database" />
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-10">
							<?php
								if(isset($_POST['username']) && isset($_POST['comments']))
								{
									$conn = connectdb();
									
									$username = sanitize_string_encode($_POST['username']);
									$comments = $_POST['comments'];
									
									$objectiveresult="";
									
									if(check_img_tag($comments) === false)
									{
										$comments = sanitize_string($comments);
									}
									if (check_alert_word($comments) === true)
									{
										$comments = replace_alert_word($comments);
									}

									$sql = "insert into usercomments(commentdate,username,usercomments,subject) values(now(), '" . $username . "','" . $comments . "','CSS')";
									//echo $sql;
									
									if ( $username === false ) 
									{
										$objectiveresult = "Invalid Username";
									}
									else if((sql_command_check3($username)===true) || (sql_command_check3($comments)===true))
									{
										$objectiveresult = "Restricted SQL Attempt failure";
									}
									else
									{		
										if ($username == '' && $comments == '')
										{
											$objectiveresult = "username and comments are missing";
										}
										else if($username == '')
										{
											$objectiveresult = "username is missing";
										}
										else if ($comments == '')
										{
											$objectiveresult = "comments are missing";
										}
										else
										{
											$result = $conn->query($sql);
											if(!$result)
											{
												die("Error: " . $conn->error . "<br />");
											}
											else
											{
												$objectiveresult = "Database created successfully";
											}
											$showresult = $conn->query("select * from usercomments");
											if ($showresult->num_rows > 0) {
												echo "<table border='1' class=table style=text-align:center;><thead class=thead-dark><tr><th> Username </th><th> Comments </th><th> DATE </th><th> Subject </th></tr></thead>";
												while($row = $showresult->fetch_assoc()) {
													echo "<tr>";
													echo "<td>" . $row["username"] . "</td>";
													echo "<td>" . $row["usercomments"] . "</td>";
													echo "<td>" . $row["commentdate"] . "</td>";
													echo "<td>" . $row["subject"] . "</td>";
													echo "</tr>";
												}
												echo "</table>";
											}
										}
									}
									echo $objectiveresult;
									$data = array(
									'sessionid' => $_SESSION['uniquekey'],
									'date' => date("Y-m-d"),
									'problemid' => $problemid,
									'problemname' => 'css(stored)',
									'problemstatus' => $objectiveresult
									);
									curl_logactivity($data);
									$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."css(stored)";
									$conn->close();
								}
								if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['deletedb']))
								{
									$conn = connectdb();
									$conn->query("delete from usercomments where 1=1");
									$conn->close();
								}
								//setcookie($cookie_name1, ""	, time() -3600, "/");
							?>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</body>
</html>