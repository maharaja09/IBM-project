<?php

require_once 'admin.php';

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the email and password from the form
    $name = input_data($_POST['name']);
    $username = input_data($_POST['user_name']);
    $admin_address = input_data($_POST['admin_address']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $admin_phno = ($_POST['admin_phno']);
    $password  = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Create a admin object
    $admin = new admin();

    // Check if the email is allowed
    if (!$admin->isEmailAllowed($email)) {
        $message[] = "Invalid email address! Registration failed.";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $message[] = "Passwords do not match! Registration failed.";
        exit();
    }

    // Register the admin
    if ($admin->registeradmin($name, $username, $admin_address, $email, $admin_phno, $password)) {
        $message[] = "Registration successful! Welcome, $first_name$last_name!";
        header("location:admin_dashboard.php");
    } else {
       $message[] = "Registration failed. mail id already exists";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class= "message" onclick= "this.remove();">' . $message . '</div>';
        }
    }
    ?>
    <h2>Registration Form</h2>
    <div class="form-container">
        <form action="admin_register.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="enter your name" class="box" required><br><br>
            <input type="text" name="user_name" placeholder="enter your username" class="box" required><br><br>
            <input type="text" name="admin_address" placeholder="enter your address" class="box" required><br><br>
            <input type="text" name="email" placeholder="enter your email" class="box" required><br><br>
            <input type="text" name="admin_phno" placeholder="enter your number" class="box" required><br><br>
            <input type="password" name="password" placeholder="enter password" class="box" required><br><br>
            <input type="password" name="confirm_password" placeholder="re-enter password" class="box" required><br><br>
            <input type="submit" name="submit" class="btn" value="register now"><br><br>
            <p>already have an account? <a href="admin_login.php">login now</a></p>
        </form>
    </div>
</body>

</html>