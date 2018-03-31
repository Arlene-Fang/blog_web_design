<?php
  include_once('include_fns.php');
  $con = db_connect();
  $id = $_REQUEST['id'];
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
  $query = "select * from stories where id ='$id' and published is not null";
  //echo $query;
  $result = mysqli_query($con, $query);
  while ($story = mysqli_fetch_assoc($result)) {
    echo urldecode($story['picture']);
    }
?>  
      " alt="Unsplashed background img 1"></div>
  </div>


<div class="container">
  <div class="section">

    <div class="fixed-action-btn">
      <a class="btn-floating hoverable tooltipped btn-large red darken-2" data-position="left" data-delay="50" data-tooltip="Back to Top" href="#top">
        <i class="material-icons">publish</i>
      </a>
    </div>

  <div class="row">
    <div class="col s12 m7 l8">
            <?php
              $con = db_connect();
              $query = "select * from stories where id ='$id' and published is not null";
              //echo $query;
              $result = mysqli_query($con, $query);
              while ($story = mysqli_fetch_assoc($result)) {
                //headline
                echo "<h4>{$story['headline']}</h4>";
                $w = get_writer_record($story['writer']);
                echo '<img src="';
                if ($w['avatar']==null){
                echo 'avatars/null.jpg';
                }else{
                echo urldecode($w['avatar']);
                }
                echo '" alt="" class="hoverable circle responsive-img" style="width:70px; height:70px">';
                echo '&nbsp;'.$w['full_name'].',&nbsp;';
                echo date('M d, H: i', $story['modified']);
                    echo '&nbsp;&nbsp;<a href="mailto:'.$w["email"].'?subject=&amp;body= Form FloaTrip (webisite: https://playground.eca.ed.ac.uk/~s1710585/beta/)" class="black-text"><i class="far fa-envelope fa-lg"></i></a>&nbsp;&nbsp;';
                echo '<br><br>';
                echo '&nbsp;<div class="chip hoverable">';
                echo '<a href="category.php?category=';
                echo $story['category'];
                echo '">';
                echo $story['category'];
                echo '</a>';
                echo '</div>';
            ?>


            <a href="https://twitter.com/intent/tweet?url=https://playground.eca.ed.ac.uk/~s1710585/beta/id.php?id=<?php echo $id;?>" class="blue-text"><i class="fab fa-twitter fa-lg"></i></a>
            &nbsp;<a href="https://www.facebook.com/sharer.php?u=https://playground.eca.ed.ac.uk/~s1710585/beta/id.php?id=<?php echo $id;?>" class="indigo-text"><i class="fab fa-facebook fa-lg"></i></a>
            &nbsp;<a href="https://plus.google.com/share?url=https://playground.eca.ed.ac.uk/~s1710585/beta/id.php?id=<?php echo $id;?>" class="black-text"><i class="fab fa-google fa-lg"></i></a>
            <?php    
                echo '&nbsp;<a ';
                if(check_auth_user()) {
                echo 'href="addlike.php?id=';
                echo $id.'"';
                }
                else {
                ?>href="javascript:alert('Please Log In first. :)');"<?php
                }
                $like_query=mysqli_query($con, "select * from likelist where storyid='$id'");
                $count_like=mysqli_num_rows($like_query);
                echo ' class="tooltipped hoverable btn-floating waves-effect waves-light red darken-2" data-position="top" data-delay="50" data-tooltip="Add To My Like"><i class="material-icons">thumb_up</i></a>';
                echo '&nbsp;'.$count_like;
                
              }
                ?>
            <?php
              $con = db_connect();
              $query = "select * from stories where id ='$id' and published is not null";
              //echo $query;
              $result = mysqli_query($con, $query);
              while ($story = mysqli_fetch_assoc($result)) {
                echo '<p class="byline">';
                echo $story['story_text'];
                echo '<center><img class="hoverable materialboxed" src="';
                echo urldecode($story['picture']);
                echo '" width="80%" hight="auto"/></center><br>';
                echo '</p>';
                }
            ?>

            <h5>Comments</h5>
                                  <div class="row">
                                    <table class="highlight">
                                        <thead class="hoverable">
                                        <th>User</th>
                                        <th>Nickname</th>
                                        <th><center>Content</center></th>
                                        <th>Time</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query=mysqli_query($con, "SELECT * from post where category = '$id'");
                                        while($row=mysqli_fetch_array($query)){
                                        $posid=$row['post_id'];
                                        $wa = get_writer_record($row['username']);
                                        
                                        ?>
                                      
                                      
                                          <tr class="hoverable">
                                            <td><?php echo '<img src="';
                                        if ($wa['avatar']==null){
                                        echo 'avatars/null.jpg';
                                        }else{
                                        echo urldecode($wa['avatar']);
                                        }
                                        echo '" alt="" class="circle responsive-img" style="width:70px; height:auto">'; ?>
                                          
                                        </td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['content']; ?></td>
                                            <td><?php echo $row['post_date']; ?></td>
                                            <td width="50">
                                              <?php 
                                              $comment_query=mysqli_query($con, "select * from comment where post_id='$posid'");
                                              $count=mysqli_num_rows($comment_query);
                                              ?>
                                            <a <?php
                                            if(check_auth_user()) {?>
                                            href="#<?php echo $posid; ?>"
                                            <?php }else{
                                            ?>href="javascript:alert('Please Log In first. :)');"<?php
                                            }
                                            ?>><i class="far fa-comments"></i>&nbsp;<span><?php echo $count; ?></span></a>
                                            </td>
                                          </tr>


            <!-- start model -->
            <div id="<?php echo $posid; ?>" class="modal bottom-sheet">
            <!-- model -->
              <div class="modal-content">
              
              <!----comment -->
                 <form  method="POST">
                  <div class="input-field">
                    <input type="hidden" name="post_info_id" value="<?php echo $posid; ?>">
                    <textarea name="comment_content" class="materialize-textarea" id="comment" required /></textarea>
                    <label for="comment">Comment</label>
                  </div>
                    <button name="comment" type="submit" class="hoverable btn btn-info red darken-2"><i class="material-icons right">send</i>&nbsp;Comment</button>
                    
                  </form>
                    <button class="hoverable modal-action modal-close waves-effect btn red lighten-4">Close<i class="material-icons right">close</i></button>
            <ul class="collection">
              <?php $comment=mysqli_query($con, "select * from comment where post_id='$posid'");
              while($comment_row=mysqli_fetch_array($comment)){ 
                $comment_user = get_writer_record($comment_row['username']);
                ?>
            <li class="collection-item avatar">
              <img src="
            <?php
                                        if ($comment_user['avatar']==null){
                                        echo 'avatars/null.jpg';
                                        }else{
                                        echo urldecode($comment_user['avatar']);
                                        }
                                        ?>
              " alt="" class="circle">
                <span class="title">User: <?php echo $comment_row['username']; ?></span><p></p>Date: <?php echo $comment_row['comment_date']; ?><p></p>Comment: <?php echo $comment_row['content']; ?></p>
              </li>  
              <?php } ?> 
            </ul>     
              </div>

              <?php } ?>
              <div class="modal-footer">
                
              </div>  
            <!--- end comment --> 
            </div>                    
            <!-- end model -->


                            </tbody>
                          </table>
              </div>





