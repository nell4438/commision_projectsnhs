<?php
require_once ("../include/initialize.php");

?>
<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "projectsnhs";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
<?php
if (isset($_SESSION['ACCOUNT_ID'])) {
  redirect(web_root . "admin/index.php");
}
?>
<?php
$maleCount = $conn->query("SELECT COUNT(*) FROM tblstudent WHERE SEX = 'Male'")->fetchColumn();
$femaleCount = $conn->query("SELECT COUNT(*) FROM tblstudent WHERE SEX = 'Female'")->fetchColumn();

try {
  $stmt = $conn->query("SELECT STRAND, YEARLEVEL, COUNT(*) as StudentCount FROM tblstudent GROUP BY STRAND, YEARLEVEL ORDER BY STRAND, YEARLEVEL");
  $strandYearData = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // Handle the error
  echo "Database error: " . $e->getMessage();
}

$strandYearLabels = [];
$populationData = [];

foreach ($strandYearData as $row) {
  $strandYearLabels[] = $row['STRAND'] . ' - ' . $row['YEARLEVEL'];
  $populationData[] = $row['StudentCount'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SNHS | Admin Login</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo web_root; ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/jquery.dataTables.css">
  <link href="<?php echo web_root; ?>css/bootstrap.css" rel="stylesheet" media="screen">

  <link href="<?php echo web_root; ?>fonts/font-awesome.min.css" rel="stylesheet" media="screen">
  <!-- Plugins -->
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/jquery.dataTables.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/fixnmix.js"></script> / -->

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    @CHARSET "UTF-8";
    /*
over-ride "Weak" message, show font in dark grey
*/

    .progress-bar {
      color: #333;
    }

    /*
Reference:
http://www.bootstrapzen.com/item/135/simple-login-form-logo/
*/

    * {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      outline: none;
    }

    .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      @include box-sizing(border-box);

      &:focus {
        z-index: 2;
      }
    }

    body {
      background: url(../img/banner1.jpeg) repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    .login-form {
      margin-top: 60px;
    }

    form[role=login] {
      color: #0f0707;
      background: #FFF1E6;
      padding: 26px;
      border-radius: 10px;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
    }

    form[role=login] img {
      display: block;
      margin: 0 auto;
      margin-bottom: 35px;
      height: 100px;
    }

    form[role=login] input,
    form[role=login] button {
      font-size: 15px;
      margin: 16px 0;
    }

    form[role=login]>div {
      text-align: center;
    }

    .form-links {
      text-align: center;
      margin-top: 1em;
      margin-bottom: 50px;
    }

    .form-links a {
      color: #fff;
    }
  </style>
</head>

<body>


  <div class="container">
    <div class="row" id="pwd-container">
      <div class="col-md-4">
        <section class="login-form"> <? echo check_message(); ?>;
          <form method="post" action="" role="login">
            <img src="../img/logosnhs.png" height="25px" class="img-responsive" alt="" />
            <input type="input" name="user_email" id="user_email" placeholder="Email Address" required
              class="form-control input-lg" value="" />
            <input type="password" name="user_pass" class="form-control input-lg" id="user_pass" placeholder="Password"
              required />
            <input type="checkbox" onclick="myFunction()"> Show Password
            <div class="pwstrength_viewport_progress"></div>
            <button type="submit" name="btnLogin" class="btn btn-lg btn-primary btn-block">Sign in</button>
            <div>
              <a href="forgot-password.php">Forgot Password?</a>
            </div>
          </form>
        </section>
      </div>
      <!-- Pie Chart Column -->
      <div class="col-md-4">
        <canvas id="pieChart" width="400" height="400"></canvas>
      </div>
      <!-- Bar Chart Column -->
      <div class="col-md-4">
        <canvas id="barChart" width="400" height="400"></canvas>
      </div>
    </div>
    <script type="text/javascript">
      function myFunction() {
        var show = document.getElementById('user_pass');
        if (show.type == 'password') {
          show.type = 'text';
        }
        else {
          show.type = 'password';
        }
      }
      // Pie Chart for Gender Data
      var ctxPie = document.getElementById('pieChart').getContext('2d');
      var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
          labels: ['Male', 'Female'],
          datasets: [{
            label: 'Gender Distribution',
            data: [<?php echo $maleCount; ?>, <?php echo $femaleCount; ?>],
            backgroundColor: [
              'rgba(54, 162, 235, 0.6)',
              'rgba(255, 99, 132, 0.6)'
            ]
          }]
        }
      });

      // Bar Chart for Population Data
      var ctxBar = document.getElementById('barChart').getContext('2d');
      var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($strandYearLabels); ?>,
          datasets: [{
            label: 'Population',
            data: <?php echo json_encode($populationData); ?>,
            backgroundColor: [
              'rgba(255, 206, 86, 0.6)',
              'rgba(75, 192, 192, 0.6)',
              'rgba(153, 102, 255, 0.6)',
              'rgba(255, 159, 64, 0.6)'
            ]
          }]
        }
      });
    </script>



  </div>

</body>

<?php

if (isset($_POST['btnLogin'])) {
  $user_email = trim($_POST['user_email']);
  $user_pass = trim($_POST['user_pass']);
  $h_upass = sha1($user_pass);

  if ($user_email == '' or $user_pass == '') {

    message("Invalid Email and Password!", "error");
    redirect("login.php");

  } else {
    //it creates a new objects of member
    $user = new User();
    //make use of the static function, and we passed to parameters
    $res = $user::userAuthentication($user_email, $h_upass);
    if ($res == true) {
      message("Welcome " . $_SESSION['ACCOUNT_TYPE'] . ".", "success");

      $sql = "INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
          VALUES (" . $_SESSION['ACCOUNT_ID'] . ",'" . date('Y-m-d H:i:s') . "','" . $_SESSION['ACCOUNT_TYPE'] . "','Logged in')";
      $mydb->setQuery($sql);
      $mydb->executeQuery();

      if ($_SESSION['ACCOUNT_TYPE'] == 'Administrator') {
        redirect(web_root . "admin/index.php");
      } elseif ($_SESSION['ACCOUNT_TYPE'] == 'Registrar') {
        redirect(web_root . "admin/index.php");

      } else {
        redirect(web_root . "admin/login.php");
      }
    } else {
      //message("Account does not exist! Please contact Administrator. bbbbb", "error");
      message("You have login successfully.", "success");
      redirect(web_root . "admin/login.php");
    }
  }
}

require_once ('auth.php');
require_once ('db-connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  extract($_POST);
  $stmt = $conn->prepare("SELECT * FROM `useraccounts` where `user_email` = ?");
  $stmt->bind_param('s', $user_email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    if (password_verify($user_pass, $data['user_pass'])) {
      foreach ($data as $k => $v) {
        if ($k != 'user_pass') {
          $_SESSION[$k] = $v;
        }
      }
      $_SESSION['msg']['success'] = "You have login successfully.";
      header('location: ./');
      exit;
    } else {
      $error = "Incorrect Email or Password";
    }
  } else {
    $error = "Incorrect Email or Password";
  }
}
?>

</html>