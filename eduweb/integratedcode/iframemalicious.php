<?php
	session_start();
	include("dbconnect.php");
	if(!isset($_SESSION['uniquekey']) && empty($_SESSION['uniquekey'])) {
	   header("Location: ./index.php"); 
		die();
	}
?>

<html>
<!--
1. check if the session does exist then just die - users should be able to reach this page directly
2. add a hidden parameter in the page that users should crack to reach this iframe
3. check the url of the page and the hidden parameter is available -
4. if the hidden parameter is available then the hack is success and log it into the result api
 
-->
	<head>
		<title>Hack Me  - MALICIOUS</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script type="text/javascript" src="./js/links.js"></script>
	</head>

	<body style="margin: 40px 40px 40px 40px;">
		<script>
			var logactivity = '';
			if ( window.location !== window.parent.location ) {
				logactivity = "Successful Attempt";
				alert("successful attempt. you answer has been recorded already");
			} else {
				logactivity = "Attempt failed";
				alert("attempt failure, try it again ");
			}
			var params = {
			log:logactivity
			};
			var fd = new FormData();

			for(var i in params){
			fd.append(i,params[i]);
			}

			fetch(logapi, {
				method: "POST",
				body: fd
			})
		</script>
		
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					<br><br><br>
					<h2>WELCOME TO THIS MALICIOUS PAGE </h2>
					<h3>Your SessionId: <?php echo $_SESSION['uniquekey']; ?> has been hijacked</h3>
					<br>
				</div>
			</div>
		</div>			
	</body>
</html>