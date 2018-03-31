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

<div class="container">
  <div class="section">
<h3>Search</h3>
<p>Enter a keyword to search for:</p>
<form action="search.php" method="post">
	<input name="keyword" size="20">
<button type="submit" name="post" class="hoverable btn waves-effect waves-light red darken-2"/>search</button>
</form>
</div>
</div>
<?php
	include_once('footer.php');
?>