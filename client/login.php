<?php
    // Developed By: Aniket Kumar Jha
    require ('../includes/connection.php');
    require ('../includes/functions.php');
    $message = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = get_safe_value($con, $_POST['email']);
      $password = get_safe_value($con, $_POST['password']);

      $res = mysqli_query($con, "SELECT * FROM cc_users WHERE email='$email' and pswd='$password'");
      $check_user = mysqli_num_rows($res);
      if($check_user > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['USER_ID'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];
        header('location: index.php');
      } else {
        $message = "❌ Invalid Email or Password!";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - ChocoCart</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/client/login.css">
  <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
</head>

<body>
  <div class="login-container shadow-lg">
    <h2>Welcome Back to 🍫 ChocoCart</h2>
    <form method="POST" class="mt-4">
      <div class="mb-3 text-start">
        <label for="email" class="form-label text-warning fw-semibold">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
      </div>
      <div class="mb-4 text-start">
        <label for="password" class="form-label text-warning fw-semibold">Password</label>
        <input type="password" class="form-control pe-5" name="password" id="password" placeholder="Password" required />
      </div>
      <button type="submit" class="btn btn-choco">Login</button>
    </form>
    <p class="mt-4 text-center">
      Don't have an account? <a href="register.php">Register here</a>
    </p>
    <p class="mt-4 text-center">
      Are you an Admin? <a href="../admin/login.php">Yes, I am Admin!</a>
    </p>
    <div class="field_error"><?php echo $message?></div>
  </div>


</body>

</html>