<?php
    // Developed By: Aniket Kumar Jha
    require('header.php');
    $msg = '➕ Add New Category';
    $mes = '';
    $category = '';
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $msg = "Edit Category";
        $id = get_safe_value($con, $_GET['id']);
        $res = mysqli_query($con, "SELECT * FROM cc_category WHERE id='$id'");
        $check = mysqli_num_rows($res);
        if($check > 0) {
            $row=mysqli_fetch_assoc($res);
            $category = $row['categories'];
        } else {
            header('location:categories.php');
            die();
        }
    }
    if(isset($_POST['submit'])) {
        $category = get_safe_value($con, $_POST['category']);

        $res = mysqli_query($con, "SELECT * FROM cc_category WHERE categories='$category'");
        $check = mysqli_num_rows($res);
        if($check > 0) {
            if(isset($_GET['id']) && $_GET['id'] != '') {
                $getdata = mysqli_fetch_assoc($res);
                if($id == $getdata['id']) {

                } else {
                    $mes = "<div class='alert alert-danger'>❌Category Already Created!</div>";
                }
            }
            $msg = "<div class='alert alert-danger'>❌Category Already Created!</div>";
        }
        if($mes == '') {
            if(isset($_GET['id']) && $_GET['id'] != '') {
                mysqli_query($con, "UPDATE cc_category SET categories='$category' WHERE id='$id'");
            } else {
                mysqli_query($con, "INSERT INTO cc_category(categories, status) VALUES('$category', '1')");
            }
            header('location:categories.php');
            die();
        }
    }
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0"><?php echo $msg; ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category Name</label>
                            <input type="text" name="category" id="category_name" class="form-control" required value="<?php echo $category; ?>">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark rounded-pill px-4" name="submit">Save</button>
                            <a href="categories.php" class="btn btn-secondary rounded-pill px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>