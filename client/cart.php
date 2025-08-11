<?php 
// Developed By: Aniket Kumar Jha
require('header.php');
$user_id = $_SESSION['USER_ID'] ?? 0;

if ($user_id == 0) {
    echo "<script>alert('Please login first.'); window.location.href = 'login.php';</script>";
    exit;
}

// Fetch cart items from database
$cart_sql = "SELECT * FROM cc_cart WHERE user_id = '$user_id'";
$cart_res = mysqli_query($con, $cart_sql);

$total_price = 0;
?>

<div class="main-content py-5" style="background: #f8f1ee;">
  <div class="container">
    <h1 class="text-center mb-4 text-brown">🛒 Your Cart</h1>

    <?php 
    if (mysqli_num_rows($cart_res) > 0) {
        while ($cart_row = mysqli_fetch_assoc($cart_res)) {
            $prod_id = $cart_row['product_id'];
            $qty = $cart_row['quantity'];

            // Get product info
            $prod_data = get_product($con, '', '', $prod_id);
            if (!$prod_data) continue;

            $product = $prod_data[0];
            $subtotal = $product['selling_price'] * $qty;
            $total_price += $subtotal;
    ?>

    <!-- Cart Item -->
    <div class="card shadow-sm mb-4 border-0">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-md-2">
            <img src="../assets/images/uploads/<?php echo $product['image']; ?>" class="img-fluid rounded" alt="Product Image">
          </div>
          <div class="col-md-4">
            <h5 class="text-brown"><?php echo $product['name']; ?></h5>
            <p class="text-muted mb-1"><?php echo $product['short_desc']; ?></p>
            <small class="text-muted">Category: <?php echo $product['categories']; ?></small>
          </div>
          <div class="col-md-2">
            <strong class="text-brown">Price: ₹<?php echo $product['selling_price']; ?></strong><br>
            <form method="post" action="update_cart.php" class="d-flex align-items-center gap-2">
                <input type="hidden" name="cart_id" value="<?php echo $cart_row['id']; ?>">
                <input type="number" name="quantity" value="<?php echo $cart_row['quantity']; ?>" min="1" class="form-control form-control-sm" style="width: 60px;">
                <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
            </form>


          </div>
          <div class="col-md-2">
            <strong class="text-brown">Subtotal: ₹<?php echo $subtotal; ?></strong>
          </div>
          <div class="col-md-2 text-end">
            <form method="post" action="remove_from_cart.php">
              <input type="hidden" name="cart_id" value="<?php echo $cart_row['id']; ?>">
              <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php 
        } // End while
    } else {
        echo "<p class='text-center'>Your cart is empty.</p>";
        ?>
        <div class="d-flex justify-content-center mt-4">
          <a href="index.php" class="btn btn-outline-primary btn-lg px-4 me-2">Add Products!</a>
        </div>
        <?php
    }
    ?>

    <!-- Total & Checkout -->
    <?php if ($total_price > 0): ?>
    <div class="card border-0 shadow-sm mt-4">
      <div class="card-body d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-brown">Total: ₹<?php echo $total_price; ?></h5>
        <div>
          <a href="index.php" class="btn btn-secondary btn-lg px-4 me-2">Continue Shopping</a>
          <a href="checkout.php" class="btn btn-success btn-lg px-4">Proceed to Checkout</a>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .text-brown {
    color: #5c3d2e;
  }
  .main-content {
    min-height: 80vh;
    background: url('images/choco-bg.png') repeat;
    background-size: cover;
  }
</style>

<?php include('footer.php'); ?>