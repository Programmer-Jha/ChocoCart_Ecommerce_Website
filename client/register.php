<?php
// Developed By: Aniket Kumar Jha
require ("../includes/connection.php");
require ("../includes/functions.php");

// Initialize messages
$message = '';
$otp_msg = '';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// When Send OTP is clicked
if (isset($_POST['send_otp'])) {
    $_SESSION['form_name'] = $_POST['name'];
    $_SESSION['form_email'] = $_POST['email'];
    $_SESSION['form_mobile'] = $_POST['mobile'];
    $_SESSION['form_password'] = $_POST['password'];

    $otp = rand(100000, 999999);
    $_SESSION['email_otp'] = $otp;
    $_SESSION['email_for_otp'] = $_POST['email'];

    // Send email using PHPMailer

    require '../includes/PHPMailer/Exception.php';
    require '../includes/PHPMailer/PHPMailer.php';
    require '../includes/PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Senders Email Address';
        $mail->Password   = 'Emails Password';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('Senders Email Address', 'ChocoCart');
        $mail->addAddress($_POST['email']);

        $mail->isHTML(true);
        $mail->Subject = 'This is your OTP for your ChocoCart Registration, Please verify your account by using this OTP.';
        $mail->Body    = "<html>
                            <head>
                                <title>ChocoCart - Verify Your Email</title>
                            </head>
                            <body style='font-family: Arial, sans-serif; background-color: #f3f2ef; padding: 20px;'>
                                <div style='max-width: 600px; margin: auto; background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>
    
                                <h2 style='color: #6b3e26; text-align: center;'>Verify Your Email 🍫</h2>
    
                                <p>Hi <strong>User</strong>,</p>
    
                                <p>Thank you for registering with <strong>ChocoCart</strong>! To complete your registration, please verify your email address by entering the One-Time Password (OTP) below:</p>
    
                                <div style='text-align: center; font-size: 24px; font-weight: bold; color: #d2691e; margin: 20px 0;'>
                                    $otp
                                </div>
    
                                <p>This OTP is valid for the next <strong>10 minutes</strong>. Do not share it with anyone for security reasons.</p>
    
                                <p>If you did not initiate this request, you can safely ignore this email.</p>
    
                                <br>
                                <p>Best regards,<br>
                                <strong>ChocoCart Team</strong><br>
                                chcocart10@gmail.com</p>
                                </div>
                            </body>
                        </html>";

        $mail->send();
        $otp_msg = "OTP sent to your email successfully!";
    } catch (Exception $e) {
        $otp_msg = "Mailer Error: " . $mail->ErrorInfo;
    }
}

// When Verify OTP is clicked
if (isset($_POST['verify_otp'])) {
    
    $entered_otp = $_POST['otp'];
    if ($_SESSION['email_otp'] == $entered_otp) {
        $_SESSION['otp_verified'] = true;
        $otp_msg = "OTP Verified!";
    } else {
        $otp_msg = "Invalid OTP!";
    }
}

// When Register is clicked
if (isset($_POST['register'])) {
    if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
        $message = "Please verify your email with OTP before registering.";
    } else {
        $_SESSION['form_mobile'] = $_POST['mobile'];
        $_SESSION['form_password'] = $_POST['password'];

        $name = get_safe_value($con, $_SESSION['form_name']);
        $email = get_safe_value($con, $_SESSION['form_email']);
        $mobile = get_safe_value($con, $_SESSION['form_mobile']);
        $password = get_safe_value($con, $_SESSION['form_password']);

        // Check if email already exists
        $check = mysqli_query($con, "SELECT * FROM cc_users WHERE email = '$email'");
        if (mysqli_num_rows($check) > 0) {
            $message = "Email already registered.";
        } else {
            $insert = mysqli_query($con, "INSERT INTO cc_users (name, email, pswd, mobile) VALUES ('$name', '$email', '$password', '$mobile')");
            if ($insert) {
                $message = "Registration successful!";
                header('location:login.php');
                // Clear session values
            } else {
                $message = "Something went wrong. Try again.";
            }
        }
    }
    session_destroy();
}
?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - ChocoCart</title>
    <link rel="stylesheet" href="../assets/css/client/register.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
</head>
<body>

<div class="register-container">
    <h2>Create Your Choco Account 🍫</h2>
    <form method="POST">
        <input type="text" name="name" id="name" placeholder="Full Name" required value="<?php echo isset($_SESSION['form_name']) ? $_SESSION['form_name'] : ''; ?>" />
        <input type="email" name="email" id="email" placeholder="Email Address" required style="width:45%" value="<?php echo isset($_SESSION['form_email']) ? $_SESSION['form_email'] : ''; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="email_sent_otp" style="width:45%" name="send_otp">Send OTP</button>
        <input type="text" name="otp" placeholder="OTP" style="width:45%" class="email_verify_otp" value="" />&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="email_verify_otp" style="width:45%" name="verify_otp">Verify OTP</button>
        <div class="password-wrapper" style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" required value="<?php echo isset($_SESSION['form_password']) ? $_SESSION['form_password'] : ''; ?>" />
            <span id="togglePassword" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">👁️</span>
        </div>
        <input type="text" name="mobile" id="mobile" placeholder="Mobile Number" required value="<?php echo isset($_SESSION['form_mobile']) ? $_SESSION['form_mobile'] : ''; ?>" />
        <button type="submit" name="register">Register</button>
        <span id="email_otp_result"><?php echo $otp_msg; ?></span>
    </form>
    <a href="login.php" class="login-link">Already have an account? Login</a>
     <?php if (!empty($message)) { ?>
    <div class="alert-message">
        <?php echo $message; ?>
    </div>
<?php } ?>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.textContent = type === 'password' ? '🙈' : '👁️';
    });
</script>


<style>

</style>
</body>
</html>