<!-- start model -->
<div id="loginform" class="modal">
<!-- model -->
  <div class="modal-content">
  
  <!----comment -->
  <div class="row">
    <div class="col s12 m2">
      <div class="icon-block"></div>
    </div>
    <div class="col s12 m8">
      <div class="icon-block">
        <?php login_form();?>
        <center><p>Not registered yet? <a href="register.php">Register Here</a></p><br></center>
        <button name="comment" type="submit" class="hoverable btn btn-info red darken-2"><i class="material-icons right">send</i>&nbsp;Submit</button>
        </form>
        <button class="hoverable modal-action modal-close waves-effect btn red lighten-4">Close<i class="material-icons right">close</i></button>
      </div>
    </div>
  
    <div class="col s12 m2">
      <div class="icon-block"></div>
    </div>
  </div>
</div>
  <div class="modal-footer">
    
  </div>  
<!--- end comment --> 
</div>
</div>



    <div class="col m5 l4">
      <div class="toc-wrapper">
<?php
  $con = db_connect();
  $query = "select * from stories where id ='$id'";
  //echo $query;
  $result = mysqli_query($con, $query);
  while ($story = mysqli_fetch_assoc($result)) {
    echo '    <br><div class="card-panel hoverable">';
    echo '<h6>Click "Find" to get the location:</h6>';
    echo '<input class="validate" id="address" type="textbox" value="';
    echo $story['location'];
    echo '">
      <button id="submit" name="post" class="hoverable btn waves-effect waves-light red darken-2"/>Find</button>
    <br>
    <div id="map" style="width:100%; height:400px"></div></div>';
    }
?>

<br><h5>Similar listing</h5>

