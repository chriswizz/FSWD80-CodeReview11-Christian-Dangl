<?php
	session_start();
	require_once "actions/db_connect.php";

	if (!isset($_SESSION['admin'])) {
		header("Location: index.php");
        exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Travelmatic Admin</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class ="container-fluid">
			<?php echo '
				<a href="upsert.php?action=create"><button type="button" class="btnFix btnFixLeft btn btn-danger border">Create New "Things To Do"-Item</button></a>
				<a href="logout.php?logout"><button type="button" class="btnFix btnFixRight btn btn-success border">Log Out</button></a>';
			?>
		<table class="table table-striped tableStickyHead" cellspacing= "0" cellpadding="0">
			<thead class="thead-dark">
				<tr>
					<th class="width-col-60">Image</th>
					<th>Item ID</th>
					<th>Name</th>
					<th>Address ID</th>
					<th>Description</th>
					<th>Website</th>
					<th>Category ID</th>
					<th>Category</th>
					<th>Todo ID</th>
					<th>Todo </th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
			</thead>

			<tbody>
				<?php
					function RemoveSpecialChar($value) {
						$result  = preg_replace('/[^a-zA-Z0-9-.:_~\/ ]/s','',$value);
						return $result;
					}

					$sqlTodo = "SELECT * FROM todos
						INNER JOIN `items` ON fk_todo_item_id = item_id
						INNER JOIN `categories` ON fk_category_id = category_id
						INNER JOIN `addresses` ON fk_address_id = address_id
						INNER JOIN `cities` ON fk_zip_code = zip_code";
					$resultTodo = $connect->query($sqlTodo);

					if($resultTodo->num_rows > 0) {
						while($row = $resultTodo->fetch_assoc()) {
							echo
							"<tr>
								<td>
									<img src=" . $row['image'] . " width=50px height=50px>
								</td>
								<td>" . $row['item_id'] . "</td>
								<td>" . $row['name'] . "</td>
								<td>" . $row['address_id'] . "</td>
								<td>" . $row['description'] . "</td>
								<td>" . $row['website'] . "</td>
								<td>" . $row['category_id'] . "</td>
								<td>" . $row['category'] . "</td>
								<td>" . $row['todo_id'] . "</td>
								<td>" . $row['todo_type'] . "</td>
								<td>
									<a href='upsert.php?action=update&item_id=" . $row['item_id'] . "'><button type='button' class='btn btn-success btn-sm btn-sm-size rounded-circle border'><i class='fas fa-pen'></i></button></a>
								</td>
								<td>
									<a href='delete.php?todo_id=" . $row['todo_id'] . "&item_id=" . $row['item_id'] . "'><button type='button' class='btn btn-success btn-sm btn-sm-size rounded-circle border'><i class='fa fa-trash' aria-hidden='true'></i></button></a>
								</td>
							</tr>";
						}
					} else {
						echo "<center><font color='red'>No Data Avaliable</font></center>";
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>