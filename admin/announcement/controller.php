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

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


		if ($_POST['title'] == "" OR $_POST['announcement'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$announce = New Announcement(); 
			$announce->date 		= $_POST['date'];
		    $announce->title 		= $_POST['title'];
			$announce->announcement		= $_POST['announcement']; 
			$announce->create();

			// $autonum = New Autonumber(); 
			// $autonum->auto_update(2);

			message(" ". $_POST['title'] ." created successfully!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){ 

 		$desc = $_POST['ANNOUNCEMENT'];

			$announce = New Announcement(); 
			$announce->date 		= $_POST['date'];
			$announce->title 		= $_POST['title'];
			$announce->announcement		= $desc;  
			$res = $announce->update($_POST['id']);

			  message("". $_POST['title'] ." has been updated!", "success");
			redirect("index.php");
			 
			
		}
	}


	function doDelete(){
		
	 
				$id = 	$_GET['id'];

				$announce = New Announcement();
	 		 	$announce->delete($id);
			 
			message("Announcement Deleted!","info");
			redirect('index.php');
		 
		
	}

	 
 
?>