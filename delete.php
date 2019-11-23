<?php 
	require_once 'actions/db_connect.php';

	if ($_GET['id']) {
	    $id = $_GET['id'];

	    $sql = "SELECT * FROM media WHERE media_id = $id";
	    $result = $connect->query($sql);
	    $data = $result->fetch_assoc();

	    $connect->close();
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title >Delete Item</title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="style/style.css">
		</head>

		<body>
			<div class="container mt-5">
				<h3>Do you really want to delete this item?</h3>
				<form action ="actions/a_delete.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id ?>" />
					<button type="submit" class="btn btn-dark border">Delete</button >
					<a href="index.php"><button type="button" class="btn btn-dark border">Back to Items</button ></a>
				</form>
			</div>
		</body>
		</html>

		<?php
	}
?>

