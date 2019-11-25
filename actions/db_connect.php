 <?php
 	error_reporting(~E_DEPRECATED & ~E_NOTICE);
 	
	$localhost = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "cr11_christian_dangl_travelmatic";

	// create connection
	$connect = new mysqli($localhost, $username, $password, $dbname);

	// check connection
	if(!$connect->set_charset("utf8")) {
	    die("<br><font color='red'><b>Error loading charset utf-8: " . $connect->connect_error . "</b></font>");
	} else {
	    $connect->character_set_name();
	}
?>