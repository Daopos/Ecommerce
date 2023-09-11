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


    $getpending = "SELECT COUNT(*) AS total_rows FROM confirmation";
    $pending = mysqli_query($connect, $getpending);
    $rowq = mysqli_fetch_assoc($pending);
    $totalpending = $rowq['total_rows'];

    if ($totalpending <= 0) {
        echo '<h1 style="text-align: center; margin-top:50px;">No Orders Yet!</h1>';
    }

    ?>

    <div class="purchase-container">

        <div class="purchase-container">

            <?php
            $results_per_page = 8; // Number of results per page
            $sql = "SELECT COUNT(*) AS total FROM confirmation";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $total_results = $row['total'];
            $total_pages = ceil($total_results / $results_per_page); // Calculate total number of pages

            // Check if "page" parameter is provided in the URL, otherwise set it to the first page
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $start_index = ($current_page - 1) * $results_per_page; // Calculate the starting index for the results in the database

            $sql = "SELECT * FROM confirmation LIMIT $start_index, $results_per_page";
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
            <h3>ORDER BY</h3>
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
        $customer = $_POST['customer'];
        $shoe = $_POST['shoe'];
        $im = $_POST['image'];
        $sn = $_POST['shoename'];
        $sc = $_POST['shoecolor'];
        $ss = $_POST['size'];
        $tl = $_POST['total'];
        $nam = $_POST['name'];
        $em = $_POST['email'];
        $add = $_POST['address'];
        $meth = $_POST['method'];
        $ph = $_POST['phone'];

        $query = "INSERT INTO shipped(customer_id, shoe_id, total_cost, name, email, address, method,phone, image, shoe_name, shoe_color, shoe_size) VALUES 
                ('$customer', '$shoe', '$tl', '$nam','$em', '$add', '$meth', '$ph', '$im', '$sn', '$sc' , '$ss')";
        $results = mysqli_query($connect, $query);

        $deletes = "DELETE FROM confirmation WHERE id = $id";

        $tests = mysqli_query($connect, $deletes);

        $qw = "DELETE FROM confirmation WHERE shoe_id = $shoe";

        $qwe = mysqli_query($connect, $qw);

        $deleteshoe = "DELETE FROM products WHERE id = $shoe";

        $testss = mysqli_query($connect, $deleteshoe);


        $deletecart = "DELETE FROM cart WHERE shoe_id = $shoe";

        $cartsss = mysqli_query($connect, $deletecart);


        header("Location: http://localhost/ecommerce/admin/pending.php?confirm=true");
        ob_end_clean();
        exit;
    }

    if (isset($_POST["cancel"])) {

        $ids = $_POST['id'];

        $delete = "DELETE FROM confirmation WHERE id = $ids";

        $test = mysqli_query($connect, $delete);

        header("Location: http://localhost/ecommerce/admin/pending.php?cancel=true");
        ob_end_clean();

        exit;
    }

    ?>
    <?php
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        echo '<script type="text/javascript">toastr.success("Succesfully Confirm!")</script>';
    }

    if (isset($_GET['cancel']) && $_GET['cancel'] === 'true') {
        echo '<script type="text/javascript">toastr.info("Cancel Order!")</script>';
    }

    ?>
</body>

</html>