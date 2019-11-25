<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
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
    <nav class="navbar sticky-top navbar-inverse navbar-expand-lg navbar-dark bg-nav">
        <a class="navbar-brand cookie font-size-20" href="#">ViennaPhpBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="index.php"><button type="button" class="nav-filter btn border-0 mx-1 active" value="All">Show All</button></a>
                </li>
                <li class="nav-item">
                    <a href="restaurant.php"><button type="button" class="nav-filter btn border-0 mx-1" value="Restaurant">Restaurants</button></a>
                </li>
                <li class="nav-item">
                    <a href="event.php"><button type="button" class="nav-filter btn border-0 mx-1" value="Event">Events</button></a>
                </li>
                <li class="nav-item">
                    <a href="maps.php"><button type="button" class="nav-filter btn border-0 mx-1" value="Event">Google Maps</button></a>
                </li>
            </ul>
            <div class="wrapper-sort d-flex">
                <?php
                    if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
                        echo '
                            <span>
                            <a href="logout.php?logout"><button type="button" class="btn btn-outline-light border mx-1">Log Out</button></a>
                            ';
                    } else {
                        echo '
                            <a href="register.php"><button type="button" class="btn btn-outline-light border mx-1">Sign Up</button></a>
                            <a href="login.php"><button type="button" class="btn btn-outline-light border mx-1"><i class="fas fa-user"></i>&nbsp;Log In</button></a>
                            ';
                    } 
                ?>
            </div>
        </div>
    </nav>
    <div class="jumbotron">
    </div>
</body>

</html>