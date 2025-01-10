<?php  
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$INST_ID = $_GET['id'];
    if($INST_ID==''){
  redirect("index.php");
}
 

  $subject = New Instructor();
  $inst = $subject->single_instructor($INST_ID);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

    
           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Edit Teacher Info</h1>
          </div>
        </div> 

        <input class="form-control input-sm" id="INST_ID" name="INST_ID" placeholder=
                            "Instructor Full Name" type="hidden" value="<?php echo $inst->INST_ID ; ?>">

                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "INST_NAME">Name:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="INST_NAME" name="INST_NAME" placeholder=
                            "Teachers Full Name" type="text" value="<?php echo $inst->INST_NAME ; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "INST_MAJOR">Year Level:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="INST_MAJOR" name="INST_MAJOR" placeholder=
                            "Subject" type="text" value="<?php echo $inst->INST_MAJOR ; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "INST_CONTACT">Section:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="INST_CONTACT" name="INST_CONTACT" placeholder=
                            "Contact Number." type="text" value="<?php echo $inst->INST_CONTACT ; ?>" required>
                      </div>
                    </div>
                  </div> 
            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                       <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Update</button> 
                       </div>
                    </div>
                  </div>


          
  </form>
      

     