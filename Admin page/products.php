<?php
session_start();
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location:admin_login.php");
}

if (isset($_POST["editproduct"])) {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $display = $_POST['display'];
    $battery = $_POST['battery'];
    $product_total_qty = $_POST['product_total_qty'];

    $updatequery = "UPDATE product_table SET
    product_name ='$name',
    ram ='$ram',
    storage ='$storage',
    display ='$display',
    battery ='$battery',
    product_price ='$price',   
    product_total_qty ='$product_total_qty' WHERE product_id = '$id';";
    if ($result = $con->query($updatequery)) {
        echo "Product Update Successfully!";
    } else {
        echo "Product Update fails";
    }
}
?>
<link rel="stylesheet" href="product.css">
<link rel="stylesheet" href="nav.css">
<div class="header-content">
    <div class="logo">
        <img src="./image/logo.jpg" alt="">
    </div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">View Products</a></li>
        <li><a href="addproduct.php">Add Products</a></li>
        <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
    </ul>
</div>
<h1 class="heading">Product Details</h1>
<div class="container">
    <table class="view-table">
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
        $result = $con->query("SELECT * FROM product_table");
        $id = 1;
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <form action="" method="post">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <td><?= $id ?></td>
                    <td><img src="./images/<?= $row['images']; ?>" height="100" alt=""></td>
                    <td><input type="text" name="product_name" value="<?= $row['product_name'] ?>" readonly></td>
                    <td><input type="text" name="product_price" value="<?= $row['product_price'] ?>"></td>
                    <td><input type="number" name="product_total_qty" value="<?=$row['product_total_qty'] ?>"></td>
                    <td><input type="text" name="ram" value="<?=$row['ram'] ?>"></td>
                    <td><input type="text" name="storage" value="<?= $row['storage'] ?>"></td>
                    <td><input type="text" name="display" value="<?= $row['display'] ?>"></td>
                    <td><input type="text" name="battery" value="<?= $row['battery'] ?>"></td>
                    <td>
                        <input type="submit" name="editproduct" value="Update"><br><br>
                        <a href='deleteproduct.php?id=<?php echo $row["product_id"] ?>'>Delete</a>
                    </td>
                </form>
            </tr>
        <?php
            $id++;
        }
        ?>
    </table>
</div>