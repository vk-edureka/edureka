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
	ob_start();
	$conn = connectdb();

	$sql = "select * from problemtable where problemid=24";
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
		<title>Hack Me - Login SQL Injection</title>
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
		<script type="text/javascript" src="./js/adm.js"></script>
		<script type="text/javascript" src="./js/links.js"></script>
	</head>

	<body>
		<script type="text/javascript">
			function TryToLogin() {
				document.getElementById("userdetailsdiv").innerHTML = "";
				var userid = 0;
				var username = document.getElementById("userlogin").value;
				var userpwd = document.getElementById("userpwd").value;
				if (username =='' || userpwd =='')
				{
					alert("Empty username or password");
					return false;
				}
				if ((username == admins) && (userpwd == adminspwd))
				{
					alert("you are already admin. try with other login credentials");
					userid = 1;
					return false;
				}
				var params = {
					uid: userid,
					uname:username
				};
				var fd = new FormData();

				for(var i in params){
				   fd.append(i,params[i]);
				}
				const sleep = (milliseconds) => {
				  return new Promise(resolve => setTimeout(resolve, milliseconds))
				}

				fetch(serverurl, {
						method: "POST",
						body: fd
					}).then(function (response) {
						return response.json();
					}).then(function (response) {
						if(response.loginstatus !== 'Success')
						{
							var userdetails = "<font color=red>login sucessful, welcome to this page "+ username+" but you are not a admin </font>";
							document.getElementById("userdetailsdiv").innerHTML = userdetails;
							sleep(7000).then(() => {
							  window.location.href = "./userpage.php";
							  return false;
							})	
						}
						else
						{
							var userdetails = "<font color=green>login sucessful, welcome  admin ("+ username +") your answer has been recorded successfully. Move to next Question or Attempt</font>";
							document.getElementById("userdetailsdiv").innerHTML = userdetails;
							sleep(7000).then(() => {
							  window.location.href = "./adminpage.php";
							  return false;
							})
						}
					}).catch(function (response) {
						window.alert("Failed Login detected and reported.");
						document.write(response);
					});
				
				return false;		

			}	
		</script>
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
				</div>
				<div class="col-md-9 body-content cnt-home" style="border-left: 1px solid black;">
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
					<br><br><br>
					<div class="row sign-in-page">
						<div class="col-md-2"></div>
						<div class="col-md-6 col-sm-6 sign-in">
							<h4 class="">sign in</h4>
							<p class="">Hello, please login to your account.</p>
							<form class="register-form" method="post" onsubmit="return TryToLogin()">
								<div class="row" style="padding: 30px;">						
									<div class="form-group" style="align: center;">
										<div class="row">
											<label class="info-title" for="exampleInputEmail1">Username <span>*</span></label>
											<input type="text" class="form-control unicase-form-control text-input" name="userlogin" id="userlogin"/>
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
								<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Login</button>
							</form>		
						</div>			
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-5" id="userdetailsdiv">
							
						</div>
						<div class="col-md-3">
						<?php
							/*if(isset($_POST["userdetailsdiv"]) && !empty($_POST["userdetailsdiv"]))
							{
								if(strpos($_POST["userdetailsdiv"],"welcome  admin") !== false)
								{
									header("Location: adminpage.php");
								}
								else{
									header("Location: userpage.php");
								}
							}
							if(isset($_POST["userdetailsdiv"]))
							{
								$dochtml = new DOMDocument();
								$dochtml->loadHTML($strhtml);

								// get the element with id="userdetailsdiv"
								$elm = $dochtml->getElementById('userdetailsdiv');

								// get the tag name, and content
								$tag = $elm->tagName;
								$cnt = $elm->nodeValue;
								
								if(strpos($_POST["userdetailsdiv"],"welcome  admin") !== false)
								{
									header("Location: adminpage.php");
								}
								else{
									header("Location: userpage.php");
								}
							}*/
						?>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</body>

</html>