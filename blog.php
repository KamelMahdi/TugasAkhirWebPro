<?php
require "config.php";
session_start();
date_default_timezone_set("Asia/Jakarta");

// Memeriksa user logout atau belum login

if (!isset($_SESSION["login"]) || isset($_GET["logout"])) {
  session_destroy();
  echo "
    <script>
      document.location.href = 'login.php';
    </script>";
}

$user_id = $_SESSION["login"];
$user = findOne("SELECT * FROM user WHERE id = '$user_id'");

// Relasi antara tabel user dan post
$posts = findAll("SELECT u.*, p.* FROM post p INNER JOIN user u WHERE p.user_id=u.id ORDER BY created_at DESC");

// Memeriksa method post yang dikirim ke halaman ini
if (isset($_POST["post"])) {
  $content = $_POST["content"];
  $created_at = date("Y-m-d H:i:s");

  $create_post = commit("INSERT INTO post SET user_id='$user_id', content='$content', created_at='$created_at'");
  if ($create_post < 0) {
    echo "
      <script>
        alert('Post gagal dikirim');
        document.location.href = 'index.php';
      </script>";
  }
  echo "
    <script>
      document.location.href = 'index.php';
    </script>";
}
?>
<!doctype html>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seafood</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bistro-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/css/settings.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="assets/css/owl.transitions.css">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css">
  <link rel="stylesheet" type="text/css" href="assets/css/zerogrid.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
  <link rel="shortcut icon" href="assets/images/favicon.png">


  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

  <!--Loader-->
  <div class="loader">
    <div class="cssload-container">
      <div class="cssload-circle"></div>
      <div class="cssload-circle"></div>
    </div>
  </div>

  <!--Top bar-->
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="pull-left hidden-xs">Seafood, the Best in Bogor </p>
          <p class="pull-right"><i class="fa fa-phone"></i>contac 111-222-3333</p>
        </div>
      </div>
    </div>
  </div>


  <header id="main-navigation">
    <div id="navigation" data-spy="affix" data-offset-top="20">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <nav class="navbar navbar-default">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#fixed-collapse-navbar" aria-expanded="false">
                  <span class="icon-bar top-bar"></span> <span class="icon-bar middle-bar"></span> <span class="icon-bar bottom-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="assets/images/favicon.png" alt="logo" class="img-responsive"></a>
              </div>

              <div id="fixed-collapse-navbar" class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="index.php">Home</a>
                  </li>
                  <li><a href="gallery.php">Menu</a></li>
                  </li>
                  <li><a href="blog.php">Review</a></li>
                  <li><a href="location2.php">Profile</a></li>
                  <li>
                    <a href="?logout" role="button">
                      <i class="ni ni-user-run d-lg-none"></i>
                      <span class="nav-link-inner--text">Logout</span>
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>



  <!--Page header & Title-->
  <section id="page_header">
    <div class="page_title">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="title">Review</h2>
            <p>here are comments about the menu that we have served</p>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- Blogs -->
  <section id="blog" class="padding-top">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-7">
          <div class="blog_item padding-bottom">
            <h2>Salmon Sushi</h2>
            <ul class="comments">
              <li><a href="#.">Jan 10, 2021</a></li>
              <li><a href="#."><i class="icon-chat-2"></i>5</a></li>
            </ul>
            <div class="image_container">
              <img src="assets/images/salmon.jpg" class="img-responsive" alt="blog post">
            </div>
            <p>This typical Japanese food will never die! When talking about sushi, what comes to mind is sushi with pieces of salmon on top. The taste that feels fresh and a little sweet is indeed craving. No wonder this menu is a favorite of Ichiban loyal visitors. For those of you who are trying sushi for the first time. There's nothing wrong with trying this sushi.</p>
            <a class="btn-common button3" href="blog-detail.php">Read the review</a>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!--Footer-->
  <footer class="padding-top bg_black">
    <div class="row">
      <div class="col-md-12">
        <div class="copyright clearfix">
          <p>Copyright &copy; 2021 Seafood. All Right Reserved</p>
        </div>
      </div>
    </div>
    </div>
  </footer>

  <a href="#." id="back-top"><i class="fa fa-angle-up fa-2x"></i></a>

  <script src="assets/js/jquery-2.2.3.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.geocomplete.min.js"></script>
  <script src="assets/js/jquery.parallax-1.1.3.js"></script>
  <script src="assets/js/jquery.themepunch.tools.min.js"></script>
  <script src="assets/js/jquery.themepunch.revolution.min.js"></script>
  <script src="assets/js/slider.js" type="text/javascript"></script>
  <script src="assets/js/jquery.appear.js"></script>
  <script src="assets/js/jquery-countTo.js"></script>
  <script src="assets/js/owl.carousel.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.fancybox.js"></script>
  <script src="assets/js/jquery.mixitup.min.js"></script>
  <script src="assets/js/functions.js" type="text/javascript"></script>
</body>

</html>