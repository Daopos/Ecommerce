<?php
require 'connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">

</head>

<body>
    <div>
        <div class="login-container">
            <img src="../customer/photos/logo.png" alt="" width="200px">
            <h1>Admin Side</h1>
            <h1 class="login">Login</h1>

            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <input name="email" class="fix" type="text" placeholder="Email">
                <input name="password" class="fix" type="password" placeholder="Password">
                <input name="login" type="submit" value="Login">

            </form>
        </div>
    </div>
    <?php if (isset($_GET['test']) && $_GET['test'] === 'true') {
        echo '<script type="text/javascript">toastr.error("Invalid Credentials!")</script>';
    } ?>
    <?php


    if (isset($_POST["login"])) {
        session_start();

        $email = isset($_POST['email']) ? filter_input(INPUT_POST, "email",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $query = "SELECT * FROM admin WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $validEmail = isset($row['email']) ? $row['email'] : '';
        $validPassword = isset($row['password']) ? $row['password'] : '';

        if ($email == $validEmail && $password == $validPassword) {
            header("Location: http://localhost/ecommerce/admin/admindashboard.php");

            $_SESSION["idont"] = $id;
            exit();
        } else {
            header("Location: http://localhost/ecommerce/admin/adminlogin.php?test=true");
            exit();
        }
    }
    ?>
</body>

</html>