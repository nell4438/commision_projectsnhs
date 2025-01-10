<?php
if (!isset($_SESSION['IDNO'])) {
  redirect("index.php");
}

$student = new Student();
$res = $student->single_student($_SESSION['IDNO']);

$resFile = $student->single_studentfile($_SESSION['IDNO']);

$course = new Course();
$resCourse = $course->single_course($res->COURSE_ID);
// print_r($_SESSION);
?>

<style type="text/css">
  #img_profile {
    width: 100%;
    height: auto;
  }

  #img_profile>a>img {
    width: 100%;
    height: auto;
  }
</style>
<div class="col-sm-3">

  <div class="panel">
    <div id="img_profile" class="panel-body">
      <a href="" data-target="#myModal" data-toggle="modal">
        <img title="student profile image" class="img-hover"
          src="<?php echo web_root . 'student/' . $res->STUDPHOTO; ?>">
      </a>
    </div>

    <ul class="list-group  ">
      <li class="list-group-item text-right"><span class="pull-left"><strong>Full name:</strong></span>
        <?php echo $res->FNAME . ' ' . $res->LNAME; ?> </li>
      <li class="list-group-item text-right"><span class="pull-left"><strong>Year Level:</strong></span>
        <?php echo $res->YEARLEVEL . '-' . $res->STRAND; ?> </li>
      <li class="list-group-item text-right"><span class="pull-left"><strong>Status:</strong></span>
        <?php echo $res->student_status; ?> </li>


    </ul>

  </div>
</div>

<!--/col-3-->
<div class="col-sm-9">

  <div class="panel">
    <div class="panel-body">
      <?php
      check_message();
      ?>
      <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#home" data-toggle="tab">Upload Documents</a></li>

        <li><a href="#settings" data-toggle="tab">Update Account</a></li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="home">
          <br />
          <div class="col-md-12">
            <h3>Supporting Documents</h3>
          </div>
          <div class="table-responsive" style="margin-top:1%;">
            <div id="img_profile" class="panel-body" style="margin-right:1%;">
              <a href="" data-target="#myModalfile" data-toggle="modal"><button class="btn btn-primary">Upload a
                  file</button></a>
              <br><br>
              <?php

              $documents = ['nso', 'gm', 'sf9', 'sf10', 'clearance'];
              $web_root = web_root;

              foreach ($documents as $doc) {
                if (isset($resFile->$doc) && !empty($resFile->$doc)) {
                  $file_path = $_SERVER['DOCUMENT_ROOT'] . $web_root . 'student/' . $resFile->$doc;
                  $file_path_real = $web_root . 'student/' . $resFile->$doc;

                  if (file_exists($file_path)) {

                    echo '<a href="' . htmlspecialchars($file_path_real) . '" target="_blank" class="btn" style="margin-right:10px; text-transform:uppercase; display: inline-block; padding: 8px 16px; border: 1px solid #ccc; text-decoration: none; color: #333; background-color: #f8f9fa;">' . htmlspecialchars($doc) . '</a>';
                  } else {
                    echo htmlspecialchars($doc) . ' file not uploaded.';
                  }
                }
                // else {
                //     echo '<span style="text-transform:uppercase">'.htmlspecialchars($doc) . ' not available.</span>';
                // }
              }

              ?>

            </div>

          </div><!--/table-resp-->

        </div><!--/tab-pane-->
        <div class="tab-pane" id="settings">

          <?php require_once "updateyearlevel.php"; ?>


        </div><!--/tab-pane-->
      </div><!--/tab-content-->
    </div>
  </div><!--/col-9-->
</div>




<!-- Modal photo -->
<div class="modal fade" id="myModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">×</button>

        <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
      </div>

      <form action="student/controller.php?action=photos" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="rows">
              <div class="col-md-12">
                <div class="rows">
                  <div class="col-md-8">
                    <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> <input id="photo" name="photo"
                      type="file">
                  </div>

                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <button
            class="btn btn-primary" name="savephoto" type="submit">Upload Photo</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Modal photo -->
<div class="modal fade" id="myModalfile" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">×</button>

        <h4 class="modal-title" id="myModalLabel">Choose 137 file.</h4>
      </div>

      <form action="student/controller.php?action=photofile" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <!-- <div class="form-group">
            <div class="rows">
              <div class="col-md-8">
                <div class="rows">
                  <div class="col-md-8">
                    <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> <input id="photos" name="photos" type="file">
                  </div>

                  <div class="col-md-4"></div>
                </div>
              </div>
            </div>
          </div> -->


          <div class="col-md-8">
            <label for="nso">NSO</label>
            <input name="nso" type="file">
            <hr>
          </div>
          <div class="col-md-8">
            <label for="gm">Good Moral</label>
            <input name="gm" type="file">
            <hr>
          </div>
          <div class="col-md-8">
            <label for="sf9">SF9</label>
            <input name="sf9" type="file">
            <hr>
          </div>
          <div class="col-md-8">
            <label for="sf10">SF10</label>
            <input name="sf10" type="file">
            <hr>
          </div>
          <?php if ($res->student_status != "New") { ?>
            <div class="col-md-8">
              <label for="clearance">Clearance</label>
              <input name="clearance" type="file">
              <hr>
            </div>
            <?php
          }
          ?>
        </div>

        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" type="button">Close</button> <button
            class="btn btn-primary" name="savephoto" type="submit">Upload File</button>
        </div>
      </form>
    </div>
  </div>
</div>