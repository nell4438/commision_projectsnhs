<?php 
require_once("../include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/login.php");
     } 

$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
	case '1' :
        $title="Home";	
		$content='home.php';		
		break;	
	default :
	    $title="Home";	
		$content ='home.php';		
}
require_once("theme/templates.php");
?>