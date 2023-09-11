<div class="navbar">
    <div class="login-test">
        <ul class="login-navlist">
            <li><a href="buyshoes.php">Buy Shoes</a></li>
            <li><a href="men.php">Men</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
    </div>
    <div class="login-logo">
        <a href="home.php">
            <img src="photos/logo.png" alt="" width="160px">
        </a>
    </div>
    <div class="login-profile">
        <ul class="login-user">
            <?php
            session_start();
            $login = false;
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
                echo '
                <li><a href="signup.php"><i class="fa-solid fa-cart-shopping fa-lg"></i></a></li>
                ';
                $login = true;
            } else if (isset($_SESSION["loggedin"]) == true) {
                echo '
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping fa-lg"></i></a></li>
                ';
            }

            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
                echo '
                <li><a href="login.php"> LOG IN</a></li>
                ';
                $login = true;
            } else if (isset($_SESSION["loggedin"]) == true) {
            }
            ?>





            <li><a href="<?php echo $login == false ?  'account.php' : 'signup.php'; ?>"><i class="fa-regular fa-circle-user fa-xl"></i></a></li>
        </ul>
    </div>
</div>