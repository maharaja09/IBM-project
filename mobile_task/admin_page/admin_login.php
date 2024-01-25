<?php
require_once '../config/config.php';
session_start();
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $select = mysqli_query($con, "SELECT * FROM admin_info WHERE user_name = '$username' AND password ='$password'") or die('query failed');
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_name'] = $row['user_name'];
        $username = $_SESSION['user_name'];
        echo $username;
        $update = "UPDATE admin_info SET updated_on = CURRENT_TIMESTAMP, updated_by = '$username' WHERE user_name = '$username'";
        if (mysqli_query($con, $update)) {
            $message[] = 'login success';
            echo '<meta http-equiv="refresh" content="0;url=admin_dashboard.php?section=products">';
        }
    } else {
        $message[] = 'incorrect password or mail';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login page</title>
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
    <div class="form-container">
        <form action="admin_login.php" method="post" autocomplete="off">
            <h3>Login now</h3>
            <input type="text" name="user_name" placeholder="enter username" class="box" required>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <input type="submit" name="submit" value="login now" class="btn">
            <p>don't have an account?<a href="admin_register.php">Register now</a></p>
        </form>
    </div>
</body>

</html>