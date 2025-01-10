<?php

if (!isset($_GET['IDNO'])) {
   redirect("index.php");
}
$sem = new Semester();
$resSem = $sem->single_semester();
$_SESSION['SEMESTER'] = $resSem->SEMESTER; 

$currentyear = date('Y');
$nextyear =  date('Y') + 1;
$sy = $currentyear .'-'.$nextyear;
$_SESSION['SY'] = $sy;

     $student = New Student(); 
     $studres = $student->single_student($_GET['IDNO'])
     
?>
<form action="index.php?q=payment" method="POST">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container">
 <!-- Main content -->
 <?php   //check_message();  ?> 
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            <i class="fa fa-user"></i> Student Information
            <small class="pull-right">Date: <?php echo date('m/d/Y'); ?></small>
          </h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-8 invoice-col"> 
          <address>
            <b>Name : <?php echo $studres->LNAME  . ', ' . $studres->FNAME  .' ' . $studres->MNAME  ;?></b><br>
            Address : <?php echo  $studres->HOME_ADD  ;?><br> 
            Contact No.: <?php echo  $studres->CONTACT_NO  ;?><br>
            
          </address>
        </div>
    
        <div class="col-sm-4 invoice-col">
          <b>Strand / Year Level:  <?php 
            $course = New Course();
            $singlecourse = $course->single_course($studres->COURSE_ID ); 

            echo $_SESSION['COURSE_YEAR'] = $studres->YEARLEVEL.'-'.$studres->STRAND;
           
            ?></b><br>
          <b>Academic Year : <?php echo $_SESSION['SY']; ?></b>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->