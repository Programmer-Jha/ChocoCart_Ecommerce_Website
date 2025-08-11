<?php
    // Developed By: Aniket Kumar Jha
    require('header.php');
    $categories_id = '';
    $name = '';
    $mrp = '';
    $selling_price = '';
    $qty = '';
    $image = '';
    $short_desc = '';
    $description = '';
    $status = '';

    $msg = '➕ Add New Product';
    $mes = '';
    $category = '';
    $image_required = 'required';
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $image_required = '';
        $msg = "Edit Product";
        $id = get_safe_value($con, $_GET['id']);
        $res = mysqli_query($con, "SELECT * FROM cc_product WHERE id='$id'");
        $check = mysqli_num_rows($res);
        if($check > 0) {
          $row=mysqli_fetch_assoc($res);
          $categories_id = $row['categories_id'];
          $name = $row['name'];
          $mrp = $row['mrp'];
          $selling_price = $row['selling_price'];
          $qty = $row['qty'];
          $short_desc = $row['short_desc'];
          $description = $row['description'];
        } else {
            header('location:products.php');
            die();
        }
    }
    if(isset($_POST['submit'])) {
        $categories_id = get_safe_value($con, $_POST['categories_id']);
        $name = get_safe_value($con, $_POST['name']);
        $mrp = get_safe_value($con, $_POST['mrp']);
        $selling_price = get_safe_value($con, $_POST['selling_price']);
        $qty = get_safe_value($con, $_POST['qty']);
        $short_desc = get_safe_value($con, $_POST['short_desc']);
        $description = get_safe_value($con, $_POST['description']);

        $res = mysqli_query($con, "SELECT * FROM cc_product WHERE name='$name'");
        $check = mysqli_num_rows($res);
        if($check > 0) {
            if(isset($_GET['id']) && $_GET['id'] != '') {
                $getdata = mysqli_fetch_assoc($res);
                if($id == $getdata['id']) {

                } else {
                  $mes = "<div class='alert alert-danger'>❌Product Already Created!</div>";
                }
            }
            $mes = "<div class='alert alert-danger'>❌Product Already Created!</div>";
        }
        if($mes == '') {
            if(isset($_GET['id']) && $_GET['id'] != '') {
              if($_FILES['image']['name'] != '') {
                $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],'../assets/images/uploads/'.$image);
                $update_sql = "UPDATE cc_product SET categories_id='$categories_id',name='$name',mrp='$mrp',selling_price='$selling_price',qty='$qty',short_desc='$short_desc',description='$description', image='$image' WHERE id='$id'";
              } else {
                $update_sql = "UPDATE cc_product SET categories_id='$categories_id',name='$name',mrp='$mrp',selling_price='$selling_price',qty='$qty',short_desc='$short_desc',description='$description' WHERE id='$id'";
              }
              mysqli_query($con, $update_sql);
            } else {
              $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'],'../assets/images/uploads/'.$image);
              mysqli_query($con, "INSERT INTO cc_product(categories_id, name, mrp, selling_price, qty, short_desc, description, status, image) VALUES('$categories_id', '$name', '$mrp', '$selling_price', '$qty', '$short_desc', '$description', '1', '$image')");
            }
            header('location:products.php');
            die();
        }
    }
?>

<div class="container mt-5">
  <div class="p-4 rounded shadow" style="background-color: #3b2f2f; color: #f8f2ed;">
    <h4 class="mb-4 text-center fw-bold" style="color: #ffe9c6;">🛍️ Add / Manage Product</h4>
    <?php echo $mes?>
    <h3><?php echo $msg?></h3>
    <form method="POST" enctype="multipart/form-data">

      <!-- Category Dropdown -->
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select class="form-select bg-light border-0" style="border-radius: 10px;" required name="categories_id">
          <option selected disabled>Select Category</option>
          <?php
            $res = mysqli_query($con, "SELECT id,categories FROM cc_category ORDER BY categories ASC");
            while($row=mysqli_fetch_assoc($res)) {
              if($row['id'] == $categories_id) {
                echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
              } else {
                echo "<option value=".$row['id'].">".$row['categories']."</option>";
              }
            }
          ?>
        </select>
      </div>

      <!-- Product Name -->
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control bg-light border-0" placeholder="Enter product name" style="border-radius: 10px;" name="name" value="<?php echo $name?>" required>
      </div>

      <!-- MRP & Selling Price -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">MRP</label>
          <input type="number" class="form-control bg-light border-0" placeholder="Enter MRP" style="border-radius: 10px;" name="mrp" value="<?php echo $mrp?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Selling Price</label>
          <input type="number" class="form-control bg-light border-0" placeholder="Enter Selling Price" style="border-radius: 10px;" name="selling_price" value="<?php echo $selling_price?>" required>
        </div>
      </div>

      <!-- Quantity -->
      <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" class="form-control bg-light border-0" placeholder="Enter quantity" style="border-radius: 10px;" name="qty" value="<?php echo $qty?>" required>
      </div>

      <!-- Image Upload -->
      <div class="mb-3">
        <label class="form-label">Product Image</label>
        <input type="file" class="form-control bg-light border-0" style="border-radius: 10px;" name="image" <?php echo $image_required?>>
      </div>

      <!-- Short Description -->
      <div class="mb-3">
        <label class="form-label">Short Description</label>
        <input type="text" class="form-control bg-light border-0" placeholder="Enter short description" style="border-radius: 10px;" name="short_desc" value="<?php echo $short_desc?>">
      </div>

      <!-- Full Description -->
      <div class="mb-3">
        <label class="form-label">Full Description</label>
        <textarea class="form-control bg-light border-0" rows="4" placeholder="Enter full product description" style="border-radius: 10px;" name="description"><?php echo $description?></textarea>
      </div>
      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="btn btn-choco px-4 mt-3" name="submit">Submit</button>
      </div>

    </form>
  </div>
</div>
<link rel="stylesheet" href="../assets/css/admin/manage_product.css">
<?php include('footer.php'); ?>