<?php
	/* following function are written for sanitizing the userinput for 
	1. SQL INJECTION
	2. HTML INJECTION
	3. CROSS SITE SCRIPTING
	4. IFRAME INJECTION
	*/
	$cookie_name1 = "edureka";
	$cookie_name2 = "titanic";
	$cookie_name3 = "starwars";
	$cookie_name4 = "findingnemo";
	$cookie_name5 = "toystory";
	$cookie_name6 = "moonstruck";
	$cookie_value1 = "hackmeifyoucan";
	$cookie_value2 = "iamthekingoftheworld";
	$cookie_value3 =  "maytheforcebewithyou";
	$cookie_value4 = "justkeepswimming";
	$cookie_value5 = "toinfinityandbeyond";
	$cookie_value6 = "snapoutofit";
	$what_name = "3 Idiots";
	$what_value = "All is well";
	$pwdvalue = "masterpassword";
	$bforce_name = "chelsea";
	$bforce_value = "lovers";
	$captcha_bypass_username = "Virus";
	$captcha_bypass_password = "Connect and Die";
	$cookie4 = "findingnemo=justkeepswimming";
	$hidden_captcha = "H1dD69";

	$assesmentURL = 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/assessment';
	$randomLoginURL = 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/login';
	$activityURL = 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/activitylog';
	$attemptstatusURL = 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/attemptstatus';

	function check_sql_1($value)
	{
		return addslashes($value);
	}

	function check_sql_2($value)
	{
		$finalvalue = str_replace("(", "", $value);
		$finalvalue = str_replace(")", "", $finalvalue);
		$finalvalue = str_replace("=", "", $finalvalue);
		$finalvalue = str_replace("'", "", $finalvalue);
		$finalvalue = str_replace(",", "", $finalvalue);
		$finalvalue = str_replace(";", "", $finalvalue);
		$finalvalue = str_replace("-", "", $finalvalue);
		$finalvalue = str_replace("#", "", $finalvalue);
		$finalvalue = str_replace(" and ", "", $finalvalue);
		$finalvalue = str_replace(" or ", "", $finalvalue);
		$finalvalue = str_replace("union", "", $finalvalue);
		$finalvalue = str_replace("select", "", $finalvalue);
		$finalvalue = str_replace("delete", "", $finalvalue);
		$finalvalue = str_replace("drop", "", $finalvalue);
		$finalvalue = str_replace(" AND ", "", $finalvalue);
		$finalvalue = str_replace(" OR ", "", $finalvalue);
		$finalvalue = str_replace("UNION", "", $finalvalue);
		$finalvalue = str_replace("SELECT", "", $finalvalue);
		$finalvalue = str_replace("DELETE", "", $finalvalue);
		$finalvalue = str_replace("DROP", "", $finalvalue);


		return $finalvalue;
	}

	function check_html($value)
	{
		return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
	}

	function sanitize_string($value)
	{
		return filter_var($value,FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	}

	function sanitize_string_encode($value)
	{
		return filter_var($value,FILTER_SANITIZE_STRING);
	}

	function remove_html_tag($value)
	{
		return strip_tags($value);
	}

	function html_form_tag_check($value)
	{
		$input = preg_match("/<form>/", $value);
		return  $input;
	}

	function html_script_tag_check($value)
	{
		$input = preg_match("/<script>/", $value);
		return  $input;
	}

	function sql_command_check($value)
	{
		$strlower = strtolower($value);

		if (preg_match("/ and /", $strlower))
		{
			return true;
		}
		if (preg_match("/ or /", $strlower))
		{
			return true;
		}
		if (preg_match("/update/", $strlower))
		{
			return true;
		}
		if (preg_match("/delete/", $strlower))
		{
			return true;
		}
		if (preg_match("/drop/", $strlower))
		{
			return true;
		}
		return false;
	}

	function sql_command_check2($value)
	{
		$strlower = strtolower($value);

		if (preg_match("/union/", $strlower))
		{
			return true;
		}
		if (preg_match("/update/", $strlower))
		{
			return true;
		}
		if (preg_match("/delete/", $strlower))
		{
			return true;
		}
		if (preg_match("/drop/", $strlower))
		{
			return true;
		}
		return false;
	}

	function sql_command_check3($value)
	{
		$strlower = strtolower($value);

		if (preg_match("/ and /", $strlower))
		{
			return true;
		}
		if (preg_match("/ or /", $strlower))
		{
			return true;
		}
		if (preg_match("/select/", $strlower))
		{
			return true;
		}
		if (preg_match("/union/", $strlower))
		{
			return true;
		}
		if (preg_match("/update/", $strlower))
		{
			return true;
		}
		if (preg_match("/delete/", $strlower))
		{
			return true;
		}
		if (preg_match("/drop/", $strlower))
		{
			return true;
		}
		return false;
	}

	function sql_command_check4($value)
	{
		$strlower = strtolower($value);

		if (preg_match("/ and /", $strlower))
		{
			return true;
		}
		if (preg_match("/ or /", $strlower))
		{
			return true;
		}

		if (preg_match("/union/", $strlower))
		{
			return true;
		}
		if (preg_match("/update/", $strlower))
		{
			return true;
		}
		if (preg_match("/delete/", $strlower))
		{
			return true;
		}
		if (preg_match("/drop/", $strlower))
		{
			return true;
		}
		return false;
	}

	function restricted_command_check($value)
	{
		$strlower = strtolower($value);

		if (preg_match("/pizza/", $strlower))
		{
			return true;
		}
		if (preg_match("/modi/", $strlower))
		{
			return true;
		}
		if (preg_match("/security/", $strlower))
		{
			return true;
		}

		return false;
	}

	function sql_command_check5($value)
	{
		$strlower = strtolower($value);
		if (preg_match("/select/", $strlower))
		{
			return true;
		}
		if (preg_match("/union/", $strlower))
		{
			return true;
		}
		if (preg_match("/update/", $strlower))
		{
			return true;
		}
		if (preg_match("/delete/", $strlower))
		{
			return true;
		}
		if (preg_match("/drop/", $strlower))
		{
			return true;
		}
		return false;
	}

	function comment_check($value)
	{
		if (preg_match("/--/", $value))
		{
			return true;
		}
		return false;
	}

	function check_img_tag($value)
	{
		$strlower = strtolower($value);
		if (preg_match("/img/", $strlower))
		{
			return true;
		}
		return false;
	}

	function check_script_tag($value)
	{
		$strlower = strtolower($value);
		if (preg_match("/<script/", $strlower))
		{
			return true;
		}
		return false;
	}

	function check_href_tag($value)
	{
		$strlower = strtolower($value);
		if (preg_match("/href/", $strlower))
		{
			return true;
		}
		return false;
	}

	function get_dbname()
	{
		return "edureka_cybersecurity";
	}

	function generate_random_string()
	{
		$char_array = array();
		$lower = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
		$upper = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		$digit = ['0','1','2','3','4','5','6','7','8','9'];
		$special = ['@','#','$','+','-','?','!'];
		for ($x = 0; $x <= 2; $x++)
		{
		    array_push($char_array,$lower[mt_rand(0,25)]);
		}
		array_push($char_array,$upper[mt_rand(0,25)]);
		array_push($char_array,$digit[mt_rand(0,9)]);
		array_push($char_array,$special[mt_rand(0,6)]);
		shuffle($char_array);
		return implode('', $char_array);

	}

	function check_alert_word($value)
	{
		$strlower = strtolower($value);
		if (preg_match("/alert/", $strlower))
		{
			return true;
		}
		return false;
	}

	Function replace_alert_word($value)
	{
		$strlower = strtolower($value);
		$finalvalue = str_replace("alert", "", $strlower);
		return $finalvalue;
	}

	function replace_script_tag($value)
	{
		$strlower = strtolower($value);
		$finalvalue = str_replace("<script>", "", $strlower);
		return $finalvalue;
	}

	function check_form_tag($value)
	{
		$strlower = strtolower($value);
		if (preg_match("/<form/", $strlower))
		{
			return true;
		}
		return false;
	}

	function check_script_form_tag($value)
	{
		$strlower = strtolower($value);
		if((check_script_tag($strlower) ===true) && (check_form_tag($strlower) ===true))
		{
			return true;
		}
		return false;
	}

	function check_cookie_info($value)
	{
		$strlower = strtolower($value);
		if((preg_match("/findingnemo/", $strlower)) && (preg_match("/justkeepswimming/", $strlower)))
		{
			return true;
		}
		return false;
	}

	function curl_answer($data)
	{
		global $assesmentURL;
		$ch = curl_init();
		$data["token"] = $_SESSION["api_token"];
		$curl_post_data =json_encode($data);

		//curl_setopt($ch, CURLOPT_URL, 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/assessment');
		//curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/edureka/assessment');
		curl_setopt($ch, CURLOPT_URL, $assesmentURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);

		$curlheaders = array();
		$curlheaders[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheaders);

		$result = curl_exec($ch);
		$result_statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch)) {
				  echo 'Error in answer:' . curl_error($ch);
		}

		$decoded = json_decode($result,true);
		if (($result_statuscode == 400) || ($result_statuscode == 500))
		{
			die('error occured: '.$decoded['ErrorMessage']);
		}
		else {
			echo "<font color=red ><center>'".$decoded['StatusMessage']."'</center></font>";
		}

		curl_close($ch);
	}

	function curl_answer_without_message($data)
	{
		global $assesmentURL;
		$ch = curl_init();
		$data["token"] = $_SESSION["api_token"];
		$curl_post_data =json_encode($data);

		//curl_setopt($ch, CURLOPT_URL, 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/assessment');
		//curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/edureka/assessment');
		curl_setopt($ch, CURLOPT_URL, $assesmentURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);

		$curlheaders = array();
		$curlheaders[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheaders);

		$result = curl_exec($ch);
		$result_statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch)) {
				  echo 'Error in answer without message:' . curl_error($ch);
		}

		$decoded = json_decode($result,true);
		if (($result_statuscode == 400) || ($result_statuscode == 500))
		{
			die('error occured: '.$decoded['ErrorMessage']);
		}		

		curl_close($ch);
	}


	function curl_login($data)
	{
		global $randomLoginURL;

		$ch = curl_init();
		$curl_post_data =json_encode($data);

		//curl_setopt($ch, CURLOPT_URL, 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/login');
		//curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/edureka/login');

		curl_setopt($ch, CURLOPT_URL, $randomLoginURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
		//"{\"username\":\"khalid\",\"password\":\"masood123\"}"

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$result_statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch)) {
				  echo 'Error in login:' . curl_error($ch) . $result_statuscode . $randomLoginURL;
		}

		$decoded = json_decode($result,true);
		//print_r($decoded);
		if (($result_statuscode == 400) || ($result_statuscode == 500))
		{
			die('error occured: '.$decoded['ErrorMessage']);
		}
		else
		{
			$_SESSION["uniquekey"] = $decoded['sessionid'];
		}

		curl_close($ch);
	}


	function curl_logactivity($data)
	{
		global $activityURL;
		$ch = curl_init();
		$data["token"] = $_SESSION["api_token"];
		$curl_post_data =json_encode($data);

		//curl_setopt($ch, CURLOPT_URL, 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/activitylog');
		//curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/edureka/activitylog');
		curl_setopt($ch, CURLOPT_URL, $activityURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
		//"{\"username\":\"khalid\",\"password\":\"masood123\"}"

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$result_statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch)) {
				  echo 'Error in logactivity :' . curl_error($ch);
		}

		$decoded = json_decode($result,true);
		//print_r($decoded);
		if (($result_statuscode == 400) || ($result_statuscode == 500))
		{
			die('error occured: '.$decoded['ErrorMessage']);
		}

		curl_close($ch);
	}

	function curl_attemptstatus($data)
	{
		global $attemptstatusURL;

		$ch = curl_init();
		$curl_post_data =json_encode($data);

		//curl_setopt($ch, CURLOPT_URL, 'http://ec2-52-66-226-77.ap-south-1.compute.amazonaws.com:80/edureka/login');
		//curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/edureka/attemptstatus');

		curl_setopt($ch, CURLOPT_URL, $attemptstatusURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_post_data);
		//"{\"username\":\"khalid\",\"password\":\"masood123\"}"

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		$result_statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch)) {
				  echo 'Error in login:' . curl_error($ch) . $result_statuscode . $randomLoginURL;
		}

		$decoded = json_decode($result,true);
		if (($result_statuscode == 400) || ($result_statuscode == 500))
		{
			die('error occured: '.$decoded['ErrorMessage']);
		}
		//print_r($decoded);
		return $decoded;
		curl_close($ch);
	}


?>
