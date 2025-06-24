<?php
session_start();
include '../../config/koneksi.php';

$id_user         = $_SESSION['id'];
$nik             = mysqli_real_escape_string($conn, $_POST['nik']);
$no_kk           = mysqli_real_escape_string($conn, $_POST['no_kk']);
$kode_keluarga   = mysqli_real_escape_string($conn, $_POST['kode_keluarga']);
$alamat          = mysqli_real_escape_string($conn, $_POST['alamat']);
$nomor_rumah     = mysqli_real_escape_string($conn, $_POST['nomor_rumah']);
$email           = mysqli_real_escape_string($conn, $_POST['email']);
$kepala_keluarga = mysqli_real_escape_string($conn, $_POST['kepala_keluarga']);
$jumlah_keluarga = mysqli_real_escape_string($conn, $_POST['jumlah_keluarga']);
$kontak_darurat  = mysqli_real_escape_string($conn, $_POST['kontak_darurat']);
$agama           = mysqli_real_escape_string($conn, $_POST['agama']);

// Validasi: NIK dan No KK harus 16 digit angka
if (!preg_match('/^\d{16}$/', $nik) || !preg_match('/^\d{16}$/', $no_kk)) {
    $_SESSION['error'] = "NIK dan Nomor KK harus terdiri dari 16 digit angka.";
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// Cek apakah user sudah mengisi sebelumnya
$cek = mysqli_query($conn, "SELECT * FROM data_warga WHERE id_user = '$id_user'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = "Data sudah pernah diisi.";
    header("Location: ../../pages/warga/lihat-data.php");
    exit;
}

// Cek apakah kode_keluarga sudah digunakan orang lain
$cek_kode = mysqli_query($conn, "SELECT * FROM data_warga WHERE kode_keluarga = '$kode_keluarga'");
if (mysqli_num_rows($cek_kode) > 0) {
    $_SESSION['error'] = "Kode keluarga sudah digunakan.";
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// Insert data
$query = "INSERT INTO data_warga 
(id_user, nik, no_kk, kode_keluarga, alamat, nomor_rumah, email, kepala_keluarga, jumlah_keluarga, kontak_darurat, agama, status_data, created_at)
VALUES 
('$id_user', '$nik', '$no_kk', '$kode_keluarga', '$alamat', '$nomor_rumah', '$email', '$kepala_keluarga', '$jumlah_keluarga', '$kontak_darurat', '$agama', 'pending', CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $query)) {
    $_SESSION['success'] = "Data berhasil disimpan. Tunggu verifikasi dari RT.";
    header("Location: ../../pages/warga/lihat-data.php");
} else {
    $_SESSION['error'] = "Gagal menyimpan data.";
    header("Location: ../../pages/warga/input-data.php");
}
exit;
?>
