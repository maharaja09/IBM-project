<html lang="en">

<head>
    <link rel="stylesheet" href="nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="float: right;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="addproduct.php">Add products</a></li>
                            <li><a class="dropdown-item" href="products.php">View products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Orders</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="addorder.php">Add Orders</a></li>
                            <li><a class="dropdown-item" href="order.php">View Orders</a></li>
                        </ul>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-outline-success">Logout</a>
            </div>
        </div>
    </nav>

</body>

</html>


<div class="header-content">
        <div class="logo">
            <img src="./image/logo.jpg" alt="">
        </div>
        <ul class="nav-links">
            <li><a href="products.php">View Products</a></li>
            <li><a href="addproduct.php">Add Products</a></li>
            <li><a href="order.php">View Orders</a></li>
            <li><a href="addorder.php">Add Orders</a></li>
            <li><a href="logout.php" style="margin-right: 10px;">Logout</a></li>
        </ul>
    </div>