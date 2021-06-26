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


// submit pendaftaran
if (isset($_POST['submit'])) {
    if (pendaftaran($_POST) > 0) {
        $_SESSION['daftar-status'] = 1;
        $_SESSION['daftar-error'] = "Pendaftaran berhasil, silahkan tunggu pengumuman";
        header("location: pendaftaran.php");
        exit();
    } else {
        $_SESSION['daftar-status'] = 0;
        $_SESSION['daftar-error'] = "Gagal mendaftar, ulangi lagi nanti";
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>PSB Online | Pendaftaran</title>

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
            <h2 class="mb-4">Pendaftaran</h2>

            <?php if (isset($_SESSION['daftar-status']) === 0) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['daftar-error'] ?>
                </div>
            <?php endif ?>

            <?php if (isset($_SESSION['daftar-status']) === 1) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['daftar-message'] ?>
                </div>
            <?php endif ?>

            <form action="" method="POST" class="row">

                <input type="text" name="id" value="<?= $data['id'] ?>" hidden>

                <!-- first column -->
                <div class="col-6">
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $data['nisn'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input value="<?= $data['nama'] ?>" type="text" class="form-control" id="nama" name="nama">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="tempat-lahir" class="form-label">Tempat lahir </label>
                            <input value="<?= $data['tempat-lahir'] ?>" type="text" class="form-control" id="tempat-lahir" name="tempat-lahir">
                        </div>

                        <div class="col-6 mb-3">
                            <label for="ttl" class="form-label">Tanggal, lahir</label>
                            <input value="<?= $data['ttl'] ?>" type="date" class="form-control" id="ttl" name="ttl">
                        </div>
                    </div>
                </div>

                <div class="col-6">

                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" aria-label="Default select example" id="jk" name="jk">
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input value="<?= $data['alamat'] ?>" type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>

            <!-- ========================== END CONTENT ===================================== -->
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- script js -->
    <!-- <script src="assets-user/js/jquery.min.js"></script> -->
    <!-- <script src="assets-user/js/popper.js"></script> -->
    <!-- <script src="assets-user/js/bootstrap.min.js"></script> -->

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- <script src="assets-user/js/main.js"></script> -->
    <script src="../../assets/js/user-main.js"></script>


</body>

</html>