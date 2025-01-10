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
		global $mydb;

		if(isset($_POST['save'])){
 

		if ($_POST['U_NAME'] == "" OR $_POST['user_email'] == "" OR $_POST['user_pass'] == "") {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	

			$sql = "SELECT * FROM useraccounts WHERE user_email='" .$_POST['user_email']."'";
			$res = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));
			$userresult = mysqli_fetch_assoc($res);

			if ($userresult) {
				# code...
				message("Username is already taken.", "error");
				redirect('index.php?view=add');
			}else{

			$user = New User();
			// $user->USERID 		= $_POST['user_id'];
			$user->ACCOUNT_NAME 		= $_POST['U_NAME'];
			$user->user_email			= $_POST['email'];
			$user->user_pass			=sha1($_POST['user_pass']);
			$user->ACCOUNT_TYPE			=  $_POST['U_ROLE'];
			$user->create();

						// $autonum = New Autonumber(); 
						// $autonum->auto_update(2);

			message("". $_POST['U_NAME'] ." created successfully!", "success");
			redirect("index.php");

			} 
		}
		}

	}

	function doEdit(){
		global $mydb;

	if(isset($_POST['save'])){
		// $sql = "SELECT * FROM useraccounts WHERE user_email='" .$_POST['email']."'";
		// 	$res = mysqli_query($mydb->conn,$sql) or die(mysqli_error($mydb->conn));
		// 	$userresult = mysqli_fetch_assoc($res);

		// 	if ($userresult) {
		// 		# code...
		// 		message("Username is already taken.", "error");
		// 		redirect('index.php?view=add');
		// 	}else{
				$user = New User(); 
			$user->ACCOUNT_NAME 		= $_POST['U_NAME'];
			$user->user_email			= $_POST['user_email'];
			$user->user_pass			=sha1($_POST['user_pass']);
			$user->ACCOUNT_TYPE			= $_POST['U_ROLE'];
			$user->update($_POST['USERID']);

			  message("[". $_POST['U_NAME'] ."] has been updated!", "success");
			redirect("index.php");
			// }
 
			
		}
	}


	function doDelete(){
		global $mydb;

		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User already Deleted!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doupdateimage(){
		global $mydb;

 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


		if ( $errofile > 0) {
				message("No File Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= true;//getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is invalid!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New User();
						$user->USERIMAGE 			= $location;
						$user->update($_SESSION['ACCOUNT_ID']);
						redirect("index.php");
						 
							
					}
			}
			 
		}
 
?>