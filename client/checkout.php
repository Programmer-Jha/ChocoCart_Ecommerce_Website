<?php 
// Developed By: Aniket Kumar Jha
require('header.php');

$user_id = $_SESSION['USER_ID'] ?? 0;
if ($user_id == 0) {
    echo "<script>alert('Please Login First, to view this page!'); window.location.href = 'login.php'; </script>";
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$user_sql = "SELECT name, mobile, email FROM cc_users WHERE id = $user_id";
$user_res = mysqli_query($con, $user_sql);
$user = mysqli_fetch_assoc($user_res);

$cart_items = [];
$total_price = 0;
$discount = 0;
$message = "No Promo Code";
$promo_code = "";
$final = 0;

$cart_sql = "SELECT * FROM cc_cart WHERE user_id = $user_id";
$cart_res = mysqli_query($con, $cart_sql);

while ($cart_row = mysqli_fetch_assoc($cart_res)) {
    $prod_id = $cart_row['product_id'];
    $qty = $cart_row['quantity'];

    $prod_sql = "SELECT name, image, selling_price FROM cc_product WHERE id = '$prod_id' LIMIT 1";
    $prod_res = mysqli_query($con, $prod_sql);
    $product = mysqli_fetch_assoc($prod_res);

    if ($product) {
        $subtotal = $product['selling_price'] * $qty;
        $total_price += $subtotal;

        $cart_items[] = [
            'product_id' => $prod_id,
            'qty' => $qty,
            'name' => $product['name'],
            'image' => $product['image'],
            'price' => $subtotal
        ];
    }
}
$final = $total_price - $discount;

if (isset($_POST['applypromo'])) {
    $promo_code = get_safe_value($con, $_POST['promoname']);
    $promo = mysqli_query($con, "SELECT * FROM cc_promo WHERE code='$promo_code'");
    if ($promo && mysqli_num_rows($promo) > 0) {
        $promores = mysqli_fetch_assoc($promo);
        $promorate = $promores['rate'];
        $discount = round(($promorate / 100) * $total_price, 2);
        $message = "Great, you get a discount of ₹" . number_format($discount, 2) . "!";
        $final = $total_price - $discount;
    } else {
        $message = "Invalid Promo Code!";
        $discount = 0;
        $final = $total_price - $discount;
    }
}

if (isset($_POST['submit'])) {

    $discount = $_POST['discount'] ?? 0;
    $promo_code = $_POST['promo_code'] ?? '';

    $address = get_safe_value($con, $_POST['address']);
    $country = get_safe_value($con, $_POST['country']);
    $state = get_safe_value($con, $_POST['state']);
    $city = get_safe_value($con, $_POST['city']);
    $pin_code = get_safe_value($con, $_POST['pincode']);
    $payment_type = get_safe_value($con, $_POST['payment']);
    $payment_status = 'pending';
    $order_status = '1';
    if($payment_type == 'COD') {
      $payment_status = 'success';
    }
    $final = $total_price - $discount;

    mysqli_query($con, "INSERT INTO cc_order(user_id, address, country, state, city, pin_code, payment_type, total_price, payment_status, order_status, discount, final_price, promo_code) VALUES('$user_id', '$address', '$country', '$state', '$city', '$pin_code', '$payment_type', '$total_price', '$payment_status', '$order_status', '$discount', '$final', '$promo_code')");

    $order_id = mysqli_insert_id($con);
    $order_date = date('d-m-Y');

    $name = '';
    $qty = '';
    $price = '';
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $name = get_safe_value($con, $item['name']);
        $image = get_safe_value($con, $item['image']);
        $qty = $item['qty'];
        $price = $item['price'];

        mysqli_query($con, "INSERT INTO cc_order_details(order_id, product_id, name, image, qty, price) VALUES('$order_id', '$product_id', '$name', '$image', '$qty', '$price')");
    }

    mysqli_query($con, "DELETE FROM cc_cart WHERE user_id = '$user_id'");
    header('location: thank_you.php');
    // Send email using PHPMailer
    require '../includes/PHPMailer/Exception.php';
    require '../includes/PHPMailer/PHPMailer.php';
    require '../includes/PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'Senders Email Address';
      $mail->Password   = 'Emails App Password';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;

      $mail->setFrom('Senders Email Address', 'ChocoCart');
      $user_query = mysqli_query($con, "SELECT  name, email FROM cc_users WHERE id='$user_id'");
      $user = mysqli_fetch_assoc($user_query);
      $mail->addAddress($user['email']);
      $unit_price = $price / $qty;
      $mail->isHTML(true);

      $invoice_rows = "";
      foreach ($cart_items as $item) {
        $name = $item['name'];
        $qty = (int)$item['qty'];
        $price = (float)$item['price'];
        $unit_price = $qty > 0 ? number_format($price / $qty, 2) : '0.00';

        $invoice_rows .= "
        <tr>
          <td>{$name}</td>
          <td>{$qty}</td>
          <td>₹{$unit_price}</td>
          <td>₹{$price}</td>
        </tr>";
      }

      $mail->Subject = 'Thank You for Your Purchase, Here Your ChocoCart Invoice!';
      $mail->Body = "<html>
                      <head>
                        <title>ChocoCart - Your Invoice</title>
                        <style>
                          table {
                            width: 100%;
                            border-collapse: collapse;
                            font-family: Arial, sans-serif;
                          }
                          th, td {
                            border: 1px solid #ddd;
                            padding: 10px;
                            text-align: left;
                          }
                          th {
                            background-color: #f2b632;
                            color: #4e2c0e;
                          }
                        </style>
                      </head>
                      <body style='font-family: Arial, sans-serif; background-color: #f3f2ef; padding: 20px;'>
                        <div style='max-width: 600px; margin: auto; background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>

                          <h2 style='color: #6b3e26; text-align: center;'>🧾 Your ChocoCart Invoice</h2>

                          <p>Hi <strong>{$user['name']}</strong>,</p>

                          <p>Thank you for your order with <strong>ChocoCart</strong>! Here's a summary of your purchase:</p>

                          <table border='Solid Black 5px'>
                            <tr>
                              <th>Item Name</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Total</th>
                            </tr>
                            {$invoice_rows}
                            <tr>
                              <th colspan='3' style='text-align:right;'>Total Amount:</th>
                              <th>₹$total_price</th>
                            </tr>
                            <tr>
                              <th colspan='3' style='text-align:right;'>Discount:</th>
                              <th>₹$discount</th>
                            </tr>
                            <tr>
                              <th colspan='3' style='text-align:right;'>Final Price to Pay:</th>
                              <th>₹$final</th>
                            </tr>
                          </table>

                          <br>
                          <p><strong>Order ID:</strong> $order_id<br>
                          <strong>Order Date:</strong> $order_date</p>

                          <p>If you have any queries or concerns regarding your order, our support team will get back to you shortly. We're always here to assist you!</p>

                          <p>We hope your day is as sweet as your chocolates 🍫</p>

                          <br>
                          <p>Warm regards,<br>
                          <strong>ChocoCart Support Team</strong><br>
                          Your Email Address</p>

                        </div>
                      </body>
                    </html>";
      $mail->send();
      $otp_msg = "Invoice Sent Successfully!";
    } catch (Exception $e) {
      $otp_msg = "Mailer Error: " . $mail->ErrorInfo;
    }
    exit();
}
?>


