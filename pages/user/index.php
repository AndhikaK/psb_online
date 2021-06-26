<?php

session_start();


// call functions
require "../../functions/functions.php";

// check login
if (!$_SESSION['login']) {
  header("location: ../auth/login.php");
  exit;
}


// logout
if (isset($_POST['logout'])) {
  session_destroy();
  header("location: ../auth/login.php");
  exit;
}

// get all data
$id = $_SESSION['id'];
$data = query("SELECT * FROM user WHERE id='$id'")[0];



?>


<!doctype html>
<html lang="en">

<head>
  <title>PSB Online | Home</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- google icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="icon" href="assets-user/images/tut-wuri.png">

  <link rel="stylesheet" href="assets-user/css/style.css">
  <link rel="stylesheet" href="assets-user/css/my-style.css">

</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <!-- side bar -->
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../../assets/images/tut-wuri.png);"></a>
        <ul class="list-unstyled components mb-5">
          <li>
            <a href="index.php">Home</a>
          </li>

          <li>
            <a href="pendaftaran.php">Pendaftaran</a>
          </li>
        </ul>
        <!-- side bar footer -->
        <div class="footer">
          <p>
          </p>
        </div>

      </div>
    </nav>
    <!-- end of sidebar -->

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

      <!-- navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">PSB Online</a>
              </li>
              <li class="nav-item">
                <form action="" method="post">
                  <button name="logout" class="link-logout nav-link">Log out</button>
                </form>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- end of nabbar -->

      <!-- ========================== ADD content here ================================ -->
      <h2 class="mb-4">Home</h2>

      <!-- jika blom ada nama ato data yang lain -->
      <?php if ($data['nama'] === "") : ?>

        <p>Silahkan lakukan pendaftaran di menu pendaftaran. Isikan semua data berdasarkan data pribadi</p>

      <?php endif ?>

      <!-- jika sudah melakukan pendaftaran -->
      <!-- tampilkan status sekarang -->
      <!-- pending -->
      <?php if ($data['status'] === "pending") : ?>
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
                <b>Hallo, <?= $data['nama'] ?></b> <span class="badge bg-primary ms-2">Pending</span>
              </button>
            </h2>
            <div id="collapseData" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Pendaftaran kamu sedang dalam proses seleksi, silahkan tunggu sampai pengumuman selanjutnya untuk status pendaftaran ya....
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>

      <!-- lulus -->
      <?php if ($data['status'] === "lulus") : ?>
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
                <b>Hallo, <?= $data['nama'] ?></b> <span class="badge bg-success ms-2">Lulus</span>
              </button>
            </h2>
            <div id="collapseData" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Selamat, kamu lulus seleksi!! Silahkan lakukan pengurusan administrasi ke loket sekolah.
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>

      <!-- Gagal -->
      <?php if ($data['status'] === "gagal") : ?>
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
                <b>Hallo, <?= $data['nama'] ?></b> <span class="badge bg-danger ms-2">Gagal</span>
              </button>
            </h2>
            <div id="collapseData" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Maaf kamu tidak lulus proses seleksi. Jangan patah semangat dan sampai ketemu di lain kesempatan ya
              </div>
            </div>
          </div>
        </div>
      <?php endif ?>


      <!-- ========================== END CONTENT ===================================== -->
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- script js -->
  <script src="assets-user/js/jquery.min.js"></script>
  <script src="assets-user/js/popper.js"></script>
  <script src="assets-user/js/bootstrap.min.js"></script>
  <script src="assets-user/js/main.js"></script>
</body>

</html>