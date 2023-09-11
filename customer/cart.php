<?php
require 'connect.php';
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/cart.css?v=2">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<html>

<body>
    <?php include("navigation.php");

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
    ?>



    <div class="shopping-cart-container">

        <h1>Your Shopping Cart</h1>
        <h3 class="smallx">items in your bag are not reserved - check out now to make them yours.</h3>

        <div class="cart-shoes">
            <?php
            $customerid = isset($_SESSION["customer_id"]) ? $_SESSION["customer_id"] : null;

            $sql = "SELECT * FROM products
    JOIN cart ON products.id = cart.shoe_id 
    AND cart.customer_id = $customerid";

            $query = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_array($query)) {
                echo '
        <div class="cart-shoes">
            <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">
                <div class="shoes-container">
                    <div class="pic-container">
                        <img src="../admin/uploads/' . $row['image'] . '" alt="">
                    </div>
                    <div class="text-container">
                        <h3>' . $row['shoe_name'] . '</h3>
                        <h5>' . $row['shoe_color'] . '</h5>
                        <h5>Size: ' . $row['shoe_size'] . '</h5>
                        <h4>₱' . $row['shoe_price'] . '</h4>
                        <a href="orderdetails.php?id=' . $row['shoe_id'] . '" class="fix-input">Checkout</a>
                    </div>
                    <input  name="getid" type="hidden" value="' . $row['cart_id'] . '">
                    <button name="cancel" class="x-button"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </form>
        </div>
    ';
            }
            ?>

            <?php
            if (isset($_POST["cancel"])) {

                $cart = $_POST['getid'];

                $delete = "DELETE FROM cart WHERE cart_id = '$cart'";
                mysqli_query($connect, $delete);
            }

            ?>


        </div>


    </div>

</body>

</html>