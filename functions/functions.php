<?php

$conn = mysqli_connect('localhost', 'root', '', 'psb_online');

function query($statement)
{
    global $conn;

    $data = mysqli_query($conn, $statement);
    $rows = [];

    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }

    return $rows;
}

function pendaftaran($data)
{
    global $conn;

    $id = $data['id'];
    $nisn = $data['nisn'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $tempatLahir = $data['tempat-lahir'];
    $ttl = $data['ttl'];
    $jk = $data['jk'];

    $statement = "
        UPDATE user
        SET 
        nisn='$nisn', nama='$nama', alamat='$alamat', `tempat-lahir`='$tempatLahir', ttl='$ttl', jk='$jk', status='pending' WHERE id = $id
    ";

    mysqli_query($conn, $statement);

    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;

    $username = $data['username'];
    $password = $data['password'];

    $statement = "
    INSERT INTO `user` 
        (`id`, `username`, `password`, `role`, `nisn`, `nama`, `jk`, `alamat`, `tempat-lahir`, `ttl`, `status`) 
    VALUES 
        (NULL, '$username', '$password', 'user', '', '', '', '', '', '', '');
    ";

    mysqli_query($conn, $statement);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;

    global $conn;

    $query = "
		DELETE FROM 
			user
		WHERE
			id=$id;
	";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
