<?php 
    // Developed By: Aniket Kumar Jha
    require('header.php'); 
    $order_id = get_safe_value($con, $_GET['order_id']);

    $orderquery = mysqli_query($con, "SELECT order_status FROM cc_order WHERE id='$order_id'");
    $order = mysqli_fetch_assoc($orderquery);
    $order_status = $order['order_status'];

    if(isset($_POST['update_order_status'])) {
        $update_order_status = $_POST['update_order_status'];
        mysqli_query($con, "UPDATE cc_order SET order_status='$update_order_status' WHERE id='$order_id'");
        header('location: orders.php');
    }
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card border-0 shadow rounded-4">
        <div class="card-header bg-choco text-white text-center fs-4 fw-semibold">
          🍫 Update Order Status
        </div>

        <div class="card-body bg-light-choco">
          <form method="POST">
            <div class="mb-4">
              <label for="orderId" class="form-label fw-medium">Order ID</label>
              <input type="text" id="orderId" class="form-control form-control-lg border-0 shadow-sm rounded-3" name="orderid" value="<?php echo $order_id; ?>" required>
            </div>

            <div class="mb-4">
              <label for="currentStatus" class="form-label fw-medium">Current Status</label>
              <input type="text" id="currentStatus" class="form-control form-control-lg border-0 shadow-sm rounded-3" name="current_status" value="<?php echo $order_status; ?>" required>
            </div>

            <div class="mb-4">
              <label for="updateStatus" class="form-label fw-medium">Update Status</label>
              <select class="form-select bg-light border-0" style="border-radius: 10px;" required name="update_order_status">
                <option selected disabled>Select Status</option>
                <?php
                    $res = mysqli_query($con, "SELECT * FROM cc_order_status");
                    while($row=mysqli_fetch_assoc($res)) {
                        if($row['id'] == $categories_id) {
                            echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                        } else {
                            echo "<option value=".$row['id'].">".$row['name']."</option>";
                        }
                    }
                ?>
              </select>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-choco btn-lg shadow rounded-pill" name="submit">Update Status</button>
            </div>
          </form>
        </div>

        <div class="card-footer text-center text-muted small bg-white">
          ChocoCart Customers are waiting for the delivery!
        </div>
      </div>

    </div>
  </div>
</div>
<link rel="stylesheet" href="../assets/css/admin/order_status_update.css">
<?php require('footer.php'); ?>