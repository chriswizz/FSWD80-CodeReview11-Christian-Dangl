<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/style.css">

<?php 
    require_once 'db_connect.php';

    if ($_POST) {
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
            echo (mysqli_query($connect, $sql)) ? "New Address created" : "Error: New Address could not be created";
        } else {
            echo "Address already exists in Database";
        }



        
        $connect->close();
    }
?>