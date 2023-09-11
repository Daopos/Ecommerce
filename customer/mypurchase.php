<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPurchase</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/mypurchase.css?v=2">
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
    <?php include("navigation.php"); ?>
    <?php
    ob_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
    require 'connect.php';


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
    <div class="account-pur-container">
        <h1 class="test">MyPurchase</h1>
        <div class="purchase-container">
            <div class="a-list">
                <a href="mypurchase.php" style="background-color: black; color: white; border-radius: 8px; padding:3px;">Preparing</a>
                <a href="shipped.php">Shipped</a>
                <a href="allorder.php">All Order</a>
            </div>
            <div class="overflow-container">
                <?php

                $sql = "SELECT * FROM confirmation WHERE customer_id = $ids";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) {


                    echo '
<div class="shoes-container">
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
<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">
<input name="id" type="hidden" value="' . $row['id'] . '">
<input name="cancel" class="inputs" type="submit" value="Cancel">
</form>
</div>
';
                }
                ?>

                <?php

                if (isset($_POST["cancel"])) {

                    $ids = $_POST['id'];

                    $delete = "DELETE FROM confirmation WHERE id = $ids";

                    $test = mysqli_query($connect, $delete);

                    header("Location: http://localhost/ecommerce/customer/mypurchase.php?cancel=true");
                }

                ?>

                <?php if (isset($_GET['success']) && $_GET['success'] === 'true') {
                    echo '<script type="text/javascript">toastr.success("Successfully Order!")</script>';
                }
                if (isset($_GET['cancel']) && $_GET['cancel'] === 'true') {
                    echo '<script type="text/javascript">toastr.warning("Cancel Order!")</script>';
                } ?>
            </div>

        </div>
    </div>
    </div>
</body>

</html>