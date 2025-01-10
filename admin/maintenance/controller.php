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
		doAdd();
		break;

	case 'photos':
		doupdateimage();
		break;


}

function doInsert()
{
	if (isset($_POST['save'])) {


		if ($_POST['COURSE_NAME'] == "" or $_POST['COURSE_LEVEL'] == "" or $_POST['COURSE_MAJOR'] == "" or $_POST['COURSE_DESC'] == "" or $_POST['DEPT_ID'] == "none") {
			$messageStats = false;
			message("All field is required!", "error");
			redirect('index.php?view=add');
		} else {
			$course = new Course();
			// $course->USERID 		= $_POST['user_id'];
			$course->COURSE_NAME = $_POST['COURSE_NAME'];
			$course->COURSE_LEVEL = $_POST['COURSE_LEVEL'];
			$course->COURSE_MAJOR = $_POST['COURSE_MAJOR'];
			$course->COURSE_DESC = $_POST['COURSE_DESC'];
			$course->DEPT_ID = $_POST['DEPT_ID'];
			$course->create();

			// $autonum = New Autonumber(); 
			// $autonum->auto_update(2);

			message("New [" . $_POST['COURSE_NAME'] . "] created successfully!", "success");
			redirect("index.php");

		}
	}

}

function doEdit()
{
	if (isset($_GET['id'])) {
		$servername = "localhost";
		$username = "root";
		$password = "admin";
		$dbname = "projectsnhs";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Fetch the SEMID of the currently set academic year/semester
			$stmt = $conn->query("SELECT SEMID FROM tblsemester WHERE SETSEM = 1");
			$currentSem = $stmt->fetch(PDO::FETCH_OBJ);
			$currentSemId = $currentSem ? $currentSem->SEMID : null;

			$newSemId = $_GET['id']; // The SEMID to be set, passed via GET

			$sql = "
				WITH RankedSemesters AS (
					SELECT SEMID,
						   ROW_NUMBER() OVER (ORDER BY SEMID DESC) AS RowNum
					FROM tblsemester
				)
				SELECT 
					CAST(
					   (SELECT RowNum FROM RankedSemesters WHERE SEMID = :newSemId) 
					   - 
					   (SELECT RowNum FROM RankedSemesters WHERE SEMID = :currentSemId) 
					AS SIGNED) AS OrderDifference
				";
			$stmt = $conn->prepare($sql);

			// Bind parameters
			$stmt->bindParam(':newSemId', $newSemId, PDO::PARAM_INT);
			$stmt->bindParam(':currentSemId', $currentSemId, PDO::PARAM_INT);

			// Execute the query
			$stmt->execute();

			// $stmt = $conn->query($sql);
			$result = $stmt->fetch();
			
			$orderDifference = $result['OrderDifference'];
			echo "<script>alert('$orderDifference');</script>";


			$updateSql = "
					UPDATE tblstudent
					SET YEARLEVEL = CASE 
						WHEN YEARLEVEL = 12 THEN 12
						WHEN YEARLEVEL + :orderDifference > 12 THEN 12
						WHEN YEARLEVEL + :orderDifference < 7 THEN 7
						ELSE YEARLEVEL + :orderDifference
					END
				";
			$updateStmt = $conn->prepare($updateSql);

			// Bind the orderDifference parameter
			$updateStmt->bindParam(':orderDifference', $orderDifference, PDO::PARAM_INT);

			// Execute the update query
			$updateStmt->execute();

			$sem = new Semester();
			$sem->SETSEM = 1;
			$sem->update($newSemId);

			$stmt = $conn->query("SELECT SEMID FROM tblsemester WHERE SEMID != '" . $newSemId . "'");
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$sem = new Semester();
				$sem->SETSEM = 0;
				$sem->update($row->SEMID);
			}

			message("Academic Year have been updated!", "success");
		} catch (Exception $e) {
			// Handle error
			message("An error occurred while updating: " . $e->getMessage(), "error");
		}

		redirect("index.php");
	}

}

function doAdd()
{
	// Database credentials
	$host = 'localhost';
	$dbname = 'projectsnhs';
	$username = 'root';
	$password = '';

	try {
		// Set up the database connection
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		// Set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Your add operation code here, using the $pdo object for database operations
		$semester = filter_input(INPUT_POST, 'semester', FILTER_SANITIZE_STRING);
		$sql = "INSERT INTO tblsemester (SEMESTER) VALUES (:semester)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':semester', $semester, PDO::PARAM_STR);
		$stmt->execute();

		// Redirect or provide feedback
		message("New academic year added successfully", "success");
	} catch (PDOException $e) {
		message("An error occurred while updating: " . $e->getMessage(), "error");
	}
	redirect("index.php");
}


?>