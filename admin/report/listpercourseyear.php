 
 <form action="" method="POST" >
    <!-- Main content --> 
        <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
        <h3 class="page-header">
            <i class="fa fa-map-marker"></i> Sto. Nino National High School
            <small class="pull-right"> <?php 
                date_default_timezone_set('Asia/Manila');
                $current_timezone = date_default_timezone_get();
                echo date("F j, Y g:i a"); 
                ?></small>
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
       
      </div>
        
        <div class="col-sm-4 invoice-col">
          Year Level
          <address>
            <div class="form-group">
			  <select name="Course" class="form-control">  
      <?php 
        $mydb->setQuery("SELECT * FROM `course` ");
        $cur = $mydb->loadResultList();

        foreach ($cur as $result) {
          echo '<option value="'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.'" >'.$result->COURSE_NAME.'-'.$result->COURSE_LEVEL.' </option>';

        }
      ?>
			  </select>
		  </div>
          </address>
        </div> 
        <!-- /.col -->
           <!-- /.col -->
        <div class="col-sm-2 invoice-col"> 
        <br/>
        <address>
        <div class="form-group"> 
        <button type="submit" name="submit" class="btn" style="background-color:#097687;color:#fff;">Submit</button>
		  </div>
		  
        </address>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- title row -->
  
   <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
          <i  class="fa fa-male"></i><i  class="fa fa-female"></i>  List Of Students Enrolled per Strand And Yer Level</i>
              <small class="pull-right"> <?php echo (isset($_POST['Course'])) ? 'Year Level :' .$_POST['Course'] : ''; ?>
                 
                  </small>
          </h3>
        </div> 
      </div> 
   

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12 table-responsive">
          <table class="table table-bordered table-striped" style="font-size:11px" cellspacing="0" >
            <thead>
            <tr style="background-color:#097687;color:#fff;">
              <th>IdNo.</th>
              <th>Name</th> 
              <th>Address</th>
              <th>Sex</th> 
              <th>AGE</th>
              <th>Contact No.</th>
              <th>Civil Status</th>
              <th>Year Level</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
              <?php
                $tot = 0;
               if(isset($_POST['submit'])){ 
          
            
                 $sql ="SELECT * FROM `schoolyr` sy, `tblstudent`  s ,`course` c 
                        WHERE sy.`IDNO`=s.`IDNO` AND s.`COURSE_ID`=c.`COURSE_ID` AND CONCAT(COURSE_NAME,'-',COURSE_LEVEL) LIKE '%" . $_POST['Course'] ."%'";

                $mydb->setQuery($sql);
                $res = $mydb->executeQuery();
                $row_count = $mydb->num_rows($res);
                $cur = $mydb->loadResultList();
               
                  if ($row_count > 0){
                    foreach ($cur as $result) {
                      $dbirth =  date($result->BDAY);
                      $today = date('Y-M-d'); 
              ?>
                      <tr> 
                        <td><?php echo $result->IDNO;?></td>
                        <td><?php echo $result->FNAME . ' ' .  $result->MNAME . '  ' .  $result->LNAME;?></td>
                        <td><?php echo $result->HOME_ADD;?></td>
                        <td><?php echo $result->SEX;?></td>
                        <td><?php echo  date_diff(date_create($dbirth),date_create($today))->y;?></td>
                        <td><?php echo $result->CONTACT_NO;?></td>
                        <td><?php echo $result->STATUS;?></td>
                        <td><?php echo $result->COURSE_NAME .'-'.$result->COURSE_LEVEL;?></td>
                        <td><?php echo $result->student_status;?></td>
                      </tr>
              <?php  
                         $tot =  count($cur);
                        
                    } 
                       // $_SESSION['tot'] = $tot;
                  } 
 
           
             }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="8" align="right"><h2>Total Number of Student/s : </h2></td><td><h2><?php echo $tot ; ?></h2></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 
</form>
    <form action="printcourseyear.php" method="POST" target="_blank">
    <input type="hidden" name="Course" value="<?php echo (isset($_POST['Course'])) ? $_POST['Course'] : ''; ?>"> 
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
<!-- ./wrapper -->
  