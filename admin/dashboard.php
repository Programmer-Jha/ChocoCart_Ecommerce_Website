<?php 
    // Developed By: Aniket Kumar Jha
    require 'header.php';
    $totalOrders = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM cc_order"))[0];
    $totalUsers = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM cc_users"))[0];
    $totalProducts = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM cc_product"))[0];
    $totalCategories = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM cc_category"))[0];

    $result = mysqli_query($con, "SELECT SUM(final_price) FROM cc_order WHERE order_status='5'");
    $totalRevenue = mysqli_fetch_row($result)[0] ?? 0;

    $recentOrders = mysqli_query($con, "SELECT id, final_price, user_id FROM cc_order ORDER BY added_on DESC LIMIT 5");
?>

<div class="container py-4">
  <!-- Welcome Message -->
  <div class="row mb-4">
    <div class="col-12 text-center">
      <h2 class="fw-bold">Welcome, Admin! 👋</h2>
    </div>
  </div>

  <!-- Summary Cards Row -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card summary-card text-white bg-brown shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Total Orders</h5>
          <p class="card-text fs-4"><?php echo $totalOrders; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card summary-card text-white bg-choco shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Total Users</h5>
          <p class="card-text fs-4"><?php echo $totalUsers; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card summary-card text-white bg-brown shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Total Products</h5>
          <p class="card-text fs-4"><?php echo $totalProducts; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card summary-card text-white bg-choco shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Total Categories</h5>
          <p class="card-text fs-4"><?php echo $totalCategories; ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Orders & Quick Actions Row -->
  <div class="row mb-4">
    <div class="col-md-6 mb-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-brown text-white">Recent Orders</div>
        <ul class="list-group list-group-flush">
          <?php while($order = mysqli_fetch_assoc($recentOrders)) { ?>
            <?php
                $userquery = mysqli_query($con, "SELECT name FROM cc_users WHERE id='".$order['user_id']."'");
                $user = mysqli_fetch_assoc($userquery);
                $username = $user['name'];
            ?>
            <li class="list-group-item">
              Order #<?php echo $order['id']; ?> - ₹<?php echo $order['final_price']; ?>, User ID: <?php echo $order['user_id']; ?>, Name: <?php echo $username; ?>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-choco text-white">Quick Actions</div>
        <div class="card-body">
          <a href="manage_product.php" class="btn btn-choco mb-2 w-100">➕ Add Product</a>
          <a href="manage_categories.php" class="btn btn-choco mb-2 w-100">📁 Add Category</a>
          <a href="orders.php" class="btn btn-choco w-100">📄 View All Orders</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Revenue Centered Row -->
  <div class="row justify-content-center mb-4">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm text-center">
        <div class="card-header bg-brown text-white">Total Revenue</div>
        <div class="card-body">
          <h3 class="fw-bold">₹<?php echo number_format($totalRevenue, 2); ?></h3>
          <div class="progress my-3" style="height: 20px;">
            <div class="progress-bar bg-choco" role="progressbar" style="width:<?php echo min(100, ($totalRevenue / 111111) * 100); ?>%;">
              <?php echo round(min(100, ($totalRevenue / 111111) * 100)); ?>%
            </div>
          </div>
          <small class="text-muted">Goal: ₹1,11,111</small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Custom Choco Styles -->
<style>
  .bg-brown { background-color: #5C4033; }
  .bg-choco { background-color: #7B3F00; }
  .btn-choco { background-color: #7B3F00; color: #fff; border: none; transition: 0.3s; }
  .btn-choco:hover { background-color: #5C4033; color: #fff; }

  .text-choco { color: #5C4033; }

  .summary-card {
    transition: transform 0.3s ease;
    cursor: pointer;
  }
  .summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 10px rgba(123, 63, 0, 0.3);
  }
</style>

<?php include 'footer.php'; ?>