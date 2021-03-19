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

	$sql = "select * from problemtable where problemid=23";
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
		<title>Hack Me - XML Search(Get)</title>
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
										<li><a href="searchget.php"><i class="icon fa fa-futbol-o"></i>Ball Store</a></li>	
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row main-header">
						<div class="col-md-12">
							<h2 style="text-align: center;">WELCOME TO THE MOVIE STORE</h2>
						</div>
					</div>					
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
							<div class="side-menu animate-dropdown outer-bottom-xs">
								<div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
								<nav class="yamm megamenu-horizontal" role="navigation">
									<ul class="nav">
										<li class="dropdown menu-item">
											<a href="xml_search.php?genre=romantic" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>Romantic</a>
										</li>
										<li class="dropdown menu-item">
											<a href="xml_search.php?genre=horror" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>Horror</a>
										</li>
										<li class="dropdown menu-item">
											<a href="xml_search.php?genre=epic" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>Epic</a>
										</li>
										<li class="dropdown menu-item">
											<a href="xml_search.php?genre=action" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>Action</a>
										</li>
										<li class="dropdown menu-item">
											<a href="xml_search.php?genre=thriller" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>Thriller</a>
										</li>
										<li class="dropdown menu-item">
											<a href="xml_search.php?genre=drama" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>Drama</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
						<div class="col-md-9">
							<?php
								$logactivity = "";
								$genre = "";
								if (isset($_GET['genre']))
								{
									$genre = $_GET['genre'];
								}
									
								$xmlfile = simplexml_load_file("bollywood.xml");
								//print_r($xmlfile);
								$result = $xmlfile->xpath("//star[contains(genre, '$genre')]/movie");
								//print_r($result);

								if($result)
								{

									$objectiveresult = "Movie found";
									?>
									<div class="search-result-container">
										<div class="tab-content">
											<div class="category-product">										
												<h3 class="section-title">Movies</h3>
												<div class="row" style="padding: 5px; text-align: ;">
									<?php										
									foreach($result as $key => $row)       
									{
										$key = $key+1;
										?>												
											<div class="col-md-4 item" style="text-align: center;">
												<div class="products" style="width: 175;text-align: center;border: 1px solid black; border-radius: 25px;">
													<div class="product" style="border: 0px solid black; border-radius: 20px; text-align: center;background: #00000;">
														<div class="product-micro">
															<div class="row product-micro-row">
																<div class="col col-xs-6 col-md-12">
																	<div class="product-image">
																		<div class="image">
																			<a href="movie_posters/<?php echo ($row. ".jpeg");?>" data-lightbox="image-1" data-title="<?php echo ($row);?>">
																				<img data-echo="movie_posters/<?php echo ($row . ".jpeg");?>" width="170" height="174" alt="Image not found" onerror="this.onerror=null;this.src='movie_posters/imagena.png';" style="opacity: 0.5;border-radius: 20px;">
																			</a>					
																		</div><!-- /.image -->

																	</div><!-- /.product-image -->
																	<div style="text-align: center;">
																		<b><h3><?php echo $row?></h3></b>
																	</div>
																</div><!-- /.col -->																	
															</div><!-- /.product-micro-row -->
														</div><!-- /.product-micro -->
													</div>
												</div>
											</div>												
										<?php																						
									}
									?>
													</div>
												</div>
											</div>
										</div>
										
									<?php
							 
								}
								else
								{
									$objectiveresult = "Movie not found";
									echo "<table border='1' class=table style=text-align:center;><thead class=thead-dark><tr><th> No movies were found! </th></tr></thead></table>";
								}
								
								$data = array(
								'sessionid' => $_SESSION['uniquekey'],
								'date' => date("Y-m-d"),
								'problemid' => 23,
								'problemname' => 'xml_search',
								'problemstatus' => $objectiveresult
								);
								curl_logactivity($data);
								$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."xml_search";
								
							?>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</body>	

</html>