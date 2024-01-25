<?php
// Include the error code
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config file include
require_once '../config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a prepared statement
    $stmt = $con->prepare("SELECT * FROM super_admin WHERE username = ?");

    // Bind the parameters
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        // Verify the password
        if ($password === $row["password"]) {
            // Update the user record with login information
            $update = "UPDATE super_admin SET updated_by = ?, updated_on = CURRENT_TIMESTAMP WHERE username = ?";
            $update_stmt = $con->prepare($update);
            $update_stmt->bind_param("ss", $username, $username);
            $update_stmt->execute();
            $update_stmt->close();

            $message[] = 'Login success';
            echo '<meta http-equiv="refresh" content="0;url=master_dashboard.php?section=products">';
        } else {
            // Password is incorrect
            $message[] = 'Invalid password!';
        }
    } else {
        // User does not exist
        $message[] = 'User not found!';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super admin login page</title>
    <link rel="stylesheet" href="../style/login.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
        }
    }
    ?>
    <div class="form-container">
        <form action="super_admin_login.php" method="post">
            <h3>Login now</h3>
            <input type="text" name="username" placeholder="Enter username" class="box" required>
            <input type="password" name="password" placeholder="Enter password" class="box" required>
            <input type="submit" name="submit" value="Login now" class="btn">
            <!-- <p>Don't have an account? <a href="admin_register.php">Register now</a></p> -->
        </form>
    </div>
</body>

</html>
