<?php

session_start();
if (!isset($_SESSION["idont"])) {
    header("location: adminlogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/navigation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="nav-prof">
        <img src="../customer/photos/logo.png" alt="" width="150px">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <input name="logout" type="submit" value="Logout">

        </form>
    </nav>
    <nav class="nav-dash">
        <ul class="nav-list">
            <li><a href="./admindashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="./products.php"><i class="fa-brands fa-product-hunt"></i>Products</a></li>
            <li><a href="./pending.php"><i class="fa-solid fa-clock"></i>Orders</a></li>
            <li><a href="./shipped.php"><i class="fa-solid fa-truck"></i>Shipped</a></li>

            <li><a href="./completed.php"><i class="fa-solid fa-truck-ramp-box"></i>Completed</a></li>

            <!-- <li><a href=""><i class="fa-solid fa-users"></i>Customers</a></li> -->
        </ul>
    </nav>

    <?php

    if (isset($_POST["logout"])) {
        session_destroy();

        header("Location: adminlogin.php");
        exit();
        ob_end_clean();
    }


    ?>
</body>

</html>