<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>

 <div class="row">
      <div class="col-lg-12">
       	 <div class="col-lg-6">
            <h1 class="page-header">List of Announcements<br>  <a href="index.php?view=add" class="btn btn-xs  " style="background-color:#097687;color:#fff;">  <i class="fa fa-plus-circle fw-fa"></i> Add New Announcement</a>  </h1>
       		</div>
       		<div class="col-lg-6" >
       		</div>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
			      <div class="table-responsive">			
				<table id="dash-table" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
				
				  <thead>
				  <tr style="background-color:#097687;color:#fff;">
				  		<th width="5%">ID</th>
						<th>Date</th>
				  		<th>Title</th>
				  		<th>Announcement</th>
				  	 	<th width="10%" >Action</th>
				 
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php   
				  		// $mydb->setQuery("SELECT * 
								// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
				  		$mydb->setQuery("SELECT * 
											FROM  `announcement`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		echo '<td>' . $result->id.'</a></td>';
						echo '<td>'. $result->date.'</td>';
				  		echo '<td>'. $result->title.'</td>';
				  		echo '<td>'. $result->announcement.'</td>';
				  	  
				  		echo '<td align="center" > <a title="Edit" href="index.php?view=edit&id='.$result->id.'"  class="btn btn-primary btn-xs  ">  <span class="fa fa-edit fw-fa"></span></a>
				  					 <a title="Delete" href="controller.php?action=delete&id='.$result->id.'" class="btn btn-danger btn-xs" ><span class="fa fa-trash-o fw-fa"></span> </a>
				  					 </td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
 
				
			</div>
				</form>
	

</div> <!---End of container-->