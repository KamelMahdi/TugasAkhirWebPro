<?php
require "config.php";
session_start();

// Memeriksa user logout atau belum login
// Memeriksa user logout atau belum login
if (!isset($_SESSION["login"]) || isset($_GET["logout"]) || !isset($_SESSION["admin"])) {
    session_destroy();
    echo "
        <script>
            document.location.href = 'login.php';
        </script>";
}


$user_id = $_SESSION["login"];
$user = findOne("SELECT * FROM user WHERE id = '$user_id'");
$posts = findAll("SELECT * FROM post WHERE user_id='$user_id' ORDER BY created_at DESC");


?>

<?php
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $user = findOne("SELECT * FROM user WHERE username = '$username'");
    if ($user != null) {
        echo "
        <script>
            alert('Username telah terdaftar, pilih username lain');
            document.location.href = 'register.php';
        </script>";
    } else {
        $create_user = commit("INSERT INTO user SET role = 'member', username = '$username', email = '$email', password = '$password'");
        if ($create_user > 0) {
            echo "
            <script>
                alert('Register berhasil');
                document.location.href = 'admin.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Register gagal');
                document.location.href = 'admin.php';
            </script>";
        }
    }
}

?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Seafood</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="favicon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
    <link href="assets2/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets2/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets2/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />


    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="assets2/css/style.css" rel="stylesheet" media="screen">
</head>

<body class="profile-page">

    <!-- Loader -->

    <div class="loader">
        <div class="page-lines">
            <div class="container">
                <div class="col-line col-xs-4">
                    <div class="line"></div>
                </div>
                <div class="col-line col-xs-4">
                    <div class="line"></div>
                </div>
                <div class="col-line col-xs-4">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="loader-brand">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
        </div>
    </div>


    <header id="top" class="header-inner">
        <div class="brand-panel">
            <a href="index.php" class="brand">
                Seafood<span class="text-primary"></span>
            </a>

        </div>
        <div class="header-phone">DASBOARD ADMIN</div>
        <div class="vertical-panel-content">
            <div class="vertical-panel-info">
            </div>
        </div>

        <!-- Navigation Desctop -->

        <nav class="navbar-desctop visible-md visible-lg">
            <div class="container">
                <a href="#top" class="brand js-target-scroll">
                    KID<span class="text-primary">.</span>DUT
                </a>
                <ul class="navbar-desctop-menu">
                    <li>
                        <a href="admin.php">Home</a>
                    </li>
                    <li>
                        <a href="?logout" role="button">
                            <i class="ni ni-user-run d-lg-none"></i>
                            <span class="nav-link-inner--text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Navigation Mobile -->

        <nav class="navbar-mobile">
            <a href="#top" class="brand js-target-scroll">
                Seafood<span class="text-primary"></span>
            </a>

            <!-- Navbar Collapse -->

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-mobile">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="navbar-nav-mobile">
                    <li class="active">
                        <a href="admin.php">Home</a>
                    </li>
                    <li>
                        <a href="?logout" role="button">
                            <i class="ni ni-user-run d-lg-none"></i>
                            <span class="nav-link-inner--text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <!-- Layout -->

    <div class="layout">

        <!-- Home -->
        <div class="wrapper">
            <div class="section section-hero section-shaped">
                <span class="span-150"></span>
                <span class="span-50"></span>
                <span class="span-50"></span>
                <span class="span-75"></span>
                <span class="span-100"></span>
                <span class="span-75"></span>
                <span class="span-50"></span>
                <span class="span-100"></span>
                <span class="span-50"></span>
                <span class="span-100"></span>
            </div>
        </div>
        <section class="section bg-secondary">
            <div class="container">
                <div class="card card-profile shadow mt--300">
                    <div class="px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image mt-3">
                                    <a href="javascript:;">
                                        <?php if ($user["avatar"] != null) : ?>
                                            <img src="assets/images/avatar/<?= $post["avatar"]; ?>" alt="Rounded image" class="img-fluid rounded shadow" width="120">
                                        <?php else : ?>
                                            <img src="assets/images/avatar/chef-order.png" alt="Rounded image" class="rounded shadow" width="120" height="120">
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-9">
                            <?= $user["username"]; ?>
                            <div class="h6 font-weight-300"><?= $user["email"]; ?></div>
                        </div>
                        <div class="mt-5 py-5 border-top text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div class="px-4">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-9">
                                                <div class="text-center text-muted mt-4 mb-4">
                                                    <p class="h4 font-weight-bold">Tambah Akun</p>
                                                </div>
                                                <div class="login-box">
                                                    <form role="form" method="post">
                                                        <div class="textbox">
                                                            <i class="fas fa-user"></i>
                                                            <input class="form-control" placeholder="Username" type="text" name="username" required>
                                                        </div>
                                                        <br>
                                                        <div class="textbox">
                                                            <i class="fas fa-envelope"></i>
                                                            <input class="form-control" placeholder="Email" type="email" name="email" required>
                                                        </div>
                                                        <br>
                                                        <div class="textbox">
                                                            <i class="fas fa-lock"></i>
                                                            <input class="form-control" placeholder="Password" type="password" name="password" required>
                                                        </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary my-4" name="register">Tambah
                                                        Akun</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="section section-typography">
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>

                            <th>Role</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM user";
                    $sql_user = mysqli_query($conn, $query) or die(mysqli_error($con));
                    while ($data = mysqli_fetch_array($sql_user)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['role'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td class="align-middle">
                                <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-icon btn-sm mt-1 mr-2" onclick="return confirm('yakin mengubah user ?')">
                                    <i class="ni ni-settings-gear-65 pt-1 text-white"></i>
                                </a>
                                <a href="delete.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-icon btn-sm mt-1 mr-2" onclick="return confirm('yakin menghapus user ?')">
                                    <i class="ni ni-fat-remove pt-1 text-white"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="assets2/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="assets2/js/core/popper.min.js" type="text/javascript"></script>
        <script src="assets2/js/core/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets2/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script>
        <script src="assets2/js/jquery.min.js"></script>
        <script src="assets2/js/bootstrap.min.js"></script>
        <script src="assets2/js/smoothscroll.js"></script>
        <script src="assets2/js/jquery.validate.min.js"></script>
        <script src="assets2/js/wow.min.js"></script>
        <script src="assets2/js/jquery.stellar.min.js"></script>
        <script src="assets2/js/jquery.magnific-popup.js"></script>
        <script src="assets2/js/owl.carousel.min.js"></script>
        <script src="assets2/js/interface.js"></script>
</body>

</html>