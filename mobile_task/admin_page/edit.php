<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../config/config.php';
session_start();
$email = $_SESSION['email'];
// echo $email;
//Process for product edit
if (isset($_POST["edit_product"])) {
    // Assign the variable for post name
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $ram = $_POST['phone_ram'];
    $storage = $_POST['phone_storage'];
    $display = $_POST['phone_display_size'];
    $battery = $_POST['battery'];
    $product_total_qty = $_POST['product_total_qty'];
    // update the data into table
    $updatequery = "UPDATE product_table SET
        product_name ='$name',
        phone_ram ='$ram',
        phone_storage ='$storage',
        phone_display_size ='$display',
        battery ='$battery',
        product_price ='$price',   
        product_total_qty ='$product_total_qty', updated_by =  '$email', updated_on = CURRENT_TIMESTAMP WHERE product_id = '$id';";
    if ($result = $con->query($updatequery)) {        //Check and run the query
        // echo "<script>alert('Product Update Success!!');</script>";
        echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=products">';
    } else {
        echo "Product Update fails";
    }
}

if (isset($_POST['edit_order'])) {
    // Assign the variable for post name
    $id = $_POST['order_id'];
    $select_query  = "SELECT order_status FROM order_table WHERE order_id = '$id';";
    $select_query_res = $con->query($select_query);
    $row = $select_query_res->fetch_assoc();
    $status = $row['order_status'];
    // echo $status;
    $status = $_POST['order_status'];
    if ($row['order_status'] == $_POST['order_status']) {
        
        echo 'Alredy Delivered the product';
    } else {
        // update the data into table
        $updatequery = "UPDATE order_table SET
        order_status = '$status',
        delivery_date = CURRENT_TIMESTAMP,
        updated_by =  '$email', 
        updated_on = CURRENT_TIMESTAMP WHERE order_id = '$id';";
        if ($result = $con->query($updatequery)) {          //Check and run the query
            // echo "<script>alert('Product Update Success!!');</script>";
            echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=order">';
        } else {
            echo "Product Update fails";
        }
    }
}
