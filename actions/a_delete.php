<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/style.css">

<?php 
	require_once 'db_connect.php';

	if ($_POST) {
	    $todo_id = $_POST['todo_id'];
	    $item_id = $_POST['item_id'];

	    $sqlTodo = "DELETE FROM `todos` WHERE todo_id = $todo_id";
	    $sqlItem = "DELETE FROM `items` WHERE item_id = $item_id";

	    if ($connect->query($sqlTodo) === TRUE) {
	    	if ($connect->query($sqlItem) === TRUE) {
				echo "<div class='container mt-5'>";
		        echo "<h3>Successfully deleted</h3>";
		        echo "<a href='../adminpanel.php'><button type='button' class='btn btn-dark border'>Back to Adminpanel</button></a>";
		        echo "</div>";
		    } else {
		    	echo "Error deleting record: " . $sqlItem . ' ' . $connect->error;
		    }
	    } else {
	        echo "Error deleting record: " . $sqlTodo . ' ' . $connect->error;
	    }
	    $connect->close();
	}
?>