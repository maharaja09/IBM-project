<?php
session_start();
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location:admin_login.php");
}
$id = "";
$name = "";
$price = "";
$ram = "";
$storage = "";
$display = "";
$battery = "";
$product_total_qty = "";
$supplier_name = "";
$supplier_id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $con->query("SELECT * FROM product_table WHERE product_id = '$id'");
    $row = mysqli_fetch_array($result);
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    $name = $row['product_name'];
    $price = $row['product_price'];
    $ram = $row['ram'];
    $storage = $row['storage'];
    $display = $row['display'];
    $battery = $row['battery'];
    $product_total_qty = $row['product_total_qty'];
}
?>
<?php require_once 'nav.php' ?>
<link rel="stylesheet" href="order.css">
<a href="products.php">View Product</a>
<h1>Edit Product</h1>
<form action="editproduct.php?id=<?= $id ?>" method="post">

    <label for="product_name">Product name</label>
    <input type="text" name="product_name" id="product_name" value="<?= $name; ?>" readonly><br><br>

    <label for='product_price'>Product Price</label>
    <input type='text' name='product_price' value="<?= $price; ?>"><br><br>

    <label for='ram'>Ram</label>
    <input type='text' name='ram' value="<?= $ram; ?>"><br><br>

    <label for='storage'>Storage</label>
    <input type='text' name='storage' value="<?= $storage; ?>"><br><br>

    <label for='battery'>Battery Capacity</label>
    <input type='text' name='battery' value="<?= $battery; ?>"><br><br>

    <label for="display" id="display">display </label>
    <input type="text" name="display" value="<?= $display; ?>"><br><br>

    <label for="product_total_qty" id="product_total_qty"> Quantity </label>
    <input type="text" name="product_total_qty" value="<?= $product_total_qty; ?>"><br><br>

    <input type="submit" name="editproduct" value="Update">
</form>
<?php
if (isset($_POST["editproduct"])) {
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
        header('location:products.php');
    } else {
        echo "Product Update fails";
    }
}
?>