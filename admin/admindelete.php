<?php
require 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$item = $row['image'];
$item1 = $row['image1'];
$item2 = $row['image2'];
$item3 = $row['image3'];
$item4 = $row['image4'];

$bn = $row['brand_name'];
$sn = $row['shoe_name'];
$sc = $row['shoe_color'];
$sp = $row['shoe_price'];
$ss = $row['shoe_size'];
$sd = $row['shoe_description'];
$im = $row['image'];
$gen = $row['gender'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Delete</title>
    <link rel="stylesheet" href="./style/admindelete.css">
    <link rel="stylesheet" href="./style/products.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'sidebar.php';
    ?>
    <h1>Are You Sure You Want To Delete This?</h1>
    <div class="delete-container">
        <form enctype="multipart/form-data" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="shoes-item">
                <img src="./uploads/<?php echo $item ?>" alt="">
                <h2><?php echo $bn ?></h2>
                <h2><?php echo $sn ?></h2>
                <h2>P<?php echo $sp ?></h2>
                <div class="two-btn">
                    <input type="submit" name="delete" value="Delete" class="up">
                    <a class="up" href="products.php"><input type="button" value="Cancel"></a>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['delete'])) {


        // Delete the image file from the upload folder
        // $upload_path = 'uploads/' . $item;
        // if (file_exists($upload_path)) {
        //     unlink($upload_path);
        // }
        // $upload_path1 = 'uploads/' . $item2;
        // if (file_exists($upload_path1)) {
        //     unlink($upload_path1);
        // }
        // $upload_path2 = 'uploads/' . $item3;
        // if (file_exists($upload_path2)) {
        //     unlink($upload_path2);
        // }
        // $upload_path3 = 'uploads/' . $item4;
        // if (file_exists($upload_path3)) {
        //     unlink($upload_path3);
        // }
        // $upload_path4 = 'uploads/' . $item1;
        // if (file_exists($upload_path4)) {
        //     unlink($upload_path4);
        // }

        $sql = "DELETE FROM products WHERE id = '$id' ";
        $checkQuery = mysqli_query($connect, $sql);


        header("Location: http://localhost/ecommerce/admin/products.php?from_delete=true");
        exit;

        // Redirect or display a success message

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>