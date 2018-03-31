<?php
include_once('include_fns.php');
include_once('header.php');
$con = db_connect();
?>

<!-- banner -->


<!-- -------------------------------mainpart------------------------------ -->
<br><br>
<div class="container">
  <div class="section">                                  
<div class="row">
        <div class="col s12 m2">
          <div class="icon-block"></div>
        </div>

        <div class="col s12 m8">
          <div class="icon-block">
              <center><h5>Sign up</h5></center>
<form action="registform.php" method="post" enctype="multipart/form-data" name="reform">
                                                <div class="input-field">
                                                  <input type="text" name="username" class="validate" required />
                                                  <label for="username">Username</label>

                                                </div>
                                                <div class="input-field">
                                                  <input type="text" name="fullname" class="validate" required />
                                                  <label for="fullname">Full name</label>

                                                </div>
                                                <div class="input-field">
                                                  <input type="email" name="email" class="validate" required />
                                                  <label for="email">Email</label>

                                                </div>

                                                <div class="input-field">
                                                  <input type="password" name="password" class="validate" required />
                                                  <label for="password">Password</label>
                                                </div>
                                        
                                                <div class="input-field">
                                                    <input type="password" name="cpassword" onchange="checkpwd()" required />
                                                    <label for="cpassword">Confirm Password</label>
                                                </div>
    <div class="file-field input-field">
      <div class="btn waves-effect waves-light red darken-2">
        <span>picture</span>
        <input  type="file" name="file" id="file">
      </div>
      <div class="file-path-wrapper">
        <input placeholder="Please upload less than 500 kb. It is better with 1:1." class="file-path validate" type="text">
      </div>
    </div>
  <center><button type="submit" name="post" class="btn waves-effect waves-light red darken-2"/>Submit</button> </center>
</form> 
<center>Already have an account? <a href="index.php">Log in here.</a></center>          
</div>
        </div>

        <div class="col s12 m2">
          <div class="icon-block"></div>
        </div>
      </div>
                                        
                                            
                                      
  </div>
</div>
<!-- -------------------------------mainpart------------------------------ -->
<!-- footer -->
<script src="../js/checkpw.js"></script>
<?php
include 'footer.php';
?>