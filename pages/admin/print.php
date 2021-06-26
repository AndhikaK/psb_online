<?php

require "../../functions/functions.php";



// get all data
$id = $_GET['id'];
$data = query("SELECT * FROM user WHERE id='$id'")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <!-- div to print -->
    <div class="divToPrint" id="divToPrint">
        <!-- <span>print me</span> -->
        <h2 class="text-center">Detail Calon Siswa</h2>

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
    </div>
</body>

</html>