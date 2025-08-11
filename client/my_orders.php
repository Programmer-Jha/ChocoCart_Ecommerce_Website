<?php 
    // Developed By: Aniket Kumar Jha
    require ('header.php'); 
    if($user_id == 0) {
        echo "<script>alert('Login First, to View this Page!'); window.location.href='login.php';</script>";
    }
?>

<div class="container my-5">
    <h2 class="text-center mb-4 text-choco">My Orders 🍫</h2>

    <div class="table-responsive shadow rounded-4 overflow-hidden">
        <table class="table table-bordered table-hover align-middle choco-table">
            <thead class="table-choco text-white">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Shipping Address</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Discount</th>
                    <th>Price to Pay</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $res = mysqli_query($con, "SELECT cc_order.*,cc_order_status.name as str FROM cc_order, cc_order_status WHERE user_id='$user_id' AND cc_order_status.id=cc_order.order_status");
                    while($row = mysqli_fetch_assoc($res)) {
                        $order_id = $row['id'];
                        $collapse_id = 'orderDetails' . $order_id;
                ?>
                <tr class="order-summary">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['added_on']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['payment_type']; ?></td>
                    <td><span class="badge bg-success"><?php echo $row['payment_status']; ?></span></td>
                    <td><span class="badge bg-warning text-dark"><?php echo $row['str']; ?></span></td>
                    <td><?php echo $row['discount']; ?></td>
                    <td><?php echo $row['final_price']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-choco" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_id; ?>" aria-expanded="false">
                            View
                        </button>
                    </td>
                </tr>
                <tr class="collapse bg-light" id="<?php echo $collapse_id; ?>">
                    <td colspan="12">
                        <strong>Product Details:</strong>
                        <div class="table-responsive mt-3">
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
                            $i = 1;
                            while($row_detail = mysqli_fetch_assoc($res_details)) {
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
                            <td><?php echo $i++; ?></td>
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
            </tbody>

        </table>
    </div>
</div>

<?php require ('footer.php'); ?>