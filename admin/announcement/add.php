                      <?php 
                       if (!isset($_SESSION['ACCOUNT_ID'])){
                          redirect(web_root."admin/index.php");
                         }

                      // $autonum = New Autonumber();
                      // $res = $autonum->single_autonumber(2);

                       ?> 
 <form class="form-horizontal span6" action="controller.php?action=add" method="POST">

           <div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Add New Announcement</h1>
          </div>
          <!-- /.col-lg-12 -->
       </div> 
                   
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "date">Date:</label>

                      <div class="col-md-8">
                        <input name="announceid" type="hidden" value="">
                         <input class="form-control input-sm" id="date" name="date" placeholder=
                            "Date" type="date" value="">
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
                            "Title" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "announcement">Announcement:</label>

                      <div class="col-md-8">
                        <input name="announceid" type="hidden" value="">
                        <textarea  class="form-control input-sm" id="announcement" name="announcement" placeholder=
                            "Announcement" rows="5" cols="60">
                          
                        </textarea>
                         
                      </div>
                    </div>
                  </div>

                 

            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                       <button class="btn btn-primary btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
                       </div>
                    </div>
                  </div>

               
        <div class="form-group">
                <div class="rows">
                  <div class="col-md-6">
                    <label class="col-md-6 control-label" for=
                    "otherperson"></label>

                    <div class="col-md-6">
                   
                    </div>
                  </div>

                  <div class="col-md-6" align="right">
                   

                   </div>
                  
              </div>
              </div>
          
        </form>
       