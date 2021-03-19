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

	$sql = "select * from problemtable where problemid=4";
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
						<div class="col-md-12">
							<h2 style="text-align: center;">WELCOME TO BALL STORE</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
							<div class="side-menu animate-dropdown outer-bottom-xs">
								<form method="post">
									<select name="searchterm" id="searchterm">
										<option value="">Select/Clear Categories</option>
										<option value="Basketballs">Basketballs</option>
										<option value="Volleyballs">Volleyballs</option>
										<option value="Footballs">Footballs</option>
										<option value="Foods">Foods</option>
									</select>
									<input type="submit" value="Go">
								</form>
							</div>
						</div>					
						<div class="col-md-9">
							<?php
								$logactivity = "";
								$itemtype = "";
								if (isset($_POST['searchterm']))
								{
									$itemtype = sanitize_string($_POST['searchterm']);
								}

								$conn = connectdb();

								$basesql = "select il.itemname, it.itemtype, cc.cost,il.itemcode  from itemlist il join itemtypes it on il.itemtypecode = it.itemtypecode join itemcosts ic on il.itemcode = ic.itemcode join costcodes cc on ic.costcodeid = cc.costcodeid ";

								$whereclause = " where 1=1";

								
								$minprice = 0;
								$ascdesc = "DESC";
								
								$limitsql = " order by cc.cost ". $ascdesc . " limit 20";

								if($itemtype == '')
								{

								}
								else
								{
									$whereclause .= " and it.itemtype = '" . $itemtype . "'";
								}

								if($minprice == '')
								{

								}
								else
								{
									$whereclause .= " and cc.cost >= '" . $minprice . "'";
								}
								
								

								$sql = $basesql . $whereclause . $limitsql;

								$objectiveresult = "";
								if(sql_command_check($itemtype) ===true)
								{
									$objectiveresult =  "Restricted sql commands";
								}
								else
								{
									$itemtypecode =$conn->query("select itemtypecode from itemtypes where itemtype = '" . $itemtype ."'");
									$result = $conn->query($sql);
									$objectiveresult = "succesful query.";

									if($itemtypecode == '3')
									{
										$objectiveresult .= " Found the correct item type.";
									}

									if ($result->num_rows > 0) {
										?>
										<div class="search-result-container">
											<div class="tab-content">
												<div class="category-product">										
													<h3 class="section-title">Products</h3>
													<div class="row">
										<?php
										while($row = $result->fetch_assoc()) {
											?>
											<div class="col-md-4 item">
												<div class="products" style="width: 170;">
													<div class="product" style="border: 0px solid black; border-radius: 20px; text-align: center;align: center; background: #808080;">
														<div class="product-micro">
															<div class="row product-micro-row">
																<div class="col col-xs-12 col-md-12">
																	<div class="product-image">
																		<div class="image">
																			<a href="product_images/<?php echo ($row['itemtype'] . "-" . $row['itemcode']%4 . ".jpeg");?>" data-lightbox="image-1" data-title="<?php echo ($row['itemname']);?>">
																				<img data-echo="product_images/<?php echo ($row['itemtype'] . "-" . $row['itemcode']%4 . ".jpeg");?>" width="170" height="174" alt="" style="opacity: 0.8;">
																			</a>					
																		</div><!-- /.image -->

																	</div><!-- /.product-image -->
																	<div class="product-info">
																		<h3 class="name"><?php echo $row['itemname']?>
																		<div class="product-price">
																			<span class="price">
																				Rs. <?php echo($row['cost']) ?>
																			</span>
																		</div>
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
									else {
										$objectiveresult .= " but no results found";
									}
								}

								echo $objectiveresult;
								
								$data = array(
								'sessionid' => $_SESSION['uniquekey'],
								'date' => date("Y-m-d"),
								'problemid' => $problemid,
								'problemname' => 'Select(post)',
								'problemstatus' => $objectiveresult
								);
								curl_logactivity($data);
								$_SESSION["logactivity"] = $_SESSION['uniquekey']." ".date("Y-m-d")." ".$objectiveresult." "."Select(post)";
								$conn->close();
								
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>	

</html>