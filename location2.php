<?php
require "config.php";
session_start();

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
$posts = findAll("SELECT * FROM post WHERE user_id='$user_id' ORDER BY created_at DESC");

// Memeriksa method post yang dikirim ke halaman ini
if (isset($_POST["update"])) {
  $user_id = $_POST["id"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $avatar = $_POST["old_avatar"];
  $file = $_FILES["new_avatar"];

  // Memeriksa adanya file yang diupoload, (file baru, file lama)
  if ($file["name"] != null) {
    $avatar = uploadAvatar($file, $avatar);
  }

  $update_user = commit("UPDATE user SET username = '$username', email = '$email', avatar = '$avatar' WHERE id = '$user_id'");
  if ($update_user > 0) {
    echo "
        <script>
            alert('Profile berhasil diubah');
            document.location.href = 'location2.php';
        </script>";
  } else {
    echo "
              <script>
            alert('Profile gagal diubah');
            document.location.href = 'location2.php';
              </script>";
  }
}

// Memeriksa method get yang dikirim ke halaman ini
if (isset($_GET["delete"])) {
  $post_id = $_GET["delete"];

  $delete_post = commit("DELETE FROM post WHERE id='$post_id'");
  if ($delete_post < 0) {
    echo "
             <script>
                 alert('Post gagal dihapus');
                 document.location.href = 'about.php';
             </script>";
  }
  echo "
         <script>
             document.location.href = 'about.php';
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
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.css">
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
            <h2 class="title">Profile</h2>
            <p>here you can edit all the things on your profile</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Layout -->

  <div class="layout">

    <!-- Home -->
    <section class="section bg-secondary">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
                <div class="card-profile-image mt-3">
                  <a href="javascript:;">
                    <?php if ($user["avatar"] != null) : ?>
                      <img src="assets/images/avatar/<?= $user["avatar"]; ?>" alt="Rounded image" class="rounded shadow" width="120" height="120">
                    <?php else : ?>
                      <img src="assets/images/avatar/chef-order.png" alt="Rounded image" class="rounded shadow" width="120" height="120">
                    <?php endif; ?>
              </div>

            <div class="mt-5 py-5 border-top text-center">
                <div class="col-lg-9">
                  <form role="form" method="post" enctype="multipart/form-data">
                    <input value="<?= $user["id"]; ?>" type="hidden" name="id">
                    <input value="<?= $user["avatar"]; ?>" type="hidden" name="old_avatar">
                    <br>
                    <div class="form-group mb-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                        </div>
                        <input class="form-control" value="<?= $user["username"]; ?>" type="text" name="username" required>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control" value="<?= $user["email"]; ?>" type="email" name="email" required>
                      </div>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="new_avatar">
                    </div>
                    <br><br>
                    <div class="text-left">
                      <button type="submit" class="btn btn-primary my-4" name="update">Simpan</button>
                    </div>
                    <br>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

  </div>
  </div>
  </div>
  </div>

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

  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U&amp;libraries=places"></script>
  <script src="assets/js/jquery-2.2.3.js" type="text/javascript"></script>
  <script src="assets/js/jquery.geocomplete.min.js"></script>
  <script src="assets/js/owl.carousel.min.js" type="text/javascript"></script>
  <script src="assets/js/jquery.parallax-1.1.3.js"></script>
  <script src="assets/js/jquery.appear.js"></script>
  <script src="assets/js/jquery-countTo.js"></script>
  <script src="assets/js/jquery.fancybox.js"></script>
  <script src="assets/js/jquery.mixitup.min.js"></script>
  <script src="assets/js/map.js" type="text/javascript"></script>
  <script src="assets/js/functions.js" type="text/javascript"></script>
</body>

</html>