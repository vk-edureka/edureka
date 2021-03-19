<?php
	session_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey'])) {
	   header("Location: ./index.php"); 
		die();
	}
?>
<html>
	<head>
		<title>Hack Me  - MALICIOUS </title>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</head>

	<body style="margin: 40px 40px 40px 40px;">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					<br><br><br>
					<h2>WELCOME TO THIS PAGE</h2>
					<br>
					<div class="row">
						<div class="col-md-12">
							<form method="post">
								<div class="row">
									Enter user name: <input type="text" name="user" id="user">
								</div>
								<br/>
								<input type="submit" value="Submit">
							</form>
							<br/>
							<br>
							<?php
								if($_POST)
								{
									$username = $_POST['user'];
									
									$objectiveresult="";

									if ( $username === false ) 
									{
										$objectiveresult = "Invalid Username";
									}
									else
									{
										echo "HEY ".$username." !!!!<br>";
										$objectiveresult = "success";
										
									}
									echo $objectiveresult;
									if(check_cookie_info($username)===true)
									{
										$data = array(
										'problemid' => 21,
										'username' => $_SESSION["username"],
										'answer' => $cookie4,
										'log' => $_SESSION["logactivity"],
										'sessionid' => $_SESSION['uniquekey'],
										'date' => date("Y-m-d")
										);
										curl_answer($data);
										echo "<h4>Great, your attempt is successful, your answer is recorded successfully, proceed to next attempt </h4>";
										
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</body>
</html>