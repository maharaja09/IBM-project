<?php
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
// Create a cutomer_table
$customer = "CREATE TABLE customer_purchase_table(
    customer_id varchar(10) NOT NULL,
    customer_name varchar(50) NOT NULL,
    customer_phno bigint(10) NOT NULL,
    customer_mail varchar(50) NOT NULL,
    customer_address varchar(255) NOT NULL,
    purchase_id varchar(10) UNIQUE NOT NULL,
    product_id varchar(10) NOT NULL,
    product_name varchar(50) NOT NULL,
    product_price int(11) NOT NULL,
    purchase_qty int(11) NOT NULL,
    total_amount int(11) NOT NULL,
    seller_name varchar(50) NOT NULL,
    seller_id varchar(50) NOT NULL,
    Seller_phno bigint(10) NOT NULL,
    seller_mail varchar(100) NOT NULL,
    company_address varchar(225) NOT NULL, 
    purchase_date date NOT NULL
)";
if ($con->query($customer) === true) {
    echo "Table created successfully";
} else {
    echo "Table creation is error" . $con->error;
}
?>