<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';
    $error = false;

    if (isset($_SESSION['user']) || isset($_SESSION['admin'])) {
        header("Location: index.php");
        exit;
    }
    if (isset($_POST['btn-signup'])) {
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        $password = trim($_POST['password']);
        $password = strip_tags($password);
        $password = htmlspecialchars($password);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "Please enter valid email address.";
        } else {
            $query = "SELECT user_email FROM users WHERE user_email='$email'";
            $result = mysqli_query($connect, $query);
            $count = mysqli_num_rows($result);
            if ($count != 0) {
                $error = true;
                $emailError = "Provided email is already in use.";
            }
        }
        if (empty($password)) {
            $error = true;
            $passError = "Please enter password.";
        } else if (strlen($password) < 6) {
            $error = true;
            $passError = "Password must have at least 6 characters.";
        }
        $passHash = hash('sha256', $password);
        if(!$error) {
            $query = "INSERT INTO users (user_email, user_password) VALUES('$email','$passHash')";
            $res = mysqli_query($connect, $query);
            if ($res) {
                $errTyp = "success";
                $errMsg = "Successfully registered, you may login now";
                unset($email);
                unset($password);
            } else  {
                $errTyp = "danger";
                $errMsg = "Something went wrong, try again later...";
            }
        }

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Travelmatic Sign Up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <fieldset>
            <legend>Sign Up</legend>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <hr>

                <?php
                    if (isset($errMsg)) {
                ?>
                      <div class="alert alert-<?php echo $errTyp ?>" >
                          <?php echo $errMsg; ?>
                      </div>
                <?php
                    }
                ?>

                <input type="email" name="email" class="form-control" placeholder="Your Email" maxlength="50" value="<?php echo $email ?>" />
                <span class="text-danger"><?php echo $emailError; ?></span>
                <hr>

                <input type="password" name="password" class="form-control" placeholder="Your Password" maxlength="15">
                <span class="text-danger"><?php echo $passError; ?></span >
                <hr>

                <button type="submit" class="btn btn-dark border" name="btn-signup">Sign Up</button>
                <hr>

                <a href="login.php"><button type="button" class="btn btn-outline-dark">Log In Here</button></a>
            </form>
        </fieldset>
    </body>
</html>

<?php ob_end_flush(); ?>