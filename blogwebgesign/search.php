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

<?php
	if ($_REQUEST['keyword']) {
		$keywords = explode(' ', $_REQUEST['keyword']);
		$num_keywords = count($keywords);
		for ($i = 0; $i<$num_keywords; $i++) {
			if ($i){
				@$keywords_string .= "or k.keyword = '".$keywords[$i]."'";
			}else {
				@$keywords_string .= "k.keyword = '".$keywords[$i]."'";
			}
		}
    $key = stripslashes($_REQUEST['keyword']);
    $key = mysqli_real_escape_string($con, $key);
		$query = "select * from stories where story_text like'%".$key."%' or headline like'%".$key."%'";
		$result = mysqli_query($con, $query);
	
	echo '<h3>Seach results</h3>';
?>

  <div class="fixed-action-btn">
    <a class="btn-floating tooltipped btn-large red darken-2 hoverable" data-position="left" data-delay="50" data-tooltip="Back to Top" href="#top">
      <i class="material-icons">publish</i>
    </a>
  </div>


<p>Enter a keyword to search for:</p>
<form action="search.php" method="post">
	<input name="keyword" size="20">
<button type="submit" name="post" class="hoverable btn waves-effect waves-light red darken-2"/>search</button>
</form>
<div class="row">
<?php
	if ($result && mysqli_num_rows($result)) {
		while ($matches = mysqli_fetch_assoc($result)) {
		echo '  <div class="card hoverable col s8 m6">
    <div class="card-image">';
    echo '<div class="grid">';
		if ($matches['picture']) {
      		echo '
            <figure class="effect-apollo">';
      		echo '<img src="';
          	echo urldecode($matches['picture']);
          	echo '" style="width:100%; height:300px"/>';
          	echo "<figcaption><p><a href='id.php?id={$matches['id']}' class='white-text'>View more</a></p></figcaption>";
          	echo '</figure>';
    	}
    echo '</div>';
    	echo '</div>
    <div class="card-content">
      <span class="black-text"><h6>';
      	echo $matches["headline"];
      	echo "</h6>";
      	echo "<p>";
      	echo "<a href='id.php?id={$matches['id']}' class='black-text'>View more</a>&nbsp;&nbsp;&nbsp;";
      	$w = get_writer_record($matches['writer']);
	    echo $w['full_name'].', ';
	    echo date('M d, H: i', $matches['modified']);
	    echo '</p>';
    echo "</div>
  </div>";
		}
	}else{
		echo 'No matching stories found';
	}
	}else{
		header("Location: search_form.php");
	}
?>
</div>
</div>
</div>
<?php
	include_once('footer.php');
?>