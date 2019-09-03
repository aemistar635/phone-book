<?php
session_start();
session_unset($_SESSION['user_id']);
session_unset($_SESSION['user_role']);
session_destroy();
header('location:login.php');
?>