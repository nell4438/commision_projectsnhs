<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}
?>
<form class="form-horizontal span6" action="controller.php?action=add" method="POST">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Section</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="section_name">Section:</label>

            <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="section_name" name="section_name" placeholder="Section Name"
                    type="text" value="">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="section_level">Level:</label>

            <div class="col-md-8">
                <input name="deptid" type="hidden" value="">
                <input class="form-control input-sm" id="section_level" name="section_level"
                    placeholder="Section Level" type="text" value="">
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