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

    $email = $row['email'];
    $country = $row['country'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $postalcode = $row['postalcode'];
    $city = $row['city'];
    $region = $row['region'];
    $phone = $row['phone_number'];
    $address = $row['address'];


    ?>
    <div class="order-container">
        <div class="order-first-container">

            <div class="order-list ">
                <ul>
                    <li>CART</li>
                    <li style="font-weight: bold;">INFORMATION</li>
                    <li>DETAIL</li>
                </ul>
            </div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <div class="order-contact-container">
                    <label for="email">Contact information</label>
                    <input class="inputtest" name="email" type="email" placeholder="Email" value="<?php echo $email ?>" required>
                </div>
                <div class="order-delivery-container">
                    <label for="deliverymethod">Delivery Method</label>
                    <div class="order-delivery-test">
                        <input name="delivery" type="radio" value="cash" checked required>
                        <i class="fa-solid fa-truck fa-lg"></i><span>Cash on delivery</span>
                    </div>
                    <div class="order-delivery-test">
                        <input name="delivery" type="radio">
                        <i class="fa-solid fa-credit-card fa-lg"></i><span>Payment Center/ E-Wallet</span></i>
                    </div>
                </div>
                <div class="order-shipping-container">
                    <label>Shipping Address</label>
                    <input name="region" class="inputtest" type="text" placeholder="Region" value="<?php echo $region ?>" required>
                    <!-- <input name="country" class="inputtest" type="text" placeholder="Country/Region" value="<?php echo $country ?>" required> -->
                    <div class="order-shipping-another">
                        <input name="fname" class=" inputtest" type="text" placeholder="First Name" value="<?php echo $firstname ?>" required>
                        <input name="lname" class="inputtest" type="text" placeholder="Last Name" value="<?php echo $lastname ?>" required>
                    </div>
                    <input name="address" class=" inputtest" type="text" placeholder="Address" value="<?php echo $address ?>" required>
                    <!-- <div class="order-shipping-another">
                        <input name="postal" class="inputtest" type="text" placeholder="postal Code" value="<?php echo $postalcode ?>" required>
                        <input name="city" class="inputtest" type="text" placeholder="City" value="<?php echo $city ?>" required>
                    </div> -->
                    <input name="phone" class="inputtest" type="text" placeholder="Phone" value="<?php echo $phone ?>" required>

                    <div class="order-return-container">
                        <a href="<?php echo "cart.php" ?>" style="text-decoration: none; color: inherit;"><i class="fa-solid fa-angle-left fa-xl"></i><span>Return Cart</span></a>
                        <button name="submit">Place order</button>
                    </div>
                </div>
            </form>

            <?php

            if (isset($_POST['submit'])) {
                $femail = isset($_POST['email']) ? $_POST['email'] : '';
                $fcountry = isset($_POST['country']) ? $_POST['country'] : '';
                $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
                $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
                $add = isset($_POST['address']) ? $_POST['address'] : '';
                $pos = isset($_POST['postal']) ? $_POST['postal'] : '';
                $fcity = isset($_POST['city']) ? $_POST['city'] : '';
                $fregion = isset($_POST['region']) ? $_POST['region'] : '';
                $fphone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $selectmethod = $_POST['delivery'] ? $_POST['delivery'] : '';
                $change = "UPDATE customer SET email = '$femail', country = '$fcountry', firstname = '$fname', lastname = '$lname', address = '$add', postalcode = '$pos', city = '$fcity', region = '$fregion', phone_number = '$fphone', method = '$selectmethod' WHERE email = '$idemail'";
                $changes = mysqli_query($connect, $change);


                header("Location: http://localhost/ecommerce/customer/orderinfo.php?id=" . $id);
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
                            <h2>P<?php echo $sp ?></h2>
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