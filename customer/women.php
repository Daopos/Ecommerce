<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women Shoes</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/men.css?v=2">
    <link rel="icon" type="image/x-icon" href="./photos/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("navigation.php"); ?>

    <div class="shoes-container">
        <div class="shoes-header">
            <h2>Women</h2>
            <div></div>
        </div>
        <div class="men-container">
            <?php
            // Retrieve the current page number
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Define the number of items per page
            $itemsPerPage = 8;

            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $itemsPerPage;

            // Retrieve the total number of items
            $sqlCount = "SELECT COUNT(*) AS total FROM products WHERE gender = 'women' OR gender = 'unisex'";
            $countResult = mysqli_query($connect, $sqlCount);
            $row = mysqli_fetch_assoc($countResult);
            $totalItems = $row['total'];

            // Calculate the total number of pages
            $totalPages = ceil($totalItems / $itemsPerPage);

            // Generate the SQL query with the LIMIT clause
            $sqlQuery = "SELECT * FROM products WHERE gender = 'women' OR gender = 'unisex' LIMIT $offset, $itemsPerPage";
            $query = mysqli_query($connect, $sqlQuery);

            // Display the items on the current page
            while ($row = mysqli_fetch_array($query)) {
                // Display the items as before
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

            // Generate the pagination links
            echo '<div class="pagination">';
            echo '<ul class="pagination-list">';

            // Adjust the start and end page numbers for the carousel effect
            $visiblePages = 5;
            $halfVisible = floor($visiblePages / 2);
            $startPage = max(1, $page - $halfVisible);
            $endPage = min($startPage + $visiblePages - 1, $totalPages);
            $startPage = max(1, $endPage - $visiblePages + 1);

            // Display the previous page arrow
            if ($startPage > 1) {
                echo '<li><a href="?page=' . ($startPage - 1) . '">&#8249;</a></li>';
            }

            // Display the page numbers
            for ($i = $startPage; $i <= $endPage; $i++) {
                $activeClass = ($i == $page) ? 'active' : '';
                echo '<li><a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a></li>';
            }

            // Display the next page arrow
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

<!-- <div class="shoes-container">
        <div class="shoes-header">
            <h2>Women</h2>
            <div></div>
        </div>
        <div class="men-container">
            <?php
            // Retrieve the current page number
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Define the number of items per page
            $itemsPerPage = 12;

            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $itemsPerPage;

            // Retrieve the total number of items
            $sqlCount = "SELECT COUNT(*) AS total FROM products WHERE gender = 'women' OR gender = 'unisex'";
            $countResult = mysqli_query($connect, $sqlCount);
            $row = mysqli_fetch_assoc($countResult);
            $totalItems = $row['total'];

            // Calculate the total number of pages
            $totalPages = ceil($totalItems / $itemsPerPage);

            // Generate the SQL query with the LIMIT clause
            $sqlQuery = "SELECT * FROM products WHERE gender = 'women' OR gender = 'unisex' LIMIT $offset, $itemsPerPage";
            $query = mysqli_query($connect, $sqlQuery);

            // Display the items on the current page
            while ($row = mysqli_fetch_array($query)) {
                // Display the items as before
                echo '<a href="shoes.php?id=' . $row['id'] . '">
        <div class="shoes-item">
            <img src="../admin/uploads/' . $row['image'] . '" alt="" width="300px">
            <h2>' . $row['brand_name'] . '</h2>
            <h2>' . $row['shoe_name'] . '</h2>
            <h2>P' . $row['shoe_price'] . '</h2>
        </div>
    </a>';
            }
            echo '</div>';


            // Generate the pagination links
            echo '<div class="pagination">';
            echo '<ul class="pagination-list">';
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';
            ?>

        </div> -->