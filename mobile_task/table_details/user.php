<?php
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
$user = "CREATE TABLE user_info(
    `id` int(100) NOT NULL,
    `first_name` varchar(100) NOT NULL,
    `last_name` varchar(100) NOT NULL,
    `user_id` varchar(100) DEFAULT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL
)";

if ($con->query($user) === true) {
    echo "Table created successfully";
} else {
    echo "Table creation is error" . $con->error;
}
