<?php
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

// Use prepared statements to avoid SQL injection
$stmt = $con->prepare("SELECT * FROM product_table LIMIT ?, ?");
$stmt->bind_param("ii", $start_from, $num_per_page);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination</title>
    <style>
        .pagination {
            margin-top: 10px;
        }

        .pagination a {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <table align="center" border="1px">
        <!-- Table headers -->
        <tr>
            <th>S.no</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Ram</th>
            <th>Storage</th>
            <th>Display</th>
            <th>Battery</th>
            <th>Action</th>
        </tr> 

    <?php
    // Calculate total number of records using COUNT
    $count_query = "SELECT COUNT(*) AS total_records FROM product_table";
    $count_result = mysqli_query($con, $count_query);
    $total_record = mysqli_fetch_assoc($count_result)['total_records'];

    // Calculate total pages
    $total_page = ceil($total_record / $num_per_page);

    // Display pagination links
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_page; $i++) {
        echo "<a href='sam1.php?page=" . $i . "' class='" . ($i == $page ? "active" : "") . "'>" . $i . "</a> ";
    }
    echo "</div>";
    ?>

</body>

</html>
