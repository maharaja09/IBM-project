<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database config file include
require_once '../config/config.php';
// Include the nav section
require_once '../navbar/nav.php';
session_start();
$username = $_SESSION['user_name'];
// echo $email;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
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
            <li class="product-btn"><a href="admin_dashboard.php?section=products">Products</a></li>
            <li class="order-btn"><a href="admin_dashboard.php?section=order">Orders</a></li>
            <li class="seller-btn"><a href="admin_dashboard.php?section=seller">Seller</a></li>
            <li class="track-btn"><a href="admin_dashboard.php?section=order-track">Tracker</a></li>
        </div>
        <div class="main-container">
            <!-- Product dashboard section -->
            <section id="products">
                <?php
                // Pagination settings
                $num_per_page = 5;
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
                    <!-- <div class="add"> -->
                    <!-- <a href="admin_dashboard.php?section=form-container">Add a new product</a> -->
                    <!-- <h3 class="pro-heading">
                            Product details
                        </h3>
                    </div> -->
                    <div class="add">
                        <a href="#"></a>
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
                                        <!-- <td>
                                            <a href='admin_dashboard.php?id=<?php echo $row["product_id"] ?>' onclick="return confirm('Are you sure edit the product?')">Edit</a>
                                            <a href='delete.php?del_id=<?php echo $row["product_id"] ?>' onclick="return confirm('Are you sure delete the product?')">Delete</a>
                                        </td> -->
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
                                echo "<a class='$active_class' href='admin_dashboard.php?section=products&page=" . $i . "'>" . $i . "</a> ";
                            }
                            echo "</div>";
                        }
                    }
                    // Add new product section 
                    // $selectedAnchor = isset($_GET['section']) ? $_GET['section'] : 'form-container';
                    // if ($selectedAnchor == 'form-container' && !isset($_GET['id'])) {
                        ?>
                        <!-- Add new product section -->
                        <!-- <section id="form-container">
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
                            </section> -->
                        <?php
                        // }
                        // // Edit product section
                        // if (isset($_GET['id'])) {
                        //     $id = $_GET['id'];
                        //     $select_query = $con->query("SELECT * FROM product_table WHERE product_id = '$id'");
                        //     while ($row = mysqli_fetch_array($select_query)) {
                        ?>
                        <!-- <div class="edit">
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
                                </table> -->
                        <?php
                        //     }
                        // }
                        ?>
            </section>
            <!-- order dashboard secttion -->
            <section id="order">
                <?php
                if ($selectedAnchor == 'order') {
                ?>
                    <div class="add">
                        <a href="admin_dashboard.php?section=order-container">Add a new order</a>
                        <h3 class="pro-heading">
                            Order details
                        </h3>
                    </div>
                    <!-- <div class="add">
                        <a href="#"></a>
                        <h3 class="pro-heading">
                            Order details
                        </h3>
                    </div> -->
                    <hr class="hr-line">
                    <div class="search">
                        <form action="" method="post" class="search-order">
                            <input type="text" name="search" placeholder="search data" value="">
                            <button name="submit">Search</button>
                        </form>
                    </div>
                    <table class="table-view">
                        <tr>
                            <th>S.no</th>
                            <th>Vendor name</th>
                            <th>Vendor mailid</th>
                            <th>Product name</th>
                            <th>Order quantity</th>
                            <th>Order price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $select_query = $con->query("SELECT * FROM order_table");
                        $id = 1;
                        while ($row = mysqli_fetch_array($select_query)) {
                        ?>
                            <tr>
                                <td><?= $row['order_id'] ?></td>
                                <td><?= $row['seller_name'] ?></td>
                                <td><?= $row['seller_mailid'] ?></td>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['order_qty'] ?></td>
                                <td><?= $row['order_price'] ?></td>
                                <td><?= $row['order_status'] ?></td>
                                <td>
                                    <a href='admin_dashboard.php?id=<?php echo $row["order_id"] ?>' onclick="return confirm('Are you sure edit the order?')">Edit</a>
                                    <!-- <a href='delete.php?id=<?php echo $row["order_id"] ?>' onclick="return confirm('Are you sure delete the order?')">Delete</a> -->
                                </td>
                            </tr>
                        <?php
                            $id++;
                        }
                        ?>
                    </table>
                <?php
                }
                // Add a new order section 
                if ($selectedAnchor == 'order-container') {
                ?>
                    <section id="order-container">
                        <h1 class="order-h1">Add a new order</h1>
                        <form action="add.php" method="POST">
                            <label for="company_name">Company Name</label>
                            <input type="text" name="company_name" value="Shopee Mobile Showroom" readonly><br><br>

                            <label for="comapny_mail">Company Mailid</label>
                            <input type="mail" name="company_mail" value="shopeemobile@gmail.com" readonly><br><br>

                            <label for="company_phno">Company phone number</label>
                            <input type="text" name="company_phno" value="9900563892" readonly><br><br>

                            <label for="company_address">Company Address</label>
                            <input type="text" name="company_address" value="Chennai-008" readonly><br><br>

                            <label for="product_name">Product name</label>
                            <input type="text" name="product_name" value="" required><br><br>

                            <label for="product_price">Product price</label>
                            <input type="text" name="product_price" value="" required><br><br>

                            <label for='seller_name'>Seller Name</label>
                            <input type='text' name='seller_name' value='' required><br><br>

                            <label for="seller_phno" id="seller_phno"> Seller Phone Number </label>
                            <input type="number" name="seller_phno" value="" required><br><br>

                            <label for="seller_mailid" id="seller_mailid"> Seller Mail </label>
                            <input type="mail" name="seller_mailid" value="" required><br><br>

                            <label for="seller_address" id="seller_address"> Seller Address </label>
                            <input type="text" name="seller_address" value="" required><br><br>

                            <label for="order_qty">Quantity to Purchase</label>
                            <input type="number" name="order_qty" id="order_qty" value='' required min="1"><br><br>

                            <label for="order_date">Order date</label>
                            <input type="date" name="order_date" id="order_date"><br><br>

                            <input type="submit" name="vendor" value="Place Order"><br><br>
                        </form>
                    </section>
                    <?php
                }
                //Update order status section 
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $select_query = $con->query("SELECT * FROM order_table WHERE order_id = '$id'");
                    while ($row = mysqli_fetch_array($select_query)) {
                    ?>
                        <div class="edit-order">
                            <h3 class="heading">
                                Update order status
                            </h3>
                        </div>
                        <hr class="hr-line">
                        <table class="table-view">
                            <tr>
                                <th>S.no</th>
                                <th>Vendor name</th>
                                <th>Vendor mailid</th>
                                <th>Product name</th>
                                <th>Order quantity</th>
                                <th>Order price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <form action="edit.php" method="post" autocomplete="off" id="update">
                                <td><input type="text" name="order_id" value="<?= $id ?>" readonly></td>
                                <td><input type="text" name="seller_name" value="<?= $row['seller_name'] ?>" readonly></td>
                                <td><input type="mail" name="seller_mailid" value="<?= $row['seller_mailid'] ?>" readonly></td>
                                <td><input type="text" name="product_name" value="<?= $row['product_name'] ?>" readonly></td>
                                <td><input type="number" name="order_qty" value="<?= $row['order_qty'] ?>" readonly></td>
                                <td><input type="text" name="order_price" value="<?= $row['order_price'] ?>" readonly></td>
                                <td>
                                    <select name="order_status" id="order_status" <?php echo $row['order_status'] === 'Delivered' ? 'disabled' : ''; ?>>
                                        <option value="<?= $row['order_status'] ?>"><?= $row['order_status'] ?></option>
                                        <option value="Pending">Pending</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </td>
                                <td><input type="submit" name="edit_order" value="Update" <?php echo $row['order_status'] === 'Delivered' ? 'disabled' : ''; ?>  onclick="return confirm('Status update successfully!!')"></td>
                            </form>
                        </table><br>
                    <?php } ?>
                    <td>Supplier name <input type="text" name="" value="" id="update"></td>
                    <td>Supplier mailid <input type="text" name="" value="" id="update"></td>
                    <td>Supplier Phone number<input type="mail" name="" value="" id="update"></td>
                    <td>Supplier address<input type="text" name="" value="" id="update"></td>
                    <!-- <td><input type="number" name="" value="" id="update"></td>
                    <td><input type="text" name="" value="" id="update"></td> -->
                <?php
                }
                ?>
            </section>
            <!-- Seller section -->
            <section id="seller">
                <?php
                if ($selectedAnchor == 'seller') {
                ?>
                    <div class="add">
                        <a href="#"></a>
                        <h3 class="pro-heading">
                            Seller details
                        </h3>
                    </div>
                    <hr class="hr-line">
                    <table class="table-view">
                        <tr>
                            <th>S.no</th>
                            <th>Id</th>
                            <th>Seller name</th>
                            <th>Phone number</th>
                            <th>Mail id</th>
                            <th>Address</th>
                        </tr>
                        <?php
                        // Fetch the product details from the product table
                        $result = $con->query("SELECT seller_id, seller_name, seller_phno, seller_mailid, seller_address FROM order_table");
                        $sno = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <!-- Display the output -->
                                <td><?= $sno; ?></td>
                                <td><?= $row['seller_id'] ?></td>
                                <td><?= $row['seller_name'] ?></td>
                                <td><?= $row['seller_phno'] ?></td>
                                <td><?= $row['seller_mailid'] ?></td>
                                <td><?= $row['seller_address'] ?></td>
                            </tr>
                        <?php
                            $sno++;
                        }
                        ?>
                    </table>
                <?php } ?>
            </section>
        </div>
    </main>
</body>

</html>