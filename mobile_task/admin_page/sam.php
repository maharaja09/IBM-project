<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config file include
require_once '../config/config.php';

// Include the nav section
require_once '../navbar/nav.php';

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search and Pagination</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div>
        <form action="" method="post">
            <input type="text" name="search" placeholder="search data" value="<?= $search ?>">
            <button name="submit">Search</button>
        </form>
        <div>
            <?php
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
            ?>
                    <table class="table-view">
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
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $row['product_id'] ?></td>
                                <td><img src="../admin_page/product_img/<?= $row['images'] ?>" height="100" alt="img"></td>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['product_price'] ?></td>
                                <td><?= $row['product_total_qty'] ?></td>
                                <td><?= $row['phone_ram'] ?></td>
                                <td><?= $row['phone_storage'] ?></td>
                                <td><?= $row['phone_display_size'] ?></td>
                                <td><?= $row['battery'] ?></td>
                                <td>
                                    <a href='admin_dashboard.php?id=<?php echo $row["product_id"] ?>' onclick="return confirm('Are you sure edit the product?')">Edit</a>
                                    <a href='delete.php?id=<?php echo $row["product_id"] ?>' onclick="return confirm('Are you sure delete the product?')">Delete</a>
                                </td>
                            </tr>
                <?php
                        }
                    } else {
                        echo "<h2>Data not found</h2>";
                    }
                }
                ?>
                    </table>
                    <?php
                    // Calculate total number of records using COUNT
                    $countStmt = $con->prepare("SELECT COUNT(*) as total FROM product_table WHERE product_id LIKE ? OR product_name LIKE ?");
                    $countStmt->bind_param("ss", $searchParam, $searchParam);
                    $countStmt->execute();
                    $countResult = $countStmt->get_result();
                    $row = mysqli_fetch_assoc($countResult);
                    $total_record = $row['total'];

                    // Calculate total pages
                    $total_page = ceil($total_record / $num_per_page);

                    // Display pagination links
                    if ($total_page > 1) {
                        echo "<div class='pagination'>";
                        for ($i = 1; $i <= $total_page; $i++) {
                            $active_class = ($i == $page) ? "active" : "";
                            echo "<a class='$active_class' href='sam.php?page=" . $i . "&search=" . urlencode($search) . "'>" . $i . "</a> ";
                        }
                        echo "</div>";
                    }
                    ?>
        </div>
    </div>
</body>

</html>