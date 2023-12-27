<?php
require_once 'C:\xampp\htdocs\Mobile_Shopee\config.php';
session_start();
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con,$_POST['password']);
    $select = mysqli_query($con, "SELECT * FROM admin_info WHERE email = '$email' AND password ='$pass'") or die('query failed');
    if(mysqli_num_rows($select)>0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['email'] = $row['id'];
        header("location:index.php");
    }
    else{
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
    <link rel="stylesheet" href="login.css">
</head>
<body>

<?php
if(isset($message))
{
    foreach($message as $message)
    {
        echo '<div class= "message" onclick= "this.remove();">'. $message.'</div>';
    }
}
?>
    <div class="form-container">
        <form action="admin_login.php" method="post">
            <h3>Login now</h3>
            <input type="email" name="email" placeholder="enter email" class="box">
            <input type="password" name="password" placeholder="enter password" class="box">
            <input type="submit" name="submit" value="login now" class="btn">
            <p>don't have an account?<a href="register.php">Register now</a></p>
        </form>
    </div>
</body>
</html>