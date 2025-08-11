<?php 
    // Developed By: Aniket Kumar Jha
    require ('header.php');
    if(isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        if($type == 'status') {
            $operation = get_safe_value($con, $_GET['operation']);
            $id = get_safe_value($con, $_GET['id']);
            $status = ($operation == 'active') ? '1' : '0';
            $update_status = "UPDATE cc_category SET status='$status' WHERE id='$id'";
            mysqli_query($con, $update_status);
        }
        if($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM cc_category WHERE id='$id'";
        mysqli_query($con, $delete_sql);
        }
    }
    $sql = "SELECT * FROM cc_category ORDER BY id ASC";
    $res = mysqli_query($con, $sql);
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0">🍫 Categories</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    if (mysqli_num_rows($res) > 0) {
                                        while($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['categories']?></td>
                                    <td>
                                        <?php 
                                            if($row['status'] == 1) {
                                                echo "<a href='?type=status&operation=deactive&id=".$row['id']."' class='badge bg-success text-decoration-none'>Active</a>";
                                            } else {
                                                echo "<a href='?type=status&operation=active&id=".$row['id']."' class='badge bg-danger text-decoration-none'>Deactive</a>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $row['created_at']?></td>
                                    <td>
                                        <?php
                                            echo '<a href="manage_categories.php?id='.$row['id'].'" class="btn btn-sm btn-primary rounded-pill px-3 me-1">Edit</a>';
                                            echo '<a href="?type=delete&id='.$row['id'].'" class="btn btn-sm btn-danger rounded-pill px-3">Delete</a>';
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">No categories found.</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="manage_categories.php" class="btn btn-dark rounded-pill px-4">+ Add Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>