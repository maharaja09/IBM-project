<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="orderdashboard.css">
</head>

<body>
    <div class="header">
        <div class="nav-bar">
            <img src="./img/logo.png" alt="logo">
        </div>
        <div class="task-bar">
            <h3>Purchase Order Generator And Tracker</h3>
            <h2> Dashboard</h2>
        </div>
    </div>
    <div class="container">
        <div class="left-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="heading">
                    <h3>Track Order</h3>
                    <hr style="margin: 1rem; margin-left: 3rem;
                    margin-right: 3rem; border: 1px solid #32a852">
                </div>
                <div class="generate-button">
                    <button type="submit" name="generate_purchase_order" style="background-color: #069c44; box-shadow: 0px 5px 8px #069c44;" class="left-side-btn" value="submit">Purchase Order</button>
                </div><br>
                <div class="generate-button">
                    <button type="submit" name="edit_product" style="background-color: #2a52be; box-shadow: 0px 5px 8px #2a52be;" class="left-side-btn" value="submit"> Edit Product</button>
                </div><br>
                <div class="generate-button">
                    <button type="submit" name="edit_supplier" style="background-color: #098f8f; box-shadow: 0px 5px 8px #098f8f;" class="left-side-btn" value="submit"> Edit Supplier</button>
                </div><br>
                <div class="generate-button">
                    <button type="submit" name="order_track" style="background-color: #302e42; box-shadow: 0px 5px 8px #302e42;" class="left-side-btn" value="submit"> Order Tracking </button>
                </div><br>
            </form>
        </div>
        <div class="right-container">
            <div class="generate-order">
                <?php
                if (isset($_POST['generate_purchase_order'])) {
                ?>
                    <h3 style=" margin-top: 1rem;
                    text-align: center;
                    color: #007FFF;
                    font-size: 1.2rem;
                    text-transform: uppercase;">Purchase Order</h3>
                    <hr style="margin: 1.5rem; border: 1px solid #007FFF">
                    <table class="table">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Product id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Supplier name</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Mail id</th>
                            <th scope="col">Address</th>
                            <th scope="col">Order date</th>
                        </tr>
                        <?php
                        require_once 'config.php';
                        $result = $con->query("SELECT * FROM maintable");
                        $sno = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['product_id'];
                            $name = $row['product_name'];
                            $price = $row['product_price'];
                            $notes = $row['notes'];
                            $qty = $row['order_qty'];
                            $sup_name = $row['supplier_name'];
                            $phno = $row['supplier_phno'];
                            $mail = $row['supplier_mailid'];
                            $address = $row['supplier_address'];
                            $date = $row['order_date'];
                        ?>
                            <tr>
                                <td><?= $sno; ?></td>
                                <td><?=$id?> </td>
                                <td><?= $name; ?></td>
                                <td><?= $price; ?></td>
                                <td><?= $notes; ?></td>
                                <td><?= $qty; ?></td>
                                <td><?= $sup_name; ?></td>
                                <td><?= $phno; ?></td>
                                <td><?= $mail; ?></td>
                                <td><?= $address; ?></td>
                                <td><?= $date; ?></td>
                            </tr>
                        <?php
                            $sno++;
                        }
                        ?>
                    </table>
                <?php
                }
                ?>
            </div>
            <div class="edit-product">
                <?php
                if (isset($_POST['edit_product'])) {
                ?>
                    <h3 style=" margin-top: 1rem;
                    text-align: center;
                    color: #007FFF;
                    font-size: 1.2rem;
                    text-transform: uppercase;">Product Details</h3>
                    <hr style="margin: 1.5rem; border: 1px solid #007FFF">
                    <table class="table">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Id</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total quantity</th>
                            <!-- <th scope="col">Description</th> -->
                        </tr>
                        <?php
                        require_once 'config.php';
                        $result = $con->query("SELECT * FROM master_table");
                        $sno = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $uid = $row['productid'];
                            $name = $row['productname'];
                            $price = $row['productprice'];
                            $qty = $row['product_total_qty'];
                            // $notes = $row['notes'];
                        ?>
                            <tr>
                                <td><?= $sno; ?></td>
                                <td>
                                    <form action="product_edit_form.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $uid ?>">
                                        <input type="submit" name="edit_product" value="<?= $uid ?>">
                                    </form>
                                </td>
                                <td><?= $name; ?></td>
                                <td><?= $price; ?></td>
                                <td><?= $qty; ?></td>
                                <!-- <td><?= $notes; ?></td> -->
                            </tr>
                        <?php
                            $sno++;
                        }
                        ?>
                    </table>
                <?php
                }
                require 'config.php';
                if (isset($_POST['update'])) {
                    $uid = $_POST['product_id'];
                    $price = $_POST['product_price'];
                    $qty = $_POST['product_total_qty'];
                    $note = $_POST['notes'];

                    if ($query = $con->query("UPDATE maintable
                    JOIN master_table ON maintable.product_id = master_table.productid
                    SET
                    maintable.product_price = '$price',
                    maintable.notes = '$note',
                    master_table.productprice = '$price',
                    master_table.product_total_qty = '$qty '
                    WHERE maintable.product_id = '$uid'")) {
                         echo "<p style= \"text-align: center; color: #007FFF;
                         font-size: 1.2rem; text-transform: uppercase\"> Product Update Successfully </p>";
                    } else {
                        echo "Error: " . $query . "<br>" . $con->error;
                    }
                }
                ?>
            </div>
            <div class="supplier-edit">
                <?php
                if (isset($_POST['edit_supplier'])) {
                ?>
                    <h3 style=" margin-top: 1rem;
                    text-align: center;
                    color: #007FFF;
                    font-size: 1.2rem;
                    text-transform: uppercase;">Supplier Details</h3>
                    <hr style="margin: 1.5rem; border: 1px solid #007FFF">
                    <table class="table">
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Id</th>
                            <th scope="col">Supplier name</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Mail id</th>
                            <th scope="col">Address</th>
                        </tr>
                        <?php
                        require_once 'config.php';
                        $result = $con->query("SELECT supplier_id, supplier_name, supplier_phno, supplier_mailid, supplier_address FROM maintable");
                        $sno = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['supplier_id'];
                            $name = $row['supplier_name'];
                            $phno = $row['supplier_phno'];
                            $mail = $row['supplier_mailid'];
                            $address = $row['supplier_address'];
                        ?>
                            <tr>
                                <td><?= $sno; ?></td>
                                <td>
                                    <form action="supplier_edit.php" method="POST">
                                        <input type="hidden" name="supplier_id" value="<?= $id ?>">
                                        <input type="submit" name="edit_supplier" value="<?= $id ?>">
                                    </form>
                                </td>
                                <td><?= $name; ?></td>
                                <td><?= $phno; ?></td>
                                <td><?= $mail; ?></td>
                                <td><?= $address; ?></td>
                            </tr>
                        <?php
                            $sno++;
                        }
                        ?>
                    </table>
                <?php
                }
                require 'config.php';
                if (isset($_POST['edit'])) {
                    $id = $_POST['supplier_id'];
                    $phno = $_POST['supplier_phno'];
                    $mail = $_POST['supplier_mailid'];
                    $address = $_POST['supplier_address'];
                    if ($query = $con->query("UPDATE maintable 
                    SET 
                    supplier_phno = '{$phno}', 
                    supplier_mailid = '{$mail}', 
                    supplier_address = '{$address}' 
                    WHERE supplier_id = '{$id}'")) {
                        echo "<p style= \"text-align: center; color: #007FFF;
                        font-size: 1.2rem; text-transform: uppercase\"> Supplier Info Update Successfully </p>";
                    } else {
                        echo "Error: " . $query . "<br>" . $con->error;
                    }
                }
                ?>
            </div>
        </div>

    </div>
</body>

</html>