<div class="container my-5">
  <div class="row">
    <!-- Left: Address Form -->
    <div class="col-lg-7 mb-4">
      <div class="card p-4 shadow-sm">
        <h4 class="mb-4 fw-bold">Shipping Information</h4>
        <form id="checkoutForm" method="POST">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="fullname" class="form-label">Full Name *</label>
              <input type="text" class="form-control" id="fullname" placeholder="Aniket Jha" name="name" required value="<?php echo $user['name']; ?>">
              <div class="invalid-feedback">Please provide your full name</div>
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label">Contact Number *</label>
              <input type="tel" class="form-control" id="phone" name="number" placeholder="e.g. 9876543210" required value="<?php echo $user['mobile']; ?>">
              <div class="invalid-feedback">Please provide a valid 10-digit phone number</div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email Address *</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="aniket@chococart.com" required value = "<?php echo $user['email']; ?>">
            <div class="invalid-feedback">Please provide a valid email address</div>
          </div>
          
          <div class="mb-3">
            <label for="address" class="form-label">Address *</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your Address here." required>
            <div class="invalid-feedback">Please provide your address</div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="country" class="form-label">Country *</label>
              <select class="form-select" id="country" required name="country">
                <option value="" selected disabled>Choose...</option>
                <option value="INDIA">India</option>
                <option value="USA">United States of America</option>
                <option value="CANADA">Canada</option>
                <option value="UK">United Kingdom</option>
                <option value="AUSTRALIA">Australia</option>
              </select>
              <div class="invalid-feedback">Please select a country</div>
            </div>
            <div class="col-md-6">
              <label for="state" class="form-label">State *</label>
              <select class="form-select" id="state" required name="state">
                <option value="" selected disabled>Choose...</option>
                <option value="BR">Bihar</option>
                <option value="GJ">Gujarat</option>
                <option value="RJ">Rajasthan</option>
                <option value="MH">Maharashtra</option>
                <option value="UP">Uttar Pradesh</option>
                <option value="MP">Madhya Pradesh</option>
                <option value="HP">Himachal Pradesh</option>
                <option value="JH">Jharkhand</option>
                <option value="DL">Delhi</option>
                <option value="WB">West Bengal</option>
            </select>
              <div class="invalid-feedback">Please select a state</div>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="city" class="form-label">City *</label>
              <input type="text" class="form-control" id="city" placeholder="Enter your City" name="city" required>
              <div class="invalid-feedback">Please provide your city</div>
            </div>
            <div class="col-md-6">
              <label for="pincode" class="form-label">Postal Code *</label>
              <input type="text" class="form-control" id="pincode" placeholder="Enter 6 digit Pincode" name="pincode" required>
              <div class="invalid-feedback">Please provide your postal code</div>
            </div>
            <div class="col-12 col-md-12">
              <label for="country" class="form-label">Payment Methods *</label>
              <select class="form-select" id="payment" required name="payment">
                <option value="" selected disabled>Choose...</option>
                <option value="COD">Cash On Delivery</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="UPI">UPI</option>
              </select>
              <div class="invalid-feedback">Please select a Payment Method</div>
            </div>
          </div>
          
          <div class="d-grid gap-2 mb-3">
            <button class="btn btn-outline-choco" type="button" data-bs-toggle="collapse" data-bs-target="#promoCollapse">
              Have a promo code?
            </button>
            <div class="collapse" id="promoCollapse">
              <div class="card card-body">
                <div class="input-group">
                  <input type="text" class="form-control" id="promoMobile" placeholder="Enter Promo Code" name="promoname">
                  <button class="btn btn-choco" type="submit" name="applypromo">Apply</button>
                </div>
                <div id="promoFeedbackMobile" class="form-text mt-1">
                  <?php if (!empty($message)) echo $message; ?>
                </div>
              </div>
            </div>
          </div>

          <?php if ($discount > 0) : ?>
            <input type="hidden" name="discount" value="<?php echo $discount; ?>">
            <input type="hidden" name="promo_code" value="<?php echo $promo_code; ?>">
          <?php endif; ?>


          <div class="d-flex justify-content-between mt-4">
            <a href="cart.php" class="btn btn-outline-choco">← Back to Cart</a>
            <button type="submit" class="btn btn-choco" name="submit" value="submit">
              <span id="submitText">Proceed to Payment</span>
              <span id="spinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <!-- Right: Order Summary -->
    <div class="col-lg-5">
      <div class="card p-4 shadow-sm mb-4">
        <h4 class="mb-4 fw-bold">Order Summary</h4>
        <ul class="list-group mb-3">
          <?php 
            foreach ($cart_items as $item) {
                $name = $item['name'];
                $qty = (int) $item['qty'];
                $price = (float) $item['price'];
                $price_per_item = $qty > 0 ? number_format($price / $qty, 2) : '0.00';

                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                echo '<div>';
                echo "<div>{$name}</div>";
                echo "<small class='text-muted'>{$qty} × ₹{$price_per_item}</small>";
                echo '</div>';
                echo "<span>₹" . number_format($price, 2) . "</span>";
                echo '</li>';
            }
            ?>
          <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
            <div>
              <div>Discount</div>
              <small class="text-muted" id="discountText"><?php echo $message; ?></small>
            </div>
            <span id="discountAmount">₹<?php echo $discount ?></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center fw-bold fs-5">
            <div>Total</div>
            <div id="totalAmount">₹<?php echo $final; ?></div>
          </li>
        </ul>
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
.card {
  background-color: #fff8f0;
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(109, 76, 65, 0.15);
}
.btn-choco {
  background-color: #6d4c41;
  color: #fff;
  border: none;
  padding: 0.5rem 1.5rem;
  font-weight: 500;
}
.btn-choco:hover {
  background-color: #5d4037;
  color: #fff;
}
.btn-outline-choco {
  border: 2px solid #6d4c41;
  color: #6d4c41;
  background-color: transparent;
  padding: 0.5rem 1.5rem;
  font-weight: 500;
}
.btn-outline-choco:hover {
  background-color: #6d4c41;
  color: #fff;
}
.form-control:focus, .form-select:focus {
  border-color: #6d4c41;
  box-shadow: 0 0 0 0.2rem rgba(109, 76, 65, 0.25);
}
input[type="text"], input[type="tel"], input[type="email"], select {
  background-color: #fcefe6;
  border: 1px solid #d7ccc8;
  color: #4e342e;
}
input[type="text"]::placeholder, input[type="tel"]::placeholder, input[type="email"]::placeholder {
  color: #a1887f;
}
.form-check-input:checked {
  background-color: #6d4c41;
  border-color: #6d4c41;
}
.list-group-item {
  border-color: #d7ccc8;
}
.list-group-item.bg-light {
  background-color: #fcefe6 !important;
}
</style>

<?php require ('footer.php'); ?>