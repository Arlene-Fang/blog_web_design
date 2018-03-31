<?php
  include_once('include_fns.php');
  $con = db_connect();
?>


<!DOCTYPE html>
<html>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a modern responsive CSS framework based on Material Design by Google. ">
    <title>FloaTrip</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <!-- Favicons-->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <!--  Android 5 Chrome Color-->
    <meta name="theme-color" content="#EE6E73">
    <!-- CSS-->
    <!-- <link href="css/prism.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection"> -->
    <link href="css/imageaction_2.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!-- <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css"> -->
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>

<style type="text/css">
/* Container needed to position the button. Adjust the width as needed */
.contain {
  position: relative;
  width: 100%;
}

/* Make the image responsive */
.contain img {
  width: 100%;
  height: auto;
}

/* Style the button and place it in the middle of the container/image */
.contain a {
  position: absolute;
  top: 75%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  border: none;
  cursor: pointer;
}



</style>
</head>
<body>

<?php
if(!check_auth_user()) {
  include_once('indexheader.php');
}
else{
  include_once('loginindexheader.php');
}

?>

<div id="index-banner" class="parallax-container">
    <!-- <img class="img" src="images/indexpic.png" style="width: 100%"> -->
    <div class="contain">
  <img src="images/indexpic.png" alt="Snow">
  <center>
  <a class="btn blue lighten-2 hoverable" href="#main">Learn More</a>
  </center>
</div>      
          
    <div class="parallax"><img src="images/parallax4.jpg" alt="Unsplashed background img 1"></div>
  </div>
 
    <div class="section grey darken-4" id="main">
      <div class="container">
 
        <div class="row center">
        <br><br><br>
          <h3 class="white-text">Stories</h3>

                                <h6 class="light float-text white-text">Read fantastic stories of traveling shared by our lovely users!</h6 >
                                <br>
                                <hr>
            
        </div>
         <div class="row">
          <ul id="staggered-test">
<?php
  $con = db_connect();
  $query = "select * from stories where published is not null order by rand() limit 3";
  //echo $query;
  $result = mysqli_query($con, $query);
  while ($story = mysqli_fetch_assoc($result)) {
    $story_img = $story['picture'];
    $story_id = $story['id'];
    $story_headline = $story['headline'];
    $story_writer = $story['writer'];
    echo '  <li>
    <div class="col s12 m4">
      <div class="card small hoverable  indigo lighten-5">';
    echo '<a href="id.php?id=';
    echo $story_id;  
    echo '"><div class="card-image">
          <div class="grid">
            <figure class="effect-apollo">';
    
    
    echo '<img src="';
    echo urldecode($story_img);
    echo '"><figcaption>';
    echo '</figcaption></figure></div>';
    echo '</div></a><div class="card-content">';
    echo '<a href="id.php?id=';
    echo $story_id;
    echo '"><h6>';
    echo $story_headline;
    echo '</h6></a>';
    echo 'A story in '.$story['category'];
    echo '<p>Writer: ';
    echo $story_writer;
    echo '</p>';
    echo '</div></div></div></li>';
  }
?> 
  </ul>
</div>
  
    </div>

   </div>
   <div class="slider grey darken-4" >
        <ul class="slides">
            <li>
              <img src="images/slider1.jpg">
            <div class="caption center-align white-text text-darken-2">
              <div class="container">
              <h4>Share your traveling stories!</h4>
              <hr><br>
                <h5 class="light white-text text-darken-2">Everyone can write their own traveling story on Floatrip.</h5>
                </div>
            </div>
          </li>
            
          <li>
            <img src="images/slider2.jpg">
            <div class="caption center-align white-grey-text text-darken-4">
                  <div class="container">
              <h4>Mark your favorite stories!</h4>
              <hr><br>
                <h5 class="light white-text text-darken-2">Add your favorite stoies into your likelist.</h5>
                </div>
            </div>
          </li>
        </ul>
    </div>
    <div class="section grey darken-4">
    <div class="container">
       <div class="row center">
        
          <h3 class="white-text">comment</h3>
                                <h6 class="light float-text white-text">Leave a comment and chat with other users.</h6 >
                                <br>
                                <hr>
            
        </div>
 <div class="row">

<ul>
<?php
  $con = db_connect();
  $query = "select * from post order by rand() limit 4";
  //echo $query;
  $result = mysqli_query($con, $query);
  while ($post = mysqli_fetch_assoc($result)) {
    $wa = get_writer_record($post['username']);
    $ca = get_story_record($post['category']);
    $content = $post['content'];
    echo '<li><div class="col s12 m3">';
    echo '<div class="card-panel small indigo hoverable">';
    echo '<span class="white-text">';
    echo '<center><img class="circle hoverable" src="';
    if ($wa['avatar']==null){
      echo 'avatars/null.jpg';
    }else{
      echo urldecode($wa['avatar']);
    }
    echo '" style="width:70px;">';
    echo '<div class="icon-block">';
    echo '<h6 align="center">';
    if($ca['category']==null){
      echo '<a href="post.php">from BBS</a>';
    }else{
      echo '<a href=id.php?id=';
      echo $post['category'];
      echo'>from '.$ca['category'].' story</a>';
    }
    echo '</h6><p align="light" class="grey-text">" ';
    echo substr("$content",0,30);
    echo '..."</p>';
    echo '<p align="right">';
    echo $post['username'];
    echo '</p></div></center></span></div><div></li>';
  }
