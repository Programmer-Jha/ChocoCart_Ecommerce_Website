<?php
    // Developed By: Aniket Kumar Jha
    require ('../includes/connection.php');
    require ('../includes/functions.php');
    $msg = '';
    if(isset($_POST['submit'])) {
        $username = get_safe_value($con, $_POST['username']);
        $password = get_safe_value($con, $_POST['password']);
        $sql = "SELECT * FROM cc_admin WHERE username='$username' and password='$password'";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);
        if($count > 0) {
            $_SESSION['ADMIN_LOGIN'] = 'yes';
            $_SESSION['ADMIN_USERNAME'] = $username;
            header('location:dashboard.php');
            die();
        } else {
            $msg = "Invalid login Credentials!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login | ChocoCart</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/admin/login.css">
  <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
</head>
<body>

  <div class="login-container">
    <div class="brand">🍫 ChocoCart Admin</div>
    <h2>Admin Login</h2>
    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-choco" name="submit">Login</button>
      </div>
      <p class="mt-4 text-center">
      Are you an User? <a href="../client/login.php">Yes, I am User!</a>
    </p>
    </form>
    <div class="field_error"><?php echo $msg?></div>
  </div>

</body>
</html>