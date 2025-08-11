<?php
    // Developed By: Aniket Kumar Jha
    session_start();
    unset($_SESSION['ADMIN_LOGIN']);
    unset($_SESSION['ADMIN_USERNAME']);
    header('location:login.php');
    die();
?>