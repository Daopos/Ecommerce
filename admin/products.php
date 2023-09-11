<?php
ob_start();
require 'connect.php';
$itemsPerPage = 8; // Number of items to display per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Calculate the offset for pagination
$offset = ($page - 1) * $itemsPerPage;

// Query to fetch the limited number of products
$sqltest = "SELECT * FROM products LIMIT $offset, $itemsPerPage";
$query = mysqli_query($connect, $sqltest);

$totalItems = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM products")); // Total number of items
$totalPages = ceil($totalItems / $itemsPerPage); // Total number of pages

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/products.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://kit.fontawesome.com/3eb6e30751.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    include 'navigation.php';
    ?>


    <div class="productsshoes box basic-drop-shadow">
        <h1>Products/Shoes</h1>
        <div class="add-btn">
            <a href="./adminadd.php"><input style="width: 140px;" class="btn btn-success btn-lg" type="button" value="Add Product"></a>
        </div>
        <table id="customers">
            <tr>
                <th>Shoes Brand</th>
                <th>Shoes Name</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($query)) {
                // Rest of your code to display table rows
                $item = $row['image'];
                $item1 = $row['image1'];
                $item2 = $row['image2'];
                $item3 = $row['image3'];
                $item4 = $row['image4'];
                $modalId = 'viewModal' . $row['id'];
                echo '
                    <tr>
                        <td>' . $row['brand_name'] . '</td>
                        <td>' . $row['shoe_name'] . '</td>
                        <td>' . $row['shoe_size'] . '</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#' . $modalId . '" onclick="setViewId(' . $row['id'] . ')">View</button>
                            <a href="adminupdate.php?id=' . $row['id'] . '"><input type="button" value="Edit" class="btn btn-secondary"></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="setDeleteId(' . $row['id'] . ')">Delete</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="' . $modalId . '" tabindex="-1" role="dialog" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">View Shoes</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="shoe-container">
                                        <div class="shoes-first-container">
                                            <div class="four-photos">
                                                <img src="../admin/uploads/' . $row['image1'] . '" alt="">
                                                <img src="../admin/uploads/' . $row['image2'] . '" alt="">
                                                <img src="../admin/uploads/' . $row['image3'] . '" alt="">
                                                <img src="../admin/uploads/' . $row['image4'] . '" alt="">
                                            </div>
                                            <div class="main-photo">
                                                <img src="../admin/uploads/' . $row['image'] . '" alt="">
                                            </div>
                                            <div class="shoes-text">
                                                <h2>' . $row['brand_name'] . '</h2>
                                                <h2>' . $row['shoe_name'] . '</h2>
                                                <h2>' . $row['shoe_color'] . '</h2>
                                                <h2>For: ' . $row['gender'] . '</h2>
                                                <h2>₱' . $row['shoe_price'] . '</h2>
                                                <h2>Size: ' . $row['shoe_size'] . '</h2>
                                                <hr style="border: 1px solid black">
                                                <div class="desc-container">
                                                    <p>' . $row['shoe_description'] . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Finish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
            ?>
        </table>

        <!-- Pagination -->
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>

    </div>





    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                        <input type="hidden" name="delete_id" id="delete_id" value="">

                        <input type="submit" name=delete class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['delete'])) {

        $id = $_POST['delete_id'];

        // Perform the deletion operation using the provided ID
        $sql = "DELETE FROM products WHERE id = '$id'";
        mysqli_query($connect, $sql);
        if (mysqli_query($connect, $sql)) {
            echo "test";
            header("Location: http://localhost/ecommerce/admin/products.php?deleted=true");
            ob_end_clean();
            exit();
        } else {
            // Deletion failed
            echo "test";
        }
    }

    ?>

    <?php
    if (isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
        echo '<script type="text/javascript">toastr.success("Succesfully Deleted!")</script>';
    }
    if (isset($_GET['updated']) && $_GET['updated'] === 'true') {
        echo '<script type="text/javascript">toastr.success("Successfully Updated!")</script>';
    }
    ?>

    <script>
        function setDeleteId(id) {
            document.getElementById('delete_id').value = id;
        }

        function setViewId(id) {
            document.getElementById('viewe_id').value = id;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>