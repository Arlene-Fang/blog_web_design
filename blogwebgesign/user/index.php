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
          <img class="responsive-img" src="../images/c.png">
        </div>

      </div>
    </div>
    <div class="parallax"><img src="../images/backgroundpic.jpg" alt="Unsplashed background img 1"></div>
  </div>


<div class="container">

<?php
  if(!check_auth_user()) {
    echo '<br><br><center><h6>Please log in to use our functions.</h6></center><br>';
    echo '<div class="row">
            <div class="col s12 m2">
          <div class="icon-block"></div>
        </div>
        <div class="col s12 m8">
          <div class="icon-block">';
    login_form();
    echo '<center>';
    echo '<p>Not registered yet? <a href="register.php">Register Here</a></p>';
    echo '</center>
      </div>                                
            <div class="col s12 m2">
          <div class="icon-block"></div>
        </div>                                            
          
</div>';
    echo '</div><br>';
  }else {
    $writer = get_writer_record($_SESSION['auth_user']);
    $query = 'select * from writers where username = \''.$_SESSION['auth_user'].'\'';
    $result = mysqli_query($con, $query);
    while ($writers = mysqli_fetch_assoc($result)) {
      echo '<br><div class="row">';
      echo '<div class="col s12 m6 l3"><p>Welcome, '.$writer['full_name'].'</p></div>';
      echo '<div class="col s12 m6 l3"><p>Email: '.$writers['email'].'</p></div>';
      echo '<div class="col s12 m6 l4"><p>Register Date: '.$writers['signup_date'].'</p></div>';
      echo '<div class="col s12 m6 l2"><img class="hoverable circle responsive-img" src="../';
      if ($writers['avatar']==null){
      echo 'avatars/null.jpg';
      }else{
      echo urldecode($writers['avatar']);
      }
      echo '" style="width:100px; height:100px"></div>';
      echo '</div>';
      }
    ?>
  <div class="fixed-action-btn">
    <a class="btn-floating hoverable tooltipped btn-large red darken-2" data-position="left" data-delay="50" data-tooltip="Back to Top" href="#top">
      <i class="material-icons">publish</i>
    </a>
  </div>

  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="hoverable tab col s3 grey lighten-1"><a class="active black-text" href="#write">My Travel Story</a></li>
        <li class="hoverable tab col s3 grey lighten-2"><a class="black-text" href="#comment">My Comments</a></li>
        <li class="hoverable tab col s3 grey lighten-3"><a class="black-text" href="#likes">My Likes</a></li>
        <li class="hoverable tab col s3 grey lighten-4"><a class="black-text" href="#publish">Publish Story(Admin Use)</a></li>
      </ul>
    </div>
    
    <div id="write" class="col s12">
      <center><p></p></center>
      <?php
$query = 'select * from stories where writer = \''.
      $_SESSION['auth_user'].'\' order by created desc';
    $result = mysqli_query($con, $query);
    echo '<center><h6>Your stories: ';
    echo mysqli_num_rows($result);
    echo ' <a class="tooltipped hoverable btn waves-effect waves-light red darken-2" data-position="top" data-delay="50" data-tooltip="For security and check, it would be saved immediately but published by our administrators later." href="story.php" >Add new</a></h6></center>';
    echo '<br/>';
    if (mysqli_num_rows($result)) {
      echo '<table class="responsive-table highlight">';
      echo '<thead class="hoverable"><th>Headline</th><th>Category</th>';
      echo '<th>created</th><th>Last modified</th><th>Information</th></thead>';
      while ($stories = mysqli_fetch_assoc($result)) {
        echo '<tr class="hoverable"><td>';
        echo $stories['headline'];
        echo '</td><td>';
        echo $stories['category'];
        echo '</td><td>';
        echo date('M d, H:i', $stories['created']);
        echo '</td><td>';
        echo date('M d, H:i', $stories['modified']);
        echo '</td><td>';

        if ($stories['published']) {
          echo '[Published '.date('M d, H:i', $stories['published']).']';
          echo '<a href="../id.php?id=';
          echo $stories['id'];
          echo '">';
          echo '[story link]';
          echo '</a>';
        }else{
          echo '[<a href="story.php?story='.$stories['id'].'">edit</a>]';
          echo '[<a href="delete_story.php?story='.$stories['id'].'">delete</a>]';
        }
        echo '</td></tr>';
      }
      echo '</table>';
      }?>
    </div>

    <div id="likes" class="col s12">
<?php
    $con = db_connect();
    $writer = get_writer_record($_SESSION['auth_user']);

    $query = 'select * from likelist where username = \''.$_SESSION['auth_user'].'\'';
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result)) {
      echo '<br><center><h6>You add: ';
      echo mysqli_num_rows($result);
      echo ' in likelist</h6></center>';
      echo '<table class="responsive-table highlight">';
      echo '<thead class="hoverable"><th>Story Headline</th><th>Category</th><th>Writer</th><th>Add Date</th>';
      echo '</thead>';
      while ($like_result = mysqli_fetch_assoc($result)) {
      $result_id = $like_result['id'];
      $like_id = $like_result['storyid'];
      $like_info = get_story_record($like_id);
        echo '<tr class="hoverable"><td>';
        echo '<a href="../id.php?id=';
        echo $like_info['id'];
        echo '">';
        echo $like_info['headline'];
        echo '</a></td><td>';
        echo '<a href="../category.php?category=';
        echo $like_info['category'];
        echo '">';
        echo $like_info['category'];;
        echo '</a></td><td>';
        echo $like_info['writer'];
        echo '</td><td>';
        echo $like_result['liketime'];
        echo '</td><td>';
        ?><td width="40"><a href="delete_likes.php<?php echo "?id=".$result_id; ?>"><i class="fas fa-trash-alt"></i>&nbsp;</a></td><?php
      }
      echo '</table>';
    }else {
        echo '<center><p>Oops, You have not added any travel stories.</p></center>';
      }
