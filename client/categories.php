<?php 
  // Developed By: Aniket Kumar Jha
  require ('header.php');
  $cat_id = get_safe_value($con, $_GET['id']);
  $get_product = get_product($con, '', $cat_id);
?>

<div class="mb-5">
  <img src="../assets/images/logo.svg" alt="Chocolate Categories Banner" class="img-fluid rounded shadow-sm w-100"
    style="max-height: 300px; object-fit: cover;">
</div>

<div class="container my-5">
  <h2 class="text-center mb-4">Chocolate Collection</h2><br>

  <div class="row g-4">
    <?php 
    if(count($get_product) > 0) {
  ?>
    <!-- Example Product Card -->
    <div class="row justify-content-center">
      <?php foreach($get_product as $list) { ?>
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
        <div class="card border-0 shadow-sm rounded-4 h-100 product-card position-relative"
          style="transition: all 0.3s ease-in-out;">
          <a href="product.php?id=<?php echo $list['id'] ?>">
            <img src="../assets/images/uploads/<?php echo $list['image'] ?>"
              class="card-img-top img-fluid rounded-top-4" alt="..." style="height: 200px; object-fit: cover;">
          </a>
          <div class="card-body text-center px-3 pb-4">
            <h5 class="card-title fw-bold">
              <?php echo $list['name'] ?>
            </h5>
            <p class="text-muted small">MRP ₹
              <strike><?php echo $list['mrp'] ?></strike>
            </p>
            <p class="text-muted">Only ₹
              <?php echo $list['selling_price'] ?>
            </p>
            <a href="product.php?id=<?php echo $list['id'] ?>"
              class="btn btn-outline-primary btn-sm rounded-pill mt-2">Explore Now</a>
          </div>
          <!-- Optional Badge -->
          <span
            class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-warning text-dark mt-2 me-2">
            New
          </span>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php
    } else {
      echo "<div class='text-center text-muted fs-5'>Products in this category are not available!</div>";
    }
  ?>
  </div>

  <style>
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 20px 0px, rgba(0, 0, 0, 0.1) 0px 6px 6px 0px;
    }
  </style>

</div>
</div>


<?php require ('footer.php') ?>