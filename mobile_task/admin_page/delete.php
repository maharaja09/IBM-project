<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../config/config.php';
session_start();
$email = $_SESSION['email'];
if (isset($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $sql = "DELETE FROM product_table WHERE product_id='$del_id'";
    $result = mysqli_query($con, $sql);
    echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=products">';
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM order_table WHERE order_id='$id'";
    $result = mysqli_query($con, $sql);
    echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=order">';
}
