<?php
session_start();
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if (!isset($_SESSION['email']) && empty($_SESSION['email'])) {
    header("location:admin_login.php");
}
?>
<link rel="stylesheet" href="table.css">
<link rel="stylesheet" href="nav.css">
    <div class="header-content">
        <div class="logo">
            <img src="./image/logo.jpg" alt="">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="order.php">View Orders</a></li>
            <li><a href="addorder.php">Add Orders</a></li>
            <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
        </ul>
    </div>
<link rel="stylesheet" href="table.css">
<h1 class="heading">Orders Details</h1>
<div class="container">
    <table class="view-table">
        <tr>
            <th>S.no</th>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Order date</th>
            <th>Action</th>
        </tr>
        <?php
        $result = $con->query("SELECT * FROM order_table");
        $id = 1;
        while ($row = mysqli_fetch_array($result)) {
            $pid = $row['product_id'];
            $name = $row['product_name'];
            $price = $row['order_price'];
            $qty = $row['order_qty'];
            $date = $row['order_date'];
        ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $pid ?></td>
                <td><?= $name ?></td>
                <td><?= $price ?></td>
                <td><?= $qty ?></td>
                <td><?= $date ?></td>
                <td>
                    <a href='editorder.php?id=<?php echo $row["product_id"] ?>'>Edit</a>
                    <a href='deleteorder.php?id=<?php echo $row["product_id"] ?>'>Delete</a>
                </td>
            </tr>
        <?php
            $id++;
        }
        ?>
    </table>
</div>