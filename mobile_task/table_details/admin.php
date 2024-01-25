<?php
require_once '../config/config.php';
$admin = "CREATE TABLE admin_info (
  `id` INT(100) NOT NULL,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL
)";

if ($con->query($admin) === true) {
    echo "Table created successfully";
} else {
    echo "Table creation is error" . $con->error;
}
?>