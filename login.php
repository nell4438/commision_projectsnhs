 <?php
require_once ("include/initialize.php"); 
require_once('auth.php');
require_once('db-connect.php');
if(isset($_POST['sidebarLogin'])){
  $email = trim($_POST['email']);
  $upass  = trim($_POST['password']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Email and Password!", "error");
      redirect(web_root."index.php");
         
    } else {   
        $stud = new Student();
        $studres = $stud->studAuthentication($email,$h_upass);

        if ($studres==true){
          
          $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
          VALUES (".$_SESSION['IDNO'].",'".date('Y-m-d H:i:s')."','Student','Logged in')";
          $mydb->setQuery($sql);
          $mydb->executeQuery();
          message("You have login successfully.", "success");
           redirect(web_root."index.php?q=profile");
        }else{
            message("Invalid Email and Password! Please contact administrator", "error");
             redirect(web_root."index.php");
        }
 
 }
}

// if(isset($_POST['oldLogin'])){
//   $email = trim($_POST['email']);
//   $upass  = trim($_POST['password']);
//   $h_upass = sha1($upass);
  
//    if ($email == '' OR $upass == '') {

//       message("Invalid Email and Password!", "error");
//       redirect(web_root."index.php");
         
//     } else {   
//         $stud = new Student();
//         $studres = $stud->studAuthentication($email,$h_upass);

//         if ($studres==true){
          
//           $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
//           VALUES (".$_SESSION['IDNO'].",'".date('Y-M-d h:i:s')."','Student','Logged in')";
//           mysql_query($sql) or die(mysql_error());

//            redirect(web_root."index.php?q=profile");
//         }else{
//              message("Invalid Email and Password! Please contact administrator", "error");
//              redirect(web_root."index.php?q=enrol");
//         }
 
//  }
// }


//  if(isset($_POST['modalLogin'])){
//   $email = trim($_POST['email']);
//   $upass  = trim($_POST['password']);
//   $h_upass = sha1($upass);
  
//    if ($email == '' OR $upass == '') { 
//       message("Invalid Email and Password!", "error");
//        redirect(web_root."index.php?q=profile");
         
//     } else {   
//         $stud = new Student();
//         $studres = $stud::studAuthentication($email,$h_upass);

//         if ($studres==true){
//            redirect(web_root."index.php?q=orderdetails");
//         }else{
//              message("Invalid Email and Password! Please contact administrator ", "error");
//              redirect(web_root."index.php");
//         }
 
//  }
//  }

//  if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     extract($_POST);
//     $stmt = $conn->prepare("SELECT * FROM `tblstudent` where `email` = ?");
//     $stmt->bind_param('s', $email);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if($result->num_rows > 0){
//         $data = $result->fetch_assoc();
//         if(password_verify($password, $data['password'])){
//             foreach($data as $k => $v){
//                 if($k != 'password'){
//                     $_SESSION[$k] = $v;
//                 }
//             }
//             //message("Invalid Email and Password!", "error");
//             //redirect(web_root."index.php?q=profile");
//             $_SESSION['msg']['success'] = "You have login successfully.";
//             redirect(web_root."index.php?q=profile");
//             exit;
//         }else{
//             message("Invalid Email and Password! Please contact administrator", "error");
//              redirect(web_root."index.php");
//              //$error = "Incorrect Email or Password";
//         }
//     }else{
//          message("Invalid Email and Password! Please contact administrator", "error");
//              redirect(web_root."index.php");
//              //$error = "Incorrect Email or Password";
//     }
// }
 
 ?> 
 

 