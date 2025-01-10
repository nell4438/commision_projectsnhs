 
 <form action="" method="POST" > 
      <!-- info row -->
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
      
     <div class="row"> 
     <div id="HideMe"class="col-md-3">
       
     </div>
     <div id="spacing" class="col-md-2"></div>
       <div class="col-md-3">
        <div class="form-group">
         <label>Teacher</label> 
            <select id="INST_ID" name="INST_ID" class="form-control"> 
            <option>Select</option>
                  <?php 
                    $mydb->setQuery("SELECT * FROM `tblinstructor` ");
                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                      echo '<option value="'.$result->INST_ID.'" >'.$result->INST_NAME.' </option>';

                    }
                  ?>
            </select>
        </div> 
      </div>  
           <!-- /.col -->
      <div class="col-md-2">
        <div class="form-group">
           <label>Section</label>  
           <select name="Section" class="form-control"> 
            <option value="1">Section 1</option>
            <option value="2">Section 2</option> 
            <option value="2">Section 3</option> 
            <option value="2">Section 4</option> 
          </select> 
        </div> 
      </div>
      <div id="loadsubject"></div>

 
 
      <div class="col-sm-2 invoice-col"> 
        <br/> 
          <div class="form-group"> 
              <button type="submit" id="gosearch" name="submit" class="btn" style="background-color:#097687;color:#fff;">Submit</button>
         </div>  
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" align="center">
            Class List 
             
          </h2>
        </div> 
      </div> 

      <div class="container">
        <table style="max-width:100%" cellpadding="4" cellspacing="7" class="table">
          <thead>
            <th><label>Teacher :</label></th><th  ><label><?php echo  isset($resInst->INST_NAME) ? $resInst->INST_NAME :'';?></label></th> 
            <th></th>
           </thead>
           
        </table>
      </div>
   

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 col-md-12 table-responsive">
          <table  class="table table-bordered table-striped" style="font-size:11px" cellspacing="0" >
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
  
            
                $sql = "SELECT * FROM `tblinstructor` i,`tblschedule` sc, `studentsubjects` ss,`tblstudent` s,course c
                 WHERE i.`INST_ID`=sc.`INST_ID` AND sc.`SUBJ_ID`=ss.`SUBJ_ID` AND STUDSECTION=SECTION AND ss.`IDNO`=s.`IDNO` 
                 AND s.COURSE_ID = c.COURSE_ID  AND i.`INST_ID`=" .$_POST['INST_ID']. " AND SECTION = ".$_POST['Section']." 
                 AND CONCAT(sc.SUBJ_ID,sched_day)='".$_POST['Subject']."'  LIMIT 40";

                

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
    <form action="printClassrecord.php" method="POST" target="_blank">
    <!-- <input type="hidden" name="Course" value="<?php echo (isset($_POST['Course'])) ? $_POST['Course'] : ''; ?>"> -->
     <input type="hidden" name="INST_ID" value="<?php echo (isset($_POST['INST_ID'])) ? $_POST['INST_ID'] : ''; ?> "> 
     <input type="hidden" name="Subject" value="<?php echo (isset($_POST['Subject'])) ? $_POST['Subject'] : ''; ?> ">
     <input type="hidden" name="Section" value="<?php echo (isset($_POST['Section'])) ? $_POST['Section'] : ''; ?> "> 
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
  