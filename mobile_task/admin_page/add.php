<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Include config file
require_once '../config/config.php';
// Include navbar section
require_once '../navbar/nav.php';
session_start();
$email = $_SESSION['email'];
// echo $email;
// Process for add product                                                      
if (isset($_POST['addproduct'])) {
    // Assign variables for post value                                                                 
    $name = $_POST['product_name'];                           
    $ram = $_POST['phone_ram'];                           
    $storage = $_POST['phone_storage'];                           
    $display = $_POST['phone_display_size'];                           
    $battery = $_POST['battery'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_total_qty'];
// Image inserting process
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
            move_uploaded_file($tmpName, '../admin_page/product_img/' . $newImageName);
// Genarate the id
            $fetch_query = "SELECT * FROM product_table ORDER BY id DESC limit 1";
            $result = mysqli_query($con, $fetch_query);
            $row = $result->fetch_assoc();
            $lastid = $row['id'];
            // echo $lastid;
            $productid = $lastid + 1;
// Insert query
            $insertquery = "INSERT INTO product_table (product_id, product_name, phone_ram, phone_storage, phone_display_size, battery, product_price, product_total_qty,images, created_by, created_on) 
            VALUES ('PRD$productid', '$name', '$ram GB', '$storage GB', '$display inch','$battery mAh', '$price','$qty','$newImageName', '$email', CURRENT_TIMESTAMP);";

            if ($result = $con->query($insertquery)) {
                // header("location:admin_dashboard.php");
                echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=products">';
            } else {
                echo 'ERROR: ' . $con->connect_error;
            }
        }
    }
}

// Genarate the id
$fetch_query = "SELECT * FROM order_table ORDER BY id DESC limit 1";
$result = mysqli_query($con, $fetch_query);
$row = $result->fetch_assoc();
$lastid = $row['id'];
echo $lastid;
$id = $lastid + 1;
// Process for add order
if (isset($_POST['vendor'])) {
    // Assign variables for post value
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
    // Calculate for the total amount 
    $totalprice = $price * $selectedorderqty;
    $insertquery = "INSERT INTO order_table (company_name, company_mail, company_phno,company_address, product_id, product_name, product_price, order_id, seller_id, seller_name, seller_phno, seller_mailid, seller_address, order_qty, order_price, order_date, created_by, 	created_on) 
        VALUES ('$companyName', '$companyMail', '$companyPhno', '$companyAddress', 'PRDID$id', '$productname', '$price', 'ORDID$id', 'SID$id', '$sellername', '$sellerphno', '$sellermail', '$selleraddress', '$selectedorderqty', '$totalprice', CURRENT_TIMESTAMP, '$email', CURRENT_TIMESTAMP)";
    if ($result = $con->query($insertquery)) {
        // header("location:admin_dashboard.php");
        echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=order">';
    } else {
        echo 'ERROR: ' . $con->connect_error;
    }
    // echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=order">';
    // header("loction:admin_dashboard.php");
}
