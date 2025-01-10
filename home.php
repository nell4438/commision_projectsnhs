<!-- Map Column -->
<div class="row">
	<div class="col-md-2">
		<img width="100%" src="img/logosnhs.png">
	</div>

	<!-- Contact Details Column -->
	<div class="col-md-10">
		<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive"
			style="font-size:14px" cellspacing="0">

			<thead>
				<tr>
					<th>Date</th>
					<th>Title</th>
					<th>Announcement</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$mydb->setQuery("SELECT * 
											FROM  `announcement`");
				$cur = $mydb->loadResultList();

				foreach ($cur as $result) {
					echo '<tr>';
					echo '<td>' . $result->date . '</td>';
					echo '<td>' . $result->title . '</td>';
					echo '<td>' . $result->announcement . '</td>';
					echo '</tr>';
				}
				?>
			</tbody>

		</table>

	</div>
</div>
<!-- /.row -->

<br />