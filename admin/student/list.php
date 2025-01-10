<?php
if (!isset($_SESSION['ACCOUNT_ID'])) {
    redirect(web_root . "admin/index.php");
}

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
// print_r($latestSemester['SEMESTER']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>List of Students</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <input type="" name="semester" id="semester" value="<?php echo $semesterHoldData; ?>" hidden>
    <div class="row">
        <div class="col-lg-12" id="printArea">
            <h1 class="page-header">List of Students</h1>
            <form action="controller.php?action=delete" Method="POST">
                <div class="table-responsive">
                    <table id="tablet" class="table table-striped table-bordered table-hover table-responsive"
                        style="font-size:12px" cellspacing="0">
                        <thead>
                            <tr style="background-color:#097687;color:#fff;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>Year Level</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $mydb->setQuery("SELECT s.*, sec.section_name
                                            FROM tblstudent s
                                            LEFT JOIN tblsection sec ON s.section_id = sec.section_id
                                            WHERE s.NewEnrollees = 0
                                            AND
                                            s.SEMESTER  = '$semesterHoldData'
                                            ORDER BY s.YEARLEVEL, s.LNAME, s.FNAME");

                            $cur = $mydb->loadResultList();
                            foreach ($cur as $result) {
                                $age = $result->BDAY != '0000-00-00' ? date_diff(date_create($result->BDAY), date_create('today'))->y : 'None';
                                echo '<tr>';
                                echo '<td>' . $result->IDNO . '</td>';
                                echo '<td>' . $result->LNAME . ',' . $result->FNAME . ' ' . $result->MNAME . '</td>';
                                echo '<td>' . $result->SEX . '</td>';
                                echo '<td>' . $age . '</td>';
                                echo '<td>' . $result->HOME_ADD . '</td>';
                                echo '<td>' . $result->CONTACT_NO . '</td>';
                                echo '<td>' . $result->YEARLEVEL . '-' . ($result->YEARLEVEL == 11 || $result->YEARLEVEL == 12 ? $result->section_name : ("TBA" ?? $result->STRAND)) . '</td>';
                                echo '<td>' . ($result->YEARLEVEL == 11 || $result->YEARLEVEL == 12 ? $result->section_name : ($result->section_name ?? "TBA")) . '</td>';
                                echo '<td align="center" >
    <a title="View Information" href="index.php?view=view&id=' . $result->IDNO . '" class="btn btn-info btn-xs">View <span class="fa fa-info-circle fw-fa"></span></a>
    <form action="controller.php?action=delete" method="POST" style="display: inline;" onsubmit="return confirm(\'Are you sure you want to delete this student?\');">
        <input type="hidden" name="id" value="' . $result->IDNO . '">
        <button type="submit" class="btn btn-danger btn-xs" title="Delete Student">Drop <span class="fa fa-trash-o fw-fa"></span></button>
    </form>
</td>';

                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                    <select class="form-control input-sm" id="gradeLevelFilter" onchange="fetchSections();">
                        <option value="">Select Grade Level</option>
                        <?php
                        for ($i = 7; $i <= 12; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>

                    </select>


                    <select class="form-control input-sm" id="sectionFilter" name="sectionFilter">
                        <option disabled selected>Select a year level first</option>
                    </select>


                </div>
            </form>
        </div>
    </div>
    <button onclick="printPage()">PRINT</button>
    <!-- <form action="ListStudentPrint.php" method="POST" target="_blank">
        <input type="hidden" name="Course" value="<?php echo (isset($_POST['Course'])) ? $_POST['Course'] : ''; ?>">
        <input type="hidden" name="Semester"
            value="<?php echo (isset($_POST['Semester'])) ? $_POST['Semester'] : ''; ?> ">
        <input type="hidden" name="SY" value="<?php echo (isset($_POST['SY'])) ? $_POST['SY'] : ''; ?> ">
     
        <div class="row no-print">
            <div class="col-xs-12">
                <span class="pull-right"> <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i>
                        Print</button></span>
            </div>
        </div>
    </form> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script>

        $(document).ready(function () {
            var table = $('#tablet').DataTable();
            $('#gradeLevelFilter, #sectionFilter').on('change', function () {
                console.log('Change event triggered');
                fetchAndLoadTableData(table)
            });
            fetchSections();
        });


        function fetchSections() {
            var yearLevel = $('#gradeLevelFilter').val();
            console.log('Grade Level Filter', yearLevel);
            if (yearLevel) {
                $.ajax({
                    url: '../course/getSection.php',
                    type: 'POST',
                    data: {
                        year_level: yearLevel
                    },
                    success: function (data) {


                        $('#sectionFilter').html(data);
                    }
                });
            }
        }

        function fetchAndLoadTableData(table) {
            var yearLevel = $('#gradeLevelFilter').val();
            var section = $('#sectionFilter').val();
            $.ajax({
                url: 'getStudents.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    year_level: yearLevel,
                    section: section
                },
                success: function (data) {
                    table.clear().rows.add(data).draw();
                },
                error: function (error) {
                    console.error("Error fetching data: ", error);
                }
            });
        }
        function printPage() {
            var yearLevel = $('#gradeLevelFilter').val();
            var section = $('#sectionFilter').val();
            var semester = $('#semester').val();

            $.ajax({
                url: 'ListStudentPrint.php',
                type: 'POST',
                data: {
                    year_level: yearLevel,
                    section: section,
                    semester: semester
                },
                success: function (response) {
                    var win = window.open('', '_blank');
                    win.document.open();
                    win.document.write(response); // write the response HTML into the new window
                    win.document.close(); // needed for some older browsers
                    convertToPDF(win);
                },
                error: function (error) {
                    console.error("Error fetching data: ", error);
                }
            });
        }

        function convertToPDF(win) {
            html2canvas(win.document.body).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF();
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save("download.pdf");
                win.close(); // close the temporary window
            });
        }
        // function printPage() {
        //     // var originalContents = document.body.innerHTML;

        //     // var printContents = document.getElementById('printArea').innerHTML;
        //     // document.body.innerHTML = printContents;

        //     // window.print();

        //     // document.body.innerHTML = printContents;
        //     var yearLevel = $('#gradeLevelFilter').val();
        //     var section = $('#sectionFilter').val();
        //     var semester = $('#semester').val();
        //     $.ajax({
        //         url: 'ListStudentPrint.php',
        //         type: 'POST',
        //         dataType: 'json',
        //         data: {
        //             year_level: yearLevel,
        //             section: section,
        //             semester: semester
        //         },
        //         success: function (data) {
        //             html2canvas(data).then(canvas => {
        //                 const imgData = canvas.toDataURL('image/png');
        //                 const pdf = new jsPDF();
        //                 const imgProps = pdf.getImageProperties(imgData);
        //                 const pdfWidth = pdf.internal.pageSize.getWidth();
        //                 const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        //                 pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        //                 pdf.save("download.pdf");
        //             });
        //         },
        //         error: function (error) {
        //             console.error("Error fetching data: ", error);
        //         }
        //     });
        // }
    </script>
</body>

</html>