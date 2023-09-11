<?php
require 'connect.php';
ob_start();

$id = $_GET['id'];


$sqls = "SELECT * FROM products WHERE id = '$id'";
$results = mysqli_query($connect, $sqls);
$rows = mysqli_fetch_assoc($results);
$item = $rows['image'];
$sn = $rows['shoe_name'];
$sp = $rows['shoe_price'];
$ss = $rows['shoe_size'];
$sc = $rows['shoe_color'];
$fee = $rows['shipfee'];

$total =  $sp + $fee;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/orderdetails.css?v=2">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'navigation.php';
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }


    $idemail = isset($_SESSION["username"]) ? $_SESSION["username"] : null;

    $sql = "SELECT * FROM customer WHERE email = '$idemail'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    $customer_id = $row['id'];
    $email = $row['email'];
    $country = $row['country'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $postalcode = $row['postalcode'];
    $city = $row['city'];
    $region = $row['region'];
    $phone = $row['phone_number'];
    $address = $row['address'];
    $method = $row['method'];
    $totalcost = $row['total_cost'];

    $fullname = $firstname . ' ' . $lastname;

    ?>
    <div class="order-container">
        <div class="order-first-container">

            <div class="order-list ">
                <ul>
                    <li>CART</li>
                    <li>INFORMATION</li>
                    <li style="font-weight: bold;">DETAIL</li>
                </ul>
            </div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <div class="detail-container">
                    <!-- <span class="input-prefix" for="Name">Name</span> -->
                    <input name="Name" type="text" value="<?php echo $fullname ?>" disabled>
                    <!-- <span class=" input-prefix2" for="test">Contact</span> -->
                    <input name="test" type="text" value="<?php echo $email ?>" disabled>
                    <!-- <span class="input-prefix3" for="Name">Ship to</span> -->
                    <input type="text" value="<?php echo $address ?>" disabled>
                    <!-- <span class="input-prefix4" for="Name">Method</span> -->
                    <input type="text" value="<?php echo $method ?>" disabled>
                    <!-- <span class="input-prefix5" for="Name">Phone</span> -->
                    <input type="text" value="<?php echo $phone ?>" disabled>
                </div>
                <div class="order-return-container">
                    <a href="<?php echo "orderdetails.php?id=" . $id ?>" style="text-decoration: none; color: inherit;"><i class="fa-solid fa-angle-left fa-xl"></i><span>Return to information</span></a>
                    <button name="submit">Complete Order</button>
                </div>
            </form>

            <?php

            if (isset($_POST['submit'])) {

                $query = "INSERT INTO confirmation(customer_id, shoe_id, total_cost, name, email, address, method,phone, image, shoe_name, shoe_color, shoe_size) VALUES 
                ('$customer_id', '$id', '$total', '$fullname','$email', '$address', '$method', '$phone', '$item', '$sn', '$sc' , '$ss')";
                $results = mysqli_query($connect, $query);

                $deletecart = "DELETE FROM cart WHERE customer_id = $customer_id  AND  shoe_id = $id";
                $delete = mysqli_query($connect, $deletecart);

                header("Location: http://localhost/ecommerce/customer/mypurchase.php?success=true");
                ob_end_clean();

                exit();
            }


            ?>

        </div>
        <div class="order-second-container">
            <div class="order-second-test">
                <div>
                    <h2 class="align-centers">Order Details</h2>
                </div>
                <div class="order-second-details">
                    <div>
                        <img src="../admin/uploads/<?php echo $item ?>" alt="" width="300px">
                    </div>
                    <div>
                        <h2><?php echo $sn ?></h2>
                        <div class="size-price">
                            <h3>Size <?php echo $ss ?></h3>
                            <h2>₱<?php echo $sp ?></h2>
                        </div>
                    </div>
                </div>
                <div class="bottom-second">
                    <h3>Shipping</h3>
                    <h3><?php echo $fee ?></h3>
                </div>
                <div class="bottom-second">
                    <h2>Total</h2>
                    <h2>₱<?php echo $total ?></h2>
                </div>
            </div>
        </div>
    </div>
</body>

</html>