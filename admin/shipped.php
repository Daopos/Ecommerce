<?php
require 'connect.php';

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/pending.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
    <?php
    include 'navigation.php';
    ?>
    <?php


    $getshipped = "SELECT COUNT(*) AS total_rows FROM shipped WHERE is_ship = false";
    $shipped = mysqli_query($connect, $getshipped);
    $roww = mysqli_fetch_assoc($shipped);
    $totalshipped = $roww['total_rows'];

    if ($totalshipped <= 0) {
        echo '<h1 style="text-align: center; margin-top:50px;">No Delivered Yet!</h1>';
    }

    ?>
    <div class="purchase-container">

        <div class="purchase-container">

            <?php
            $results_per_page = 8; // Number of results per page
            $sql = "SELECT COUNT(*) AS total FROM shipped WHERE is_ship != true";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $total_results = $row['total'];
            $total_pages = ceil($total_results / $results_per_page); // Calculate total number of pages

            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $start_index = ($current_page - 1) * $results_per_page; // Calculate the starting index for the results in the database

            $sql = "SELECT * FROM shipped WHERE is_ship != true LIMIT $start_index, $results_per_page";
            $result = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_array($result)) {
                $image = $row['image'];
                $total = $row['total_cost'];
                $name = $row['name'];
                $email = $row['email'];
                $method = $row['method'];
                $phone = $row['phone'];
                $shoename = $row['shoe_name'];
                $color = $row['shoe_color'];
                $size = $row['shoe_size'];

                echo '
<div class="addborder">
<div class="shoes-container">
    <div class="pic-container">
        <img src="../admin/uploads/' . $row['image'] . '" alt="">
    </div>
    <div class="text-container">
        <h5>' . $row['shoe_name'] . ' </h5>
        <h5>' . $row['shoe_color'] . '</h5>
        <h5>Size: ' . $row['shoe_size'] . '</h5>
        <h4>₱' . $row['total_cost'] . '</h4>
    </div>
</div>
<div class="orderby">
    <h3>Ship To</h3>
    <h6>Name: ' . $row['name'] . '</h6>
    <h6>Contact: ' . $row['email'] . '</h6>
    <h6>Ship to ' . $row['address'] . '</h6>
    <h6>Method: ' . $row['method'] . '</h6>
    <h6>Phone Number: ' . $row['phone'] . '</h6>
</div>
<div class="input-container">
    <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">

        <input type="hidden" name="image" value="' . $row['image'] . '">
        <input type="hidden" name="shoename" value="' . $row['shoe_name'] . '">
        <input type="hidden" name="shoecolor" value="' . $row['shoe_color'] . '">
        <input type="hidden" name="size" value="' . $row['shoe_size'] . '">
        <input type="hidden" name="total" value="' . $row['total_cost'] . '">
        <input type="hidden" name="name" value="' . $row['name'] . '">
        <input type="hidden" name="email" value="' . $row['email'] . '">
        <input type="hidden" name="address" value="' . $row['address'] . '">
        <input type="hidden" name="method" value="' . $row['method'] . '">
        <input type="hidden" name="phone" value="' . $row['phone'] . '">
        <input type="hidden" name="customer" value="' . $row['customer_id'] . '">
        <input type="hidden" name="shoe" value="' . $row['shoe_id'] . '">
        <input type="hidden" name="id" value="' . $row['id'] . '">

        <input name="confirm" class="inputs" type="submit" value="Confirm">
        <input name="cancel" class="inputss" type="submit" value="Cancel">
    </form>
</div>
</div>
';
            }
            ?>
        </div>


    </div>
    <!-- Pagination -->
    <div class="pagination" style="display: block; text-align: center; margin: 0px auto; margin-top: -30px; margin-bottom: 50px; font-size: 18px">
        <?php
        for ($page = max(1, $current_page - 2); $page <= min($current_page + 2, $total_pages); $page++) {
            echo '<a href="?page=' . $page . '">' . $page . '</a>';
        }
        ?>
    </div>

    <?php

    if (isset($_POST["confirm"])) {

        $id = $_POST['id'];


        $query = "UPDATE shipped SET is_ship = true WHERE id = $id";
        $results = mysqli_query($connect, $query);

        $deletes = "DELETE FROM confirmation WHERE id = $id";
        $tests = mysqli_query($connect, $deletes);

        header("Location: http://localhost/ecommerce/admin/shipped.php?confirm=true");
        ob_end_clean();
        exit;
    }

    if (isset($_POST["cancel"])) {

        $ids = $_POST['id'];

        $delete = "DELETE FROM shipped WHERE id = $ids";

        $test = mysqli_query($connect, $delete);

        header("Location: http://localhost/ecommerce/admin/shipped.php?cancel=true");
        ob_end_clean();

        exit;
    }

    ?>

    <?php
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        echo '<script type="text/javascript">toastr.success("Succesfully Dilevered!")</script>';
    }

    if (isset($_GET['cancel']) && $_GET['cancel'] === 'true') {
        echo '<script type="text/javascript">toastr.info("Cancel Delivery!")</script>';
    } ?>
</body>

</html>