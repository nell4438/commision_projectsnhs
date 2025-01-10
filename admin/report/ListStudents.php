<?php
// Your PHP initialization code here (e.g., session start, database connection)

// ... (Other PHP code if necessary)
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sto. Nino National High School - List of Students</title>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Include jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header">
                    <i class="fa fa-map-marker"></i> Sto. Nino National High School
                    <small class="pull-right"><?php echo date("F j, Y g:i a"); ?></small>
                </h3>
            </div>
        </div>


        <!-- Table of Students -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List of Students</h1>
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
                                    echo '<td>'. $result->student_status.'</td>';
                                    echo '</tr>';
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </form>
    <form action="ListStudentPrint.php" method="POST" target="_blank">
    <input type="hidden" name="Course" value="<?php echo (isset($_POST['Course'])) ? $_POST['Course'] : ''; ?>">
     <input type="hidden" name="Semester" value="<?php echo (isset($_POST['Semester'])) ? $_POST['Semester'] : ''; ?> "> 
     <input type="hidden" name="SY" value="<?php echo (isset($_POST['SY'])) ? $_POST['SY'] : ''; ?> "> 
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
             <span class="pull-right"> <button type="submit" class="btn btn-primary"  ><i class="fa fa-print"></i> Print</button></span>  
          </div>
          </div> 
    </form>
    <!-- /.content -->
    <div class="clearfix"></div>

    </div>

    <script>
        $(document).ready(function() {
           

            $('#searchInput').keyup(function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
</body>
</html>
