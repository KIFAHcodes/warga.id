<?php
// Koneksi ke database kelompok_8
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kelompok_8";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
