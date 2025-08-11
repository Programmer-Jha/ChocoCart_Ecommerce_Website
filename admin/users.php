<?php 
    // Developed By: Aniket Kumar Jha
    require('header.php'); 
    if(isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        if($type == 'delete') {
            $id = get_safe_value($con, $_GET['id']);
            $delete_sql = "DELETE FROM cc_users WHERE id='$id'";
            mysqli_query($con, $delete_sql);
        }
    }
?>
<div class="main-content">
  <div class="wrapper">
    <h1 class="page-title">Users</h1>

    <div class="card">
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>S.No</th>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Mobile</th>
              <th>Created On</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $res = mysqli_query($con, "SELECT * FROM cc_users ORDER BY id ASC");
            while($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['pswd']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['added_on']; ?></td>
            <td>
                <?php
                    echo '<a href="?type=delete&id='.$row['id'].'" class="btn btn-sm btn-danger rounded-pill px-3">Delete</a>';
                ?>
            </td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<?php include('footer.php'); ?>