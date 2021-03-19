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
	//ob_start();
	$conn = connectdb();

	$sql = "select * from problemtable where problemid=22";
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
		<title>Hack Me -  BROKEN AUTHENTICATION Forgot Password</title>
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
		
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 body-content cnt-home">
					<div class="row top-bar">
						<div class="container">
							<div class="header-top-inner">
								<div class="cnt-account">
									<ul class="list-unstyled list-inline">
										<li><a><i class="icon fa fa-user"></i>Feedback</a></li>
										<li><i class="icon fa fa-sign-in"></i><b>Login</b></a></li>
										<li class="dropdown dropdown-small"><span class="key">Track Order</b></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<br><br><br>
					<br><br><br>
					<div class="row sign-in-page">
						<div class="col-md-2"></div>
						<div class="col-md-6 col-sm-6 sign-in">
							<h4 class="">Reset Password</h4>
							<p class="">please reset password of your account.</p>
							<form class="register-form" method="post" onsubmit="return TryToLogin()">
								<div class="row" style="padding: 30px;">						
									<div class="form-group" style="align: center;">
										<div class="row">
											<label class="info-title" for="exampleInputEmail1">Select Username <span>*</span></label>
											<input type="text" class="form-control unicase-form-control text-input" name="userlogin" id="userlogin" value="Sam" readonly />
										</div>
										<div class="row">
											<br>
										</div>
										<div class="row">						 										
											<label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
											<input type="text" class="form-control unicase-form-control text-input" name="userpwd" id="userpwd"/>
										</div>
									</div>
								</div>
								<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">RESET</button>
							</form>
						</div>			
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-8">
							<?php
								if(isset($_POST['userlogin']) && isset($_POST['userpwd']))
								{
									$conn = connectdb();
									$objectiveresult="";
									$x =0;
									$username = sanitize_string_encode($_POST['userlogin']);
									$userpwd = check_sql_2($_POST['userpwd']);
									if ($username =='' || $username ===false || $userpwd=='')
									{
										$objectiveresult = "Invalid username or password";
									}
									else
									{
										$sql = "update usermaptable set password = '". $userpwd ."' where username = '". $username ."'";
										$result1 = $conn->query($sql);
										$objectiveresult = "password successfully changed for ".$username;
										$result2 = $conn->query("select * from usermaptable");
										if ($result2->num_rows > 0) {
											while($row = $result2->fetch_assoc()) {
												if ($row["username"] == 'Mark' && $row["password"] != 'Markel')
												{
													$x =$x+1;
												}
												if ($row["username"] == 'Jeff' && $row["password"] != 'Jeffery')
												{
													$x =$x+1;
												}
												if ($row["username"] == 'Hari' && $row["password"] != 'Harihar')
												{
													$x =$x+1;
												}
												if ($row["username"] == 'Tony' && $row["password"] != 'Tommy')
												{
													$x =$x+1;
												}
												if ($row["username"] == 'Stark' && $row["password"] != 'Ironman')
												{
													$x =$x+1;
												}
												if ($row["username"] == 'Tanya' && $row["password"] != 'Goyanka')
												{
													$x =$x+1;
												}
												if ($row["username"] == 'Alice' && $row["password"] != 'Bobby')
												{
													$x =$x+1;
												}
											}
										}
									}
									
									echo $objectiveresult."<br>";
									
									$data = array(
									'sessionid' => $_SESSION['uniquekey'],
									'date' => date("Y-m-d"),
									'problemid' => 16,
									'problemname' => 'ba_Forgotpassword',
									'problemstatus' => $objectiveresult
									);
									curl_logactivity($data);
									$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."ba_Forgotpassword";
									if($x >= 2)
									{
										echo "<font color=green>Your attempt is successful. Your answer has been recorded. Move to next question</font>";
										$data = array(
											'problemid' => 16,
											'username' => $_SESSION["username"],
											'answer' => "2passwordchanged",
											'log' => $_SESSION["logactivity"],
											'sessionid' => $_SESSION['uniquekey'],
											'date' => date("Y-m-d")
										);
										curl_answer($data);
									}
									echo "<a class="."btn btn-primary"." href="."ba_forgotpassword.php"." role="."button".">Click here after reset password is complete</a>";
								
									//sleep(10);
									//header("Location: ba_forgotpassword.php");
								}
							?>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>