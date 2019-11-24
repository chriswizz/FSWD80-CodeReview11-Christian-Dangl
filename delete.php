<?php 
	require_once 'actions/db_connect.php';

	if ($_GET['todo_id'] && $_GET['item_id']) {
	    $todo_id = $_GET['todo_id'];
	    $item_id = $_GET['item_id'];

	    $connect->close();
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title >Delete Item</title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>

		<body>
			<div class="container mt-5">
				<h3>Do you really want to delete this item?</h3>
				<form action ="actions/a_delete.php" method="post">
					<input type="hidden" name="todo_id" value="<?php echo $todo_id ?>" />
					<input type="hidden" name="item_id" value="<?php echo $item_id ?>" />
					<button type="submit" class="btn btn-dark border">Delete</button >
					<a href="adminpanel.php"><button type="button" class="btn btn-dark border">Back to Adminpanel</button ></a>
				</form>
			</div>
		</body>
		</html>

		<?php
	}
?>

