<?php
require_once("../../include/initialize.php");
	if(!isset($_SESSION['ACCOUNT_ID'])){
	redirect(web_root."admin/index.php");
}
 // if (!isset($_SESSION['justadmin_ID'])){
 // 	redirect(WEB_ROOT ."admin/login.php");
 // }
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$title ='Report';
switch ($view) {
	case 'studentlist' :

		$content    = 'ListStudents.php';		
		break;
	case 'academicRecord' :
		$content    = 'academicRecord.php';		
		break;	
	case 'log' :
		$content    = 'userlogs.php';		
		break;		
	case 'classrecord' :
		$content    = 'classrecord.php';		
		break;	
	case 'perCourse' :
		$content    = 'listpercourseyear.php';		
		break;
	default :
		$content    = 'ListStudents.php';		
}
  // include '../modal.php';
require_once '../theme/Templates.php';
?>


  
