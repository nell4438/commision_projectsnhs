<?php
require_once "../include/initialize.php";

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        doInsert();
        break;

    case 'edit':
        doEdit();
        break;
    case 'editNewEnrollees':
        doEditNewEnrollees();
        break;
    case 'delete':
        doDelete();
        break;
    case 'photos':
        doupdateimage();
        break;

    case 'photofile':
        doupdateimages();
        break;

}

function doInsert()
{
    if (isset($_POST['submit'])) {

        @$errofile = $_FILES['image']['error'];
        @$type = $_FILES['image']['type'];
        @$temp = $_FILES['image']['tmp_name'];
        @$myfile = $_FILES['image']['name'];
        @$location = "customer_image/" . $myfile;

        @$file = $_FILES['image']['tmp_name'];
        @$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        @$image_name = addslashes($_FILES['image']['name']);
        @$image_size = true; //getimagesize($_FILES['image']['tmp_name']);

        if (@$_FILES["image"]["size"] > 5000000000) { //> 5000000) {
            message("Your file is too large. The file cannot be uploaded. You can set or upload a file in your profile", "error");
            // $uploadOk = 0;
            // }elseif ($image_size==FALSE ) {
            //     message("Uploaded file is invalid", "error");
            // redirect(web_root."index.php?page=6");
        } else {
            //uploading the file
            move_uploaded_file($temp, "customer_image/" . $myfile);
        }
        $customer = new Customer();
        // $customer->CUSTOMERID         = $_POST['CUSTOMERID'];
        $customer->FNAME = $_POST['FNAME'];
        $customer->LNAME = $_POST['LNAME'];
        // $customer->MNAME             = $_POST['MNAME'];
        $customer->CUSHOMENUM = $_POST['CUSHOMENUM'];
        $customer->STREETADD = $_POST['STREETADD'];
        $customer->BRGYADD = $_POST['BRGYADD'];
        $customer->CITYADD = $_POST['CITYADD'];
        $customer->PROVINCE = $_POST['PROVINCE'];
        $customer->COUNTRY = $_POST['COUNTRY'];
        $customer->GENDER = $_POST['GENDER'];
        $customer->PHONE = $_POST['PHONE'];
        $customer->ZIPCODE = $_POST['ZIPCODE'];
        $customer->CUSPHOTO = $location;
        $customer->CUSUNAME = $_POST['CUSUNAME'];
        $customer->CUSPASS = sha1($_POST['CUSPASS']);
        $customer->DATEJOIN = date('Y-m-d h-i-s');
        $customer->TERMS = 1;
        $customer->create();

        $email = trim($_POST['CUSUNAME']);
        $h_upass = sha1(trim($_POST['CUSPASS']));

        //it creates a new objects of member
        $user = new Customer();
        //make use of the static function, and we passed to parameters
        $res = $user::cusAuthentication($email, $h_upass);

        //             if(isset($_POST['savecustomer'])){
        echo "<script> alert('You are now successfully registered. '); </script>";
        redirect(web_root . "index.php?q=orderdetails");
        //             }else{
        // redirect(web_root."index.php?q=profile");

        // echo  "<script> alert('" .$_POST['FNAME']."'); </script>";

        //             }

    }
}

function doEditNewEnrollees()
{
    if (isset($_POST['save'])) {

        $age = date_diff(date_create($_POST['BIRTHDATE']), date_create('today'))->y;

        if ($age < 10) {
            message("Invalid age. 10 years old and above is allowed.", "error");
            redirect(web_root . 'index.php?q=profile');

        } else {
            $stud = new Student();
            $stud->FNAME = $_POST['FNAME'];
            $stud->LNAME = $_POST['LNAME'];
            $stud->MNAME = $_POST['MI'];
            $stud->SEX = $_POST['optionsRadios'];
            $stud->BDAY = date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');
            $stud->BPLACE = $_POST['BIRTHPLACE'];
            $stud->STATUS = $_POST['CIVILSTATUS'];
            $stud->NATIONALITY = $_POST['NATIONALITY'];
            $stud->RELIGION = $_POST['RELIGION'];
            $stud->CONTACT_NO = $_POST['CONTACT'];
            $stud->HOME_ADD = $_POST['PADDRESS'];
            $stud->email = $_POST['USER_NAME'];
            $stud->YEARLEVEL = $_POST['YEARLEVEL'];
            $stud->SEMESTER = $_POST['newsemester'] != $_POST['oldsemester'] ? $_POST['newsemester'] : $_POST['oldsemester'];
            $stud->NewEnrollees = $_POST['oldYearLevel'] != $_POST['YEARLEVEL'] ? 1 : 0;
            $stud->update($_SESSION['IDNO']);

            $studetails = new StudentDetails();
            $studetails->GUARDIAN = $_POST['GUARDIAN'];
            $studetails->GCONTACT = $_POST['GCONTACT'];
            $studetails->update($_SESSION['IDNO']);

            message("Accounts has been updated!", "success");
            redirect(web_root . 'index.php?q=profile');
        }

    }
}