?>
</ul>



     </div> 
  </div>
  </div>



<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        
        <div class="row center">
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="images/parallax5.jpg" alt="Unsplashed background img 1"></div>
  </div>
  <footer class="page-footer grey darken-3">
    <div class="container">
    <br>
    <center><a href="report.pdf" class="white-text">report</a></center>
    <center><a href="https://media.ed.ac.uk/media/t/1_151tqa18" class="white-text">video</a></center>
    <!-- <div class="col"> -->
    <center><p><a href="https://twitter.com/intent/tweet?url=https://playground.eca.ed.ac.uk/~s1710585/beta/" class="white-text"><i class="fab fa-twitter fa-lg"></i></a>
    <a href="https://www.facebook.com/sharer.php?u=https://playground.eca.ed.ac.uk/~s1710585/beta/" class="white-text"><i class="fab fa-facebook fa-lg"></i></a>
    <a href="https://plus.google.com/share?url=https://playground.eca.ed.ac.uk/~s1710585/beta/" class="white-text"><i class="fab fa-google fa-lg"></i></a>
    <a href="http://www.tumblr.com/share/link?url=https://playground.eca.ed.ac.uk/~s1710585/beta/&amp;name=&amp;description=" class="white-text"><i class="fab fa-tumblr fa-lg"></i></a>
    <a href="mailto:?subject=Share amazing website to you&amp;body=https://playground.eca.ed.ac.uk/~s1710585/beta/" class="white-text"><i class="far fa-envelope fa-lg"></i></a></p>
    </center>
  </div>
</div> 
    <div class="footer-copyright">
      <div class="container">
        <div class="row center">
            <p class="uppercase">&copy; 2018 Design: Chicken Dinner</p>
          </div>
      </div>
    </div>

  </footer>

   <script src='http://manual.okgoes.com/index/count'></script>
    <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?478902902272d2025e064ebc5eb6c99c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
    <!--  Scripts-->
    <script src="indexjs/jquery-2.1.4.min.js"></script>
    <script>if (!window.jQuery) { document.write('<script src="indexjs/jquery-2.1.1.min.js"><\/script>'); }
    </script>
    <script src="indexjs/jquery.timeago.min.js"></script>
    <script src="indexjs/prism.js"></script>
    <script src="indexjs/lunr.min.js"></script>
    <script src="indexjs/search.js"></script>
    <script src="indexjs/materialize.js"></script>
    <script src="indexjs/init.js"></script>
<script type="text/javascript" src='indexjs/adv.min.js'></script>
<script type="text/javascript">createAdv(200, 200,"rightCenter", "https://s.click.taobao.com/t?e=m%3D2%26s%3DznqHlRDnF5QcQipKwQzePCperVdZeJviEViQ0P1Vf2kguMN8XjClAnT5i1FeR%2BHExBEf%2F8FFdHx%2FtK0Figy3wdlS6sJWbBwf39gsB8kJ3DFv%2BK4tnq%2FMVjDVuRn8ddiDsEVVC24eqozO54LQ%2FVw1L9X5LHh3Z8M%2BWS6ALZVeqlk9XUfbPSJC%2F06deTzTIbffYpyF7ku%2BxKgGargQjSAC4C6cUF%2FXAmem", "/images/aliyun/adv1/200-200.jpg")</script>

    <script type="text/javascript">
      var options = [
        // {selector: '#staggered-test', offset: 50, callback: function(el) {
        //   Materialize.toast("This is our ScrollFire Demo!", 1500);
        //   $("#call-1").velocity({ backgroundColor: "#333", color: "#ef5350" }, {duration: 500});
        // } },
        // {selector: '#staggered-test', offset: 205, callback: function(el) {
        //   Materialize.toast("Please continue scrolling!", 1500);
        //   $("#call-2").velocity({ backgroundColor: "#333", color: "#ef5350" }, {duration: 500});
        // } },
        {selector: '#staggered-test', offset: 500, callback: function(el) {
          Materialize.showStaggeredList($(el));
          $("#call-3").velocity({ backgroundColor: "#333", color: "#ef5350" }, {duration: 500});
        } },
        // {selector: '#image-test', offset: 500, callback: function(el) {
        //   Materialize.fadeInImage($(el));
        //   $("#call-4").velocity({ backgroundColor: "#333", color: "#ef5350" }, {duration: 500});
        // } }
      ];
      Materialize.scrollFire(options);
    </script>
</body>
</html>