<?php

$dbServerName = "db";
$dbUsername = "khalid";
$dbPassword = "khalid123";
$dbName = "edureka_cybersecurity";
#$conn = mysqli_connect($dbName, $dbUsername, $dbPassword, "edureka_cybersecurity") or die((mysqli_error($conn)));
$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);
echo "Connected to MySQL<br />";
$sql = "select * from problemtable where problemid=3";
//$result = mysqli_query($conn,$sql);
$result = $conn->query($sql);
			echo $sql;
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $problemid = $row["problemid"];
                        $problemtitle = $row["problemtitle"];
			$problemdescription = $row["problemdescription"];
			echo $problemtitle;
                }
        }
        $conn->close();

?>
