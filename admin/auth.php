<?php
//session_start();
$_self = $_SERVER["PHP_SELF"];
if(stripos($_self, 'admin/index.php')){
    if(!isset($_SESSION['ACCOUNT_ID']) || (isset($_SESSION['ACCOUNT_ID']) && $_SESSION['ACCOUNT_ID'] <= 0)){
        header('location: admin/login.php');
    }
} elseif(stripos($_self, 'admin/login.php') || stripos($_self, 'reset-password.php') || stripos($_self, 'forgot-password.php')){
    if(isset($_SESSION['ACCOUNT_ID']) && $_SESSION['ACCOUNT_ID'] > 0){
        header('location: admin/index.php');
    }
}

