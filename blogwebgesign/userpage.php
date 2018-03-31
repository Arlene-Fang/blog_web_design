<?php
  include('db.php');
  include 'userheader.php';
  $con = db_connect();
?>
<?php
  include("auth.php");
?>
<!-- banner -->
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center white-text">FloaTrip</h1>
        <div class="row center">
          <h5 class="header col s12 light">Enjoy float trip in london from this site.</h5>
        </div>
        <div class="row center">

        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="../float/background1.jpg" alt="Unsplashed background img 1"></div>
  </div>

<!-- -------------------------------mainpart------------------------------ -->
<div class="container">
  <div class="section">
    <center><h5>Welcome <?php echo $_SESSION['username']; ?>!</h5></center>
<hr>
            <center><p>Information:</p></center>

    <table class="striped">
      <thead>
                    
      </thead>
      <tbody>
        <?php
          $query = mysqli_query($con,"SELECT * FROM writers WHERE username = '" . $_SESSION['username'] . "'");
          $row = mysqli_fetch_array($query);
        ?>
        <tr>
          <th>Username:</th>
          <td><?php echo $row['username']; ?></td>
        </tr>
        <tr>
          <th>Email:</th>
          <td><?php echo $row['email']; ?></td>
        </tr>
      </tbody>
      </table>
<hr>
    <table class="striped">
      <thead>
          <th>My Comments:</th>
          <th>Time:</th>                 
      </thead>
      <tbody>
        
        
        <tr><?php
          $query = mysqli_query($con,"SELECT * FROM post WHERE username = '" . $_SESSION['username'] . "'");
                            while($row=mysqli_fetch_array($query)){
                            $id=$row['post_id'];
        ?>
          
          <td><?php echo $row['content']; ?></td>
          <td><?php echo $row['post_date']; ?></td>
          <td width="40"><a href="delete_post.php<?php echo '?id='.$id; ?>"><i class="fas fa-trash-alt"></i>&nbsp;</a></td>
        </tr>
         <?php  } ?>
      </tbody>
      </table>  

  </div>
</div>
<!-- -------------------------------mainpart------------------------------ -->
<!-- footer -->
<?php
include 'footer.php';
?>