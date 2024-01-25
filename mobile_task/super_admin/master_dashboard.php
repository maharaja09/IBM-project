<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database config file include
require_once '../config/config.php';
session_start();
$username = $_SESSION['username'];
// echo $username;
require_once 'navbar.php';
?>
<h1>Welcome super admin <span><?= $username; ?>!</span></h1>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master page</title>
    <!-- link css -->
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/search.css">
    <script src="https://kit.fontawesome.com/73ebdd0ca9.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- header part -->
    <main>
        <div class="side-container">
            <div class="side-heading">
                <h3>track order</h3>
            </div>
            <hr class="hrline">
            <!-- Left side anchor section -->
            <li class="product-btn"><a href="master_dashboard.php?section=products">Products</a></li>
            <li class="order-btn"><a href="master_dashboard.php?section=order">Orders</a></li>
            <li class="seller-btn"><a href="master_dashboard.php?section=seller">Supplier</a></li>
            <li class="track-btn"><a href="master_dashboard.php?section=order-track">Branches</a></li>
        </div>
        <div class="main-container">
            <!-- Product dashboard section -->
            <section id="products">
                <?php
                // Pagination settings
                $num_per_page = 4;
                // Get the current page number
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
                // Calculate the starting point for fetching records
                $start_from = ($page - 1) * $num_per_page;
                $search = "";
                if (isset($_POST['search'])) {
                    $search = $_POST['search'];
                }
                // Use prepared statements to avoid SQL injection
                $stmt = $con->prepare("SELECT * FROM product_table WHERE product_id LIKE ? OR product_name LIKE ? LIMIT ?, ?");
                $searchParam = "%$search%";
                $stmt->bind_param("ssii", $searchParam, $searchParam, $start_from, $num_per_page);
                $stmt->execute();
                $result = $stmt->get_result();
                $selectedAnchor = isset($_GET['section']) ? $_GET['section'] : 'products';
                if ($selectedAnchor == 'products' && !isset($_GET['id'])) {
                ?>
                    <div class="add">
                        <a href="master_dashboard.php?section=form-container">Add a new product</a>
                        <h3 class="pro-heading">
                            Product details
                        </h3>
                    </div>
                    <hr class="hr-line">
                    <div class="search">
                        <form action="" method="post" class="search-form">
                            <input type="text" name="search" placeholder="search data" value="<?= $search ?>">
                            <button name="submit">Search</button>
                        </form>
                    </div>
                    <!-- Display all product from db -->
                    <?php
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                    ?>
                            <table class="table-view">
                                <tr>
                                    <th>S.no</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Ram</th>
                                    <th>Storage</th>
                                    <th>Display</th>
                                    <th>Battery</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?= $row['product_id'] ?></td>
                                        <td><img src="../admin_page/product_img/<?= $row['images'] ?>" height="100" alt="img"></td>
                                        <td><?= $row['product_name'] ?></td>
                                        <td><?= $row['product_price'] ?></td>
                                        <td><?= $row['product_total_qty'] ?></td>
                                        <td><?= $row['phone_ram'] ?></td>
                                        <td><?= $row['phone_storage'] ?></td>
                                        <td><?= $row['phone_display_size'] ?></td>
                                        <td><?= $row['battery'] ?></td>
                                        <td>
                                            <a href='admin_dashboard.php?id=<?php echo $row["product_id"] ?>' onclick="return confirm('Are you sure edit the product?')">Edit</a>
                                            <a href='delete.php?del_id=<?php echo $row["product_id"] ?>' onclick="return confirm('Are you sure delete the product?')">Delete</a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<h3 class='pro-heading'>Data not found</h3>";
                            }
                        }
                        ?>
                            </table>
                            <?php
                            // Calculate total number of records using COUNT
                            $countStmt = $con->prepare("SELECT COUNT(*) as total FROM product_table WHERE product_id LIKE ? OR product_name LIKE ?");
                            $countStmt->bind_param("ss", $searchParam, $searchParam);
                            $countStmt->execute();
                            $countResult = $countStmt->get_result();
                            $row = mysqli_fetch_assoc($countResult);
                            $total_record = $row['total'];

                            // Calculate total pages
                            $total_page = ceil($total_record / $num_per_page);

                            // Display pagination links
                            if ($total_page > 1) {
                                echo "<div class='pagination'>";
                                for ($i = 1; $i <= $total_page; $i++) {
                                    $active_class = ($i == $page) ? "active" : "";
                                    echo "<a class='$active_class' href='master_dashboard.php?section=products&page=" . $i . "'>" . $i . "</a> ";
                                }
                                echo "</div>";
                            }
                        }
                        // Add new product section 
                        $selectedAnchor = isset($_GET['section']) ? $_GET['section'] : 'form-container';
                        if ($selectedAnchor == 'form-container' && !isset($_GET['id'])) {
                            ?>
                            <!-- Add new product section -->
                            <section id="form-container">
                                <h1 class="product-h1">Add a new product</h1>
                                <form action="add.php" method="post" enctype="multipart/form-data" class="product-form">
                                    <label for="product_name">Product name</label>
                                    <input type="text" name="product_name" id="product_name" value="" class="input-box"><br><br>

                                    <label for='product_price'>Product price</label>
                                    <input type='text' name='product_price' id="product_price" value='' class="input-box" required><br><br>

                                    <label for='phone_ram'>Mobile Ram</label>
                                    <input type='text' name='phone_ram' id="phone_ram" value='' class="input-box" required><br><br>

                                    <label for='phone_storage'>Phone Storage</label>
                                    <input type='text' name='phone_storage' id="phone_storage" class="input-box" value='' required><br><br>

                                    <label for='phone_display_size'>Display Size</label>
                                    <input type='text' name='phone_display_size' id="phone_display_size" class="input-box" value='' required><br><br>

                                    <label for='battery'>Battery</label>
                                    <input type='text' name='battery' id="battery" class="input-box" value='' required><br><br>

                                    <label for="product_total_qty">Quantity to Purchase</label>
                                    <input type="number" name="product_total_qty" id="product_total_qty" class="input-box" value='' min="1" required><br><br>

                                    <label for="images">Image</label>
                                    <input type="file" name="file" id="images" value="" class="input-box" accept=".jpg, .jpeg, .jfif, .pjpeg, .pjp, .png" required><br><br>

                                    <input type="submit" name="addproduct" value="Add product"><br><br>
                                </form>
                            </section>
                            <?php
                        }
                        // Edit product section
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $select_query = $con->query("SELECT * FROM product_table WHERE product_id = '$id'");
                            while ($row = mysqli_fetch_array($select_query)) {
                            ?>
                                <div class="edit">
                                    <h3 class="heading">
                                        Update product details
                                    </h3>
                                </div>
                                <hr class="hr-line">
                                <table class="table-view">
                                    <tr>
                                        <th>S.no</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Ram</th>
                                        <th>Storage</th>
                                        <th>Display</th>
                                        <th>Battery</th>
                                        <th>Action</th>
                                    </tr>
                                    <form action="edit.php" method="post">
                                        <tr>
                                            <td><input type="text" name="product_id" value="<?= $id ?>" readonly></td>
                                            <td><img src="../admin_page/product_img/<?= $row['images'] ?>" height="100" alt="img"></td>
                                            <td><input type="text" name="product_name" value="<?= $row['product_name'] ?>" readonly></td>
                                            <td><input type="text" name="product_price" value="<?= $row['product_price'] ?>"></td>
                                            <td><input type="text" name="product_total_qty" value="<?= $row['product_total_qty'] ?>"></td>
                                            <td><input type="text" name="phone_ram" value="<?= $row['phone_ram'] ?>"></td>
                                            <td><input type="text" name="phone_storage" value="<?= $row['phone_storage'] ?>"></td>
                                            <td><input type="text" name="phone_display_size" value="<?= $row['phone_display_size'] ?>"></td>
                                            <td><input type="text" name="battery" value="<?= $row['battery'] ?>"></td>
                                            <td><input type="submit" name="edit_product" value="Update"></td>
                                        </tr>
                                    </form>
                                </table>
                        <?php
                            }
                        }
                        ?>
            </section>
    </main>
</body>

</html>