?>
    </div>

    <div id="publish" class="col s12">
<?php
    $writer = get_writer_record($_SESSION['auth_user']);

    $query = "select * from stories s, writer_permissions wp where wp.writer = '{$_SESSION['auth_user']}' and s.category = wp.category order by modified desc";
    $result = mysqli_query($con, $query);
    if ($stories = mysqli_fetch_assoc($result)==0){
      echo "<br><p>Sorry you are not an administrator and don't have permission to publish. For security, administrators are only the group members now. Welcome to writer your travel story and administrators will publish your story.</p>";
      echo "<center><p>Want to be an administrator? Please send an email to our group <a href='mailto:s1710585@ed.ac.uk?subject=&amp;body= Form FloaTrip (webisite: https://playground.eca.ed.ac.uk/~s1710585/beta/)' class='black-text'><i class='far fa-envelope fa-lg'></i></a></p></center>";

    }else{
    echo '<center><h6>Editor admin</h6></center></br>';
    echo '<table class="responsive-table highlight">';
    echo '<thead class="hoverable"><th>Headline</th><th>Last modified</th><th>Information</th></thead>';      
  } 
    $query = "select * from stories s, writer_permissions wp where wp.writer = '{$_SESSION['auth_user']}' and s.category = wp.category order by modified desc";
    $result = mysqli_query($con, $query);
    while($story = mysqli_fetch_assoc($result)) {
      echo '<tr class="hoverable"><td>';
      echo $story['headline'];
      echo '</td><td>';
      echo date('M d,H:i', $story['modified']);
      echo '</td><td>';
      if($story['published']) {
        echo '[<a href="unpublish_story.php?story='.$story['id'].'">unpublish</a>]';
      }else {
        echo '[<a href="publish_story.php?story='.$story['id'].'">publish</a>]';
        echo '[<a href="delete_story.php?story='.$story['id'].'">delete</a>]';
      }
      echo '[<a href="story.php?story='.$story['id'].'">edit</a>]';
      echo '</td></tr>';
    }
    echo '</table>';
?>
    </div>
    <div id="comment" class="col s12">
<?php
    $con = db_connect();
    $writer = get_writer_record($_SESSION['auth_user']);

    $query = 'select * from post where username = \''.$_SESSION['auth_user'].'\'';
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result)) {
      echo '<br><center><h6>Your Comments: ';
      echo mysqli_num_rows($result);
      echo '</h6></center>';
      echo '<table class="responsive-table highlight">';
      echo '<thead class="hoverable"><th>Content</th><th>Category</th><th>Post Date</th>';
      echo '</thead>';
      while ($post = mysqli_fetch_assoc($result)) {
      $post_id = $post['post_id'];
      $cate = $post['category'];
        $post_category = get_story_category($cate);
      if ($post_category==null){
        $post_category['headline'] = '<a href="../post.php">BBS</a>';
      }
        echo '<tr class="hoverable"><td>';
        echo $post['content'];
        echo '</td><td>';
        echo '<a href="../id.php?id=';
        echo $post_category['id'];
        echo '">';
        echo $post_category['headline'];
        echo '</a></td><td>';
        echo $post['post_date'];
        echo '</td><td>';
        ?><td width="40"><a href="delete_post.php<?php echo "?id=".$post_id; ?>"><i class="fas fa-trash-alt"></i>&nbsp;</a></td><?php
      }
      echo '</table>';
    }else {
        echo '<center><p>Oops, You have not post any comments.</p></center>';
        echo "<center><p>post your first comments <a href='../post.php'>here.</a></p></center>";
      }
}?>
    </div>
  </div>
</div>
<?php
	include_once('footer.php');
?>