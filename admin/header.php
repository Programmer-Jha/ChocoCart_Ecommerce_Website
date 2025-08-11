<?php
    // Developed By: Aniket Kumar Jha
    require ('../includes/connection.php');
    require ('../includes/functions.php');
    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {

    } else {
        header('location:login.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel | ChocoCart</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/admin/header.css">
  <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
</head>
<body>
  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="dashboard.php">🍫 ChocoCart Admin</a>
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarChoco">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarChoco">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        </ul>

        <div class="d-flex">
          <span class="me-3 fw-semibold">Hello, Aniket!</span>
          <a href="logout.php" class="icon-btn" title="Logout">
            <i class="bi bi-box-arrow-right fs-5"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <main class="container py-4">