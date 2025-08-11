<?php 
  // Developed By: Aniket Kumar Jha
  require ('../includes/connection.php');
  require ('../includes/functions.php');

  $user_id = $_SESSION['USER_ID'] ?? 0;
  $user_name = $_SESSION['USER_NAME'] ?? 0;
  if($user_id == 0) {
    $user_name = "Guest";
  }
  $total_cart_qty = get_cart_qty($con, $user_id);

  $cat_res = mysqli_query($con, "SELECT * FROM cc_category WHERE status='1' ORDER BY categories ASC");
  $cat_arr = array();
  while($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ChocoCart</title>

  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/client/header.css" />
  <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
  <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body>

  <!-- 🍫 ChocoCart Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top choco-navbar shadow-sm">
  <div class="container">
    <div class="navbar-brand fw-bold fs-3">
      🍫 ChocoCart
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto text-end align-items-lg-center">
        <li class="nav-item mx-2">
          <a class="nav-link" href="index.php"><i class="bi bi-house-door-fill me-1"></i> Home</a>
        </li>

        <!-- 🔍 Search -->
        <li class="nav-item mx-2">
          <a class="nav-link" href="search.php"><i class="bi bi-search me-1"></i> Search</a>
        </li>

        <!-- 📂 Categories -->
        <li class="nav-item dropdown mx-2">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-grid-fill me-1"></i> Categories
          </a>
          <ul class="dropdown-menu">
            <?php foreach($cat_arr as $list): ?>
              <li><a class="dropdown-item" href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="nav-item mx-2">
          <a class="nav-link" href="my_orders.php"><i class="bi bi-bag-fill me-1"></i> My Orders</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="about.php"><i class="bi bi-person-vcard me-1"></i> About Us</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="contact.php"><i class="bi bi-telephone-fill me-1"></i> Contact Us</a>
        </li>

        <!-- 🛒 Cart -->
        <li class="nav-item mx-2">
          <a class="nav-link" href="cart.php"><i class="bi bi-cart-fill me-1"></i> Cart <span class="badge bg-warning text-dark"><?php echo $total_cart_qty; ?></span></a>
        </li>

        <!-- 👤 Login / Logout -->
        <?php if(isset($_SESSION['USER_LOGIN'])): ?>
          <li class="nav-item mx-2">
            <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item mx-2">
            <a class="nav-link" href="login.php"><i class="bi bi-person-circle me-1"></i> Login/Register</a>
          </li>
        <?php endif; ?>
      </ul>

      <!-- Hello Guest/Username -->
      <!-- <span class="fw-semibold text-white bg-dark bg-opacity-50 px-3 py-1 rounded-pill shadow-sm ms-lg-3 mt-3 mt-lg-0 d-block">
        Hello, !
      </span> -->
    </div>
  </div>
</nav>

<main class="container-fluid px-0">