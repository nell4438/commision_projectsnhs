<?php  
     if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

  @$id = $_GET['id'];
    if($id==''){
  redirect("index.php");
}
  $announce = New Announcement();
  $singleannouncement = $announce->single_announcements($id);

?> 

 <form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
  <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Edit Announcement</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 
                
                   
                    
                 <input id="id" name="id"  
                 type="Hidden" value="<?php echo $singleannouncement->id; ?>">
                  
                 <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "date">Date:</label>

                      <div class="col-md-8">
                        <input name="announceid" type="hidden" value="">
                         <input class="form-control input-sm" id="date" name="date" placeholder=
                            "Date" type="date" value="<?php echo $singleannouncement->date; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "title">Title:</label>

                      <div class="col-md-8">
                        <input name="announceid" type="hidden" value="">
                         <input class="form-control input-sm" id="title" name="title" placeholder=
                            "Title" type="text" value="<?php echo $singleannouncement->title; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ANNOUNCEMENT">Announcement:</label>

                      <div class="col-md-8"> 
                        <textarea class="form-control input-sm" id="ANNOUNCEMENT" name="ANNOUNCEMENT" placeholder=
                    "announcement" type="text" rows="6"><?php echo $singleannouncement->announcement; ?></textarea>
                        </div>
                    </div>
                  </div>

 
            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                         <button class="btn btn-primary " name="save" type="submit" ><span class="fa fa-save fw-fa"></span> Update</button>
                      </div>
                    </div>
                  </div>
 
        </form>
      

        </div><!--End of container-->