<?php
session_start();
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
    header("location:admin_login.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM product_table WHERE product_id='$id'";
    $result = mysqli_query($con, $sql);
    header('location:products.php');

}