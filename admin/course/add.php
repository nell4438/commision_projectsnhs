<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}


?>
<form class="form-horizontal span6" action="controller.php?action=add" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Year Level</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="COURSE_NAME">Year Level:</label>

            <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <select class="form-control input-sm" id="COURSE_NAME" name="COURSE_NAME" onchange="showHideFields();fetchSections();">
                    <option value="37">Select</option>
                    <?php
                    // Populate year levels (7 - 12)
                    for ($i = 7; $i <= 12; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
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
                <!-- <select class="form-control input-sm" id="COURSE_MAJOR" name="COURSE_MAJOR">
                    <?php
                    $mydb->setQuery("SELECT * FROM `tblsection`");

                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                        echo '<option value=' . $result->section_id . ' >' . $result->section_name . '</option>';
                    }
                    ?>
                </select> -->
            </div>
        </div>
    </div>
    <div class="form-group" id="strandField">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="DEPT_ID">Strand:</label>

            <div class="col-md-8">
                <select class="form-control input-sm" name="DEPT_ID" id="DEPT_ID">
                    <option value="37">Select</option>
                    <?php
                    // Populate strands for Grade 11 and 12
                    $mydb->setQuery("SELECT * FROM `department`");
                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                        echo '<option value="' . $result->DEPT_ID . '">' . $result->DEPARTMENT_NAME . ' [ ' . $result->DEPARTMENT_DESC . ' ]</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="COURSE_DESC">Description:</label>

            <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="COURSE_DESC" name="COURSE_DESC" placeholder="Year Level Description" type="text" value="" required readonly>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="idno"></label>

            <div class="col-md-8">
                <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span>
                    Save</button>
            </div>
        </div>
    </div>



</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function showHideFields() {
        var yearLevel = document.getElementById('COURSE_NAME').value;
        var descriptionField = document.getElementById('COURSE_DESC');
        var strandField = document.getElementById('strandField');

        // Hide section and strand fields for all year levels
        // sectionField.style.display = 'none';
        strandField.style.display = 'none';

        if (yearLevel == 11 || yearLevel == 12) {
            strandField.style.display = 'block';
            descriptionField.value = "Senior Level";
        } else {
            descriptionField.value = "Junior Level";
        }
    }

    function fetchSections() {
        var yearLevel = $('#COURSE_NAME').val();
        console.log('course', yearLevel)
        if (yearLevel) {
            $.ajax({
                url: 'getSection.php', // Adjust the URL to your PHP script
                type: 'POST',
                data: {
                    year_level: yearLevel
                },
                success: function(data) {
                    $('#COURSE_MAJOR').html(data);
                }
            });
        }
    }
</script>