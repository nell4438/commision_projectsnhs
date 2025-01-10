<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "admin";
$db_name = "projectsnhs";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Failed to connect to MySQL: " . $conn->connect_error);
}

$year_level = $_POST['year_level'];

$stmt = $conn->prepare("SELECT * FROM `tblsection` WHERE section_level = ?");
$stmt->bind_param("i", $year_level);
$stmt->execute();
$result = $stmt->get_result();

$options = "<option value=''></option>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // $options .= "<option value='" . $row['section_id'] . "'>" . $row['section_name'] . "</option>";
        if (isset($_POST['isEdit'])) {
            $selected = ($_POST['course_edit'] == $row['section_id']) ? 'selected' : '';
            $options .= "<option value='" . $row['section_id'] . "'$selected>" . $row['section_name'] . "</option>";
        } else {
            $options .= "<option value='" . $row['section_id'] . "'>" . $row['section_name'] . "</option>";
        }
    }
} else {
    $options = "<option value='37'>No sections found</option>";
}

echo $options;
$conn->close();