<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?> | Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo web_root; ?>admin/css/bootstrap.min.css" rel="stylesheet">


    <script src="<?php echo web_root; ?>admin/select2/select2.min.css"></script>
    <!-- MetisMenu CSS -->
    <link href="<?php echo web_root; ?>admin/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo web_root; ?>admin/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo web_root; ?>admin/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->

    <link href="<?php echo web_root; ?>admin/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo web_root; ?>admin/font/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo web_root; ?>admin/font/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="<?php echo web_root; ?>admin/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- datetime picker CSS -->
    <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo web_root; ?>css/datepicker.css" rel="stylesheet" media="screen">

    <link href="<?php echo web_root; ?>admin/css/costum.css" rel="stylesheet">
    <link href="<?php echo web_root; ?>css/ekko-lightbox.css" rel="stylesheet">

</head>


<?php


admin_confirm_logged_in();

$semester = new Semester();
$semesters = $semester->listofsemesters();
// print_r($semester->listofsemester());
$latestSemester = null;
foreach ($semesters as $sem) {
    if ($sem['SETSEM'] == 1) {
        if ($latestSemester === null || $sem['SEMID'] > $latestSemester['SEMID']) {
            $latestSemester = $sem;
        }
    }
}
$semesterHoldData = $latestSemester['SEMESTER'];


$sql = "SELECT count(*) as 'enrollees' FROM tblstudent WHERE NewEnrollees=1 AND SEMESTER='$semesterHoldData'";
$mydb->setQuery($sql);
$enrollees = $mydb->loadSingleResult();




