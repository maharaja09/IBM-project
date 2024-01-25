<?php
// include config file
require_once '../config/config.php';
//create the order table
$order_table = "CREATE TABLE order_table(
    id int NOT NULL,
    company_name varchar(50) NOT NULL,
    company_mail varchar(50) NOT NULL,
    company_phbo bigint(50) NOT NULL,
    company_address varchar(50) NOT NULL,
    product_id varchar(5) NOT NULL,
    product_name varchar(50) NOT NULL,
    product_total_qty int(11) NOT NULL,
    product_price int(11) NOT NULL,
    order_id varchar(5) UNIQUE NOT NULL,
    seller_id varchar(5) NOT NULL,
    seller_name varchar(50) NOT NULL,
    seller_phno bigint(10) NOT NULL,
    seller_mailid varchar(255) NOT NULL,
    seller_address varchar(255) NOT NULL,
    order_qty int(11) NOT NULL,
    order_price int(11) NOT NULL,
    order_date date NOT NULL,
    delivery_date date NOT NULL
)";

// Run the query
if($con->query($order_table) === true){
    echo "Table created successfully";
}
else{
    echo "Table creation is  error" . $con->error;
}
// mysqli_close($con);
?>