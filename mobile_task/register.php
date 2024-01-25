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
    $first_name = input_data($_POST['first_name']);
    $last_name = input_data($_POST['last_name']);
    $admin_address = input_data($_POST['admin_address']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $admin_phno = ($_POST['admin_phno']);
    $password  = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Create a admin object
    $admin = new admin();

    // Check if the email is allowed
    if (!$admin->isEmailAllowed($email)) {
        echo "Invalid email address! Registration failed.";
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match! Registration failed.";
        exit();
    }

    // Register the admin
    if ($admin->registeradmin($first_name, $last_name, $admin_address, $email, $admin_phno, $password)) {
        echo "Registration successful! Welcome, $first_name$last_name!";
    } 
    else {
        echo "Registration failed. mail id already exists";
    }
}
?>
