<?php
session_start();
session_destroy();
header('location:super_admin_login.php')
?>