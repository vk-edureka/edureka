<?php
	session_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey']) && !isset($_SESSION["username"]) ) {
	   header("Location: ./index.php"); 
		die();
	}

?>
<html>
	<head>
		<title>Hack Me -  BROKEN AUTHENTICATION SESSION MANAGEMENT ADMIN</title>
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
				<div class="col-md-2"></div>
				<div class="col-md-8 body-content cnt-home">
					<div class="row top-bar">
						<div class="container">
							<div class="header-top-inner">
								<div class="cnt-account">
									<ul class="list-unstyled list-inline">
										<li><a><i class="icon fa fa-edit"></i>Feedback</a></li>
										<li><i class="icon fa fa-user"></i> Not Admin</li>
										<li><a href="smngmnt_admin.php"><i class="icon fa fa-sign-in"></i>Logout</a></li>
										<li><font color="green"><h3>Welcome <?php echo $_SESSION["userasadmin"]; ?></h3></font></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<br><br><br>
					<br><br><br>
					<div class="row sign-in-page">
						<div class="col-md-2"></div>
						<div class="col-md-8 col-sm-8 sign-in">
							<h4 style="text-align:center;">WELCOME BACK USER</h4>
							<p style="text-align:center;">Let's work. Have a nice day </p>
						</div>			
					</div>
					<br><br>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-8">
							<?php
							?>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<form method="post">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:2px;">
							<center><img src="<?php echo "product_images/e4.jpg";?>" alt="centered image" width="300" /></center>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form method="post">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:2px;">
							<center><img src="<?php echo "product_images/e5.jpg";?>" alt="centered image" width="300" /></center>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form method="post">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:2px;">
							<center><img src="<?php echo "product_images/e6.jpg";?>" alt="centered image" width="300" /></center>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form method="post">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:2px;">
							<center><img src="<?php echo "product_images/e10.jpg";?>" alt="centered image" width="300" /></center>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form method="post">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:2px;">
							<center><img src="<?php echo "product_images/e11.jpg";?>" alt="centered image" width="300" /></center>
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form method="post">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:2px;">
							<center><img src="<?php echo "product_images/e12.jpg";?>" alt="centered image" width="300" /></center>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>