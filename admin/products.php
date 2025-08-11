<?php 
  // Developed By: Aniket Kumar Jha
  include('header.php');
  if(isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if($type == 'status') {
      $operation = get_safe_value($con, $_GET['operation']);
      $id = get_safe_value($con, $_GET['id']);
      if($operation == 'active') {
        $status = '1';
      } else {
        $status = '0';
      }
      $update_status_sql = "UPDATE cc_product SET status='$status' WHERE id='$id'";
      mysqli_query($con, $update_status_sql);
    }
    if($type=='delete') {
      $id = get_safe_value($con, $_GET['id']);
      $delete_sql = "DELETE FROM cc_product WHERE id='$id'";
      mysqli_query($con, $delete_sql);
    }
  } 
  $sql = "SELECT cc_product.*,cc_category.categories FROM cc_product,cc_category WHERE cc_product.categories_id=cc_category.id ORDER BY cc_product.id DESC";
  $res = mysqli_query($con, $sql);
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-white">🍫 Products Management</h2>
    <a href="manage_product.php" class="btn btn-primary px-4">+ Add Product</a>
  </div>

  <div class="table-responsive shadow-sm rounded-3">
    <table class="table table-hover align-middle bg-white border">
      <thead class="table-dark text-center">
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID</th>
          <th scope="col">Category</th>
          <th scope="col">Name</th>
          <th scope="col">MRP(₹)</th>
          <th scope="col">Selling Price(₹)</th>
          <th scope="col">Qty</th>
          <th scope="col">Image</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php
          $i = 1;
          while($row = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
          <td><?php echo $i++?></td>
          <td><?php echo $row['id']?></td>
          <td><?php echo $row['categories']?></td>
          <td><?php echo $row['name']?></td>
          <td><?php echo $row['mrp']?></td>
          <td><?php echo $row['selling_price']?></td>
          <td><?php echo $row['qty']?></td>
          <td><img src="../assets/images/uploads/<?php echo $row['image']?>" alt="Product Image" width="80"></td>
          <td>
            <?php 
              if($row['status'] == 1) {
                echo "<a href='?type=status&operation=deactive&id=".$row['id']."' class='badge bg-success text-decoration-none'>Active</a>";
              } else {
                echo "<a href='?type=status&operation=active&id=".$row['id']."' class='badge bg-danger text-decoration-none'>Deactive</a>";
              }
            ?>
          </td>
          <td>
            <?php
              echo '<a href="manage_product.php?id='.$row['id'].'" class="btn btn-sm btn-primary rounded-pill px-3 me-1">Edit</a>';
              echo '<a href="?type=delete&id='.$row['id'].'" class="btn btn-sm btn-danger rounded-pill px-3">Delete</a>';
          }
            ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php include('footer.php'); ?>