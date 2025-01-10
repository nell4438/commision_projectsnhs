<?php
$student = new Student();
$res = $student->single_student($_GET['id']);
$studentdetails = new StudentDetails();
$resguardian = $studentdetails->single_StudentDetails($_GET['id']);

$resFile = $student->single_studentfile($_GET['id']);

$course = new Course();
$resCourse = $course->single_course($res->COURSE_ID);

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
<div class="col-sm-5">

  <div class="panel">
    <div id="img_profile" class="panel-body">
      <a href="" data-target="#myModal" data-toggle="modal">
        <img title="profile image" class="img-hover" src="<?php echo web_root . 'student/' . $res->STUDPHOTO; ?>">
      </a>
    </div>
    <ul class="list-group">


      <li class="list-group-item text-right"><span class="pull-left"><strong>Student name:</strong></span>
        <?php echo $res->FNAME . ' ' . $res->LNAME; ?> </li>
      <li class="list-group-item text-right"><span class="pull-left"><strong>Year Level</strong></span>
        <?php echo $res->YEARLEVEL . '-' . $res->STRAND; ?> </li>
      <li class="list-group-item text-right"><span class="pull-left"><strong>Status</strong></span>
        <?php echo $res->student_status; ?> </li>


    </ul>

  </div>
</div>

<!--/col-3-->
<div class="col-sm-7">
  <!-- `IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, `STATUS`, `AGE`, `NATIONALITY`,
 `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `EMAIL`, `password`, `student_status`, `schedID`, `course_year` -->
  <?php
  $currentyear = date('Y');
  $nextyear = date('Y') + 1;
  $sy = $currentyear . '-' . $nextyear;
  $_SESSION['SY'] = $sy;
  // $newDate    = Carbon::createFromFormat('Y-m-d',$_SESSION['SY'] )->addYear(1);
  
  ?>

  <form action="controller.php?action=edit" class="form-horizontal" method="post">
    <div class="table-responsive">
      <div class="col-md-8">
        <h2>Student Information</h2>
      </div>
      <table class="table">
        <tr>
          <td><label>Id</label></td>
          <td>
            <input class="form-control input-md" readonly id="IDNO" name="IDNO" placeholder="Student Id" type="text"
              value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
          </td>
          <td colspan="4"></td>

        </tr>
        <tr>
          <td><label>Firstname</label></td>
          <td>
            <input required="true" class="form-control input-md" id="FNAME" name="FNAME" placeholder="First Name"
              type="text" value="<?php echo $res->FNAME; ?>">
          </td>
          <td><label>Lastname</label></td>
          <td colspan="2">
            <input required="true" class="form-control input-md" id="LNAME" name="LNAME" placeholder="Last Name"
              type="text" value="<?php echo $res->LNAME; ?>">
          </td>
          <td>
            <input class="form-control input-md" id="MI" name="MI" placeholder="MI" type="text"
              value="<?php echo $res->MNAME; ?>">
          </td>
        </tr>
        <tr>
          <td><label>Address</label></td>
          <td colspan="5">
            <input required="true" class="form-control input-md" id="PADDRESS" name="PADDRESS"
              placeholder="Permanent Address" type="text" value="<?php echo $res->HOME_ADD; ?>">
          </td>
        </tr>
        <tr>
          <td><label>Sex </label></td>
          <td colspan="2">
            <label>
              <?php
              if ($res->SEX == 'Male') {
                # code...
                echo '<input checked id="optionsRadios1" name="optionsRadios" type="radio"   value="Female">Female
             <input id="optionsRadios2" name="optionsRadios" type="radio"  CHECKED="true"  value="Male"> Male';
              } else {
                echo '<input checked id="optionsRadios1" name="optionsRadios" type="radio"  CHECKED="true"  value="Female">Female
             <input id="optionsRadios2" name="optionsRadios" type="radio"   value="Male"> Male';
              }

              ?>

            </label>
          </td>
          <td><label>Date of birth</label></td>
          <td colspan="2">
            <div class="input-group ">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input required="true" name="BIRTHDATE" id="BIRTHDATE" type="text" class="form-control input-md"
                data-inputmask="'alias': 'mm/dd/yyyy'" data-mask
                value="<?php echo date_format(date_create($res->BDAY), 'm/d/Y'); ?>">
            </div>
          </td>

        </tr>
        <tr>
          <td><label>Place of Birth</label></td>
          <td colspan="5">
            <input required="true" class="form-control input-md" id="BIRTHPLACE" name="BIRTHPLACE"
              placeholder="Place of Birth" type="text" value="<?php echo $res->BPLACE; ?>">
          </td>
        </tr>
        <tr>
          <td><label>Nationality</label></td>
          <td colspan="2"><input required="true" class="form-control input-md" id="NATIONALITY" name="NATIONALITY"
              placeholder="Nationality" type="text" value="<?php echo $res->NATIONALITY; ?>">
          </td>
          <td><label>Religion</label></td>
          <td colspan="2"><input required="true" class="form-control input-md" id="RELIGION" name="RELIGION"
              placeholder="Religion" type="text" value="<?php echo $res->RELIGION; ?>">
          </td>

        </tr>
        <tr>
          <td><label>Contact No.</label></td>
          <td colspan="3"><input required="true" class="form-control input-md" id="CONTACT" name="CONTACT"
              placeholder="Contact Number" type="text" value="<?php echo $res->CONTACT_NO; ?>">
          </td>
          <td><label>Civil Status</label></td>
          <td colspan="2">
            <select class="form-control input-sm" name="CIVILSTATUS">
              <option value="<?php echo $res->STATUS; ?>"><?php echo $res->STATUS; ?></option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Widow">Widow</option>
            </select>
          </td>
        </tr>

        <tr>
          <td><label>Gaurdian</label></td>
          <td colspan="2">
            <input required="true" class="form-control input-md" id="GUARDIAN" name="GUARDIAN"
              placeholder="Parents/Guardian Name" type="text"
              value="<?php echo isset($resguardian->GUARDIAN) ? $resguardian->GUARDIAN : ''; ?>">
          </td>
          <td><label>Contact No.</label></td>
          <td colspan="2"><input required="true" class="form-control input-md" id="GCONTACT" name="GCONTACT"
              placeholder="Contact Number" type="text"
              value="<?php echo isset($resguardian->GCONTACT) ? $resguardian->GCONTACT : ''; ?>"></td>
        </tr>
        <tr>
          <td>
            <label>Email:</label>
          </td>
          <td colspan="2">
          <input required="true" class="form-control input-md" id="email" name="email"
              placeholder="Email" type="text"
              value="<?php echo isset($res->email) ? $res->email : ''; ?>">
          </td>
        </tr>
        <tr>
          <td></td>
          <td colspan="5">
            <button class="btn btn-success btn-lg" name="save" type="submit">Save</button>
          </td>
        </tr>
      </table>

    </div>
    <td><label>FILES</label></td>
    <div id="img_profile" class="panel-body">

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
  </form>
</div>