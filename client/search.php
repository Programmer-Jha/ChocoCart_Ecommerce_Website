<?php 
  // Developed By: Aniket Kumar Jha
  require('header.php'); 
  $product_query = null;
  if(isset($_POST['submit'])) {
    $product_name = get_safe_value($con, $_POST['productnm']);
    $product_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM cc_product WHERE name='$product_name'"));
  }
?>

<!-- 🍫 Search Results Page -->
<section class="py-5" style="background-color: #fdf6f0;">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">🔍 Find Your Favourite Chocolates</h2>
    
    <!-- Search Input Box -->
    <form class="d-flex justify-content-center mb-4" method="POST">
      <input type="text" class="form-control w-50 me-2 rounded-3 shadow-sm" placeholder="Search for chocolates, brands or categories..." style="border: 2px solid #b5651d;" name="productnm">
      <button type="submit" class="btn btn-choco px-4 shadow-sm" name="submit">
        <i class="bi bi-search-heart-fill"></i> Search
      </button>
    </form>

    <?php if ($product_query) { ?>
      <!-- Search Result -->
      <div class="row g-4">
        <div class="col-md-4 mx-auto">
          <div class="card border-0 shadow-sm h-100">
            <img src="../assets/images/uploads/<?php echo $product_query['image']; ?>" class="card-img-top" alt="<?php echo $product_query['name']; ?>" width="40">
            <div class="card-body">
              <h5 class="card-title"><?php echo $product_query['name']; ?></h5>
              <p class="card-text text-muted"><?php echo $product_query['short_desc']; ?></p>
              <a href="product.php?id=<?php echo $product_query['id']; ?>" class="btn btn-outline-choco btn-sm">View Product</a>
            </div>
          </div>
        </div>
      </div>
    <?php } elseif (isset($_POST['submit'])){ ?>
      <!-- No Product Found Message -->
      <div class="alert alert-warning text-center mt-4" role="alert">
        😕 Oops! No chocolates found matching "<strong><?php echo $_POST['productnm']; ?></strong>".
      </div>
    <?php } ?>
  </div>
    
</section>
<link rel="stylesheet" href="../assets/css/client/search.css">
<?php 
  require('footer.php'); 
?>