<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

@$sect_id = $_GET['id'];
if ($sect_id == '') {
    redirect("index.php");
}
$sect = new Section();
$singlesection = $sect->single_sections($sect_id);

?>

<form class="form-horizontal span6" action="controller.php?action=edit" method="POST">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Section</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>



    <input id="section_id" name="section_id" type="Hidden" value="<?php echo $singlesection->section_id; ?>">


    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="section_name">Section:</label>

            <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="section_name" name="section_name" placeholder="Section Name"
                    type="text" value="<?php echo $singlesection->section_name; ?>">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="level">Level:</label>

            <div class="col-md-8">
                <input type="text" class="form-control input-sm" id="section_level" name="section_level" placeholder="Section Level" type="text"
                    value="<?php echo $singlesection->section_level; ?>"></input>
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

</form>


</div><!--End of container-->