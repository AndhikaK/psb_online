<?php


session_start();

// add functions
require "../../functions/functions.php";

// check if login
if (isset($_SESSION['login'])) {
	// die(var_dump("true"));
	// redirect to role page 
	if ($_SESSION['role'] === "admin") {
		header("location: ../../pages/admin");
		exit;
	}

	if ($_SESSION['role'] === "user") {
		header("location: ../../pages/user");
		exit;
	}
}


// registrasi
if (isset($_POST['registrasi'])) {

	$username = $_POST['username'];
	// check for duplicate username
	$checkUsername = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if (mysqli_num_rows($checkUsername) > 0) {
		$_SESSION['regis-status'] = 0;
		$_SESSION['regis-message'] = "Username tidak tersedia";
		header("location: registrasi.php");
		exit();
	}

	// if password and confirm password not same 
	if ($_POST['password'] != $_POST['confirm-password']) {
		$_SESSION['regis-status'] = 0;
		$_SESSION['regis-message'] = "Confirm password not same";
		header("location: registrasi.php");
		exit();
	} else {
		$_SESSION['regis-status'] = 1;

		if (registrasi($_POST) > 0) {
			$_SESSION['regis-status'] = 1;
			$_SESSION['regis-message'] = "Registrasi berhasil";
			header("location: registrasi.php");
			exit;
		}
	}
	// registrasi($_POST);
}


?>




<!doctype html>
<html lang="en">

<head>
	<title>Login 05</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">



			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<!-- <div class="img" style="background-image: url(images/bg-1.jpg);"></div> -->


						<div class="login-wrap  p-md-4">

							<!-- notification fail -->
							<?php if (isset($_SESSION['regis-status'])) : ?>
								<?php if ($_SESSION['regis-status'] === 0) : ?>

									<div class="alert alert-danger" role="alert">
										<?= $_SESSION['regis-message'] ?>
									</div>
								<?php endif ?>
							<?php endif ?>

							<!-- natification success -->
							<?php if (isset($_SESSION['regis-status'])) : ?>
								<?php if ($_SESSION['regis-status'] === 1) : ?>

									<div class="alert alert-success" role="alert">
										<?= $_SESSION['regis-message'] ?>
									</div>
								<?php endif ?>
							<?php endif ?>

							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Registrasi</h3>
								</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<!-- <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a> -->
									</p>
								</div>
							</div>
							<form action="" method="POST" class="signin-form">
								<div class="form-group mt-3">
									<input type="text" class="form-control" name="username" autofocus required>
									<label class="form-control-placeholder" for="username">Username</label>
								</div>
								<div class="form-group">
									<input id="password-field" name="password" type="password" class="form-control" required>
									<label class="form-control-placeholder" for="password">Password</label>
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group">
									<input id="confirm-password-field" name="confirm-password" type="password" class="form-control" required>
									<label class="form-control-placeholder" for="confirm-password">Confirm Password</label>
									<span toggle="#confirm-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>

								<div class="form-group">
									<button type="submit" name="registrasi" class="form-control btn btn-primary rounded submit px-3">Registrasi</button>
								</div>
								<div class="form-group d-md-flex">
									<!-- <div class="w-50 text-left">
										<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
											<input type="checkbox" checked>
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div> -->
								</div>
							</form>
							<p class="text-center">Sudah punya akun? <a href="login.php">Login</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- remove regis-status session -->
	<?php $_SESSION['regis-status'] = '' ?>

	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/popper.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/main.js"></script>

</body>

</html>