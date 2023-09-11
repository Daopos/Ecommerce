<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men Shoes</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/men.css?v=2">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
    <?php include("navigation.php"); ?>

    <div class="shoes-container">
        <div class="shoes-header">
            <h2>Men</h2>
            <div></div>
        </div>
        <div class="men-container">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $itemsPerPage = 8;

            $offset = ($page - 1) * $itemsPerPage;

            $sqlCount = "SELECT COUNT(*) AS total FROM products WHERE gender = 'men' OR gender = 'unisex'";
            $countResult = mysqli_query($connect, $sqlCount);
            $row = mysqli_fetch_assoc($countResult);
            $totalItems = $row['total'];

            $totalPages = ceil($totalItems / $itemsPerPage);

            $sqlQuery = "SELECT * FROM products WHERE gender = 'men' OR gender = 'unisex' LIMIT $offset, $itemsPerPage";
            $query = mysqli_query($connect, $sqlQuery);

            while ($row = mysqli_fetch_array($query)) {
                echo '<a href="shoes.php?id=' . $row['id'] . '">
        <div class="shoes-item">
            <img src="../admin/uploads/' . $row['image'] . '" alt="" width="300px">
            <h2>' . $row['brand_name'] . '</h2>
            <h2>' . $row['shoe_name'] . '</h2>
            <h2>₱' . $row['shoe_price'] . '</h2>
        </div>
    </a>';
            }
            echo '</div>';

            echo '<div class="pagination">';
            echo '<ul class="pagination-list">';

            $visiblePages = 5;
            $halfVisible = floor($visiblePages / 2);
            $startPage = max(1, $page - $halfVisible);
            $endPage = min($startPage + $visiblePages - 1, $totalPages);
            $startPage = max(1, $endPage - $visiblePages + 1);

            if ($startPage > 1) {
                echo '<li><a href="?page=' . ($startPage - 1) . '">&#8249;</a></li>';
            }

            for ($i = $startPage; $i <= $endPage; $i++) {
                $activeClass = ($i == $page) ? 'active' : '';
                echo '<li><a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a></li>';
            }

            if ($endPage < $totalPages) {
                echo '<li><a href="?page=' . ($endPage + 1) . '">&#8250;</a></li>';
            }

            echo '</ul>';
            echo '</div>';
            ?>
        </div>
    </div>

</body>

</html>