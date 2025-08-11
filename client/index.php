<?php 
  // Developed By: Aniket Kumar Jha
  require ('header.php'); 
?>

<!-- Carousel Started -->
<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
      aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../assets/images/Carousel1.webp" class="d-block w-100"
        alt="Premium chocolate assortment in elegant packaging">
      <div class="carousel-caption d-none d-md-block">
        <h5>Indulge in Luxury</h5>
        <p>Our premium chocolate collection crafted with the finest ingredients</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../assets/images/Carousel2.webp" class="d-block w-100"
        alt="Chocolate artisan crafting truffles in a workshop">
      <div class="carousel-caption d-none d-md-block">
        <h5>Handcrafted Perfection</h5>
        <p>Each chocolate is meticulously crafted by our master chocolatiers</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../assets/images/Carousel3.webp" class="d-block w-100"
        alt="Gourmet chocolate gift box with assorted chocolates">
      <div class="carousel-caption d-none d-md-block cul">
        <h5>Perfect Gifts</h5>
        <p>Surprise your loved ones with our exquisite chocolate gifts</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div><br>
<!-- Carousel Ended -->
<div class="text-center mb-4">
  <h2 class="fw-bold text-dark">Our Delicious Chocolates</h2>
  <p class="text-muted">Discover our handpicked collection of chocolates crafted with love and passion.</p>
</div>
<!-- Cards Started -->
<div class="container my-5">
  
  <div class="row justify-content-center g-4">
    <?php
      $get_product = get_product($con, 8);
      foreach($get_product as $list) {
    ?>
    <div class="col-md-3 col-sm-6 d-flex justify-content-center">
      <div class="card border-0 rounded-4 shadow-sm h-100 product-card" style="width: 18rem; transition: all 0.3s ease;">
        <img src="../assets/images/uploads/<?php echo $list['image']?>" class="card-img-top rounded-top-4 img-fluid" alt="<?php echo $list['name']?>" style="height: 200px; object-fit: cover;">
        <div class="card-body text-center d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title fw-semibold text-dark"><?php echo $list['name']?></h5>
            <p class="text-muted small"><?php echo $list['short_desc']?></p>
            <p class="card-text text-danger fw-bold mb-2 small text-muted">MRP: <strike>₹<?php echo $list['mrp']?></strike></p>
            <p class="card-text text-primary fw-bold mb-2">Our Price: ₹<?php echo $list['selling_price']?></p>
          </div>
          <a href="product.php?id=<?php echo $list['id']?>" class="btn btn-dark rounded-pill mt-auto px-4">Explore Now</a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<!-- Cards Ended -->

<div class="mb-5">
  <img src="../assets/images/logo.svg" alt="Chocolate Categories Banner" class="img-fluid rounded shadow-sm w-100"
    style="max-height: 300px; object-fit: cover;">
</div>

<!-- Feature Highlights -->
<div class="container my-5">
  <div class="row text-center g-4">
    <div class="col-md-4">
      <div class="feature-box p-4 rounded-4 shadow-sm h-100">
        <img src="../assets/images/delivery.avif" width="60" alt="Fast Delivery" class="mb-3">
        <h5 class="fw-bold">Fast & Free Delivery</h5>
        <p class="text-muted small mb-0">Across all major cities with no extra cost</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="feature-box p-4 rounded-4 shadow-sm h-100">
        <img src="../assets/images/secure.png" width="60" alt="Secure Payment" class="mb-3">
        <h5 class="fw-bold">Secure Payments</h5>
        <p class="text-muted small mb-0">We ensure encrypted and trusted checkout</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="feature-box p-4 rounded-4 shadow-sm h-100">
        <img src="../assets/images/gift.jpg" width="60" alt="Gift Options" class="mb-3">
        <h5 class="fw-bold">Gifting Made Easy</h5>
        <p class="text-muted small mb-0">Personalized chocolates and packaging</p>
      </div>
    </div>
  </div>
</div>

<!-- Testimonials -->
<section class="bg-light py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-5">🍫 What Our Customers Say</h2>
    <div class="row g-4 justify-content-center">
      
      <!-- Testimonial 1 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-3 rounded-4 hover-shadow transition">
          <img src="../assets/images/riya.webp" alt="User" class="rounded-circle mx-auto d-block mb-3 shadow-sm" width="70">
          <blockquote class="blockquote mb-0">
            <p class="fst-italic">“Absolutely delicious and fresh! My go-to chocolate shop now.”</p>
            <footer class="blockquote-footer mt-2">Riya Trivedi <cite title="Mumbai">Mumbai</cite></footer>
          </blockquote>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-3 rounded-4 hover-shadow transition">
          <img src="../assets/images/amit.jpeg" alt="User" class="rounded-circle mx-auto d-block mb-3 shadow-sm" width="70">
          <blockquote class="blockquote mb-0">
            <p class="fst-italic">“Great packaging and on-time delivery. Perfect for gifting!”</p>
            <footer class="blockquote-footer mt-2">Amit Randhawa <cite title="Delhi">Delhi</cite></footer>
          </blockquote>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-3 rounded-4 hover-shadow transition">
          <img src="../assets/images/sneha.jpg" alt="User" class="rounded-circle mx-auto d-block mb-3 shadow-sm" width="70">
          <blockquote class="blockquote mb-0">
            <p class="fst-italic">“Loved the gift chocolate boxes. My kids are fans now!”</p>
            <footer class="blockquote-footer mt-2">Sneha Dubey <cite title="Pune">Pune</cite></footer>
          </blockquote>
        </div>
      </div>

    </div>
  </div>
</section>

<link rel="stylesheet" href="../assets/css/client/index.css">

<?php require ('footer.php')?>