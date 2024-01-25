<?php
//Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database config file include
require_once '../config/config.php';

// Pagination settings
$num_per_page = 5;
// Get the current page number
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
// Calculate the starting point for fetching records
$start_from = ($page - 1) * $num_per_page;
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
// Use prepared statements to avoid SQL injection
$stmt = $con->prepare("SELECT * FROM product_table WHERE product_id LIKE ? OR product_name LIKE ? LIMIT ?, ?");
$searchParam = "%$search%";
$stmt->bind_param("ssii", $searchParam, $searchParam, $start_from, $num_per_page);
$stmt->execute();
$result = $stmt->get_result();
?>