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
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seafood</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bistro-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/settings.css">
  <link rel="stylesheet" type="text/css" href="assets/css/navigation.css">
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
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>

  <!--Topbar-->
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

  <!--Header-->
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
                <a class="navbar-brand logo-center" href="index.php"><img src="assets/images/favicon.png" alt="logo" class="img-responsive"></a>
              </div>

              <div id="fixed-collapse-navbar" class="navbar-collapse collapse">

                <div class="navbar-left-1">
                  <ul class="nav navbar-nav  navbar-left">
                    <li class="dropdown active">
                      <a href="index.php">Home</a>
                    </li>
                    <li><a href="gallery.php">Menu</a></li>
                  </ul>
                  </li>
                  </ul>
                </div>
                <div class="navbar-right-1">
                  <ul class="nav navbar-nav  navbar-right">
                    <li><a href="blog.php">Review</a></li>
                    <li>
                      <a href="location2.php">Profile</a>
                    </li>
                    <li>
                      <a href="?logout" role="button">
                        <i class="ni ni-user-run d-lg-none"></i>
                        <span class="nav-link-inner--text">Logout</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>



  <!-- REVOLUTION SLIDER -->
  <section class="rev_slider_wrapper">
    <div id="rev_slider" class="rev_slider" data-version="5.0">
      <ul>
        <!-- SLIDE  -->
        <li data-transition="fade">
          <!-- MAIN IMAGE -->
          <img src="assets/images/sea.jpg" alt="" data-bgposition="center center" data-bgfit="cover">
          <!-- LAYER NR. 1 -->
          <h1 class="tp-caption tp-resizeme text-center" data-x="center" data-hoffset="15" data-y="170" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" style="z-index: 6;">
            <span class="small_title">Yes We Have</span> <br> The &nbsp; Best &nbsp; Fish &nbsp;<span class="color">Steak</span>
          </h1>

          </p>
        </li>

        <li data-transition="fade text-center">
          <img src="assets/images/salmon.jpg" alt="" data-bgposition="center center" data-bgfit="cover">
          <h1 class="tp-caption tp-resizeme text-center" data-x="center" data-hoffset="15" data-y="170" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:0;y:0;s:inherit;e:inherit;" data-start="500" data-splitin="none" data-splitout="none" style="z-index: 6;">
            <span class="small_title">Yes We Have</span> <br> The &nbsp; Best &nbsp; Fish &nbsp;<span class="color">Steak</span>
          </h1>
          <!-- LAYER NR. 2 -->

          </p>
        </li>
      </ul>
    </div>
  </section>

  <!-- END REVOLUTION SLIDER -->




  <!--Features Section-->
  <section class="feature_wrap padding-half" id="specialities">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="heading ">Our &nbsp; Specialities</h2>
          <hr class="heading_space">
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 feature text-center">
          <i class="icon-glass"></i>
          <h3><a href="#">Dinner &amp; Dessert</a></h3>
          <p> we can make you a very delicious dinner and dessert.</p>
        </div>
        <div class="col-md-3 col-sm-6 feature text-center">
          <i class="icon-coffee"></i>
          <h3><a href="#">Breakfast</a></h3>
          <p> a good breakfast is everyone's desire before doing daily activities.</p>
        </div>
        <div class="col-md-3 col-sm-6 feature text-center">
          <i class="icon-glass"></i>
          <h3><a href="#">Ice Shakes</a></h3>
          <p> cold ice shake can keep you stamina during your busy day.</p>
        </div>
        <div class="col-md-3 col-sm-6 feature text-center">
          <i class="icon-coffee"></i>
          <h3><a href="#">Beverges</a></h3>
          <p> our beverges quench thirst for a long time.</p>
        </div>
      </div>

    </div>
  </section>

  <!-- testinomial -->
  <section id="testinomial" class="padding">
    <div class="container">

      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="heading">Our &nbsp; happy &nbsp; Customers</h2>
          <hr class="heading_space">
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div id="testinomial-slider" class="owl-carousel text-center">
            <div class="item">
              <h3>Seafood dishes, chicken pecel, cheap catfish in the area of ​​Jalan Raya Bogor in front of Planet Ban. the sauce bounces, the price is affordable and the variety of food is quite complete, there are pomfret, carp also cah kale which challenges the spicy there is a parking lot, unfortunately it can't be eaten on the spot because of the PSBB.</h3>
              <p>Zulkifli</p>
            </div>
            <div class="item">
              <h3>The place is quite big, there are 2 shophouses but separate, the place to eat is only on the ground floor. Car park in the shop next door & under the Transjakarta flyover. The shop is quite popular so it is very full, in pandemic conditions it is a bit risky. The food is delicious, the price is not expensive either.</h3>
              <p>Kamel</p>
            </div>
            <div class="item">
              <h3>Family favorite seafood restaurant, large parking area and cheap prices. For the quality of fresh seafood and lots of choices. For friendly and fast service. Good and cheap seafood restaurant, go to Bogor again</h3>
              <p>Ridho</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!--Footer-->
  <footer class="padding-top bg_black">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 footer_column">
          <h4 class="heading">Why Seafood?</h4>
          <hr class="half_space">
          <p class="half_space">Seafood is packed with nutrients, including, vitamin B, B-complex vitamins and vitamin A. Some fish, like tuna is even filled with vitamin D, which is great for the bones and for immune system.</p>
          <p>Seafood is high in protein and low in saturated fat, not to mention filled with those omega 3s that can really help with heart health and reducing the risk of cardiovascular events.</p>
        </div>


      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="copyright clearfix">
            <p>Copyright &copy; 2021 Seafood. All Right Reserved</p>
            <ul class="social_icon">
              <li><a href="#." class="facebook"><i class="icon-facebook5"></i></a></li>
              <li><a href="#." class="twitter"><i class="icon-twitter4"></i></a></li>
              <li><a href="#." class="google"><i class="icon-google"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!--Contact Form & Address-->
  <section class="padding">
    <div class="container order-page">
      <div class="row">
        <div class="col-md-8 col-sm-8">
          <h2 class="heading">Get in Seafood</h2>
          <hr class="heading_space">
          <p><strong>Phone:</strong> 111.222.3333</p>
          <p><strong>Email:</strong> <a href="mailto:support@bistro.com">seafood@gmail.com</a></p>
          <p><a href="#."><strong>Web:</strong> www.seafood.com</a></p>
          <p><strong>Address:</strong> 12345 bogor, jawa barat</p>
        </div>
  </section>

  <a href="#" id="back-top"><i class="fa fa-angle-up fa-2x"></i></a>

  <script src="assets/js/jquery-2.2.3.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.themepunch.tools.min.js"></script>
  <script src="assets/js/jquery.themepunch.revolution.min.js"></script>
  <script src="assets/js/revolution.extension.layeranimation.min.js"></script>
  <script src="assets/js/revolution.extension.navigation.min.js"></script>
  <script src="assets/js/revolution.extension.parallax.min.js"></script>
  <script src="assets/js/revolution.extension.slideanims.min.js"></script>
  <script src="assets/js/revolution.extension.video.min.js"></script>
  <script src="assets/js/slider.js" type="text/javascript"></script>
  <script src="assets/js/owl.carousel.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.parallax-1.1.3.js"></script>
  <script src="assets/js/jquery.mixitup.min.js"></script>
  <script src="assets/js/jquery-countTo.js"></script>
  <script src="assets/js/jquery.appear.js"></script>
  <script src="assets/js/jquery.fancybox.js"></script>
  <script src="assets/js/functions.js" type="text/javascript"></script>

</body>

</html>