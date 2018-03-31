<div class="navbar-fixed">
  <nav class="grey darken-4" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo white-text"><img src="images/logo.png" style="width: 30px;">FloaTrip</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="search_form.php" class="white-text"><i class="material-icons">search</i></a></li>
        <li><a href="index.php" class="white-text">Home</a></li>
          <!-- Dropdown Trigger -->
        <li><a class='dropdown-button white-text' href='' data-activates='dropdown1'>Category</a></li>
        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content grey darken-3'>
          <li><a href="category.php?category=UK" class="white-text">UK</a></li>
          <li><a href="category.php?category=France" class="white-text">France</a></li>
          <li><a href="category.php?category=China" class="white-text">China</a></li>
        </ul>
        <?php
            $con = db_connect();
            $query = "select * from stories where published is not null order by rand() limit 1";
            //echo $query;
            $result = mysqli_query($con, $query);
            while ($story = mysqli_fetch_assoc($result)) {
              echo "<li><a class='white-text' href='id.php?id=";
              echo $story['id'];
              echo "' >Feel Lucky</a></li>";
            }
        ?>
        <li><a href="post.php" class="white-text">BBS</a></li>
        <li><a href="user/index.php" class="dropdown-button white-text" data-activates='dropdown2'>User</a></li>
        <!-- Dropdown Structure -->
        <ul id='dropdown2' class='dropdown-content grey darken-3'>
          <li><a href="user/index.php#writer" class="white-text">My Story</a></li>
          <li><a href="user/index.php#comment" class="white-text">My Comment</a></li>
          <li><a href="user/index.php#likes" class="white-text">My Likes</a></li>
        </ul>
        <li><a href="login.php" class="white-text">Join In</a></li>

      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse white-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</div>


