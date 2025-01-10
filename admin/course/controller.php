<?php
require_once("../../include/initialize.php");
if (!isset($_SESSION['ACCOUNT_ID'])) {
	redirect(web_root . "admin/index.php");
}

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doInsert();
		break;

	case 'edit':
		doEdit();
		break;

	case 'delete':
		doDelete();
		break;

	case 'photos':
		doupdateimage();
		break;
}
// Array ( [deptid] => [COURSE_NAME] => 11 [COURSE_MAJOR] => 24 [DEPT_ID] => 33 [COURSE_DESC] => Senior Level [save] => )
function doInsert()
{
	// 	print_r($_POST);
	// exit;
	if (isset($_POST['save'])) {

		if ($_POST['COURSE_NAME'] == "" or $_POST['COURSE_MAJOR'] == "" or $_POST['COURSE_DESC'] == "" or $_POST['DEPT_ID'] == "none") {
			$messageStats = false;
			message("All field is required!", "error");
			redirect('index.php?view=add');
		} else {
			$course = new Course();
			// $course->USERID 		= $_POST['user_id'];
			$course->COURSE_NAME 		= $_POST['COURSE_NAME'];
			$course->COURSE_MAJOR		= $_POST['COURSE_MAJOR'];
			$course->COURSE_DESC		= $_POST['COURSE_DESC'];
			$course->DEPT_ID			= $_POST['DEPT_ID'];
			$course->create();

			// $autonum = New Autonumber(); 
			// $autonum->auto_update(2);

			message(" " . $_POST['COURSE_NAME'] . " created successfully!", "success");
			redirect("index.php");
		}
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {

		$course = new Course();
		$course->COURSE_NAME 		= $_POST['COURSE_NAME'];
		$course->COURSE_MAJOR		= $_POST['COURSE_MAJOR'];
		$course->COURSE_DESC		= $_POST['COURSE_DESC'];
		$course->DEPT_ID			= $_POST['DEPT_ID'];
		$res = $course->update($_POST['COURSE_ID']);

		message("" . $_POST['COURSE_NAME'] . " has been updated!", "success");
		redirect("index.php");
	}
}


function doDelete()
{

	$id = 	$_GET['id'];

	$course = new Course();
	$course->delete($id);

	message("Year Level Deleted!", "info");
	redirect('index.php');
	// }
	// }


}
