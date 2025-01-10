<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
	redirect(web_root . "admin/index.php");
}

?>
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<h2 class="page-header">Set Current Academic Year </h2>
		</div>
		<div class="col-lg-6">
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>


<div class="table-responsive">
	<table id="" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px"
		cellspacing="0">

		<thead>
			<tr style="background-color:#097687;color:#fff;">
				<th>Academic Year</th>
				<th>Set</th>
				<th width="10%">Action</th>

			</tr>
		</thead>

		<tbody>
			<?php
			$mydb->setQuery("SELECT * FROM  `tblsemester`");
			$cur = $mydb->loadResultList();

			foreach ($cur as $result) {
				echo '<tr>';
				echo '<td >' . $result->SEMESTER . '</td>';
				echo '<td>' . $result->SETSEM . '</a></td>';

				echo '<td align="center" ><a title="Edit" href="controller.php?action=edit&id=' . $result->SEMID . '"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"> Set</span></a>
				  					  </td>';
				echo '</tr>';
			}
			?>
		</tbody>

	</table>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addAcademicYearModal">
	Add Academic Year
</button>

<!-- Add Academic Year Modal -->
<div class="modal fade" id="addAcademicYearModal" tabindex="-1" role="dialog"
	aria-labelledby="addAcademicYearModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addAcademicYearModalLabel">Add Academic Year</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controller.php?action=delete" Method="POST">
				<div class="modal-body">
					<!-- Form fields for adding a new academic year -->
					<div class="form-group">
						<label for="semester-name">Academic Year</label>
						<input type="text" class="form-control" id="semester-name" name="semester" required>
					</div>
					<!-- Hidden field to indicate the action -->
					<input type="hidden" name="action" value="YLadd">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add Academic Year</button>
				</div>
			</form>
		</div>
	</div>
</div>


</div> <!---End of container-->