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
</head>

<body>
    <?php
    include 'navigation.php';
    ?>
    <div class="purchase-container">

        <?php
        // Pagination configuration
        $records_per_page = 10;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $records_per_page;

        // Fetch records with pagination
        $sql = "SELECT * FROM shipped WHERE is_ship = true LIMIT $offset, $records_per_page";
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
            <img src="../admin/uploads/' .  $row['image']  . '" alt="">
        </div>
        <div class="text-container">
            <h5>' . $row['shoe_name'] . ' </h5>
            <h5>' . $row['shoe_color'] . '</h5>
            <h5>Size: ' . $row['shoe_size'] . '</h5>
            <h4>₱' . $row['total_cost'] . '</h4>
        </div>
    </div>
    <div class="orderby">
        <h3>Received by</h3>
        <h6>Name: ' . $row['name'] . '</h6>
        <h6>Contact: ' . $row['email'] . '</h6>
        <h6>Ship to: ' . $row['address'] . '</h6>
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
        </form>
    </div>
</div>
';
        }


        ?>

    </div>
    <?php
    // Pagination links
    $total_pages_sql = "SELECT COUNT(*) as count FROM shipped WHERE is_ship = true";
    $result = mysqli_query($connect, $total_pages_sql);
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row['count'] / $records_per_page);

    echo '<div class="pagination" style="display: block; text-align: center;  margin-bottom: 30px">';
    for ($page = 1; $page <= $total_pages; $page++) {
        echo '<a href="?page=' . $page . '">' . $page . '</a>';
    }
    echo '</div>';
    ?>
</body>

</html>