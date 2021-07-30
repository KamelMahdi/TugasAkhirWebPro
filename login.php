<?php
require "config.php";
session_start();

// Memeriksa method post yang dikirim ke halaman ini
if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$user = findOne("SELECT * FROM user WHERE username = '$username'");
	if ($user != null) {

		// Memeriksa apakah password benar
		if (password_verify($password, $user["password"])) {

			// Membuat session login berupa id user
			$_SESSION["login"] = $user["id"];

			// Login ke halaman admin
			if ($user["role"] == "admin") {
				$_SESSION["admin"] = true;
				echo "
 					<script>
 						document.location.href = 'admin.php';
 					</script>";
			} else {
				echo "
 					<script>
 						document.location.href = 'index.php';
 					</script>";
			}
		} else {
			echo "
 				<script>
 					alert('Password salah');
 					document.location.href = 'login.php';
 				</script>";
		}
	} else {
		echo "
 			<script>
 				alert('Username belum terdaftar, silahkan register');
 				document.location.href = 'login.php';
 			</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="stylelogin.css">
</head>

<body>
	<div class="login-box">
		<h1>Login</h1>
		<form role="form" method="post">
			<div class="form-group">
				<div class="input-group input-group-alternative mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="ni ni-single-02"></i></span>
						<div class="textbox">
							<i class="fas fa-user"></i>
							<input class="form-control" placeholder="Username" type="text" name="username" required>
						</div>

						<div class="textbox">
							<i class="fas fa-lock"></i>
							<input class="form-control" placeholder="Password" type="password" name="password" required>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary mt-4" name="login">Masuk</button>
						</div>
						<br>
					</div>
</body>

</html>