?>
<?php
if (isset($_SESSION['admingvCart'])) {
    if (count($_SESSION['admingvCart']) > 0) {
        $cart = '<span class="carttxtactive">(' . count($_SESSION['admingvCart']) . ')</span>';
    }

}
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" style="background-color:#097687;color:#fff;"
            role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="background-color:#097687;color:#fff;"
                    href="<?php echo web_root; ?>admin/index.php">
                    <img src="<?php echo web_root; ?>img/logosnhs.png" height="30">
                    Sto.Nino National High School</a>
            </div>
            <!-- /.navbar-header -->

            <!-- <div class="navbar-middle text-center" style="text-align: center; padding-top: 15px;">
        <?php
        // date_default_timezone_set('Asia/Manila');
        // $current_time = date('h:i:s a');
        // $current_date = date('F j, Y'); // Format the date as desired
        // echo "<div class='time-display' style='font-size: 20px; color: #fff;'>$current_date $current_time</div>";
        ?>
    </div> -->

            <ul class="nav navbar-top-links navbar-right">
                <?php
                $user = new User();
                $singleuser = $user->single_user($_SESSION['ACCOUNT_ID']);
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" style="background-color:#097687;color:#fff;" data-toggle="dropdown"
                        href="#">
                        Welcome! <?php echo $_SESSION['ACCOUNT_NAME']; ?> <img title="profile image" width="23px"
                            height="17px" src="<?php echo web_root . 'admin/user/' . $singleuser->USERIMAGE ?>">
                    </a>
                    <ul class="dropdown-menu dropdown-acnt">
                        <div class="divpic">
                            <a href="" data-target="#usermodal" data-toggle="modal">
                                <img title="profile image" width="80" height="90"
                                    src="<?php echo web_root . 'admin/user/' . $singleuser->USERIMAGE ?>">
                            </a>
                        </div>
                        <div class="divtxt">
                            <li><a
                                    href="<?php echo web_root; ?>admin/user/index.php?view=edit&id=<?php echo $_SESSION['ACCOUNT_ID']; ?>">
                                    <?php echo $_SESSION['ACCOUNT_NAME']; ?> </a>
                            <li>
                                <a title="Edit"
                                    href="<?php echo web_root; ?>admin/user/index.php?view=edit&id=<?php echo $_SESSION['ACCOUNT_ID']; ?>">Edit
                                    My Profile</a>
                            </li>
                </li>
                <li>
                    <a href="<?php echo web_root; ?>admin/logout.php"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                </li>
    </div>
    </ul>
    </li>
    <!-- ... existing code ... -->
    </ul>
    <!-- /.navbar-top-links -->
    <br />


    </ul>
    <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <br />
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <!-- /input-group -->
                <li>
                    <a href="<?php echo web_root; ?>admin/index.php"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="<?php echo web_root; ?>admin/announcement/index.php"><i class="fa fa-bullhorn"></i>
                        Announcements</a>
                </li>
                <li>
                    <a href="<?php echo web_root; ?>admin/enrollees/index.php"><i class="fa fa-external-link"></i> New
                        Enrollees
                        <label
                            class="label pull-right label-danger"><?php echo isset($enrollees->enrollees) ? $enrollees->enrollees : 0; ?></label>
                    </a>

                </li>


                <li>
                    <a href="<?php echo web_root; ?>admin/department/index.php"><i class="fa  fa-building fa-fw"></i>
                        Strands</a>
                </li>

                <li>
                    <a href="<?php echo web_root; ?>admin/section/index.php"><i class="	fa fa-reorder fa-fw"></i>
                        Section</a>
                </li>

                <li>
                    <a href="<?php echo web_root; ?>admin/course/index.php"><i class="fa  fa-level-up"></i> Year Level
                    </a>

                </li>

                <li>
                    <a href="<?php echo web_root; ?>admin/student/index.php"><i class="fa fa-male"></i><i
                            class="fa fa-female"></i> Students </a>

                </li>

                <li>
                    <a href="<?php echo web_root; ?>admin/instructor/index.php"><i class="fa fa-group fa-fw"></i>Teacher
                    </a>

                </li>
                <li>
                    <a href="<?php echo web_root; ?>admin/maintenance/index.php"><i class="fa fa-gear fa-fw"></i> Set
                        Academic Year </a>

                </li>


                <li>
                    <!-- <a href="<?php echo web_root; ?>admin/report/index.php" ><i class="fa  fa-file-text fa-fw"></i> Report </a> -->
                    <a href="#"><i class="fa  fa-file-text fa-fw"></i> Report <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo web_root; ?>admin/report/index.php?view=log">System Log</a>
                        </li>

                    </ul>
                    <!-- /.nav-third-level -->
                </li>
                <?php if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') {
                    # code...
                    ?>
                    <li>
                        <a href="<?php echo web_root; ?>admin/user/index.php"><i class="fa fa-user fa-fw"></i> Users </a>

                    </li>


                <?php } ?>


            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="usermodal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>

                    <h4 class="modal-title" id="myModalLabel">Profile Image.</h4>
                </div>

                <form action="<?php echo web_root; ?>admin/user/controller.php?action=photos"
                    enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <div class="rows">
                                        <img title="profile image" width="500" height="360"
                                            src="<?php echo web_root . 'admin/user/' . $singleuser->USERIMAGE ?>">

                                    </div>
                                </div><br />
                                <div class="col-md-12">
                                    <div class="rows">
                                        <div class="col-md-8">

                                            <input type="hidden" name="MIDNO" id="MIDNO"
                                                value="<?php echo $_SESSION['ACCOUNT_ID']; ?>">
                                            <input name="MAX_FILE_SIZE" type="hidden" value="1000000"> <input id="photo"
                                                name="photo" type="file">
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


    <div id="page-wrapper">
        <?php check_message(); ?>
        <div class="row">

            <div class="col-lg-12">
                <p>
                    <?php
                    if ($title <> 'Home') {
                        echo ' <a href="' . web_root . 'admin/index.php" title="Home" >Home</a>  / 
                        <a href="index.php" title="' . $title . '" >' . $title . '</a> 
                        ' . (isset($header) ? ' / ' . $header : '') . '</p>';
                    } ?>



                    <?php require_once $content; ?>

            </div>
            <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




    <!-- jQuery -->
    <script src="<?php echo web_root; ?>admin/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo web_root; ?>admin/js/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo web_root; ?>admin/select2/select2.full.min.js"></script>
    <script src="<?php echo web_root; ?>admin/slimScroll/jquery.slimscroll.min.js"></script>

    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo web_root; ?>js/bootstrap-datetimepicker.uk.js"
        charset="UTF-8"></script>



    <script type="text/javascript" language="javascript"
        src="<?php echo web_root; ?>input-mask/jquery.inputmask.js"></script>
    <script type="text/javascript" language="javascript"
        src="<?php echo web_root; ?>input-mask/jquery.inputmask.date.extensions.js"></script>
    <script type="text/javascript" language="javascript"
        src="<?php echo web_root; ?>input-mask/jquery.inputmask.extensions.js"></script>


    <script type="text/javascript" language="javascript"
        src="<?php echo web_root; ?>input-mask//meiomask.min.js"></script>
    <script src="<?php echo web_root; ?>js/ekko-lightbox.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/sb-admin-2.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>admin/js/janobe.js"></script>


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>

        $(function () {
            $(".select2").select2();
        })


        $('input[data-mask]').each(function () {
            var input = $(this);
            input.setMask(input.data('mask'));
        });

        //Datemask2 mm/dd/yyyy
        $("#datetime12").inputmask("hh:mm t", { "placeholder": "hh:mm t" });

        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", { "placeholder": "mm/dd/yyyy" });
        //Money Euro
        $("[data-mask]").inputmask();


        $(document).ready(function () {
            var t = $('#example').DataTable({
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                // "sort": false,
                //ordering start at column 1
                "order": [[6, 'desc']]
            });

            t.on('order.dt search.dt', function () {
                t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });



        $(document).ready(function () {
            $('#dash-table').DataTable({
                responsive: true,
                "sort": false
            });

        });

        $(document).ready(function () {
            $('#dash-table1').DataTable({
                responsive: true,
                "sort": false
            });

        });



        $('.date_pickerfrom').datetimepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/2000',
            language: 'en',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0

        });


        $('.date_pickerto').datetimepicker({
            format: 'mm/dd/yyyy',
            startDate: '01/01/2000',
            language: 'en',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0

        });


        $('#date_picker').datetimepicker({
            format: 'mm/dd/yyyy',
            language: 'en',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: '1945:' + (new Date).getFullYear()
        });

    </script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo web_root; ?>admin/js/raphael-min.js"></script>
    <script src="<?php echo web_root; ?>admin/js/morris.min.js"></script>
    <script src="<?php echo web_root; ?>admin/js/morris-data.js"></script>

    <script type="text/javascript">

        $(document).on("change", "#COURSE_ID", function () {
            /* load all variables */

            var courseid = document.getElementById('COURSE_ID').value
            var semester = document.getElementById('sched_semester').value

            $("#loadedit").hide();

            // alert(courseid);
            $.ajax({    //create an ajax request to load_page.php
                type: "POST",
                url: "loaddata.php",
                dataType: "text",   //expect html to be returned  
                data: { id: courseid, SEMESTER: semester },
                success: function (data) {
                    $('#loaddata').html(data);


                }

            });

        });

        $(document).on("change", "#sched_semester", function () {
            /* load all variables */

            var courseid = document.getElementById('COURSE_ID').value
            var semester = document.getElementById('sched_semester').value

            $("#loadedit").hide();

            // $("#subjFirst").hide();
            // alert(courseid);
            $.ajax({    //create an ajax request to load_page.php
                type: "POST",
                url: "loaddata.php",
                dataType: "text",   //expect html to be returned  
                data: { id: courseid, SEMESTER: semester },
                success: function (data) {
                    $('#loaddata').html(data);


                }

            });

        });


        $(document).on("change", "#INST_ID", function () {
            /* load all variables */

            var instid = document.getElementById('INST_ID').value

            $("#spacing").hide();
            $("#HideMe").hide();

            // $("#subjFirst").hide();
            // alert(courseid);
            $.ajax({    //create an ajax request to load_page.php
                type: "POST",
                url: "loaddata.php",
                dataType: "text",   //expect html to be returned  
                data: { id: instid },
                success: function (data) {
                    $('#loadsubject').html(data);


                }

            });

        });

        $("#gosearch").click(function () {
            var instructor = document.getElementById("INST_ID").value;
            if (instructor == 'Select') {
                alert("Pls. Select Teacher.");
                return false;
            } else {
                return true;
            };
        })
    </script>
    <script type="text/javascript">
        $("#FIRSTGRADING").keyup(function () {
            //alert('FIRSTGRADING');

            var first = document.getElementById('FIRSTGRADING').value;
            var second = document.getElementById('SECONDGRADING').value;
            var third = document.getElementById('THIRDGRADING').value;
            var fourth = document.getElementById('FOURTHGRADING').value;
            var tot;


            first = parseFloat(first) * .20;
            second = parseFloat(second) * .20;
            third = parseFloat(third) * .20;
            fourth = parseFloat(fourth) * .40

            tot = parseFloat(first) + parseFloat(second) + parseFloat(third) + parseFloat(fourth);

            // tot = tot /  4;

            document.getElementById('AVERAGE').value = tot;







        });
        $("#SECONDGRADING").keyup(function () {
            var first = document.getElementById('FIRSTGRADING').value;
            var second = document.getElementById('SECONDGRADING').value;
            var third = document.getElementById('THIRDGRADING').value;
            var fourth = document.getElementById('FOURTHGRADING').value;
            var tot;


            first = parseFloat(first) * .20;
            second = parseFloat(second) * .20;
            third = parseFloat(third) * .20;
            fourth = parseFloat(fourth) * .40

            tot = parseFloat(first) + parseFloat(second) + parseFloat(third) + parseFloat(fourth);

            // tot = tot /  4;

            document.getElementById('AVERAGE').value = tot;

        });
        $("#THIRDGRADING").keyup(function () {
            // alert('THIRDGRADING');
            var first = document.getElementById('FIRSTGRADING').value;
            var second = document.getElementById('SECONDGRADING').value;
            var third = document.getElementById('THIRDGRADING').value;
            var fourth = document.getElementById('FOURTHGRADING').value;
            var tot;


            first = parseFloat(first) * .20;
            second = parseFloat(second) * .20;
            third = parseFloat(third) * .20;
            fourth = parseFloat(fourth) * .40

            tot = parseFloat(first) + parseFloat(second) + parseFloat(third) + parseFloat(fourth);

            // tot = tot /  4;

            document.getElementById('AVERAGE').value = tot;

        });
        $("#FOURTHGRADING").keyup(function () {
            // alert('FOURTHGRADING');
            var first = document.getElementById('FIRSTGRADING').value;
            var second = document.getElementById('SECONDGRADING').value;
            var third = document.getElementById('THIRDGRADING').value;
            var fourth = document.getElementById('FOURTHGRADING').value;
            var tot;


            first = parseFloat(first) * .20;
            second = parseFloat(second) * .20;
            third = parseFloat(third) * .20;
            fourth = parseFloat(fourth) * .40

            tot = parseFloat(first) + parseFloat(second) + parseFloat(third) + parseFloat(fourth);

            // tot = tot /  4;

            document.getElementById('AVERAGE').value = tot;

        });
    </script>
</body>

</html>