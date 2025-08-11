<?php 
    // Developed By: Aniket Kumar Jha
    require ('header.php');

    $user_id = get_safe_value($con, $_SESSION['USER_ID']);
    if($user_id == 0) {
        echo "<script>alert('Please Login First!'); window.location.href='login.php';</script>";
    }
    $user_query = mysqli_query($con, "SELECT * FROM cc_users WHERE id='$user_id'");
    $user = mysqli_fetch_assoc($user_query);
    $username = $user['name'];
    $email = $user['email'];
    $mobile = $user['mobile'];

    if(isset($_POST['b1'])) {
        $name = get_safe_value($con, $_POST['t1']);
        $email = get_safe_value($con, $_POST['t2']);
        $mobile = get_safe_value($con, $_POST['t3']);
        $comment = get_safe_value($con, $_POST['t4']);

        $ins = "INSERT INTO cc_contact(name, email, mobile, comment) VALUES('$name', '$email', '$mobile', '$comment')";
        $res = mysqli_query($con, $ins);
        echo "
            <script>
                alert('Your response has been submitted successfully');
                // window.location.href='index.php';
            </script>";
            header('Location: index.php');
    }
?>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name" required name="t1" value="<?php echo $username; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com" required name="t2" value="<?php echo $email; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="tel" class="form-control" id="mobile" placeholder="Enter your mobile number" required name="t3" value="<?php echo $mobile; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control" id="comment" rows="4" placeholder="Your message..." required name="t4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-3" name="b1">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require ('footer.php'); 
?>