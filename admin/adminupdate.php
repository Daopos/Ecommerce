<?php
ob_start();
require 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $bn = null;
    $sn = null;
    $sc = null;
    $sp = null;
    $sd = null;
    $ss = null;
    $im = null;
    $gen = null;
    $im1 = null;
    $im2 = null;
    $im3 = null;
    $im4 = null;
    $fee = null;




    $sqltest = "SELECT * FROM products WHERE id = $id";
    $query = mysqli_query($connect, $sqltest);
    while ($row = mysqli_fetch_array($query)) {

        $bn = $row['brand_name'];
        $sn = $row['shoe_name'];
        $sc = $row['shoe_color'];
        $sp = $row['shoe_price'];
        $ss = $row['shoe_size'];
        $sd = $row['shoe_description'];
        $im = $row['image'];
        $gen = $row['gender'];
        $im = $row['image'];
        $im1 = $row['image1'];
        $im2 = $row['image2'];
        $im3 = $row['image3'];
        $im4 = $row['image4'];
        $fee = $row['shipfee'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/adminupdate.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
</head>

<body>
    <?php
    include 'navigation.php';
    ?>
    <h1 style="text-align: center; margin: 20px 0px;">Update Product</h1>
    <div class="shadow-box">

        <form enctype="multipart/form-data" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="addform">
            <div class="upload-container">

                <div class="three-input">
                    <div class="file-input">
                        <div class="fix-file">
                            <label class="label-upload" for="image">Main Photo</label>
                            <input class="color-input" type="file" name="image" id="file-input" class="file-input__input" accept="image/*" style="color:transparent; " />
                            <label for="image" id="file-name" class="label-upload"><?php echo $im ?></label>
                        </div>

                    </div>
                    <div class="file-input">
                        <div class="fix-file">
                            <label class="label-upload" for="image1">Photo 1</label>
                            <input type="file" name="image1" id="file-input1" class="file-input__input" accept="image/*" style="color:transparent; " />

                            <label for="image1" id="file-name1" class="label-upload"><?php echo $im1 ?></label>
                        </div>

                    </div>
                    <div class="file-input">
                        <div class="fix-file">
                            <label class="label-upload" for="">Photo 2</label>
                            <input type="file" name="image2" id="file-input2" class="file-input__input" accept="image/*" style="color:transparent; " />
                            <label for="image2" id="file-name2" class="label-upload"><?php echo $im2 ?></label>
                        </div>
                    </div>

                </div>

                <div class="two-input">
                    <div class="file-input">
                        <div class="fix-file">
                            <label class="label-upload" for="">Photo 3</label>
                            <input type="file" name="image3" id="file-input3" class="file-input__input" accept="image/*" style="color:transparent; " />
                            <label for="image3" id="file-name3" class="label-upload"><?php echo $im3 ?></label>
                        </div>

                    </div>
                    <div class="file-input">
                        <div class="fix-file">
                            <label class="label-upload" for="">Photo 4</label>
                            <input type="file" name="image4" id="file-input4" class="file-input__input" accept="image/*" style="color:transparent; " />
                            <label for="image4" id="file-name4" class="label-upload"><?php echo $im4 ?></label>
                        </div>
                    </div>
                </div>


            </div>

            <div class="inputs-s">
                <div class="fix-file">
                    <label for="">BrandName:</label>
                    <input name="brandname" type="text" placeholder="Brand Name" value="<?php echo $bn ?>">
                </div>
                <div class="fix-file">
                    <label for="">ShoeName:</label>
                    <input name="shoename" type="text" placeholder="Shoe Name" value="<?php echo $sn ?>">
                </div>
                <div class="fix-file">
                    <label for="">ShoeColor:</label>
                    <input name="shoecolor" type="text" placeholder="Shoe Color" value="<?php echo $sc ?>">

                </div>
                <div class="fix-file">
                    <label for="">ShoePrice:</label>
                    <input name="shoeprice" type="number" step="0.01" placeholder="Shoe price" value="<?php echo $sp ?>">

                </div>
                <div class="fix-file">
                    <label for="">ShoeSize:</label>
                    <input name="shoesize" type="text" placeholder="Shoe Size" value="<?php echo $ss ?>">

                </div>
                <div class="fix-file">
                    <label for="">ShippingFee:</label>
                    <input name="ship" type="number" step="0.001" placeholder="Shipping Fee" value="<?php echo $fee ?>">

                </div>
            </div>
            <div class="gender-input">
                <div class="fix-file">
                    <label for="">Gender:</label>
                    <select name="gender">
                        <option value="unisex " <?php if ($gen == "unisex") echo 'selected'; ?>>Unisex</option>
                        <option value="men" <?php if ($gen == "men") echo 'selected'; ?>>Men</option>
                        <option value="women" <?php if ($gen == "women") echo 'selected'; ?>>Women</option>
                    </select>
                </div>
            </div>
            <div class="upload-desc">
                <div class="fix-file">
                    <label for="">Description:</label>
                    <textarea name="description" id="" cols="50" rows="10" placeholder="Shoe Description" style="resize: none; padding: 10px;"><?php echo $sd ?></textarea>
                </div>
            </div>
            <div class="two-btn">
                <input class="fix-btn" type="submit" name="update" value="Update">
                <a href="products.php"><input class="fix-btns" type="button" value="Cancel"></a>
            </div>
        </form>
    </div>
    <?php

    if (isset($_POST['update'])) {


        $brandname = isset($_POST['brandname']) ? filter_input(INPUT_POST, "brandname",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $shoename = isset($_POST['shoename']) ? filter_input(INPUT_POST, "shoename",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $shoecolor = isset($_POST['shoecolor']) ? filter_input(INPUT_POST, "shoecolor",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $shoeprice = isset($_POST['shoeprice']) ? filter_input(INPUT_POST, "shoeprice",  FILTER_VALIDATE_FLOAT) : '';
        $shoesize = isset($_POST['shoesize']) ? filter_input(INPUT_POST, "shoesize",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $shoedescription = isset($_POST['description']) ? filter_input(INPUT_POST, "description",  FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';

        $shipfee = isset($_POST['ship']) ? filter_input(INPUT_POST, "ship",  FILTER_VALIDATE_FLOAT) : '';


        $image = $im;
        $gender = isset($_POST['brandname']) ? $_POST['gender'] : '';
        $filteredDecimal = number_format($shoeprice, 2, '.', '');
        $image1 = $im1;
        $image2 = $im2;
        $image3 = $im3;
        $image4 = $im4;




        if (isset($_FILES["image"])) {

            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if ($error === 0) {

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png", "webp");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $image = $new_img_name;
                } else {
                    // unknow error
                }
            }


            if (isset($_FILES["image1"])) {

                $img_name = $_FILES['image1']['name'];
                $img_size = $_FILES['image1']['size'];
                $tmp_name = $_FILES['image1']['tmp_name'];
                $tmp_name = $_FILES['image1']['tmp_name'];
                $error = $_FILES['image1']['error'];

                if ($error === 0) {

                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png", "webp");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $image1 = $new_img_name;
                    } else {
                        // unknow error
                    }
                }
            }

            if (isset($_FILES["image2"])) {

                $img_name = $_FILES['image2']['name'];
                $img_size = $_FILES['image2']['size'];
                $tmp_name = $_FILES['image2']['tmp_name'];
                $tmp_name = $_FILES['image2']['tmp_name'];
                $error = $_FILES['image2']['error'];

                if ($error === 0) {

                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png", "webp");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $image2 = $new_img_name;
                    } else {
                        // unknow error
                    }
                }
            }
            if (isset($_FILES["image3"])) {

                $img_name = $_FILES['image3']['name'];
                $img_size = $_FILES['image3']['size'];
                $tmp_name = $_FILES['image3']['tmp_name'];
                $tmp_name = $_FILES['image3']['tmp_name'];
                $error = $_FILES['image3']['error'];

                if ($error === 0) {

                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png", "webp");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $image3 = $new_img_name;
                    } else {
                        // unknow error
                    }
                }
            }
            if (isset($_FILES["image4"])) {

                $img_name = $_FILES['image4']['name'];
                $img_size = $_FILES['image4']['size'];
                $tmp_name = $_FILES['image4']['tmp_name'];
                $tmp_name = $_FILES['image4']['tmp_name'];
                $error = $_FILES['image4']['error'];

                if ($error === 0) {

                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png", "webp");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $image4 = $new_img_name;
                    } else {
                        // unknow error
                    }
                }
            }


            // $sqltest = "SELECT * FROM admin";
            // $query = mysqli_query($connect, $sqltest);
            // while ($row = mysqli_fetch_array($query)) {
            //   $imagePath = htmlspecialchars($row['photo']);
            //   echo '<img src="uploads/' .  $imagePath . '" alt="Uploaded Image">';
            //   echo "<br>";
            // }
        }
        $sql = "UPDATE products SET brand_name = '$brandname', shoe_name = '$shoename' , shoe_color = '$shoecolor', shoe_price = '$shoeprice', shoe_size = '$shoesize', shoe_description = '$shoedescription', image = '$image', gender = '$gender', image1 ='$image1', image2 = '$image2', image3 = '$image3', image4 = '$image4', shipfee = '$shipfee' WHERE id = $id";
        $checkQuery = mysqli_query($connect, $sql);

        echo $brandname;

        header("Location: http://localhost/ecommerce/admin/products.php?updated=true");
        ob_end_clean();
        exit();
    }




    ?>
    <script>
        const fileInput = document.getElementById('file-input');
        const fileNameSpan = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameSpan.textContent = file.name;
            } else {
                fileNameSpan.textContent = 'Upload file';
            }
        });
        const fileInput1 = document.getElementById('file-input1');
        const fileNameSpan1 = document.getElementById('file-name1');

        fileInput1.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameSpan1.textContent = file.name;
            } else {
                fileNameSpan1.textContent = 'Upload file';
            }
        });
        const fileInput2 = document.getElementById('file-input2');
        const fileNameSpan2 = document.getElementById('file-name2');

        fileInput2.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameSpan2.textContent = file.name;
            } else {
                fileNameSpan2.textContent = 'Upload file';
            }
        });
        const fileInput3 = document.getElementById('file-input3');
        const fileNameSpan3 = document.getElementById('file-name3');

        fileInput3.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameSpan3.textContent = file.name;
            } else {
                fileNameSpan3.textContent = 'Upload file';
            }
        });
        const fileInput4 = document.getElementById('file-input4');
        const fileNameSpan4 = document.getElementById('file-name4');

        fileInput4.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameSpan4.textContent = file.name;
            } else {
                fileNameSpan4.textContent = 'Upload file';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>


</html>