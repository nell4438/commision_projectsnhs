<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "admin";
$db_name = "projectsnhs";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}
$section = $_POST['section'];
$studentId = $_POST['studentId'];

$stmt = $conn->prepare("UPDATE `tblstudent` SET `section_id` = ? WHERE `IDNO` = ?");
$stmt->bind_param('si', $section, $studentId);
$stmt->execute();
if ($stmt->execute()) {
    echo ("<SCRIPT>window.alert('Succesfully Updated')</SCRIPT>");
} else {
    echo ("<SCRIPT>window.alert('" . $stmt->error . "')</SCRIPT>");
}
$conn->close();
