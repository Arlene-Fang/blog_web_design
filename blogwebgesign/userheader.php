<head>
  <title>FloaTrip</title>
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/imageaction.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/styles.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style>
    #map {
    height: 400px;
    width: 100%;
    }
  </style>
</head>

<body>
<div class="navbar-fixed">
  <nav class="grey darken-4" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo white-text">FloaTrip</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php" class="white-text">Home</a></li>
          <!-- Dropdown Trigger -->
        <li><a class='dropdown-button white-text' href='' data-activates='dropdown1'>Recommend</a></li>

        <!-- Dropdown Structure -->
        <ul id='dropdown1' class='dropdown-content grey darken-3'>
          <li><a href="category.php?category=museums" class="white-text">Museums</a></li>
          <li><a href="category.php?category=tourist" class="white-text">Tourists</a></li>
          <li><a href="category.php?category=churches" class="white-text">Churches</a></li>
          <!-- <li class="divider"></li>
          <li><a href="#!">Log Out</a></li> -->
        </ul>
        <li><a href="post.php" class="white-text">BBS</a></li>
        <li><a href="logout.php" class="white-text">Log Out</a></li>
      <ul id="nav-mobile" class="side-nav">

      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse white-text"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</div>