<?php
  $con = db_connect();
  $query = "select * from stories where id ='$id' and published is not null";
  //echo $query;
  $result = mysqli_query($con, $query);
  while ($story = mysqli_fetch_assoc($result)) {
    $cate = $story['category'];
    $query = "select * from stories where category ='$cate' and published is not null and id<>'$id' order by rand() limit 2";
    $result = mysqli_query($con, $query);
    while ($list = mysqli_fetch_assoc($result)) {
     echo '<a href="id.php?id=';
     echo $list['id'];
     echo '"><img src="';
     echo urldecode($list['picture']);
     echo '" class="hoverable" style="width:20em; height:auto">';
     echo '</a><center>';
     echo '<a href="id.php?id=';
     echo $list['id'];
     echo '"><h6>';
     echo $list['headline'];
     echo '</h6></a></center>';
     echo '<br>';
    }
  }
?>
    </div>
  </div>
</div>




<?php
  if(!check_auth_user()) {
    ?>
<div class="row">
<div class="col s12 m6 l10"><h6>Please Log In to post what you want to say. </h6></div>
<div class="col s12 m6 l2"><a class="hoverable btn waves-effect waves-light red darken-2" href="#loginform" >Login</a></h6></div>
</div>
    <?php
  }else {
    $writer = get_writer_record($_SESSION['auth_user']);
    $query = 'select * from writers where username = \''.$_SESSION['auth_user'].'\'';
    $result = mysqli_query($con, $query);
    while ($writers = mysqli_fetch_assoc($result)) {
      echo '<br><div class="row">';
      echo '<div class="col s12 m2 l2"><div class="row">';
      echo '&nbsp;<img class="hoverable circle responsive-img" src="';
      if ($writers['avatar']==null){
      echo 'avatars/null.jpg';
      }else{
      echo urldecode($writers['avatar']);
      }
      echo '" style="width:70px; height:70px">';
      echo '<p>&nbsp;'.$writer['full_name'].'</p></div></div>';
    }
?>
<div class="col s12 m10 l10">    
    <form method="POST" class="col s12">
    <div class="row">
      <div class="input-field s6">
        <input name="post_content" class="validate" id="post_content" type="text" required />
        <label for="post_content">What you want to say</label>
      </div>
      <div class="input-field s6">
        <button type="submit" name="post" class="hoverable btn waves-effect waves-light red darken-2"/>post<i class="material-icons right">send</i></button>
        <button type="reset" class="hoverable btn waves-effect waves-light red lighten-4"/>reset<i class="material-icons right">mode_edit</i></button>
      </div>
    </div>
    </form>
</div> 
<?php }?>

    <?php
    if(isset($_POST['post'])){
    $post_content=$_POST['post_content'];
    $username=$_SESSION['auth_user'];
    $post_date = date("Y-m-d H:i:s");
    $query = "select id from post where category ='$id'";

    mysqli_query($con, "insert into post (username, content, post_date, category) values('$username', '$post_content', '$post_date', '$id')");
    echo "<script type='text/javascript'>location.href='id.php?id=$id';</script>";             
    }
    ?>                        
  </div> 
</div>



    <?php
    if(isset($_POST['comment'])){
    $comment_content=$_POST['comment_content'];
    $username=$_SESSION['auth_user'];
    $post_id=$_POST['post_info_id'];
    $comment_date = date("Y-m-d H:i:s");
    mysqli_query($con, "insert into comment (content,post_id,username, comment_date) values('$comment_content','$post_id', '$username', '$comment_date')");
    echo "<script type='text/javascript'>location.href='id.php?id=$id';</script>"; 
    
    
    }
    ?>

      
<!-- start model -->
<div id="loginform" class="modal">
<!-- model -->
  <div class="modal-content">
  
  <!----comment -->
  <div class="row">
  <div class="col s12 m2">
    <div class="icon-block"></div>
  </div>
  <div class="col s12 m8">
    <div class="icon-block">
    <?php login_form();?>
    <center><p>Not registered yet? <a href="register.php">Register Here</a></p><br></center>
    <center><button name="comment" type="submit" class="hoverable btn btn-info red darken-2"><i class="material-icons right">send</i>&nbsp;Submit</button></center>
    </form>
    <center><button class="modal-close modal-close waves-effect btn red lighten-4">Close<i class="material-icons right">close</i></button></center>
    </div>
  </div>
  
  <div class="col s12 m2">
    <div class="icon-block"></div>
  </div>
  </div>
</div>
  <div class="modal-footer">
    
  </div>  
<!--- end comment --> 
</div>
</div>

<?php
  include_once('footer.php');
?>