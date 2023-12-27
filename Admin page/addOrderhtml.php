<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Order</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="nav.css">
</head>

<body>
    <!-- Header and nav section -->
    <div class="header-content">
        <div class="logo">
            <img src="./image/logo.jpg" alt="">
        </div>.
        <!-- Nav section -->
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="order.php">View Orders</a></li>
            <li><a href="addorder.php">Add Orders</a></li>
            <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
        </ul>
    </div>
    <!-- Page heading -->
    <h1 class="heading"> Product Order Form </h1>
    <!-- Form for order product -->
    <form action="addorder.php" method="POST">
        <label for="company_name">Company Name</label>
        <input type="text" name="company_name" value="Shopee Mobile Showroom" ><br><br>

        <label for="comapny_mail">Company Mailid</label>
        <input type="mail" name="company_mail" value="shopeemobile@gmail.com"><br><br>

        <label for="company_phno">Company phone number</label>
        <input type="text" name="company_phno" value="9900563892"><br><br>

        <label for="company_address">Company Address</label>
        <input type="text" name="company_address" value="Chennai-008"><br><br>

        <label for="product_name">Product name</label>
        <input type="text" name="product_name" value=""><br><br>

        <label for="product_price">Product price</label>
        <input type="text" name="product_price" value=""><br><br>

        <label for='seller_name'>Seller Name</label>
        <input type='text' name='seller_name' value=''><br><br>

        <label for="seller_phno" id="seller_phno"> Seller Phone Number </label>
        <input type="number" name="seller_phno" value=""><br><br>

        <label for="seller_mailid" id="seller_mailid"> Seller Mail </label>
        <input type="mail" name="seller_mailid" value=""><br><br>

        <label for="seller_address" id="seller_address"> Seller Address </label>
        <input type="text" name="seller_address" value=""><br><br>

        <label for="order_qty">Quantity to Purchase</label>
        <input type="number" name="order_qty" id="order_qty" value='' required min="1"><br><br>

        <label for='order_price'>Total Price</label>
        <input type='text' name='order_price' value=''><br><br>

        <button type="submit" name="vendor" value="Submit"> Place Order </button><br><br>
    </form>
</body>

</html>