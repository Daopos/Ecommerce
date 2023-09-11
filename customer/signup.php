<?php
require 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/signup.css?v=2">
    <link rel="stylesheet" href="./style/login.css?v=2">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<style>

</style>

<body>
    <?php
    include 'navigation.php';

    ?>
    <div class="container-signup">
        <div class="signup-photo">
        </div>
        <div class="login-side">
            <div class="login-title">
                <h1>Sign up</h1>
                <h2 class="anccount">Create an account</h2>
            </div>
            <div>
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="login-inputs">
                    <input name="name" class="login-input" type="text" placeholder="Name" required>
                    <input name="email" class="login-input <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
                                                                echo 'error';
                                                            } ?>" type="email" placeholder="Email" required>
                    <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
                        echo '<span style="margin-top: -10px; margin-bottom: 10px; color: #D21312">Email is already registered</span>';
                    } ?>
                    <input name="phone" class="login-input" type="number" placeholder="Phone number" required>
                    <input name="password" class="login-input" type="password" placeholder="Password" required>
                    <div class="login-btn">
                        <button name="register" type="submit">Create account</button>
                    </div>
                </form>

                <div class="login-or">
                    <h6><span>or</span></h6>
                </div>
                <div class="login-google">
                    <img src="photos/google.png" alt="" width="25px">
                    <h3>Sign in with google</h3>
                </div>
                <div class="signup-test">
                    <h3>Already have an account? <a class="signupfree" href="login.php">Login</a></h3>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
        echo '<script type="text/javascript">toastr.error("Email in used!")</script>';
    } ?>
    <?php


    $name = NULL;
    $email;
    $phone;
    $password;
    if (isset($_POST["register"])) {
        $name = isset($_POST['name']) ? filter_input(INPUT_POST, "name",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $email = isset($_POST['email']) ? filter_input(INPUT_POST, "email",  FILTER_VALIDATE_EMAIL) : '';
        $phone = isset($_POST['phone']) ? filter_input(INPUT_POST, "phone",  FILTER_SANITIZE_NUMBER_INT) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Check if email exists in the database
        $checkEmailQuery = "SELECT id FROM customer WHERE email = '$email'";
        $checkEmailResult = mysqli_query($connect, $checkEmailQuery);
        $emailExists = mysqli_num_rows($checkEmailResult) > 0;

        if ($emailExists) {
            header("Location: http://localhost/ecommerce/customer/signup.php?test=true");
            exit();
        } else {
            // Email is not in the database, proceed with registration
            $sqlInsert = "INSERT INTO customer(name, email, phone_number, password) VALUES('$name','$email','$phone','$password')";
            $insertQuery = mysqli_query($connect, $sqlInsert);

            // Retrieve the inserted customer's ID
            $getIdQuery = "SELECT id FROM customer WHERE email = '$email'";
            $getIdResult = mysqli_query($connect, $getIdQuery);
            $row = mysqli_fetch_assoc($getIdResult);
            $id = $row['id'];

            // Redirect and set session variables
            header("Location: http://localhost/ecommerce/customer/home.php?from_signup=true");
            $_SESSION["username"] = $email;
            $_SESSION["loggedin"] = true;
            $_SESSION["customer_id"] = $id;
            exit();
        }
    }
    ?>
</body>


</html>