<?php
require 'connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/login.css?v=2">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
    <?php
    include 'navigation.php';
    ?>
    <div class="container">
        <div class="shoes-photo">
        </div>
        <div class="login-side">
            <div class="login-title">
                <h1>Log In</h1>
                <h3>Welcome to Foot Ready</h3>
            </div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

                <div class="login-inputs">
                    <input class="login-input <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
                                                    echo 'error';
                                                } ?>" name="email" type="email" placeholder="Email" required>
                    <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
                        echo '<span style="margin-top: -10px; margin-bottom: 10px; color: #D21312">Invalid email address</span>';
                    } ?>
                    <input class="login-input <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
                                                    echo 'error';
                                                } ?>" name="password" type="password" placeholder="Password" required>
                    <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
                        echo '<span style="margin-top: -10px; margin-bottom: 10px; color: #D21312">Invalid password</span>';
                    } ?>

                    <div class=" login-forgot">
                        <div class="fix-align">
                            <input type="checkbox" name="keepsign" value="enabled">
                            <label for="keepsign">keep me signed in</label>
                        </div>
                        <h4><a href="">Forgot Password</a></h4>
                    </div>
                    <div class="login-btn">
                        <button type="submit" name="login">Log In</button>
                    </div>
            </form>
            <div class="login-or">
                <h6><span>or</span></h6>
            </div>
            <div class="login-google">
                <img src="photos/google.png" alt="" width="25px">
                <h3>Sign in with google</h3>
            </div>
            <div class="donthave">
                <h3>Don't have an account? <a class="signupfree" href="Signup.php">Sign up for Free</a></h3>
            </div>
        </div>
    </div>
    </div>
    <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
        echo '<script type="text/javascript">toastr.error("Invalid Credentials!")</script>';
    } ?>
    <?php



    if (isset($_POST["login"])) {

        $email = isset($_POST['email']) ? filter_input(INPUT_POST, "email",  FILTER_VALIDATE_EMAIL) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $query = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $validEmail = isset($row['email']) ? $row['email'] : '';
        $validPassword = isset($row['password']) ? $row['password'] : '';

        if ($email == $validEmail && $password == $validPassword) {
            header("Location: http://localhost/ecommerce/customer/home.php");
            $_SESSION["username"] = $email;
            $_SESSION["loggedin"] = true;
            $_SESSION["customer_id"] = $id;
            exit();
        } else {
            header("Location: http://localhost/ecommerce/customer/login.php?test=true");
            exit();
        }
    }
    ?>
</body>




</html>