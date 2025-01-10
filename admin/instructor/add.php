<?php 
if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."admin/index.php");
}
?>

<form class="form-horizontal span6" action="controller.php?action=add" method="POST">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Teacher</h1>
        </div>
    </div> 
    
    <!-- Name Field -->
    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="INST_NAME">Name:</label>
            <div class="col-md-8">
                <input class="form-control input-sm" id="INST_NAME" name="INST_NAME" placeholder="Teacher Full Name" type="text" value="">
            </div>
        </div>
    </div>

    <!-- Year Level Field -->
    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="INST_MAJOR">Year Level:</label>
            <div class="col-md-8">
                <select class="form-control input-sm" id="INST_MAJOR" name="INST_MAJOR" onchange="updateSectionOrStrand()">
                    <option value="7">Grade 7</option>
                    <option value="8">Grade 8</option>
                    <option value="9">Grade 9</option>
                    <option value="10">Grade 10</option>
                    <option value="11">Grade 11</option>
                    <option value="12">Grade 12</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Hidden field for storing either Section or Strand -->
<input type="hidden" id="INST_CONTACT" name="INST_CONTACT" value="">

<!-- Visible Section Field -->
<div class="form-group" id="sectionField" style="display:none;">
    <div class="col-md-8">
        <label class="col-md-4 control-label">Section:</label>
        <div class="col-md-8">
            <input class="form-control input-sm" id="SECTION" placeholder="Section" type="text" value="">
        </div>
    </div>
</div>

<!-- Visible Strand Field -->
<div class="form-group" id="strandField" style="display:none;">
    <div class="col-md-8">
        <label class="col-md-4 control-label">Strand:</label>
        <div class="col-md-8">
            <input class="form-control input-sm" id="STRAND" placeholder="Strand" type="text" value="">
        </div>
    </div>
</div>


    <!-- Submit Button -->
    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="idno"></label>
            <div class="col-md-8">
                <button class="btn btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span> Save</button>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('INST_MAJOR').addEventListener('change', function() {
    var yearLevel = this.value;
    var sectionField = document.getElementById('sectionField');
    var strandField = document.getElementById('strandField');
    var sectionInput = document.getElementById('SECTION');
    var strandInput = document.getElementById('STRAND');
    var contactInput = document.getElementById('INST_CONTACT');

    if (yearLevel >= 7 && yearLevel <= 10) {
        sectionField.style.display = 'block';
        strandField.style.display = 'none';
        contactInput.value = sectionInput.value; // Update INST_CONTACT when Section is visible
    } else if (yearLevel >= 11) {
        sectionField.style.display = 'none';
        strandField.style.display = 'block';
        contactInput.value = strandInput.value; // Update INST_CONTACT when Strand is visible
    }
});

// Update INST_CONTACT field on input change in Section or Strand
document.getElementById('SECTION').addEventListener('input', function() {
    document.getElementById('INST_CONTACT').value = this.value;
});
document.getElementById('STRAND').addEventListener('input', function() {
    document.getElementById('INST_CONTACT').value = this.value;
});

// Form submission handler
document.querySelector('form').addEventListener('submit', function(e) {
    updateContactFieldOnSubmit();
});
</script>


  
