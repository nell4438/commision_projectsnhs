<?php
//session_start();
$_self = $_SERVER["PHP_SELF"];
if(stripos($_self, 'index.php?q=profile')){
    if(!isset($_SESSION['S_ID']) || (isset($_SESSION['S_ID']) && $_SESSION['S_ID'] <= 0)){
        header('location: index.php');
    }
} elseif(stripos($_self, 'index.php') || stripos($_self, 'reset-password.php') || stripos($_self, 'forgot-password.php')){
    if(isset($_SESSION['S_ID']) && $_SESSION['S_ID'] > 0){
        header('location: index.php?q=profile');
    }
}

