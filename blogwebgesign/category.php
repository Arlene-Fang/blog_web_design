<?php
	if (!isset($_REQUEST['category']) && !isset($_REQUEST['story'])) {
		header('Location:index.php');
	 	exit;
	}
	$category = $_REQUEST['category'];
	@$story = intval($_REQUEST['story']);
?>
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
    <div class="parallax"><img src="
<?php
  $con = db_connect();
  $query = "select * from stories where category ='$category' and published is not null order by rand() limit 1";
  //echo $query;
  $result = mysqli_query($con, $query);
  while ($story = mysqli_fetch_assoc($result)) {
    echo urldecode($story['picture']);
  }
?>
      " alt="Unsplashed background img 1"></div>
  </div>

	<div class="section">
    
<div class="container"> 
<?php
  $query = "select * from category where code ='$category'";
  $result = mysqli_query($con, $query);
  while ($cate = mysqli_fetch_assoc($result)) {
    echo '<center><h5>'.$cate['code'].'</h5></center>';
    echo '<p class="byline">'.$cate['description'].'</p>';
  }  
?>     
<div class="row">

  <div class="fixed-action-btn">
    <a class="btn-floating hoverable tooltipped btn-large red darken-2" data-position="left" data-delay="50" data-tooltip="Back to Top" href="#top">
      <i class="material-icons">publish</i>
    </a>
  </div>

<?php
	$con = db_connect();

	if ($story) {
		$query = "select * from stories where id ='$story' and published is not null order by published desc";
	}else {
		$query = "select * from stories where category = '$category' and published is not null order by published desc";
	}
	//echo $query;
	$result = mysqli_query($con, $query);
	while ($story = mysqli_fetch_assoc($result)) {
		echo '  <div class="card hoverable col s8 m6">
    <div class="card-image">';
    echo '<div class="grid">';
		if ($story['picture']) {
      		echo '
            <figure class="effect-apollo">';
      		echo '<img src="';
          	echo urldecode($story['picture']);
          	echo '" style="width:100%; height:300px"/>';
          	echo "<figcaption><p><a href='id.php?id={$story['id']}' class='white-text'>View more</a></p></figcaption>";
          	echo '</figure>';
    	}
    echo '</div>';
    	echo '</div>
    <div class="card-content"><h6>';
      	echo $story["headline"];
      	echo "</h6>";
      	echo "<p>";
      	echo "<a href='id.php?id={$story['id']}' class='black-text right-align'>View more</a>&nbsp;&nbsp;&nbsp;";
      	$w = get_writer_record($story['writer']);
	    echo $w['full_name'].', ';
	    echo date('M d, H: i', $story['modified']);
	    echo '</p>';
    echo "</div>
  </div>";
    }
?></div>
	</div>
</div>


<?php
	include_once('footer.php');
?>