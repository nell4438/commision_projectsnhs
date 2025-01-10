<?php
require_once ("../../include/initialize.php");
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

function doInsert()
{
	if (isset($_POST['save'])) {
		if ($_POST['section_name'] == "" && $_POST['section_level'] == "") {
			$messageStats = false;
			message("All field is required!", "error");
			redirect('index.php?view=add');
		} else {
			$sect = new Section();
			$sect->section_name = $_POST['section_name'];
			$sect->section_level = $_POST['section_level'];
			$sect->create();


			message(" " . $_POST['section_name'] . " created successfully!", "success");
			redirect("index.php");

		}
	}

}

function doEdit()
{
	if (isset($_POST['save'])) {
		$sect = new Section();
		$sect->section_name = $_POST['section_name'];
		$sect->section_level = $_POST['section_level'];
		$res = $sect->update($_POST['section_id']);

		message("" . $_POST['section_name'] . " has been updated!", "success");
		redirect("index.php");


	}
}


function doDelete()
{
	$id = $_GET['id'];
	$sect = new Section();
	$sect->delete($id);

	message("Strand Deleted!", "info");
	redirect('index.php');


}



?>