<?php


// start session
session_start();

// add functions
require "../../functions/functions.php";

// check if login
if (isset($_SESSION['login'])) {
	if ($_SESSION['role'] === "admin") {
		header("location: ../../pages/admin");
		exit;
	}

	if ($_SESSION['role'] === "user") {
		header("location: ../../pages/user");
		exit;
	}
}

// login
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// cek username
	$result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username';");

	if (mysqli_num_rows($result) === 1) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		// if ( password_verify($password, $row['password']) ) {
		// 	$_SESSION["login"] = true;
		// 	header('location: index.php');
		// 	exit;
		// }
		if ($password === $row['password']) {
			// redirect to admin if role is admin
			if ($row['role'] === "admin") {
				$_SESSION['login'] = true;
				$_SESSION['role'] = "admin";
				header("location: ../../pages/admin");
				exit;
			}

			// redirect to user if role is user
			if ($row['role'] === "user") {
				$id = $row['id'];
				$_SESSION['login'] = true;
				$_SESSION['role'] = "user";
				$_SESSION['id'] = $id;
				header("location: ../../pages/user?id=$id");
				exit;
			}
		}
	}
	$_SESSION['login-status'] = 0;
	$_SESSION['login-message'] = "Password or username incorect";
	$error = true;
}

?>


<!-- ============================ HTML ================================== -->
<!doctype html>
<html lang="en">

<head>
	<title>Login 05</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- bootsrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


	<link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">



			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<!-- <div class="img" style="background-image: url(images/bg-1.jpg);"></div> -->
						<div class="login-wrap p-4 p-md-5">
							<?php if (isset($_SESSION['login-status'])) : ?>
								<?php if ($_SESSION['login-status'] === 0) : ?>

									<div class="alert alert-danger" role="alert">
										<?= $_SESSION['login-message'] ?>
									</div>

									<?php unset($_SESSION['login-message']) ?>
								<?php endif; ?>
							<?php endif; ?>
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Login</h3>
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
									<input type="text" name="username" class="form-control" autofocus required>
									<label class="form-control-placeholder" for="username">Username</label>
								</div>
								<div class="form-group">
									<input id="password-field" name="password" type="password" class="form-control" required>
									<label class="form-control-placeholder" for="password">Password</label>
									<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								<div class="form-group">
									<button type="submit" name="login" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
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
							<p class="text-center">Belum punya akun? <a href="registrasi.php">Sign Up</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- remove sessoin loginstatus -->
	<?php $_SESSION['login-status'] = '' ?>

	<!-- bootstrap js -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/popper.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/main.js"></script>

</body>

</html>