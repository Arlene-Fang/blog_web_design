<?php
  include_once('include_fns.php');
  $con = db_connect();
?>
<?php
if(!check_auth_user()) {
  include_once('header.php');
}
else{
  include_once('loginheader.php');
}

?>
<!-- banner -->
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
       
       <!--  <h1 class="header center teal-text text-lighten-2">Parallax Template</h1> -->
        <div class="row center">
          <img class="responsive-img" src="images/c.png">
        </div>

      </div>
    </div>
    <div class="parallax"><img src="images/backgroundpic.jpg" alt="Unsplashed background img 1"></div>
  </div>


<!-- -------------------------------mainpart------------------------------ -->
<div class="container">
  <div class="section">
<?php
  if(!check_auth_user()) {
    ?>
      <div class="row">
          <div class="col s12 m2">
            <div class="icon-block"></div>
          </div>
          <div class="col s12 m8">
            <div class="icon-block">
                          <center><h5>Log In</h5></center>
                    <form method="post" action="loginform1.php">
                      <div class="input-field">
                        <input type="text" name="username" class="validate" required />
                        <label for="username">Username</label>
                      </div>
                      <div class="input-field">
                        <input type="password" name="password" class="validate" required />
                        <label for="password">Password</label>
                      </div>
                      <div class="input-field">
                    </div>
            
            <center><button name="comment" type="submit" class="hoverable btn btn-info red darken-2"><i class="material-icons right">send</i>&nbsp;Submit</button></center>
            </form>
            <center><p>Not registered yet? <a href="register.php">Register Here</a></p></center>
            </div>
          </div>
          <div class="col s12 m2">
            <div class="icon-block"></div>
          </div>
    <?php
  }else {

  }
?>



</div>
  </div>
</div>
<!-- -------------------------------mainpart------------------------------ -->
<?php
include_once('footer.php');
?>