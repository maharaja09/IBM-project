<?php
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
$cart = "CREATE TABLE `cart` (
    `cart_id` int(100) NOT NULL,
    `user_id` varchar(100) NOT NULL,
    `product_name` varchar(50) NOT NULL,
    `product_price` int(11) NOT NULL,
    `quantity` int(11) NOT NULL
)";

if ($con->query($cart) === true) {
    echo "Table created successfully";
} else {
    echo "Table creation is error" . $con->error;
}
