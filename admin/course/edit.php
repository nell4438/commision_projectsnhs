<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
  redirect(web_root . "admin/index.php");
}

@$COURSE_ID = $_GET['id'];
if ($COURSE_ID == '') {
  redirect("index.php");
}
$course = new Course();
$singlecourse = $course->single_course($COURSE_ID);
// print_r($singlecourse);
$COURSE_MAJOR = $singlecourse->COURSE_MAJOR;
?>

<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Edit Year Level</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <input type="hidden" id="course_major" value="<?= $COURSE_MAJOR ?>">
  <input class="form-control input-sm" id="COURSE_ID" name="COURSE_ID" placeholder="Account Id" type="Hidden"
    value="<?php echo $singlecourse->COURSE_ID; ?>">

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COURSE_NAME">Year Level:</label>

      <div class="col-md-8">
        <select class="form-control input-sm" id="COURSE_NAME" name="COURSE_NAME"
          onchange="showHideFields();fetchSections();">
          <option value="37">Select</option>
          <?php
          for ($i = 7; $i <= 12; $i++) {
            // echo $singlecourse->COURSE_NAME;
            $selected = ($i == $singlecourse->COURSE_NAME) ? 'selected' : '';
            echo "<option value='$i' $selected>$i</option>";
          }
          ?>
        </select>
        <!-- <input class="form-control input-sm" id="COURSE_NAME" name="COURSE_NAME" placeholder="Year Level" type="text"
          value="<?php echo $singlecourse->COURSE_NAME; ?>"> -->
      </div>
    </div>
  </div>


  <div class="form-group" id="sectionField">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COURSE_MAJOR">Section:</label>

      <div class="col-md-8">
        <input name="deptid" type="hidden" value="">
        <select class="form-control input-sm" id="COURSE_MAJOR" name="COURSE_MAJOR">
          <option disabled selected>Select a year level first</option>
        </select>
      </div>
    </div>
  </div>


  <!-- <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COURSE_MAJOR">Section:</label>

      <div class="col-md-8">

        <input class="form-control input-sm" id="COURSE_MAJOR" name="COURSE_MAJOR" placeholder="Section" type="text"
          value="<?php echo $singlecourse->COURSE_MAJOR; ?>" required>
      </div>
    </div>
  </div> -->

  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="COURSE_DESC">Description:</label>

      <div class="col-md-8">

        <input class="form-control input-sm" id="COURSE_DESC" name="COURSE_DESC" placeholder="Year Level Description"
          type="text" value="<?php echo $singlecourse->COURSE_DESC; ?>" required readonly>
      </div>
    </div>
  </div>


  <div class="form-group" id="strandField">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="DEPT_ID">Strand:</label>

      <div class="col-md-8">
        <select class="form-control input-sm" name="DEPT_ID" id="DEPT_ID">
          <?php

          $mydb->setQuery("SELECT * FROM `department` WHERE DEPT_ID=" . $singlecourse->DEPT_ID);
          $cur = $mydb->loadResultList();

          foreach ($cur as $result) {
            echo '<option value=' . $result->DEPT_ID . ' >' . $result->DEPARTMENT_NAME . ' [ ' . $result->DEPARTMENT_DESC . ' ]</option>';

          }
          ?>
          <?php

          $mydb->setQuery("SELECT * FROM `department` WHERE DEPT_ID!=" . $singlecourse->DEPT_ID);
          $cur = $mydb->loadResultList();

          foreach ($cur as $result) {
            echo '<option value=' . $result->DEPT_ID . ' >' . $result->DEPARTMENT_NAME . ' [ ' . $result->DEPARTMENT_DESC . ' ]</option>';

          }
          ?>


        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-8">
      <label class="col-md-4 control-label" for="idno"></label>

      <div class="col-md-8">
        <button class="btn btn-primary " name="save" type="submit"><span class="fa fa-save fw-fa"></span>
          Update</button>
      </div>
    </div>
  </div>


  <div class="form-group">
    <div class="rows">
      <div class="col-md-6">
        <label class="col-md-6 control-label" for="otherperson"></label>

        <div class="col-md-6">

        </div>
      </div>

      <div class="col-md-6" align="right">


      </div>

    </div>
  </div>

</form>


</div><!--End of container-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    showHideFields();  // Call this function to setup UI correctly on page load
    fetchSections();   // Also fetch sections based on the initial year level
  });
  function showHideFields() {
    var yearLevel = document.getElementById('COURSE_NAME').value;
    var descriptionField = document.getElementById('COURSE_DESC');
    var strandField = document.getElementById('strandField');

    strandField.style.display = 'none';

    if (parseInt(yearLevel) === 11 || parseInt(yearLevel) === 12) {
      strandField.style.display = 'block';
      descriptionField.value = "Senior Level";
    } else {
      descriptionField.value = "Junior Level";
    }
  }

  function fetchSections() {
    var yearLevel = $('#COURSE_NAME').val();
    console.log('course', yearLevel)
    let course_edit= document.getElementById('course_major').value;
    if (yearLevel) {
      $.ajax({
        url: 'getSection.php',  // Make sure URL is correct
        type: 'POST',
        data: {
          year_level: yearLevel,
          isEdit: true,
          course_edit: course_edit,
        },
        success: function (data) {
          $('#COURSE_MAJOR').html(data);
        }
      });
    }
  }
</script>