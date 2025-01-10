

<!-- login -->
<?php 
if(!isset($_SESSION['IDNO'])){

?>
 <div class="panel panel-default">
    <div class="panel-body">
        <div class="well well-sm"  style="background-color:#097687;color:#fff;"><b >  Login Here </b> </div>

            <form class="form-horizontal span6" action="login.php" method="POST">
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "email">Email Address:</label> 
                          <input   id="email" name="email" placeholder="Email Address" type="text" value="<?= $_POST['email'] ?? "" ?>" class="form-control input" >  
                  </div> 
 
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "password">Password:</label> 
                     <input name="password" id="password" placeholder="Password" type="password" value="<?= $_POST['password'] ?? "" ?>" class="form-control input ">            
                  </div>
                  
                  <div class="col-md-12">
                  <label class="checkbox"></label>
                      <input type="checkbox" onclick="myFunction()"> Show Password          
                  </div> 

                  </div>
                  <div class="form-group">
                  <div class="col-md-12"> 
                    <button type="submit" id="sidebarLogin" name="sidebarLogin"  style="background-color:#097687;color:#fff;" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-logged-in "></span>   Login</button>                    
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12"> 
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                </div>


            </form>

            <script type="text/javascript">
          function myFunction(){
           var show = document.getElementById('password');
            if(show.type=='password') {
              show.type='text';
            }
            else{
              show.type='password';
            }
          }
        </script>

        </div> 
</div>
<?php } ?>
 