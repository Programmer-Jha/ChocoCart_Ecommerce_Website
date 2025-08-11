<?php 
    // Developed By: Aniket Kumar Jha
    require('header.php'); 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_GET['type']) && $_GET['type'] != '') {
        $type = get_safe_value($con, $_GET['type']);
        $id = get_safe_value($con, $_GET['id']);
        if($type == 'reply') {
          
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
            $mail->Password   = 'Emails App Password';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('Senders Email Address', 'ChocoCart');
            $reply_query = mysqli_query($con, "SELECT  name, email FROM cc_contact WHERE id='$id'");
            $reply = mysqli_fetch_assoc($reply_query);
            $mail->addAddress($reply['email']);

            $mail->isHTML(true);
            $mail->Subject = 'Thank You for Reaching Out to ChocoCart!';
            $mail->Body = "<html>
              <head>
              <title>ChocoCart - We've Received Your Message</title>
              </head>
              <body style='font-family: Arial, sans-serif; background-color: #f3f2ef; padding: 20px;'>
              <div style='max-width: 600px; margin: auto; background-color: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>

              <h2 style='color: #6b3e26; text-align: center;'>Thank You for Contacting Us 🍫</h2>

              <p>Hi <strong>{$reply['name']}</strong>,</p>

              <p>We sincerely appreciate you taking the time to reach out to <strong>ChocoCart</strong>. Your message means a lot to us!</p>

              <p>If you had a query or concern, our support team will carefully review your message and respond to you as soon as possible — typically within <strong>24–48 hours</strong>.</p>

              <p>If your matter is urgent, feel free to reply directly to this email and mention <strong>URGENT</strong> in the subject line. We're here to help.</p>

              <p>Once again, thank you for getting in touch. We’re always happy to assist you!</p>

              <br>
              <p>With gratitude,<br>
              <strong>ChocoCart Support Team</strong><br>
              Your Email Address</p>

              </div>
              </body>
              </html>";

            $mail->send();
            $otp_msg = "Contact's Reply Sent Successfully!";
          } catch (Exception $e) {
            $otp_msg = "Mailer Error: " . $mail->ErrorInfo;
          }
        }
        if($type == 'delete') {
            $delete_sql = "DELETE FROM cc_contact WHERE id='$id'";
            mysqli_query($con, $delete_sql);
        }
    }
?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">📬 Contact Form Submissions</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Comment</th>
          <th>Submitted On</th>
          <th>Reply</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          $res = mysqli_query($con, "SELECT * FROM cc_contact ORDER BY id DESC");
          while($row = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
          <td><?php echo $i++; ?></td>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['mobile']; ?></td>
          <td><?php echo $row['comment']; ?></td>
          <td><?php echo $row['added_on']; ?></td>
          <td>
            <?php
                echo '<a href="?type=reply&id='.$row['id'].'" class="btn btn-sm btn-primary rounded-pill px-3">Reply</a>';
            ?>
          </td>
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

<?php require('footer.php'); ?>