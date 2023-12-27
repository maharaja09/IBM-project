<?php
session_start();
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location:admin_login.php");
}
$id = "";
$name = "";
$price = "";
$qty = "";
$date = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id;
    $result = $con->query("SELECT * FROM order_table WHERE product_id = '$id'");
    $row = mysqli_fetch_array($result);
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    $name = $row['product_name'];
    $price = $row['order_price'];
    $qty = $row['order_qty'];
    $date = $row['order_date'];
}
?>
<link rel="stylesheet" href="order.css">
<link rel="stylesheet" href="nav.css">
<div class="header-content">
        <div class="logo">
            <img src="./image/logo.jpg" alt="">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="order.php">View Orders</a></li>
            <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
        </ul>
    </div>
<h1 class="heading">Edit Product</h1>

<form action="editorder.php?id=<?= $id?>" method="post">

    <label for="product_name">Product name</label>
    <input type="text" name="product_name" id="product_name" value="<?= $name; ?>"><br><br>

    <label for='order_price'>Product Price</label>
    <input type='text' name='order_price' value="<?= $price; ?>"><br><br>

    <label for="order_qty" id="order_qty"> Quantity </label>
    <input type="text" name="order_qty" value="<?= $qty; ?>"><br><br>

    <label for="order_date" id="order_date"> Date </label>
    <input type="date" name="order_date" value="<?=$date ?>"><br><br>

    <input type="submit" name="editorder" value="Update">
</form>
<?php
if (isset($_POST["editorder"])) {
    $name = $_POST['product_name'];
    $price = $_POST['order_price'];
    $date = $_POST['order_date'];
    $qty = $_POST['order_qty'];

    $updatequery = "UPDATE  order_table SET
    product_name ='$name',
    order_date ='$date',
    order_price ='$price',   
    order_qty ='$qty' WHERE product_id = '$id';";
    if ($result = $con->query($updatequery)) {
        echo "Product Update Successfully!";
    } else {
        echo "Product Update fails";
    }
}
?>