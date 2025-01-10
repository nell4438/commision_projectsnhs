
<?php
require_once '../db-connect.php';
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['studentId'])) {
    $errmsg = "no err";

    $studentId = $_POST['studentId'] ?? '';
    $section   = $_POST['section'] ?? '';

    // Prepare the statement
    $stmt = $conn->prepare("UPDATE `tblstudent` SET `STRAND` = ? WHERE `IDNO` = ?");

    // Bind parameters
    $stmt->bind_param('si', $section, $studentId); // 's' for string, 'i' for integer

    // Execute the statement
    if ($stmt->execute()) {
        echo ("<SCRIPT>window.alert('Succesfully Updated')</SCRIPT>");
    } else {
        echo ("<SCRIPT>window.alert('" . $stmt->error . "')</SCRIPT>");
    }
}

$semester = new Semester();
$semesters = $semester->listofsemesters();
// print_r($semester->listofsemester());
$latestSemester = null;
foreach ($semesters as $sem) {
    if ($sem['SETSEM'] == 1) {
        if ($latestSemester === null || $sem['SEMID'] > $latestSemester['SEMID']) {
            $latestSemester = $sem;
        }
    }
}
$semesterHoldData = $latestSemester['SEMESTER'];


ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Bootstrap JS (if you're using Bootstrap) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<h1 class="page-header">New Enrollees</h1>
		</div>
		<div class="col-lg-6">
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<form action="controller.php?action=delete" Method="POST">
	<div class="table-responsive">
		<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">

			<thead>
				<tr style="background-color:#097687;color:#fff;">
					<th>ID</th>
					<th>Name</th>
					<th>Sex</th>
					<th>Age</th>
					<th>Address</th>
					<th>Contact No.</th>
					<th>Status</th>
					<th>Year Level</th>
					<th>Strand</th>
					<th width="14%">Action</th>
				</tr>
			</thead>
			<tbody>
    <?php
$mydb->setQuery("SELECT s.*, f.nso, f.gm, f.sf9, f.sf10, f.clearance FROM `tblstudent` s LEFT JOIN `tblstudfile` f ON f.IDNO = s.IDNO WHERE NewEnrollees=1 AND s.SEMESTER = '$semesterHoldData'");
$cur = $mydb->loadResultList();

foreach ($cur as $result) {
    $age = ($result->BDAY != '0000-00-00') ? date_diff(date_create($result->BDAY), date_create('today'))->y : 'None';
    echo '<tr>';
    echo '<td>' . $result->IDNO . '</td>';
    echo '<td>' . $result->LNAME . ',' . $result->FNAME . ' ' . $result->MNAME . '</td>';
    echo '<td>' . $result->SEX . '</td>';
    echo '<td>' . $age . '</td>';
    echo '<td>' . $result->HOME_ADD . '</td>';
    echo '<td>' . $result->CONTACT_NO . '</td>';
    echo '<td>' . $result->student_status . '</td>';
    echo '<td>' . $result->YEARLEVEL . '</td>';
    echo '<td>' . $result->STRAND . '</td>';

    if ($result->student_status == 'New') {
        echo '<td align="center" >';
        echo '<a title="Confirm" href="controller.php?action=confirm&IDNO=' . $result->IDNO . '" class="btn btn-info btn-xs">Confirm <span class="fa fa-info-circle fw-fa"></span></a>';
        echo '<a href="#" class="btn btn-primary btn-xs edit-btn" data-id="' . $result->IDNO . '" data-strand="' . $result->STRAND . '" data-yearlevel="' . $result->YEARLEVEL . '">Edit <span class="fa fa-edit fw-fa"></span></a>';
        echo '<div class="dropdown">';
        echo '  <button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown">View';
        echo '  <span class="fa fa-eye fw-fa"></span></button>';
        echo '  <div class="dropdown-menu">';
        foreach (['nso', 'gm', 'sf9', 'sf10', 'clearance'] as $file) {
            if (!empty($result->$file)) {
                // echo '<a class="dropdown-item" href="../../student/' . htmlspecialchars($result->$file) . '" target="_blank">' . strtoupper($file) . '</a>';
				echo '<a href="../../student/' . htmlspecialchars($result->$file) . '" target="_blank" class="btn" style="margin-right:10px; text-transform:uppercase; display: inline-block; padding: 8px 16px; border: 1px solid #ccc; text-decoration: none; color: #333; background-color: #f8f9fa;">' . htmlspecialchars($file) . '</a><br>';
            }
        }
        echo '  </div></div>';
        echo '</td>';
    } else {
        echo '<td align="center">';
        echo '<a title="Add Subject" href="index.php?view=addCredit&IDNO=' . $result->IDNO . '" class="btn btn-info btn-xs">Add Subject <span class="fa fa-info-circle fw-fa"></span></eda>';
        echo '</td>';
    }
    echo '</tr>';
}
?>
</tbody>

		</table>
	</div>
</form>
</div> <!---End of container-->
<!-- Edit Section Modal -->
<div id="editModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Section</h4>
			</div>
			<div class="modal-body">
				<form id="editForm" method="POST">
					<input type="hidden" id="studentId" name="studentId">
					<div class="form-group">
						<label for="section">Section:</label>
						<select class="form-control" id="section" name="section">
						</select>
					</div>
					<button type="submit" class="btn btn-default">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script>
	$(document).ready(function() {
		console.log('--------=-=-=-=')
		$('.edit-btn').click(function(e) {
			e.preventDefault(); // Prevent default anchor behavior
			var id = $(this).data('id');
			var strand = $(this).data('strand');
			var yearlevel = $(this).data('yearlevel');

			// Set form values
			$('#editModal #studentId').val(id);
			$('#editModal #section').val(strand);

			$.ajax({
				url: '../course/getSection.php',
				type: 'POST',
				data: {
					year_level: yearlevel
				},
				success: function(data) {
					$('#editModal #section').html(data);
				}
			});

			// Show modal
			$('#editModal').modal('show');
		});

		$('#editForm').submit(function(e) {
			e.preventDefault();
			var studentId = $('#studentId').val();
			var section = $('#section').val();
			// AJAX request to the same page (or to the specific handler for this, adjust the URL as necessary)
			$.ajax({
				url: 'update_strand.php', // Adjust this URL if the handling PHP file is different
				method: 'POST',
				data: {
					studentId: studentId,
					section: section
				},
				success: function(response) {
					console.log(response); // Log the response from the server
					alert('The form was successfully submitted.');
					$('#editModal').modal('hide'); // Hide the modal upon successful Ajax request
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error('Error: ' + textStatus + ', ' + errorThrown); // Log any error to the console for debugging
				}
			});
		});
	});
</script>