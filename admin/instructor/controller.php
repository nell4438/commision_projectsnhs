<?php
require_once ("../../include/initialize.php");
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
 
	
	case 'delete' :
	doDelete();
	break;
  
 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){
			// Convert year level to integer for proper comparison
			$yearLevel = intval($_POST['INST_MAJOR']);
			$sectionOrStrand = $_POST['INST_CONTACT'];
			$errorMessage = "";
	
			// Check for empty name
			if (empty($_POST['INST_NAME'])) {
				$errorMessage .= "Name is required. ";
			}
	
			// Validate 'Section' for Grade 7-10
			if ($yearLevel >= 7 && $yearLevel <= 10) {
				if (empty($sectionOrStrand)) {
					$errorMessage .= "Section is required for Grade 7-10. ";
				}
			}
	
			// Validate 'Strand' for Grade 11-12
			if ($yearLevel >= 11 && $yearLevel <= 12) {
				if (empty($sectionOrStrand)) {
					$errorMessage .= "Strand is required for Grade 11-12. ";
				}
			}
	
			if (!empty($errorMessage)) {
				message($errorMessage, "error");
				redirect('index.php?view=add');
			} else {    
				$inst = New Instructor(); 
				$inst->INST_NAME = $_POST['INST_NAME'];
				$inst->INST_MAJOR = $yearLevel; // Year Level
				$inst->INST_CONTACT = $sectionOrStrand; // Section or Strand
				$inst->create();
	 
				message("New Teacher created successfully!", "success");
				redirect("index.php");
			}
		}
	}
	
	
	

	function doEdit(){
	if(isset($_POST['save'])){

		if ($_POST['INST_NAME'] == "" OR $_POST['INST_MAJOR'] == "" OR $_POST['INST_CONTACT'] == "" ) {
			message("All field is required!","error");
			redirect('index.php?view=edit&id='.$_POST['INST_ID']);
		}else{

 
			$inst = New Instructor();
			$inst->INST_NAME 	= $_POST['INST_NAME'];
			$inst->INST_MAJOR	= $_POST['INST_MAJOR']; 
			$inst->INST_CONTACT	= $_POST['INST_CONTACT']; 
			$inst->update($_POST['INST_ID']);


		 
			message("Teacher Info has been updated!", "success");
			redirect("index.php");
	 
 		 }

		}
	}


	function doDelete(){
	 	$id = 	$_GET['id'];

				$inst = New Instructor();
	 		 	$inst->delete($id);
			 
			message("Teacher Deleted!","info");
			redirect('index.php');
		 
		
	}
  
 
?>