<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kampus";

// Koneksi menggunakan mysqli procedural style
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Ketentuan 3: Tampilkan pesan error jika koneksi gagal
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>