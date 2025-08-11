<?php
    // Developed By: Aniket Kumar Jha
    require ('../includes/connection.php');
    require ('../includes/functions.php');
    unset($_SESSION['USER_LOGIN']);
    unset($_SESSION['USER_ID']);
    unset($_SESSION['USER_NAME']);
    header('location: index.php');
    die();
?>