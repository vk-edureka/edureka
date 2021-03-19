<?php
	session_start();
	include("dbconnect.php");
	$_SESSION["api_token"] = "edureka321";
	$_SESSION["uniquekey"] = "";
	$_SESSION["username"] = "";
	$_SESSION["logactivity"]="";
	$_SESSION["attempt"] = 0;
	$_SESSION["userasadmin"] = "";
	//$hostname = gethostname();
	$hostname = getenv("MYHOST");
	$username = getenv("username");
	if (empty($username)) {
		$username = posix_getpwuid(posix_geteuid())['name'];
	}
	if (empty($username)) {
		$username = get_current_user();
	}
	//$username = posix_getpwuid(posix_geteuid());
	//$username = get_current_user();
	$servername = $_SERVER['SERVER_NAME'];
	//$password = $_POST['password'];
	$data = array(
		'hostname' => $hostname,
		'username' => $username,
		'servername' => $servername,
		'token' => "edureka321"
	);
	$conn = connectdb();
	curl_login($data);
	$_SESSION["username"] = $username;
	$data1 = array(
		'username' => $_SESSION["username"],
		'token' => "edureka321"
	);
	$attemptstatus = curl_attemptstatus($data1);
	
	if ((isset($_SESSION["uniquekey"]) && !empty($_SESSION["uniquekey"])) && (isset($_SESSION["username"]) && !empty($_SESSION["username"])))
	{
?>
		<html>
			<head>
				<title>Hack Me  - MY SHOP</title>
				<link rel="icon" href="favicon.ico" type="image/x-icon" />
				<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
				<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
				<style>
				</style>
			</head>
			<body>
				<div class="row" width="100%"  style="text-align: center;background-color: #3333ff;">
					<br/>
					<div class="col-md-4">
						<h4 align="left" style="color: #FFFFFF">edureka!</h4>
					</div>
					<div class="col-md-4">
						<h1 style="color: #FFFFFF">HACK ME</h1>
					</div>
					<br/>
				</div>
				<br />
				<br />
				<div class="col-md-12">
					<div class="row">
						<?php
							$conn = connectdb();
							$sql = "select * from problemtable order by problemid ASC";
							$result = $conn->query($sql);							
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc())
								{
						?>
						<div class="col-md-4">
							<form method="<?php echo $row["problemmethod"]; ?>" action="<?php echo $row["problemlink"]; ?>">
								<div style="border:2px solid #f1f1f1; background-color:#FFFFFF; box-shadow: 1px 3px #f1f1f1;">
									<img src="<?php echo "product_images/".$row["problemimage"]; ?>" class="img-responsive m-auto d-block" width="100%" height="150" /><br />
									<div style="width: 350px; max-width: 350px; height: 72px;">
										<h5 class="text-info" style="text-align:center;font-size:130%;"><?php echo $row["problemid"].".  ".$row["problemtitle"] ?></h5><br>
									</div>
									<h6 class="text-success" style="text-align:center;"><?php echo "LAST ATTEMPT DATE AND STATUS:<br>";?></h6>
									<div style="height: 65px;">
										<h6 class="text-danger" style="text-align:center;"><?php if (isset($attemptstatus[$row["problemid"]]["attemptdate"])) {echo $attemptstatus[$row["problemid"]]["attemptdate"];} ?></h6>
										<h6 class="text-danger" style="text-align:center;"><?php if (isset($attemptstatus[$row["problemid"]]["attemptstatus"])) {echo $attemptstatus[$row["problemid"]]["attemptstatus"];} ?></h6>
									</div>
									<div style="text-align: center;">
										<input type="submit" name="start" style="margin-top:5px; text-align:center;" class="btn btn-success" value="Start" />
									</div>
									<br/>
								</div>
							</form>
						</div>
						
						<?php
									
								}
							}
							$conn->close();
						?>
					</div>
				</div>
				<br />
			</body>
		</html>
<?php
	}
?>
