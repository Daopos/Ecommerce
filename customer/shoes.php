<?php
require 'connect.php';
ob_start();
$id = $_GET['id'];



$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$item = $row['image'];
$item1 = $row['image1'];
$item2 = $row['image2'];
$item3 = $row['image3'];
$item4 = $row['image4'];

$bn = $row['brand_name'];
$sn = $row['shoe_name'];
$sc = $row['shoe_color'];
$sp = $row['shoe_price'];
$ss = $row['shoe_size'];
$sd = $row['shoe_description'];
$im = $row['image'];
$gen = $row['gender'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/shoes.css">
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
    <?php include("navigation.php");
    $customerid = isset($_SESSION["customer_id"]) ? $_SESSION["customer_id"] : "null";

    ?>
    <div class="shoe-container">
        <div class="shoes-first-container">
            <div class="four-photos">
                <img src="<?php echo '../admin/uploads/' . $item1; ?>" alt="">
                <img src="<?php echo '../admin/uploads/' . $item2; ?>" alt="">
                <img src="<?php echo '../admin/uploads/' . $item3; ?>" alt="">
                <img src="<?php echo '../admin/uploads/' . $item4; ?>" alt="">
            </div>
            <div class="main-photo">
                <img src="<?php echo '../admin/uploads/' . $item; ?>" alt="">
            </div>
            <div class="shoes-text">
                <h2><?php echo $bn ?></h2>
                <h2><?php echo $sn ?></h2>
                <h2><?php echo $sc ?></h2>
                <h2>For: <?php echo $gen ?></h2>
                <h2>₱<?php echo $sp ?></h2>
                <h2>Size: <?php echo $ss ?></h2>
                <hr style="border: 1px solid black">
                <div class="shoes-button">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id ?>" method="POST">
                        <button type="submit" name="<?php echo $customerid == "null" ? 'cancel' : 'submit' ?>"><i class="fa-solid fa-cart-shopping fa-lg"></i>Add to Cart</button>
                        <a class="tobuy" href="<?php echo $customerid == "null" ? 'signup.php' : 'orderdetails.php?id=' . $id; ?>" style="margin-left: 10px;">Buy Now</a>
                    </form>
                </div>
                <div class="desc-container">
                    <p><?php echo $sd ?></p>
                </div>
            </div>
        </div>
        <h1 class="related">Related Products</h1>
        <div class="shoes-second-container">
            <?php
            $user_id = $_GET['id'];
            $sqltest = "SELECT * FROM products WHERE id <> $id ORDER BY RAND() LIMIT 4";
            $query = mysqli_query($connect, $sqltest);
            while ($row = mysqli_fetch_array($query)) {
                echo '<a class="fix-a" href="shoes.php?id=' . $row['id'] . '">
        <div class="shoes-item">
            <img src="../admin/uploads/' . $row['image'] . '" alt="" width="300px">
            <h2>' . $row['brand_name'] . '</h2>
            <h2>' . $row['shoe_name'] . '</h2>
            <h2>₱' . $row['shoe_price'] . '</h2>
        </div>
    </a>';
            }
            ?>
        </div>
    </div>

    <?php


    if (isset($_POST['submit'])) {
        $addtocart = "INSERT INTO cart (shoe_id, customer_id)
        SELECT $id, $customerid
        WHERE NOT EXISTS (
          SELECT 1 FROM cart WHERE shoe_id = $id AND customer_id = $customerid
        );";
        $check = mysqli_query($connect, $addtocart);

        $isadded = true;

        header("Location: http://localhost/ecommerce/customer/shoes.php?id=" . $id . "&isadded=true");
        ob_end_clean();
        exit(); // It's good practice to exit after a header redirection
    }

    if (isset($_POST['cancel'])) {

        header("Location: http://localhost/ecommerce/customer/signup.php");
        ob_end_clean();
        exit(); // It's good practice to exit after a header redirection
    }

    ?>
    <?php if (isset($_GET['isadded']) && $_GET['isadded'] === 'true') {
        echo '<script type="text/javascript">toastr.success("Added To Cart!")</script>';
    } ?>

</body>

</html>