<?php
session_start();
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if(!isset($_SESSION['email']) && empty($_SESSION['email']))
{
    header('location:admin_login.php');
}
?>
<link rel="stylesheet" href="nav.css">
<div class="header-content">
        <div class="logo">
            <img src="./image/logo.jpg" alt="">
        </div>
        <ul class="nav-links">
            <li><a href="products.php">View Products</a></li>
            <li><a href="addproduct.php">Add Products</a></li>
            <li><a href="order.php">View Orders</a></li>
            <li><a href="addOrderhtml.php">Add Orders</a></li>
            <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
        </ul>
    </div>
