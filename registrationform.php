 <!-- `IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, `STATUS`, `AGE`, `NATIONALITY`,
 `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `EMAIL`, `password`, `student_status`, `schedID`, `course_year` -->
 <?php
 require_once('db-connect.php');
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require 'PHPMailer/src/Exception.php';
 require 'PHPMailer/src/PHPMailer.php';
 require 'PHPMailer/src/SMTP.php';
 
 function sendUploadReminder($emailReceiver)
{
	$mail = new PHPMailer(true);
	try {
		// Server settings
		$adminEmail = 'addatujhasper0@gmail.com';
		$adminEmailPassword = 'aifoczdjbmylcsoo';
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = $adminEmail; //your gmail
		$mail->Password = $adminEmailPassword; ///your gmail app password - remove spaces
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
		$mail->Port = 587; // TCP port to connect to

		// Recipients
		$mail->setFrom('info@yourschool.com'); //your gmail
		$mail->addAddress($emailReceiver); //recipient email

		// Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Credentials Reminder for Enrollment';
		$mail->Body = 'Dear student, <br><br> Please remember to upload all your Credentials. This is a necessary document for your enrollment.<br><br>This is a system-generated email. Please do not reply.';

		$mail->send();
		echo 'Reminder has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}
 
if (isset($_POST['regsubmit'])) {

	$_SESSION['STUDID'] 	  =  $_POST['IDNO'];
	$_SESSION['FNAME'] 	      =  $_POST['FNAME'];
	$_SESSION['LNAME']  	  =  $_POST['LNAME'];
	$_SESSION['MI']           =  $_POST['MI'];
	$_SESSION['PADDRESS']     =  $_POST['PADDRESS'];
	$_SESSION['SEX']          =  $_POST['optionsRadios'];
	$_SESSION['BIRTHDATE']    = date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');
	$_SESSION['NATIONALITY']  =  $_POST['NATIONALITY'];
	$_SESSION['BIRTHPLACE']   =  $_POST['BIRTHPLACE'];
	$_SESSION['RELIGION']     =  $_POST['RELIGION'];
	$_SESSION['CONTACT']      =  $_POST['CONTACT'];
	$_SESSION['CIVILSTATUS']  =  $_POST['CIVILSTATUS'];
	$_SESSION['YEARLEVEL']  =  $_POST['YEARLEVEL'];
	$_SESSION['GUARDIAN']     =  $_POST['GUARDIAN'];
	$_SESSION['GCONTACT']     =  $_POST['GCONTACT'];
	$_SESSION['COURSEID'] 	  =  $_POST['COURSE'];
	$_SESSION['STRAND'] 	  =  $_POST['STRAND'];
	// $_SESSION['SEMESTER']     =  $_POST['SEMESTER'];  
	$_SESSION['USER_NAME']    =  $_POST['USER_NAME'];
	$_SESSION['PASS']    	  =  $_POST['PASS'];


	$student = new Student();
	$res = $student->find_all_student($_POST['LNAME'], $_POST['FNAME'], $_POST['MI']);

	if ($res) {
		# code...
		message("Student already exist.", "error");
		redirect(web_root . "index.php?q=enrol");
	} else {

		$sql = "SELECT * FROM tblstudent WHERE email='" . $_SESSION['USER_NAME'] . "'";
		$userresult = mysqli_query($mydb->conn, $sql) or die(mysqli_error($mydb->conn));
		$userStud  = mysqli_fetch_assoc($userresult);

		if ($userStud) {
			message("Email is already taken.", "error");
			redirect(web_root . "index.php?q=enrol");
		} else {
			if ($_SESSION['COURSEID'] == 'Select' || $_SESSION['SEMESTER'] == 'Select') {
				message("Select Year Level and Strand exactly" . "error");
				redirect("index.php?q=enrol");
			} else {

				$age = date_diff(date_create($_SESSION['BIRTHDATE']), date_create('today'))->y;

				if ($age < 10) {
					message("Cannot Proceed. Must be 10 years old and above to enroll.", "error");
					redirect("index.php?q=enrol");
				} else {
					$student = new Student();
					$student->IDNO 			= $_SESSION['STUDID'];
					$student->FNAME 		= $_SESSION['FNAME'];
					$student->LNAME 		= $_SESSION['LNAME'];
					$student->MNAME 		= $_SESSION['MI'];
					$student->SEX 			= $_SESSION['SEX'];
					$student->BDAY 			= $_SESSION['BIRTHDATE'];
					$student->BPLACE 		= $_SESSION['BIRTHPLACE'];
					$student->STATUS 		= $_SESSION['CIVILSTATUS'];
					$student->YEARLEVEL   	= $_SESSION['YEARLEVEL'];
					$student->STRAND   	= $_SESSION['STRAND'];
					$student->NATIONALITY 	= $_SESSION['NATIONALITY'];
					$student->RELIGION 		= $_SESSION['RELIGION'];
					$student->CONTACT_NO	= $_SESSION['CONTACT'];
					$student->HOME_ADD 		= $_SESSION['PADDRESS'];
					$student->email	= $_SESSION['USER_NAME'];
					$student->password 	= sha1($_SESSION['PASS']);
					$student->COURSE_ID   	= $_SESSION['COURSEID'];
					$student->SEMESTER   	= $_SESSION['SEMESTER'];
					$student->student_status = 'New';
					$student->NewEnrollees  = 1;
					$student->create();

					$studentdetails = new StudentDetails();
					$studentdetails->IDNO = $_SESSION['STUDID'];
					$studentdetails->GUARDIAN = $_SESSION['GUARDIAN'];
					$studentdetails->GCONTACT = $_SESSION['GCONTACT'];
					$studentdetails->create();

					$studAuto = new Autonumber();
					$studAuto->studauto_update();

					@$_SESSION['IDNO'] = $_SESSION['STUDID'];
					
					$sql = "SELECT STUDFILE FROM tblstudent WHERE IDNO = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("s", $_SESSION['STUDID']);
					$stmt->execute();
					$stmt->bind_result($studfile);
					$stmt->fetch();
					$stmt->close();

					if (empty($studfile)) {
						// STUDFILE is null, so send the reminder email
						sendUploadReminder($_POST['USER_NAME']);
					} 
					// else {
					// 	echo '<script>alert("' . $studfile . '");</script>';
					// }

					redirect("index.php?q=profile");
				}
			}
		}
	}
}


	$currentyear = date('Y');
	$nextyear =  date('Y') + 1;
	$sy = $currentyear .'-'.$nextyear;
	$_SESSION['SY'] = $sy; 


	$studAuto = New Autonumber();
	$autonum = $studAuto->stud_autonumber();
?>
<?php
	// $currentyear = date('Y');
	// $nextyear =  date('Y') + 1;
	// $sy = $currentyear .'-'.$nextyear;
	// $_SESSION['SY'] = $sy;
	// // $newDate    = Carbon::createFromFormat('Y-m-d',$_SESSION['SY'] )->addYear(1);


	// $studAuto = New Autonumber();
	// $autonum = $studAuto->stud_autonumber();
?>

<form action="" class="form-horizontal well" method="post" >
<!-- <form action="index.php?q=subject" class="form-horizontal well" method="post" > -->
	<div class="table-responsive">
	<div class="col-md-8"><h2>Registration Form</h2></div>
	<div class="col-md-4"><label>Academic Year: <?php echo $_SESSION['SY'] ; ?></label></div>
		<table class="table">
			<tr>
				<td><label>Id</label></td>
				<td >
					<input class="form-control input-md" readonly id="IDNO" name="IDNO" placeholder="Student Id" type="text" value="<?php echo isset($_SESSION['STUDID']) ? $_SESSION['STUDID'] : $autonum->AUTO; ?>">
				</td>
				<td colspan="4"></td>

			</tr>
			<tr>
				<td><label>Firstname</label></td>
				<td>
					<input required="true"   class="form-control input-md" id="FNAME" name="FNAME" placeholder="First Name" type="text" value="<?php echo isset($_SESSION['FNAME']) ? $_SESSION['FNAME'] : ''; ?>">
 				</td>
				<td><label>Lastname</label></td>
				<td colspan="2">
					<input required="true"  class="form-control input-md" id="LNAME" name="LNAME" placeholder="Last Name" type="text" value="<?php echo isset($_SESSION['LNAME']) ? $_SESSION['LNAME'] : ''; ?>">
				</td> 
				<td>
					<input class="form-control input-md" id="MI" name="MI" placeholder="MI"  maxlength="1" type="text" value="<?php echo isset($_SESSION['MI']) ? $_SESSION['MI'] : ''; ?>">
				</td>
			</tr>
			<tr>
				<td><label>Address</label></td>
				<td colspan="5"  >
				<input required="true"  class="form-control input-md" id="PADDRESS" name="PADDRESS" placeholder="Permanent Address" type="text" value="<?php echo isset($_SESSION['PADDRESS']) ? $_SESSION['PADDRESS'] : ''; ?>">
				</td> 
			</tr>
			<tr>
				<td ><label>Sex </label></td> 
				<td colspan="2">
					<label>
						<input checked id="optionsRadios1" name="optionsRadios" type="radio" value="Female">Female 
						 <input id="optionsRadios2" name="optionsRadios" type="radio" value="Male"> Male
					</label>
				</td>
				<td><label>Date of birth</label></td>
    <td colspan="5">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input required="true" name="BIRTHDATE" id="BIRTHDATE" type="date" class="form-control input-md" max="<?php echo date('Y-m-d'); ?>" value="<?php echo isset($_SESSION['BIRTHDATE']) ? $_SESSION['BIRTHDATE'] : ''; ?>">
        </div>
    </td>
				 
			</tr>
			<tr><td><label>Place of Birth</label></td>
				<td colspan="5">
				<input required="true"  class="form-control input-md" id="BIRTHPLACE" name="BIRTHPLACE" placeholder="Place of Birth" type="text" value="<?php echo isset($_SESSION['BIRTHPLACE']) ? $_SESSION['BIRTHPLACE'] : ''; ?>">
			   </td>
			</tr>
			<tr>
				<td><label>Nationality</label></td>
				<td colspan="2"><input required="true"  class="form-control input-md" id="NATIONALITY" name="NATIONALITY" placeholder="Nationality" type="text" value="<?php echo isset($_SESSION['CONTACT']) ? $_SESSION['CONTACT'] : ''; ?>">
							</td>
				<td><label>Religion</label></td>
				<td colspan="2"><input  required="true" class="form-control input-md" id="RELIGION" name="RELIGION" placeholder="Religion" type="text" value="<?php echo isset($_SESSION['RELIGION']) ? $_SESSION['RELIGION'] : ''; ?>">
				</td>
				
			</tr>
			<tr>
			<td><label>Contact No.</label></td>
    <td colspan="5">
	<input required="true" class="form-control input-md" id="GCONTACT" name="GCONTACT" placeholder="Contact Number" type="tel" maxlength="11" oninput="validateInput(this)" value="<?php echo isset($_SESSION['GCONTACT']) ? $_SESSION['GCONTACT'] : ''; ?>">

<script>
function validateInput(input) {
    var inputValue = input.value;

    // Check if the input contains any non-numeric characters
    if (/[^0-9]/.test(inputValue)) {
        alert("Only numbers are allowed in the contact number field.");
        // Remove any non-numeric characters from the input value
        input.value = inputValue.replace(/[^0-9]/g, '');
    }
}
</script>
    </td>
				
			</tr>
			<tr>
			<td><label>Year Level</label></td>
    <td colspan="2">
        <select class="form-control input-sm" name="YEARLEVEL" id="yearLevelSelect" onchange="showHideStrandField()">
            <?php
            for ($i = 7; $i <= 12; $i++) {
                echo '<option value="' .  $i . '">' .  $i . '</option>';
            }
			 echo isset($_SESSION['YEARLEVEL']) ? $_SESSION['YEARLEVEL'] : ''; 
            ?>
        </select>
    </td>
				
			 
				<td><label>Civil Status</label></td>
				<td colspan="2">
					<select class="form-control input-sm" name="CIVILSTATUS">
						 <option value="Single">Single</option>
						 <option value="Married">Married</option> 
						 <option value="Widow">Widow</option>
					</select>
				</td>
			</tr>
			<tr>
				<!-- Add Strand Field for Grade 11 and 12 -->
				<td id="strandFieldLabel" style="display:none;"><label>Strand</label></td>
    <td id="strandField" style="display:none;" colspan="2">
        <select class="form-control input-sm" name="STRAND">
            <option value="TBA">Select</option>
            <option value="ABM">ABM</option>	
            <option value="AGRI-FISHERY ARTS">AGRI-FISHERY ARTS</option>
            <option value="HOME ECONOMICS">HOME ECONOMICS</option>
            <option value="ICT">ICT</option>
            <option value="STEM">STEM</option>
            <option value="HUMSS">HUMSS</option>
        </select>
    </td>
	<script>
    function showHideStrandField() {
        var yearLevelSelect = document.getElementById('yearLevelSelect');
        var strandFieldLabel = document.getElementById('strandFieldLabel');
        var strandField = document.getElementById('strandField');

        // Reset strand field when changing year level
        strandField.value = 'Select';

        if (yearLevelSelect.value == "11" || yearLevelSelect.value == "12") {
            // Show strand field for Grade 11 and 12
            strandFieldLabel.style.display = 'table-cell';
            strandField.style.display = 'table-cell';
        } else {
            // Hide strand field for other year levels
            strandFieldLabel.style.display = 'none';
            strandField.style.display = 'none';
        }
    }
</script>
			</tr>
			<tr>
				<td><label>Email Address</label></td>
				<td colspan="2">
				  <input required="true"  class="form-control input-md" id="USER_NAME" name="USER_NAME" placeholder="Email Address" type="text"value="<?php echo isset($_SESSION['USER_NAME']) ? $_SESSION['USER_NAME'] : ''; ?>">
				</td>
				<td><label>Password</label></td>
				<td colspan="2">
						<input required="true"  class="form-control input-md" id="PASS" name="PASS" placeholder="Password" type="password"value="<?php echo isset($_SESSION['PASS']) ? $_SESSION['PASS'] : ''; ?>">
				</td>
			</tr>
			<tr>
				<td><label>Gaurdian</label></td>
				<td colspan="2">
					<input required="true"  class="form-control input-md" id="GUARDIAN" name="GUARDIAN" placeholder="Parents/Guardian Name" type="text"value="<?php echo isset($_SESSION['GUARDIAN']) ? $_SESSION['GUARDIAN'] : ''; ?>">
				</td>
				<td><label>Contact No.</label></td>
    <td colspan="5">
	<input required="true" class="form-control input-md" id="GCONTACT" name="GCONTACT" placeholder="Contact Number" type="tel" maxlength="11" oninput="validateInput(this)" value="<?php echo isset($_SESSION['GCONTACT']) ? $_SESSION['GCONTACT'] : ''; ?>">

<script>
function validateInput(input) {
    var inputValue = input.value;

    // Check if the input contains any non-numeric characters
    if (/[^0-9]/.test(inputValue)) {
        alert("Only numbers are allowed in the contact number field.");
        // Remove any non-numeric characters from the input value
        input.value = inputValue.replace(/[^0-9]/g, '');
    }
}
</script>

    </td>
			</tr>
			<tr>
			<td></td>
				<td colspan="5">	
					<button class="btn btn-success btn-lg" name="regsubmit" type="submit">Submit</button>
				</td>
			</tr>
		</table>
	</div>
</form>