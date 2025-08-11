<?php
// Developed By: Aniket Kumar Jha
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['USER_ID'] ?? 0;
  if ($user_id == 0) {
    echo "<script>alert('Please Login First!'); window.location.href='login.php';</script>";
    exit;
  }

  $product_id = get_safe_value($con, $_POST['product_id']);
  $quantity = (int)$_POST['quantity'];

  $check_sql = "SELECT * FROM cc_cart WHERE user_id='$user_id' AND product_id='$product_id'";
  $check_res = mysqli_query($con, $check_sql);

  if (mysqli_num_rows($check_res) > 0) {
    // Already in cart, update quantity
    $row = mysqli_fetch_assoc($check_res);
    $new_qty = $row['quantity'] + $quantity;
    $update_sql = "UPDATE cc_cart SET quantity='$new_qty' WHERE id='" . $row['id'] . "'";
    mysqli_query($con, $update_sql);
  } else {
    // Not in cart, insert new
    $insert_sql = "INSERT INTO cc_cart(user_id, product_id, quantity) VALUES('$user_id', '$product_id', '$quantity')";
    mysqli_query($con, $insert_sql);
  }
  header('location: cart.php');
//   echo "<script>alert('Product added to cart!'); window.location.href='cart.php';</script>";
}
?>