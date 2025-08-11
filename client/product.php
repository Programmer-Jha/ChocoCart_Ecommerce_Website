<?php 
  // Developed By: Aniket Kumar Jha
  require ('header.php');
  $product_id = get_safe_value($con, $_GET['id']);
  $get_product = get_product($con, '', '', $product_id);
  $related_products = get_related_products($con, $get_product[0]['categories_id'], $product_id);
?>

<div class="mb-5">
  <img src="../assets/images/logo.svg" alt="Chocolate Categories Banner" class="img-fluid rounded shadow-sm w-100"
    style="max-height: 150px; object-fit: cover;">
</div>

<div class="container my-5">

  <!-- Product Detail Card -->
  <div class="row">
    <div class="col-md-6">
      <img src="../assets/images/uploads/<?php echo $get_product['0']['image']?>" alt="Chocolate Delight"
        class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
    </div>
    <div class="col-md-6">
      <h2 class="mb-3">
        <?php echo $get_product['0']['name']?>
      </h2>
      <p class="text-muted">Category: <strong>
          <?php echo $get_product['0']['categories']?>
        </strong></p>
      <h4 class="text-muted mb-4">MRP: ₹
        <strike><?php echo $get_product['0']['mrp']?></strike>
      </h4>
      <h4 class="text-danger mb-4">Our Price: ₹
        <?php echo $get_product['0']['selling_price']?>
      </h4>

      <p>
        <?php echo $get_product['0']['short_desc']?>
      </p>

      <!-- <div class="d-flex align-items-center mb-3">
        <input type="number" id="quantity" class="form-control" value="1" min="1" style="width: 80px;">
      </div> -->
      <form method="POST" action="add_to_cart.php" class="d-flex align-items-center mb-3">
        <input type="hidden" name="product_id" value="<?php echo $get_product[0]['id']; ?>">
        <label for="quantity" class="me-3 fw-semibold">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control d-inline" value="1" min="1" style="width: 80px; display: none;"> <br>
        <button type="submit" class="btn btn-danger btn-lg">Add to Cart</button>
      </form>

    </div>
  </div>

  <!-- Additional Info / Description -->
  <div class="mt-5">
    <h5>Description</h5>
    <p>
      <?php echo $get_product['0']['description']?>
    </p>
  </div>

  <style>
    .related-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 16px;
    }

    .related-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .related-card img {
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }

    .related-btn {
      transition: all 0.3s ease;
    }

    .related-btn:hover {
      background-color: #563d7c;
      color: #fff;
      border-color: #563d7c;
    }
  </style>


  <div class="mt-5">
    <h5>Related Products</h5><br>
    <div class="row g-4">
      <?php
      $cat_id = $get_product[0]['categories_id'];
      $product_id = $get_product[0]['id'];

      $related_sql = "SELECT * FROM cc_product WHERE categories_id='$cat_id' AND status=1 AND id!='$product_id' ORDER BY RAND() LIMIT 4";
      $related_res = mysqli_query($con, $related_sql);

      while($row = mysqli_fetch_assoc($related_res)) {
    ?>
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card related-card h-100 shadow-sm">
          <img src="../assets/images/uploads/<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>"
            class="card-img-top" style="height: 180px; object-fit: cover;">
          <div class="card-body d-flex flex-column justify-content-between">
            <h6 class="card-title">
              <?php echo $row['name'] ?>
            </h6>
            <p class="card-text text-danger mb-2">₹
              <?php echo $row['selling_price'] ?>
            </p>
            <a href="product.php?id=<?php echo $row['id'] ?>"
              class="btn btn-outline-dark btn-sm related-btn">Explore</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>



</div>

<?php require ('footer.php') ?>