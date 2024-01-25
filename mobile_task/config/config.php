<?php
//Database Connection Setting 
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";

//Create database and check the Connection

$con = mysqli_connect($servername,  $username, $password, $database);
if (!$con) {
    die("Connection failed:" . mysqli_connect_error());
}
// echo "db connection successfully";
// mysqli_close($con);