function doEdit()
{
    if (isset($_POST['save'])) {

        $age = date_diff(date_create($_POST['BIRTHDATE']), date_create('today'))->y;

        if ($age < 10) {
            message("Invalid age. 10 years old and above is allowed.", "error");
            redirect(web_root . 'index.php?q=profile');

        } else {
            $stud = new Student();
            $stud->FNAME = $_POST['FNAME'];
            $stud->LNAME = $_POST['LNAME'];
            $stud->MNAME = $_POST['MI'];
            $stud->SEX = $_POST['optionsRadios'];
            $stud->BDAY = date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');
            $stud->BPLACE = $_POST['BIRTHPLACE'];
            $stud->STATUS = $_POST['CIVILSTATUS'];
            $stud->NATIONALITY = $_POST['NATIONALITY'];
            $stud->RELIGION = $_POST['RELIGION'];
            $stud->CONTACT_NO = $_POST['CONTACT'];
            $stud->HOME_ADD = $_POST['PADDRESS'];
            $stud->email = $_POST['USER_NAME'];
            // $stud->YEARLEVEL       = $_POST['YEARLEVEL'];
            $stud->update($_SESSION['IDNO']);

            $studetails = new StudentDetails();
            $studetails->GUARDIAN = $_POST['GUARDIAN'];
            $studetails->GCONTACT = $_POST['GCONTACT'];
            $studetails->update($_SESSION['IDNO']);

            message("Accounts has been updated!", "success");
            redirect(web_root . 'index.php?q=profile');
        }

    }
}


function doDelete()
{

    if (isset($_SESSION['U_ROLE']) == 'Customer') {

        if (isset($_POST['selector']) == '') {
            message("Select the records first before you delete!", "error");
            redirect(web_root . 'index.php?page=9');
        } else {

            $id = $_POST['selector'];
            $key = count($id);

            for ($i = 0; $i < $key; $i++) {

                $order = new Order();
                $order->delete($id[$i]);

                message("Order has been Deleted!", "info");
                redirect(web_root . "index.php?q='product'");

            }

        }
    } else {

        if (isset($_POST['selector']) == '') {
            message("Select the records first before you delete!", "error");
            redirect('index.php');
        } else {

            $id = $_POST['selector'];
            $key = count($id);

            for ($i = 0; $i < $key; $i++) {

                $customer = new Customer();
                $customer->delete($id[$i]);

                $user = new User();
                $user->delete($id[$i]);

                message("Customer has been Deleted!", "info");
                redirect('index.php');

            }
        }

    }

}

function doupdateimage()
{

    $errofile = $_FILES['photo']['error'];
    $type = $_FILES['photo']['type'];
    $temp = $_FILES['photo']['tmp_name'];
    $myfile = $_FILES['photo']['name'];
    $location = "student_image/" . $myfile;

    if ($errofile > 0) {
        message("No File Selected!", "error");
        redirect(web_root . "index.php?q=profile");
    } else {

        @$file = $_FILES['photo']['tmp_name'];
        @$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
        @$image_name = addslashes($_FILES['photo']['name']);
        @$image_size = true; //getimagesize($_FILES['photo']['tmp_name']);

        if ($image_size == false) {
            message(web_root . "Uploaded file is invalid!", "error");
            redirect(web_root . "index.php?q=profile");
        } else {
            //uploading the file
            move_uploaded_file($temp, "student_image/" . $myfile);

            $stud = new Student();
            $stud->STUDPHOTO = $location;
            $stud->update($_SESSION['IDNO']);

            redirect(web_root . "index.php?q=profile");

        }
    }

}

