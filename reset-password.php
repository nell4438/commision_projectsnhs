<?php
require_once "include/initialize.php";
require_once 'auth.php';
require_once 'db-connect.php';

$error = ''; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    if ($new_password != $confirm_password) {
        $error = "Password does not match.";
    } else {
        $uid  = $_GET['uid'] ?? '';
        $stmt = $conn->prepare("SELECT * FROM `tblstudent` WHERE md5(`S_ID`) = ?");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // $password = password_hash($new_password, PASSWORD_DEFAULT);
            $password = sha1($new_password);
            $stmt     = $conn->prepare("UPDATE `tblstudent` SET `password` = ? WHERE md5(`S_ID`) = ?");
            $stmt->bind_param('ss', $password, $uid);
            if ($stmt->execute()) {
                $_SESSION['msg']['success'] = "New Password has been saved successfully.".$new_password;
                header('Location: ' . web_root . 'index.php');
                exit;
            } else {
                $error = 'Password has failed to update.';
            }
        } else {
            $error = "No user is registered with this ID.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'header.php';?>
<body>
    <h1 id="page-title" class="text-center">Reset Password</h1>
    <hr id="title_hr" class="mx-auto">
    <div id="login-wrapper">
        <div class="text-muted"><small><em></em></small></div>
        <?php if (!empty($error)): ?>
            <div class="message-error"><?=$error;?></div>
        <?php endif;?>
        <form action="" method="POST">
            <div class="input-field">
                <label for="new_password" class="input-label">New Password</label>
                <input type="password" id="new_password" name="new_password" required="required">
            </div>
            <div class="input-field">
                <label for="confirm_password" class="input-label">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required="required">
            </div>
            <button type="submit" class="reset-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
