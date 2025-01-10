<?php
require_once ("include/initialize.php");
require_once ('auth.php');
require_once ('db-connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $stmt = $conn->prepare("SELECT * FROM `tblstudent` where `email` = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        try {


            // initialization
            $data = $result->fetch_assoc();
            $mail = new PHPMailer(true);
            $emailReceiver = $data['email'];
            $subject = "SNHS Online Enrollment Website - Reset Password for Student";
            $message = "";
            ob_start();
            include ("reset_mail-template.php");
            $message = ob_get_clean();

            // start
            $adminEmail = 'addatujhasper0@gmail.com';
            $adminEmailPassword = 'aifoczdjbmylcsoo';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $adminEmail; //your gmail
            $mail->Password = $adminEmailPassword; ///your gmail app password - remove spaces
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom($adminEmail); //your gmail
            $mail->addAddress($emailReceiver); //recipient email

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();
            $_SESSION['msg']['success'] = "We have sent you an email to reset your password.";

        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
        // end
        // $data = $result->fetch_assoc();
        // $email = $data['email'];

        // $subject = "SNHS Online Enrollment Website - Reset Password for Student";
        // $message = "";
        // ob_start();
        // include ("reset_mail-template.php");
        // $message = ob_get_clean();
        // // echo $message;exit;
        // $eol = "\r\n";
        // // Mail Main Header
        // $headers = "From: info@sample.com" . $eol;
        // $headers .= "Reply-To: noreply@sample.com" . $eol;
        // $headers .= "To: <{$email}>" . $eol;
        // $headers .= "MIME-Version: 1.0" . $eol;
        // $headers .= "Content-Type: text/html; charset=iso-8859-1" . $eol;
        // try {
        //     mail($email, $subject, $message, $headers);
        //     $_SESSION['msg']['success'] = "We have sent you an email to reset your password.";
        //     header('location: forgot-password.php');
        //     exit;
        // } catch (Exception $e) {
        //     throw new ErrorException($e->getMessage());
        //     exit;
        // }
    ?>
    <?php
    } else {
        $error = "Email is not registered!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once ('header.php') ?>

<body>
    <h1 id="page-title" class="text-center">Forgot Password</h1>
    <hr id="title_hr" class="mx-auto">
    <div id="login-wrapper">
        <div class="text-muted"><small><em> </em></small></div>

        <?php if (isset($error) && !empty($error)): ?>
            <div class="message-error"><?= $error ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['msg']['success']) && !empty($_SESSION['msg']['success'])): ?>
            <div class="message-success">
                <?php
                echo $_SESSION['msg']['success'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-field">
                <label for="email" class="input-label">Email Address</label>
                <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? "" ?>" required="required">
            </div>
            <div class="input-field ">
                <a href="index.php" tabindex="-1"><small><strong>Go back to login page</strong></small></a>
            </div>
            <button class="login-btn">Reset Password</button>
        </form>
    </div>
</body>

</html>