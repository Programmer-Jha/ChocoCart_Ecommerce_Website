<?php 
    // Developed By: Aniket Kumar Jha
    require ('header.php'); 
?>

<div class="container my-5">
    <h2 class="text-center text-choco mb-4">ChocoCart Admin Panel - Orders 🍫</h2>

    <div class="table-responsive shadow rounded-4 overflow-hidden">
        <table class="table table-bordered table-hover align-middle choco-table">
            <thead class="table-choco text-white">
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Shipping Address</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Discount</th>
                    <th>Price to Pay</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $res = mysqli_query($con, "SELECT cc_order.*, cc_order_status.name as str FROM cc_order, cc_order_status WHERE cc_order_status.id = cc_order.order_status");
                    if (!$res) {
                        die("Query failed: " . mysqli_error($con));
                    }

                    if (mysqli_num_rows($res) == 0) {
                        echo "<tr><td colspan='8' class='text-center'>No orders found.</td></tr>";
                    } else {
                        $io = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $order_id = $row['id'];
                            $collapse_id = 'orderDetails' . $order_id;

                            $user_query = mysqli_query($con, "SELECT * FROM cc_users WHERE id='".$row['user_id']."'");                            $user = mysqli_fetch_assoc($user_query);
                            $user_name = $user['name'];
                ?>
                <tr class="order-summary">
                    <td><?php echo $io++; ?></td>
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $user_name ?></td>
                    <td><?php echo $row['added_on']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['payment_type']; ?></td>
                    <td><span class="badge bg-success"><?php echo $row['payment_status']; ?></span></td>
                    <td><span class="badge bg-warning text-dark"><?php echo $row['str']; ?></span></td>
                    <td><?php echo $row['discount']; ?></td>
                    <td><?php echo $row['final_price']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-choco btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_id; ?>" aria-expanded="false">
                            View
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm"><a href="order_status_update.php?order_id=<?php echo $order_id; ?>">UPDATE</a></button>
                    </td>
                </tr>
                <tr class="collapse bg-light" id="<?php echo $collapse_id; ?>">
                    <td colspan="15" class="text-center">
                        <div class="table-responsive mt-3 d-inline-block text-start">
                        <strong>Product Details:</strong>
                        <table class="table table-sm table-bordered">
                        <thead class="table-choco text-white">
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $res_details = mysqli_query($con, "SELECT * FROM cc_order_details WHERE order_id='$order_id'");
                            if (!$res_details) {
                                die("Query failed: " . mysqli_error($con));
                            }
                            $ii = 1;
                            while ($row_detail = mysqli_fetch_assoc($res_details)) {
                                $product_id = $row_detail['product_id'];
                                $qty = $row_detail['qty'];
                                $price = $row_detail['price'];

                                $product_query = mysqli_query($con, "SELECT * FROM cc_product WHERE id='$product_id'");
                                $product = mysqli_fetch_assoc($product_query);

                                $productName = $product['name'];
                                $productimage = $product['image'];
                                $productcat_id = $product['categories_id'];

                                $categoryquery = mysqli_query($con, "SELECT * FROM cc_category WHERE id='$productcat_id'");
                                $category = mysqli_fetch_assoc($categoryquery);

                                $cat_name = $category['categories'];
                        ?>
                        <tr>
                            <td><?php echo $ii++; ?></td>
                            <td><?php echo $product_id; ?></td>
                            <td><?php echo $productName; ?></td>
                            <td><?php echo $cat_name; ?></td>
                            <td><img src="../assets/images/uploads/<?php echo $productimage; ?>" width="30"></td>
                            <td><?php echo $qty; ?></td>
                            <td>₹<?php echo $price; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </td>
            </tr>
            <?php } ?>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<?php require ('footer.php'); ?>