<?php
// Include the config file
require_once '../config.php';
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
    $totalprice = $_POST['order_price'];

    // Select the query for fetch data from order table
    $result = $con->query("SELECT order_id, product_id, seller_id FROM order_table");
    //Check the query if result is 0 excute if part
    if ($result->num_rows == 0) {
        //Value insert and run the insert query
        $con->query("INSERT INTO order_table (company_name, company_mail, company_phno,company_address, product_id, product_name, product_price, order_id, seller_id, seller_name, seller_phno, seller_mailid, seller_address, order_qty, order_price, order_date) 
        VALUES ('$companyName', '$companyMail', '$companyPhno', '$companyAddress', '1001', '$productname', '$price', '2001', '3001', '$sellername', '$sellerphno', '$sellermail', '$selleraddress', '$selectedorderqty', '$totalprice',  CURRENT_TIMESTAMP)");

        echo "Order placed successfully.";
    } 
    //Fetch max value from database and excute the else part
    else {
        $result = $con->query("SELECT max(order_id), max(product_id), max(seller_id) FROM order_table");
        $result = $result->fetch_assoc();
        $orderid = $result['max(order_id)'];
        $selectedproductid = $result['max(product_id)'];
        $sellerid = $result['max(seller_id)'];
        $selectedproductid = $selectedproductid + 1;
        $orderid = $orderid + 1;
        $sellerid = $sellerid + 1;
        //Run the insert query
        $con->query("INSERT INTO order_table (company_name, company_mail, company_phno,company_address, product_id, product_name, product_price, order_id, seller_id, seller_name, seller_phno, seller_mailid, seller_address, order_qty, order_price, order_date) 
        VALUES ('$companyName', '$companyMail', '$companyPhno', '$companyAddress', '$selectedproductid', '$productname', '$price', '$orderid', '$sellerid', '$sellername', '$sellerphno', '$sellermail', '$selleraddress', '$selectedorderqty', '$totalprice',  CURRENT_TIMESTAMP)");

        echo "Order placed successfully.";
        header('location:index.php');
    }
}