function doupdateimages()
{
    $filesToUpload = ['nso', 'gm', 'sf9', 'sf10', 'clearance'];
    $uploadDirectory = "student_file/";

    foreach ($filesToUpload as $fileKey) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
            $fileName = uniqid() . '-' . $_FILES[$fileKey]['name'];
            $destinationPath = $uploadDirectory . $fileName;

            if (move_uploaded_file($fileTmpPath, $destinationPath)) {

                $stud = new Student();

                $success = $stud->setFile($fileKey, $destinationPath);

                if (!$success) {

                    echo "Error updating the database for $fileKey";
                }
            } else {
                echo "There was an error moving the uploaded file: $fileKey";
            }
        } elseif (isset($_FILES[$fileKey])) {
            echo "Error uploading $fileKey: " . $_FILES[$fileKey]['error'];
        }
    }

    redirect(web_root . "index.php?q=profile");

    // $errofile = $_FILES['photos']['error'];
    // $type     = $_FILES['photos']['type'];
    // $temp     = $_FILES['photos']['tmp_name'];
    // $myfile   = $_FILES['photos']['name'];
    // $location = "student_file/" . $myfile;

    // if ($errofile > 0) {
    //     message("No File Selected!", "error");
    //     redirect(web_root . "index.php?q=profile");
    // } else {

    //     @$file       = $_FILES['photos']['tmp_name'];
    //     @$image      = addslashes(file_get_contents($_FILES['photos']['tmp_name']));
    //     @$image_name = addslashes($_FILES['photos']['name']);
    //     @$image_size = true; //getimagesize($_FILES['photos']['tmp_name']);

    //     if ($image_size == false) {
    //         message(web_root . "Uploaded file is invalid", "error");
    //         redirect(web_root . "index.php?q=profile");
    //     } else {
    //         //uploading the file
    //         move_uploaded_file($temp, "student_file/" . $myfile);

    //         $stud           = new Student();
    //         $stud->STUDFILE = $location;
    //         $stud->update($_SESSION['IDNO']);

    //         redirect(web_root . "index.php?q=profile");

    //     }
    // }

}

/*
function dovalidate(){

if (isset($_GET['id'])) {

$query ="SELECT * FROM `studentsubjects` ss, `tblschedule` s
WHERE ss.`SUBJ_ID`=s.`SUBJ_ID` AND IDNO=".$_SESSION['IDNO']." AND SEMESTER='".$_SESSION['SEMESTER']."'
AND `TIME_FROM` >=  '".$_GET['TIME_FROM']."'
AND  `TIME_TO` <=  '".$_GET['TIME_TO']."'
AND  `TIME_FROM` <=  `TIME_TO` AND sched_day='".$_GET['sched_day']."'";
// AND sched_room ='" .$_GET['sched_room'] . "'";
$result = mysql_query($query) or die(mysql_errno());

$numrow = mysql_num_rows($result);

if ($numrow > 0) {
# code...
message("The subject that you added is conflict to your schedule","error");
redirect(web_root.'index.php?q=profile');
}else{

$subject = New Subject();
$subj = $subject->single_subject($_GET['id']);

$sql = "SELECT * FROM `grades` g, `subject` s WHERE g.`SUBJ_ID`=s.`SUBJ_ID` AND `SUBJ_CODE`='" .$subj->PRE_REQUISITE. "' AND AVE < 75 AND IDNO=". $_SESSION['IDNO'];
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);

if (isset($row['SUBJ_CODE'])) {
?>
<script type="text/javascript">
alert('You must take the pre-requisite first before taking up this subject.')
window.location = "../index.php?q=profile";
</script>
<?php
}else{

$sql = "SELECT * FROM `grades`  WHERE REMARKS !='Drop' AND `SUBJ_ID`='" .$_GET['id']. "'   AND IDNO=". $_SESSION['IDNO'];
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_assoc($result);

if (isset($row['SUBJ_ID'])) {
# code...
if ($row['AVE'] > 0 && $row['AVE'] < 75 ) {
# code...
?>
<script type="text/javascript">
alert('This subject is under taken.')
window.location = "../index.php?q=profile";
</script>
<?php
}elseif ($row['AVE']==0) {
# code...
?>
<script type="text/javascript">
alert('This subject is under taken.')
window.location = "../index.php?q=profile";
</script>
<?php
}elseif ($row['AVE'] > 74) {
# code...

?>
<script type="text/javascript">
alert('You have already taken this subject.')
window.location = "../index.php?q=profile";
</script>
<?php
}
}else{
$grade = New Grade();
$grade->IDNO = $_SESSION['IDNO'];
$grade->SUBJ_ID     = $_GET['id'];
$grade->create();

$studsub = new StudentSubjects();
$studsub->IDNO = $_SESSION['IDNO'];
$studsub->LEVEL = $_GET['level'];
$studsub->SEMESTER = $_SESSION['SEMESTER'];
$studsub->SUBJ_ID     = $_GET['id'];
$studsub->create();

message("Subject has been added","success");
redirect(web_root."index.php?q=profile");
}
}
}
}
// end  function body

}
function dodrop(){

$grade = New Grade();
$grade->REMARKS     = 'Drop';
$grade->update($_GET['gid']);

$sql = "DELETE FROM studentsubjects WHERE IDNO=" . $_SESSION['IDNO']. " AND SUBJ_ID=".$_GET['id'] ;
mysql_query($sql) or die(mysql_error());

message("Subject has been dropped","success");
redirect(web_root."index.php?q=profile");

}
 */
