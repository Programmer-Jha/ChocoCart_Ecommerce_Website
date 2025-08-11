<?php 
  // Developed By: Aniket Kumar Jha
  require ('header.php');
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">
      <!-- Thank You Card -->
      <div class="card border-0 shadow-lg overflow-hidden">
        <div class="card-body p-0">
          <!-- Chocolate Header -->
          <div class="bg-choco text-white py-5 position-relative overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
              <div class="d-flex justify-content-around align-items-center h-100">
                <i class="bi bi-heart-fill" style="font-size: 8rem;"></i>
                <i class="bi bi-star-fill" style="font-size: 6rem;"></i>
                <i class="bi bi-heart-fill" style="font-size: 8rem;"></i>
              </div>
            </div>
            
            <div class="position-relative z-1">
              <div class="display-1 mb-3">
                <i class="bi bi-check-circle-fill text-success"></i>
              </div><br><br><br>
              <h1 class="display-4 fw-bold">Thank You!</h1>
              <p class="lead mb-0">For choosing ChocoCart!</p>
            </div>
          </div>
          
          <!-- Message Section -->
          <div class="p-5">
            <div class="mb-5">
              <p class="fs-5 mb-4">
                Your order has been successfully placed and is being prepared with love. 
                We're excited to bring our handcrafted chocolates to your doorstep!
              </p>
              <p class="text-muted">
                We've sent a confirmation email with all the details of your purchase. 
                Our team is carefully packing your chocolates to ensure they arrive in perfect condition.
              </p>
            </div>
            
            <!-- Decorative Divider -->
            <div class="d-flex align-items-center justify-content-center my-5">
              <div class="flex-grow-1 border-top border-choco"></div>
              <div class="mx-4 text-choco">
                <i class="bi bi-heart-fill"></i>
              </div>
              <div class="flex-grow-1 border-top border-choco"></div>
            </div>
            
            <!-- Special Message -->
            <div class="bg-light rounded p-4 mb-5">
              <h3 class="text-choco fw-bold mb-3">A Sweet Thank You</h3>
              <p class="mb-0">
                Every purchase helps us continue our passion for creating exceptional chocolates. 
                We're grateful for your support and can't wait for you to enjoy your treats!
              </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-grid gap-3 d-md-flex justify-content-md-center">
              <a href="index.php" class="btn btn-choco btn-lg px-5 py-3">
                <i class="bi bi-arrow-left me-2"></i> Continue Shopping
              </a>
              <a href="contact.php" class="btn btn-outline-choco btn-lg px-5 py-3">
                <i class="bi bi-chat-dots me-2"></i> Contact Us
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Additional Features -->
      <div class="row mt-5">
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <div class="text-choco mb-3">
                <i class="bi bi-truck fs-1"></i>
              </div>
              <h5 class="fw-bold">Fast Delivery</h5>
              <p class="text-muted mb-0">Your chocolates will be delivered fresh and on time</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <div class="text-choco mb-3">
                <i class="bi bi-shield-check fs-1"></i>
              </div>
              <h5 class="fw-bold">Quality Guarantee</h5>
              <p class="text-muted mb-0">100% satisfaction guaranteed with every purchase</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <div class="text-choco mb-3">
                <i class="bi bi-gift fs-1"></i>
              </div>
              <h5 class="fw-bold">Special Offers</h5>
              <p class="text-muted mb-0">Check your email for exclusive discounts on your next order</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Chocolate Pattern Footer -->
      <div class="mt-5 text-center">
        <div class="d-flex justify-content-center mb-3">
          <div class="chocolate-dot"></div>
          <div class="chocolate-dot"></div>
          <div class="chocolate-dot"></div>
        </div>
        <p class="text-muted">Made with passion, delivered with love</p>
      </div>
    </div>
  </div>
</div>

<style>
body {
  background-color: #fffaf5;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #4e342e;
}

/* Chocolate Theme Colors */
.bg-choco {
  background: linear-gradient(135deg, #6d4c41 0%, #5d4037 100%);
}
.text-choco {
  color: #6d4c41;
}
.border-choco {
  border-color: #6d4c41 !important;
}
.btn-choco {
  background-color: #6d4c41;
  color: #fff;
  border: none;
  transition: all 0.3s ease;
}
.btn-choco:hover {
  background-color: #5d4037;
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(109, 76, 65, 0.3);
}
.btn-outline-choco {
  border: 2px solid #6d4c41;
  color: #6d4c41;
  background-color: transparent;
  transition: all 0.3s ease;
}
.btn-outline-choco:hover {
  background-color: #6d4c41;
  color: #fff;
  transform: translateY(-2px);
}

/* Card Styling */
.card {
  background-color: #fff8f0;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(109, 76, 65, 0.15);
  transition: transform 0.3s ease;
}
.card:hover {
  transform: translateY(-5px);
}

/* Success Icon */
.bi-check-circle-fill {
  color: #4caf50;
  text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

/* Chocolate Dots */
.chocolate-dot {
  width: 12px;
  height: 12px;
  background-color: #6d4c41;
  border-radius: 50%;
  margin: 0 5px;
  opacity: 0.7;
}

/* Animation */
.card {
  animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Adjustments */
@media (max-width: 767.98px) {
  .display-4 {
    font-size: 2.5rem;
  }
  .btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
  }
}
</style>

<?php require ('footer.php'); ?>