<?php
require 'connect.php';

$getpending = "SELECT COUNT(*) AS total_rows FROM confirmation";
$pending = mysqli_query($connect, $getpending);
$rowq = mysqli_fetch_assoc($pending);
$totalpending = $rowq['total_rows'];

$getshipped = "SELECT COUNT(*) AS total_rows FROM shipped WHERE is_ship = false";
$shipped = mysqli_query($connect, $getshipped);
$roww = mysqli_fetch_assoc($shipped);
$totalshipped = $roww['total_rows'];

$getcomplete = "SELECT COUNT(*) AS total_rows FROM shipped  WHERE is_ship = true";
$complete = mysqli_query($connect, $getcomplete);
$rowe = mysqli_fetch_assoc($complete);
$totalcomplete = $rowe['total_rows'];

$getcost = "SELECT SUM(total_cost) AS total_sum FROM shipped WHERE is_ship = true";
$total = mysqli_query($connect, $getcost);
$rowes = mysqli_fetch_assoc($total);
$totalcost = $rowes['total_sum'];

$getcustomer = "SELECT COUNT(*) AS total_sum FROM customer";
$cust = mysqli_query($connect, $getcustomer);
$rowese = mysqli_fetch_assoc($cust);
$totalcustomer = $rowese['total_sum'];


$getproducts = "SELECT COUNT(*) AS total_rows FROM products";
$prodductsnum = mysqli_query($connect, $getproducts);
$rowqq = mysqli_fetch_assoc($prodductsnum);
$totalproducts = $rowqq['total_rows'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./style/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'navigation.php';
    ?>

    <div class="dashboard-container">
        <a href="pending.php">
            <div class="box-dash">
                <h1>Pending Order</h1>
                <h1><?php echo $totalpending ?></h1>
            </div>
        </a>

        <a href="shipped.php">
            <div class="box-dash">
                <h1>Shipped</h1>
                <h1><?php echo $totalshipped ?></h1>
            </div>
        </a>

        <a href="completed.php">
            <div class="box-dash">
                <h1>Order Completed</h1>
                <h1><?php echo $totalcomplete ?></h1>
            </div>
        </a>

        <a href="products.php">
            <div class="box-dash">
                <h1>Total Products</h1>
                <h1><?php echo $totalproducts ?></h1>
            </div>
        </a>

        <div class="box-dash">
            <h1>Total Sales</h1>
            <h1><?php echo $totalcost ?></h1>
        </div>


        <div class="box-dash">
            <h1>Total Customer</h1>
            <h1><?php echo $totalcustomer ?></h1>
        </div>




    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>