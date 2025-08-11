<?php
// Developed By: Aniket Kumar Jha
require('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get cart item ID and new quantity
    $cart_id = isset($_POST['cart_id']) ? (int)$_POST['cart_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    // Make sure quantity is valid
    if ($cart_id > 0 && $quantity > 0) {
        // Update the quantity in the database
        $sql = "UPDATE cc_cart SET quantity = $quantity WHERE id = $cart_id";
        $result = mysqli_query($con, $sql);

        if ($result) {
            // echo "<script>alert('Cart Updated Successfully!'); window.location.href = 'cart.php';</script>";
        } else {
            // echo "<script>alert('Failed to Update Cart!'); window.location.href = 'cart.php';</script>";
        }
    } else {
        // echo "<script>alert('Invalid Input!'); window.location.href = 'cart.php';</script>";
    }
}
header("Location: cart.php");
exit;
?>