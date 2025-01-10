
<div class="row">
         <div class="col-lg-12">
            <h1 class="page-header">Welcome to the <?php echo $_SESSION['ACCOUNT_TYPE'] ?> Panel</h1>
          </div>
          <!-- /.col-lg-12 -->

 </div>
              <b> <?php
date_default_timezone_set('Asia/Manila');
$current_timezone = date_default_timezone_get();
echo date("F j, Y g:i a");
?>
                </b>



