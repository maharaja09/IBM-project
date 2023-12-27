<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Order</title>
</head>

<body>
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="nav.css">
    <div class="header-content">
        <div class="logo">
            <img src="./image/logo.jpg" alt="">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">View Products</a></li>
            <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
        </ul>
    </div>
    <h1 class="heading">Add New Product</h1>
    <form action="addproduct.php" method="post" enctype="multipart/form-data">

        <label for='product_name'>Product Name</label>
        <input type='text' name='product_name' value=''><br><br>

        <label for='product_price'>Product price</label>
        <input type='text' name='product_price' value=''><br><br>

        <label for='ram'>Ram</label>
        <input type='text' name='ram' value=''><br><br>

        <label for='storage'>Phone Storage</label>
        <input type='text' name='storage' value=''><br><br>

        <label for='display'>Display Size</label>
        <input type='text' name='display' value=''><br><br>

        <label for='battery'>Battery</label>
        <input type='text' name='battery' value=''><br><br>

        <label for="product_total_qty">Quantity to Purchase</label>
        <input type="number" name="product_total_qty" value='' min="1"><br><br>

        <label for="images">Image</label>
        <input type="file" name="file" value="" accept=".jpg, .jpeg, .png"><br><br>

        <input type="submit" name="addproduct" value="Add product"><br><br>
    </form>
</body>

</html>

<?php
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if (isset($_POST['addproduct'])) {
    $name = $_POST['product_name'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $display = $_POST['display'];
    $battery = $_POST['battery'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_total_qty'];
    if ($_FILES['file']['error'] === 4) {
        echo "image does't exits";
    } else {
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "invalid image Extension";
        } elseif ($fileSize > 1000000) {
            echo "image size is too large";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpName, 'images/'.$newImageName);
            $result = $con->query("SELECT max(product_id) FROM product_table");
            $result = $result->fetch_assoc();
            $productid = $result['max(product_id)'];
            $productid = $productid + 1;
            // echo $productid;

            $insertquery = "INSERT INTO product_table (product_id, product_name, ram, storage, display, battery, product_price, product_total_qty,images) 
            VALUES ('$productid', '$name', '$ram GB', '$storage GB', '$display inch','$battery mAh', '$price','$qty','$newImageName');";

            if ($result = $con->query($insertquery)) {
                echo "Add a new product successfully!";
            } else {
                echo "Add a new product fails";
            }
        }
    }
}
?>