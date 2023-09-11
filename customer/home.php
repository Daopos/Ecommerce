<?php
require 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./style/style.css?v=2">
    <link rel="stylesheet" href="./style/homes.css?v=2">
    <link rel="stylesheet" href="./style/men.css?v=2">
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
    <?php include("navigation.php"); ?>
    <div class="shoes-of-quality">
        <div>
            <h1>Shoes of the</h1>
            <h1>Best Quality</h1>
        </div>
        <div class="para">
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
                luctus nec ullamcorper mattis, pulvinar dapibus leo .</h4>
        </div>
        <div class="shopcollect">
            <a href="#test1">Shop Collection</a>
        </div>

    </div>
    <div class="best-offer">
        <h1 id="test1">Best Offer Shoes</h1>
        <div class="carousel">
            <div class="slides-container">
                <div class="slide">
                    <?php



                    $one = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
                    $two = mysqli_query($connect, $one);

                    while ($row = mysqli_fetch_array($two)) {
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
                    ?>
                </div>

                <div class="slide">
                    <?php



                    $one = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
                    $two = mysqli_query($connect, $one);

                    while ($row = mysqli_fetch_array($two)) {
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
                    ?>
                </div>
                <div class="slide">
                    <?php



                    $three = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
                    $four = mysqli_query($connect, $three);

                    while ($row = mysqli_fetch_array($four)) {
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
                    ?>
                </div>
            </div>
            <button class="prev-button">&lt;</button>
            <button class="next-button">&gt;</button>
        </div>

    </div>
    <div class="twopic">
        <div class="boycontainer">
            <img class="boysit" src="./photos/boysit.jpg" alt="">
            <h2>The base collection - ideal</h2>
            <h2>every day.</h2>
            <a href="buyshoes.php">Shop Now</a>
        </div>
        <div class="girlcontainer">
            <img class="girlsit" src="./photos/girlset.png" alt="">
        </div>
    </div>
    <div class="collection">
        <h3>NEW COLLECTION</h3>
        <div>
            <h1>Be different in your own way!</h1>
            <h2>Find your unique style.</h2>
        </div>

        <a href="#test1">Shop collection</a>
    </div>
    <div class="explore">
        <div class="exploreone">
            <img src="./photos/nkes.jpg" alt="">
            <img src="./photos/vans.jpg" alt="">
        </div>
        <div class="exploretwo">
            <div>
                <h1>Explore our</h1>
                <h1>Latest Collections</h1>
            </div>
            <div>
                <h4>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Ut elit tellus, luctus nec ullamcorper
                    mattis, pulvinar dapibus leo.</h4>
            </div>
            <div>
                <h4>Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Ut elit tellus, luctus nec ullamcorper
                    mattis, pulvinar dapibus leo.</h4>
            </div>
            <div>
                <a href="buyshoes.php">Shop Now</a>
            </div>
        </div>

    </div>
    <div class="threepic">
        <img src="./photos/white.jpg" alt="">
        <img src="./photos/pata.png" alt="">
        <img src="./photos//rebok.jpg" alt="">
    </div>
    <div class="footer">
        <div>
            <h2>Foot Ready</h2>
            <h4>Shoe Shop</h4>
        </div>
        <div class="midfoot">
            <h3>About Us</h3>
            <h4>Street lifestyle store that houses the most
                sought after sneaker brands like Nike, adidas,
                New Balance, Asics, Puma and more.</h4>
        </div>
        <div>
            <h1>Shop</h1>
            <a href="buyshoes.php">Buy Shoe</a>
            <a href="women.php">Women</a>
            <a href="men.php">Men</a>
        </div>
    </div>

    <?php if (isset($_GET['from_signup']) && $_GET['from_signup'] === 'true') {
        echo '<script type="text/javascript">toastr.success("Welcome New User!")</script>';
    } ?>
    <script>
        // Function to initialize the carousel
        function initializeCarousel() {
            const carousel = document.querySelector('.carousel');
            const slidesContainer = carousel.querySelector('.slides-container');
            const slides = Array.from(slidesContainer.querySelectorAll('.slide'));
            const prevButton = carousel.querySelector('.prev-button');
            const nextButton = carousel.querySelector('.next-button');

            let slideIndex = 0;

            // Show the initial slide
            showSlide();

            // Function to show a specific slide
            function showSlide() {
                slidesContainer.style.transform = `translateX(-${slideIndex * 100}%)`;
            }

            // Event listeners for prev and next buttons
            prevButton.addEventListener('click', () => {
                slideIndex = (slideIndex - 1 + slides.length) % slides.length;
                showSlide();
            });

            nextButton.addEventListener('click', () => {
                slideIndex = (slideIndex + 1) % slides.length;
                showSlide();
            });
        }

        // Call the initializeCarousel function when the DOM is ready
        document.addEventListener('DOMContentLoaded', initializeCarousel);
    </script>
</body>

</html>