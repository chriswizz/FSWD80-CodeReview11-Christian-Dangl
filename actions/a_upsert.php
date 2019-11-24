<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/style.css">

<?php 
    require_once 'db_connect.php';

    if ($_POST) {
        $item_id = $_POST['item_id'];
        $image = $_POST['image'];
        $name = $_POST['name'];
        $zip_code = $_POST['zip_code'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $house_no = $_POST['house_no'];
        $description = $_POST['description'];
        $website = $_POST['website'];
        $todo_type = $_POST['todo_type'];

        $sqlCity = "SELECT * FROM cities WHERE zip_code = $zip_code";
        $resultCity = mysqli_query($connect, $sqlCity);
        $cityRow = mysqli_fetch_assoc($resultCity);

        if ($resultCity->num_rows == 0) {
            $sql = "INSERT INTO cities VALUES ($zip_code, '$city')";
            echo (mysqli_query($connect, $sql)) ? "New ZIP Code created<br>" : "Error: New ZIP Code could not be created<br>";
        } else {
            echo "ZIP Code already exists in Database<br>";
        }

        $sqlAddress = "SELECT * FROM addresses WHERE street = '$street' AND house_no='$house_no'";
        $resultAddress = mysqli_query($connect, $sqlAddress);
        $addressRow = mysqli_fetch_assoc($resultAddress);

        if ($resultAddress->num_rows == 0) {
            $sql = "INSERT INTO addresses (street, house_no, fk_zip_code) VALUES ('$street', '$house_no', $zip_code)";
            echo (mysqli_query($connect, $sql)) ? "New Address created<br>" : "Error: New Address could not be created<br>";
        } else {
            echo "Address already exists in Database<br>";
        }

        $sqlAddressId = "SELECT address_id FROM addresses WHERE street = '$street' AND house_no='$house_no'";
        $resultAddressId = mysqli_query($connect, $sqlAddressId);
        $addressIdRow = mysqli_fetch_assoc($resultAddressId);
        $address_id = $addressIdRow['address_id'];

        if ($_POST['item_id'] <> "") {
            $item_id = $_POST['item_id'];
            $sqlItem = "UPDATE `items` SET image='$image', name='$name', fk_address_id=$address_id, description='$description', website='$website' WHERE item_id=$item_id";
            $sqlTodo = "UPDATE `todos` SET todo_type='$todo_type' WHERE fk_todo_item_id=$item_id";

            if ($connect->query($sqlItem) === TRUE && $connect->query($sqlTodo) === TRUE) {
                echo "<div class='container mt-5'>";
                echo "<h3>\"Things To Do\"-Item Successfully Updated</h3>";
                echo "<a href='../adminpanel.php'><button type='button' class='btn btn-dark border'>Back to Adminpanel</button></a>";
                echo "</div>";
            } else  {
                echo "Error " . $sqlItem . ' ' . $connect->connect_error;
                echo "Error " . $sqlTodo . ' ' . $connect->connect_error;
            }
        } else {
            $sqlItem = "INSERT INTO `items` (image, name, fk_address_id, description, website, fk_category_id) VALUES ('$image', '$name', $address_id, '$description', '$website', 2)";

            if ($connect->query($sqlItem) === TRUE) {
                echo "";
            } else  {
                echo "Error " . $sqlItem . ' ' . $connect->connect_error;
            }

            $sqlItemId = "SELECT item_id FROM `items` WHERE image='$image' AND name='$name' AND fk_address_id=$address_id AND description='$description' AND website='$website' AND fk_category_id=2";
            $resultItemId = mysqli_query($connect, $sqlItemId);
            $itemIdRow = mysqli_fetch_assoc($resultItemId);
            $item_id = $itemIdRow['item_id'];

            $sqlTodo = "INSERT INTO `todos` (todo_type, fk_todo_item_id) VALUES ('$todo_type', $item_id)";

            if ($connect->query($sqlTodo) === TRUE) {
                echo "<div class='container mt-5'>";
                echo "<h3>New \"Things To Do\"-Item Successfully Created</h3>";
                echo "<a href='../upsert.php?action=create'><button type='button' class='btn btn-dark m-1 border'>Create New \"Things To Do\"-Item</button></a>";
                echo "<a href='../adminpanel.php'><button type='button' class='btn btn-dark m-1 border'>Back to Adminpanel</button></a>";
                echo "</div>";
            } else {
                echo "Error " . $sqlTodo . ' ' . $connect->connect_error;
            }
        }
        $connect->close();
    }
?>