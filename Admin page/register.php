<?php
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($con, $_POST['first_name']);
    $lname = mysqli_real_escape_string($con, $_POST['last_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, ($_POST['password']));
    $cpass = mysqli_real_escape_string($con, ($_POST['cpassword']));
    $select = mysqli_query($con, "SELECT * FROM admin_info WHERE email = '$email' AND password ='$pass'") or die ('query failed');
    if(mysqli_num_rows($select) > 0)
    {
        echo 'admin already exist';
        header("location:admin_login.php");
    }
    else{
        mysqli_query($con, "INSERT INTO admin_info (first_name,last_name, email, password) VALUES('$fname', '$lname', '$email', '$pass')") or die('query failed');
        echo 'Rregistered successfully';
        header('location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register site page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php
    if(isset($message))
    {
        foreach($message as $message)
        {
            echo '<div class= "message" onclick= "this.remove();">' . $message . '</div>';
        }
    }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register now</h3>
            <input type="text" name="first_name" placeholder="enter your first name" class="box">
            <input type="text" name="last_name" placeholder="enter your last name" class="box">
            <input type="email" name="email" placeholder="enter your email" class="box">
            <input type="password" name="password" placeholder="enter password" class="box">
            <input type="password" name="cpassword" placeholder="confirm password" class="box">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>already have an account? <a href="admin_login.php">login now</a></p>
        </form>
    </div>
</body>

</html>