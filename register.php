<?php
    require "config.php";

    // Memeriksa method post yang dikirim ke halaman ini
    if(isset($_POST["register"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];

        // Enkripsi password
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $user = findOne("SELECT * FROM user WHERE username = '$username'");
        if($user != null) {
            echo"
            <script>
                alert('Username telah terdaftar, pilih username lain');
                document.location.href = 'register.php';
            </script>";
        }
        else {
            $create_user = commit("INSERT INTO user SET role = 'member', username = '$username', email = '$email', password = '$password'");
            if($create_user > 0) {
                echo"
                <script>
                    alert('Register berhasil');
                    document.location.href = 'login.php';
                </script>";
            }
            else {
                echo"
                <script>
                    alert('Register gagal');
                    document.location.href = 'register.php';
                </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">

    <title>
        Register
    </title>

    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="stylelogin.css">

</head>

<body>
    <div class="login-box">
        <h1>Register</h1>
        <form role="form" method="post">
        <div class="textbox">
            <i class="fas fa-user"></i>
            <input class="form-control" placeholder="Username" type="text" name="username" required>
        </div>

        <div class="textbox">
            <i class="fas fa-envelope"></i>
            <input class="form-control" placeholder="Email" type="email" name="email" required>
        </div>

        <div class="textbox">
            <i class="fas fa-lock"></i>
            <input class="form-control" placeholder="Password" type="password" name="password" required>
        </div>
        <div class="text-center">
        <button type="submit" class="btn" name="register">Buat Akun</button>
        </div>
        <br>
        <div class="text-center">
            <a class="btn" type="button" href="login.php" value="Sign in">Sudah punya akun?</a>
        </div>
        </form>
    </div>
    
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script>
</body>

</html>