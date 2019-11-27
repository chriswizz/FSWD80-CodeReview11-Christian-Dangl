<?php
	require_once "actions/db_connect.php";

	$str = $_GET['q'];
	if (strlen($str)>0) {
		$sql = "SELECT name, street, website FROM items
				INNER JOIN addresses ON fk_address_id = address_id
				WHERE name LIKE '%$str%' OR street LIKE '%$str%' LIMIT 5";
		$result = mysqli_query($connect, $sql);
		$data = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($data as $row) {
			echo $row['name'].", ".$row['street'].", ".$row['website']."<br>";
		}
	}

?>