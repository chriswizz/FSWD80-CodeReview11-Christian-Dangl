 <?php
 	error_reporting(~E_DEPRECATED & ~E_NOTICE);
 	
	$localhost = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "cr11_christian_dangl_travelmatic";

	// create connection
	$connect = new mysqli($localhost, $username, $password, $dbname);

	// check connection
	if($connect->connect_error) {
	    die("<br><font color='red'><b>connection failed: " . $connect->connect_error . "</b></font>");
	} else {
	    // echo "Successfully Connected";
	}
?>