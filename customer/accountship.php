<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/account.css?v=2">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php include("navigation.php"); ?>
    <?php
    require 'connect.php';

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
    $id = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
    $ids = isset($_SESSION["customer_id"]) ? $_SESSION["customer_id"] : null;

    $name = '';
    $email = '';
    $phone = '';
    $address = '';

    $sqltest = "SELECT * FROM customer WHERE email = '$id'";
    $query = mysqli_query($connect, $sqltest);
    while ($row = mysqli_fetch_array($query)) {
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone_number'];
        $address = $row['address'];
    }
    ?>
    <div class="account-container">
        <div class="account-my-container">
            <h1>My Account</h1>
            <label for="name">Name</label>
            <input type="text" value="<?php echo $name ?>" disabled>
            <label for="email">Email</label>
            <input type="text" disabled value="<?php echo $email ?>">
            <label for="phone">Phone</label>
            <input type="text" value="<?php echo $phone ?>" disabled>
            <label for="address">Address</label>
            <input type="text" value="<?php echo $address ?>" disabled>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <input name="logout" type="submit" value="Log out" class="acc-logout">
            </form>
        </div>
        <div class="account-pur-container">
            <a href="mypurchase.php" style="text-decoration: none; color:inherit">
                <h1>MyPurchase</h1>
            </a>
            <div class="purchase-container">
                <div class="a-list">
                    <a href="account.php">Preparing</a>
                    <a href="accountship.php" style="background-color: black; color: white; border-radius: 8px; padding:3px;">Shipped</a>
                    <a href="accountallorder.php">All Order</a>
                </div>
                <div class="overflow-container">
                    <?php

                    $sql = "SELECT * FROM shipped WHERE customer_id = $ids AND is_ship = false";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_array($result)) {


                        echo '
    <div class="shoes-container-ship">
    <div class="pic-container">
        <img src="../admin/uploads/' . $row['image'] . '" alt="">
    </div>
    <div class="text-container">
        <h3>' . $row['shoe_name'] . '</h3>
        <h5>' . $row['shoe_color'] . '</h5>
        <h5>Size: ' . $row['shoe_size'] . '</h5>
        <h4>₱' . $row['total_cost'] . '</h4>
    </div>
</div>
<div class="input-container">
    
</div>
    ';
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <?php

    if (isset($_POST["logout"])) {
        session_destroy();

        header("Location: login.php");
        exit();
    }


    ?>

</body>

</html>