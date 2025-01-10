<?php
$q = $_GET['q'];
if ($q == 'enrol') {
  if (isset($_SESSION['IDNO'])) {

    $student = new Student();
    $stud = $student->single_student($_SESSION['IDNO']);


    if ($stud->NewEnrollees == 1) {
      # code...
      // message("You cannot enrol now. For more information, please contact administrator.","error");
      redirect('index.php?q=profile');
    } else {

      if ($stud->student_status == 'Regular') {
        # code...
        redirect('index.php?q=subject');

      } elseif ($stud->student_status == 'Irregular') {

        // redirect("index.php?q=subjectlist");
        redirect("index.php?q=cart");

      } else {
        redirect('index.php?q=profile');
      }

    }


  } else {
    ?>
    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a href="#New" data-toggle="tab">New</a></li>

      <li><a href="#Transferees" data-toggle="tab">Transferees</a></li>
    </ul>
    <div class="tab-content"><br />
      <div class="tab-pane active" id="New">

        <?php include "regform.php"; ?>

      </div><!--/tab-pane-->


      <div class="tab-pane" id="Transferees"><br />
        <?php include "registrationform.php"; ?>
      </div><!--/tab-pane-->

    </div><!--/tab-content-->
    <?php
  }
} else {
  include 'coursesubject.php';
}
?>