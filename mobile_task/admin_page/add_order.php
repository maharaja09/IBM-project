<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the config file
require_once '../config/config.php';
require_once '../navbar/nav.php';
session_start();
$email = $_SESSION['email'];
// echo $email;
// Genarate the order id
$fetch_query = "SELECT * FROM order_table ORDER BY order_id DESC limit 1";
$result = mysqli_query($con, $fetch_query);
$row = $result->fetch_assoc();
$lastid = $row['order_id'];
if ($lastid == "") {
    $orderid = "OID1";
} else {
    $orderid = substr($lastid, 3);
    $orderid = intval($orderid);
    $orderid = "OID" . ($orderid + 1);
}

$fetch_query = "SELECT * FROM order_table ORDER BY product_id DESC limit 1";
$result = mysqli_query($con, $fetch_query);
$row = $result->fetch_assoc();
$lastid = $row['product_id'];
if ($lastid == "") {
    $productid = "PID1";
} else {
    $productid = substr($lastid, 3);
    $productid = intval($productid);
    $productid = "PID" . ($productid + 1);
}

$fetch_query = "SELECT * FROM order_table ORDER BY seller_id DESC limit 1";
$result = mysqli_query($con, $fetch_query);
$row = $result->fetch_assoc();
$lastid = $row['seller_id'];
if ($lastid == "") {
    $sellerid = "SID1";
} else {
    $sellerid = substr($lastid, 3);
    $sellerid = intval($sellerid);
    $sellerid = "SID" . ($sellerid + 1);
}

// Assign the variable for post name
if (isset($_POST['vendor'])) {
    $companyName = $_POST['company_name'];
    $companyMail = $_POST['company_mail'];
    $companyPhno = $_POST['company_phno'];
    $companyAddress = $_POST['company_address'];
    $productname = $_POST['product_name'];
    $price = $_POST['product_price'];
    $sellername = $_POST['seller_name'];
    $sellerphno = $_POST['seller_phno'];
    $sellermail = $_POST['seller_mailid'];
    $selleraddress = $_POST['seller_address'];
    $selectedorderqty = $_POST['order_qty'];
    $orderDate = $_POST['order_date'];
    $estimateddeliverytime = 4;
    $deliveryDate = date("Y-m-d", strtotime($orderDate . " + $estimateddeliverytime days"));
    $totalprice = $price * $selectedorderqty;
    $con->query("INSERT INTO order_table (company_name, company_mail, company_phno,company_address, product_id, product_name, product_price, order_id, seller_id, seller_name, seller_phno, seller_mailid, seller_address, order_qty, order_price, order_date, created_by, 	created_on) 
        VALUES ('$companyName', '$companyMail', '$companyPhno', '$companyAddress', '$productid', '$productname', '$price', '$orderid', '$sellerid', '$sellername', '$sellerphno', '$sellermail', '$selleraddress', '$selectedorderqty', '$totalprice', CURRENT_TIMESTAMP, '$email', CURRENT_TIMESTAMP)");
    echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=order">';
    // header("loction:admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new order</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="form-container">
        <h1 class="heading-h1">Add a new order</h1>
        <form action="add_order.php" method="POST">
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
    </div>
</body>

</html>