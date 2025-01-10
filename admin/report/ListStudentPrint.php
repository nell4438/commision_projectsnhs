<?php
require_once("../../include/initialize.php");
  if(!isset($_SESSION['ACCOUNT_ID'])){
  redirect(web_root."admin/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SNHS | Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
 
   <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href="<?php echo web_root; ?>admin/font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet">
 
     <!-- datetime picker CSS -->
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">
 
 <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h4 class="page-header ">
        <i class="fa fa-map-marker"></i> Sto. Nino National High School
           <small class="pull-right">Printed Date: <?php echo date('m/d/Y'); ?></small>
        </h4>
      </div>
      <!-- /.col -->
    </div>
    <div class="row"><h2 align="center">List Of Students</h2>
    <h5 align="center"><?php echo isset($_POST['Course']) ? "Course/Year :". $_POST['Course'] ." || SY :".$_POST['SY']: ''; ?></h5></div>
    <!-- info row --> 
    <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List of Students</h1>
        <form action="controller.php?action=delete" Method="POST">  
            <div class="table-responsive">          
                <table id="tablet" class="table table-striped table-bordered table-hover table-responsive" style="font-size:12px" cellspacing="0">
                    <thead>
                        <tr style="background-color:#097687;color:#fff;">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sex</th> 
                            <th>Age</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Year Level</th>
                            <th>Status</th>
                        </tr>   
                    </thead> 
                    <tbody>
                        <?php  
                            $mydb->setQuery("SELECT * FROM `tblstudent` s WHERE NewEnrollees=0 ORDER BY s.YEARLEVEL, s.LNAME, s.FNAME");
                            $cur = $mydb->loadResultList();
                            foreach ($cur as $result) {
                                $age = $result->BDAY != '0000-00-00' ? date_diff(date_create($result->BDAY),date_create('today'))->y : 'None';
                                echo '<tr>';
                                echo '<td>' . $result->IDNO.'</td>';
                                echo '<td>'. $result->LNAME.','. $result->FNAME.' '. $result->MNAME.'</td>';
                                echo '<td>'. $result->SEX.'</td>';
                                echo '<td>' .$age.'</td>';
                                echo '<td>'. $result->HOME_ADD.'</td>';
                                echo '<td>'. $result->CONTACT_NO.'</td>';
                                echo '<td>' . $result->YEARLEVEL.'-' . $result->STRAND.'</td>';
                                echo '<td>' . $result->student_status.'</td>';
                                echo '</tr>';
                            } 
                        ?>
                    </tbody>
                </table>
				<script>
					$(document).ready(function() 
					{
    					$('#tablet').DataTable();
					});
				</script>
            </div>
        </form>
    </div>
</div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
