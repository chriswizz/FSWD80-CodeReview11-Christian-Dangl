<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';
    $error = false;

    if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
        header("Location: index.php");
        exit;
    }
    if (isset($_POST['btn-login'])) {
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        $password = trim($_POST['password']);
        $password = strip_tags($password);
        $password = htmlspecialchars($password);
        if(empty($email)) {
            $error = true;
            $emailError = "Please enter your email address.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }
        if (empty($password)) {
            $error = true;
            $passError = "Please enter your password.";
        } elseif (strlen($password) < 5) {
            $error = true;
            $passError = "Must be more than 5 char";
        }
        if (!$error) {
            $passHash = hash('sha256', $password);
            $res = mysqli_query($connect, "SELECT user_id, user_email, user_password, user_role FROM users WHERE user_email='$email'");
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res);
            if ($count == 1 && $row['user_password'] == $passHash) {
                if($row['user_role'] == 'admin') {
                    $_SESSION['admin'] = $row['user_id'];
                    header("Location: adminpanel.php");
                    exit;
                } else {
                    $_SESSION['user'] = $row['user_id'];
                    header("Location: index.php");
                }
            } else {
            $errMSG = "Incorrect Credentials, Try again...";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Travelmatic Log In</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <fieldset>
            <legend>Log In</legend>
            <form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                <hr>

                <?php if (isset($errMSG)) echo $errMSG; ?>

                <input type="email" name="email" class="form-control" placeholder="Your email" value="<?php echo $email; ?>" maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span >
                <hr>

                <input type="password" name="password" class="form-control" placeholder="Enter password" maxlength="15" />
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr>

                <button type="submit" class="btn btn-dark border" name="btn-login">Log In</button>
                <hr>

                <a href="register.php"><button type="button" class="btn btn-outline-dark">Sign Up Here</button></a>
            </form>
        </fieldset>
    </body>
</html>

<?php ob_end_flush(); ?>