<?php
// Developed By: Aniket Kumar Jha
require('header.php');

$user_id = $_SESSION['USER_ID'] ?? 0;
if ($user_id == 0) {
    header('location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = get_safe_value($con, $_POST['cart_id']);

    mysqli_query($con, "DELETE FROM cc_cart WHERE id = '$cart_id' AND user_id = '$user_id'");
    echo "<script>
        alert('Item Removed Successfully from the Cart!');
        window.location.href = 'cart.php';
    </script>";
}

header('Location: cart.php');
exit;
