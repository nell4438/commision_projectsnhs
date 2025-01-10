<?php
require_once ("../../include/initialize.php");
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

$yearLevel = $_POST['year_level'] ?? '';
$section = $_POST['section'] != 37 && $_POST['section'] ? $_POST['section'] : '';

$query = "SELECT s.*, sec.section_name FROM tblstudent s LEFT JOIN tblsection sec ON s.section_id = sec.section_id WHERE s.NewEnrollees = 0";

if (!empty($yearLevel)) {
    $query .= " AND s.YEARLEVEL = '$yearLevel'";
}

if (!empty($section) && $section != "Select a year level first") {
    $query .= " AND sec.section_name = '$section'";
}

$query .= " ORDER BY s.YEARLEVEL, s.LNAME, s.FNAME";

$mydb->setQuery($query);
$results = $mydb->loadResultList();

$data = array();

foreach ($results as $row) {
    $age = $row->BDAY != '0000-00-00' ? date_diff(date_create($row->BDAY), date_create('today'))->y : 'None';
    $data[] = array(
        $row->IDNO,
        $row->LNAME . ', ' . $row->FNAME . ' ' . $row->MNAME,
        $row->SEX,
        $age,
        $row->HOME_ADD,
        $row->CONTACT_NO,
        $row->YEARLEVEL . '-' . ($row->YEARLEVEL == 11 || $row->YEARLEVEL == 12 ? $row->section_name : ("TBA" ?? $row->STRAND)),
        $row->section_name ?? "TBA",
        `<a title="View Information" href="index.php?view=view&id=' . $row->IDNO . '" class="btn btn-info btn-xs">View <span class="fa fa-info-circle fw-fa"></span></a>
    <form action="controller.php?action=delete" method="POST" style="display: inline;" onsubmit="return confirm(\'Are you sure you want to delete this student?\');">
        <input type="hidden" name="id" value="' . $row->IDNO . '">
        <button type="submit" class="btn btn-danger btn-xs" title="Delete Student">Drop <span class="fa fa-trash-o fw-fa"></span></button>
    </form>`,
    );
}

echo json_encode($data);