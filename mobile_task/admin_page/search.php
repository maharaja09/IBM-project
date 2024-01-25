<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database config file include
require_once '../config/config.php';
// Include the nav section
require_once '../navbar/nav.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div>
        <form action="" method="post">
            <input type="text" name="search" placeholder="search data">
            <button name="submit">Search</button>
        </form>
        <div>
            <?php
            if (isset($_POST['search'])) {
                $search  = $_POST['search'];
                $sql = "SELECT * FROM product_table WHERE product_id LIKE '%$search%' OR product_name LIKE '%$search%'";
                $result = mysqli_query($con, $sql);
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
                                    <td><?= $row['phone_storage'] ?></< /td>
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
                            echo "<h2> Data not found</h2>";
                        }
                    }
                    ?>
                        </table>
                    <?php } ?>
        </div>
    </div>

</body>

</html>