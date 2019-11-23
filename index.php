<?php
	require_once "actions/db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Travelmatic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cookie&display=swap" rel="stylesheet">
    <!-- bootstrap css local fallback - copy bootstrap file in correct folder -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <!-- adapt external css link -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid">
        <!-- <header> -->
        <?php
        	include "header.php";
        ?>
        <!-- </header> -->
        <div class="container">
            <div class="row flex-column align-items-center">
                <div class="cookie display-2 main-color">ViennaPhpBlog</div>
                <hr class="col-12 p-0">
            </div>
            <div class="items row">
            	<?php
					function RemoveSpecialChar($value) {
						$result  = preg_replace('/[^a-zA-Z0-9-.:_~\/ ]/s','',$value);
						return $result;
					}

					$sqlTodo = "SELECT * FROM items
							INNER JOIN `todos` ON fk_todo_item_id = item_id
							INNER JOIN `categories` ON fk_category_id = category_id
							INNER JOIN `addresses` ON fk_address_id = address_id
							INNER JOIN `cities` ON fk_zip_code = zip_code
							WHERE `category_id` = '2'";
					$resultTodo = $connect->query($sqlTodo);
					$sqlRestaurant = "SELECT * FROM restaurants
							INNER JOIN `items` ON fk_restaurant_item_id = item_id
							INNER JOIN `categories` ON fk_category_id = category_id
							INNER JOIN `addresses` ON fk_address_id = address_id
							INNER JOIN `cities` ON fk_zip_code = zip_code";
					$resultRestaurant = $connect->query($sqlRestaurant);
					$sqlConcert = "SELECT * FROM concerts
							INNER JOIN `items` ON fk_concert_item_id = item_id
							INNER JOIN `categories` ON fk_category_id = category_id
							INNER JOIN `addresses` ON fk_address_id = address_id
							INNER JOIN `cities` ON fk_zip_code = zip_code";
					$resultConcert = $connect->query($sqlConcert);

					if($resultTodo->num_rows > 0) {
						while($row = $resultTodo->fetch_assoc()) {
							echo
								'<div class="card col-12 col-md-6 col-lg-4 p-4">
					                <img class="d-none d-md-block" src="'.$row['image'].'" class="card-img-top" alt="...">
					                <div class="card-body px-2 pt-2 pb-0">
					                    <h5 class="card-title py-2 mb-1 main-color font-size-17">'.$row['name'].'<br><small>'.$row['category'].'</small></h5>

					                    <p class="card-text my-3">'.$row['description'].'</p>
					                    <ul class="list-group list-group-flush">
					                        <li class="list-group-item px-2"><i class="fas fa-map-marker-alt"></i> '.$row['street'].' '.$row['house_no'].', '.$row['zip_code'].' Vienna</li>
										<li class="list-group-item px-2"><a href="http://'.$row['website'].'" title="" target="_blank">'.$row['website'].'</a></li>
					                    </ul>
					                </div>
					                <hr class="col-12 m-0 p-0">
					            </div>
            				';
						}
					} else {
						echo "<center><font color='red'>No Data Avaliable</font></center>";
					}
					if($resultRestaurant->num_rows > 0) {
						while($row = $resultRestaurant->fetch_assoc()) {
							echo
								'<div class="card col-12 col-md-6 col-lg-4 p-4">
					                <img class="d-none d-md-block" src="'.$row['image'].'" class="card-img-top" alt="...">
					                <div class="card-body px-2 pt-2 pb-0">
					                    <h5 class="card-title py-2 mb-1 main-color font-size-17">'.$row['name'].'<br><small>'.$row['category'].'</small></h5>

					                    <p class="card-text my-3">'.$row['description'].'</p>
					                    <ul class="list-group list-group-flush">
					                        <li class="list-group-item px-2"><i class="fas fa-map-marker-alt"></i> '.$row['street'].' '.$row['house_no'].', '.$row['zip_code'].' Vienna</li>
											<li class="list-group-item px-2"><i class="fas fa-phone"></i> '.$row['restaurant_tel'].'</li>
											<li class="list-group-item px-2"><a href="http://'.$row['website'].'" title="" target="_blank">'.$row['website'].'</a></li>
					                    </ul>
					                </div>
					                <hr class="col-12 m-0 p-0">
					            </div>
            				';
						}
					} else {
						echo "<center><font color='red'>No Data Avaliable</font></center>";
					}
					if($resultConcert->num_rows > 0) {
						while($row = $resultConcert->fetch_assoc()) {
							echo
								'<div class="card col-12 col-md-6 col-lg-4 p-4">
					                <img class="d-none d-md-block" src="'.$row['image'].'" class="card-img-top" alt="...">
					                <div class="card-body px-2 pt-2 pb-0">
					                    <h5 class="card-title py-2 mb-1 main-color font-size-17">'.$row['name'].'<br><small>'.$row['category'].'</small></h5>

					                    <p class="card-text my-3">'.$row['description'].'</p>
					                    <ul class="list-group list-group-flush">
					                        <li class="list-group-item px-2"><i class="fas fa-map-marker-alt"></i> '.$row['street'].' '.$row['house_no'].', '.$row['zip_code'].' Vienna</li>
											<li class="list-group-item px-2"><i class="far fa-calendar-alt"></i> '.$row['concert_date'].', '.$row['concert_time'].' &nbsp; | &nbsp; € '.$row['concert_price'].'</li>
											<li class="list-group-item px-2"><a href="http://www.'.$row['website'].'" title="" target="_blank">'.$row['website'].'</a></li>
					                    </ul>
					                </div>
					                <hr class="col-12 m-0 p-0">
					            </div>
            				';
						}
					} else {
						echo "<center><font color='red'>No Data Avaliable</font></center>";
					}
				?>








            </div>
            <footer class="row justify-content-center align-items-center">
                <div class="cookie display-2 text-white">ViennaPhpBlog</div>
            </footer>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- bootstrap js local fallback - copy bootstrap file in correct folder -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <!-- adapt external js src-->
    <!-- <script src="js/data.json"></script> -->
    <!-- <script src="js/script.js"></script> -->
</body>

</html>