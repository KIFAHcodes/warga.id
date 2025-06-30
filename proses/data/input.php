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
    $_SESSION['old'] = $_POST;
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// Validasi: Email harus format valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Format email tidak valid.";
    $_SESSION['old'] = $_POST;
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// Validasi: Kontak darurat hanya 10–13 digit angka
if (!preg_match('/^\d{10,13}$/', $kontak_darurat)) {
    $_SESSION['error'] = "Nomor kontak darurat harus 10–13 digit angka.";
    $_SESSION['old'] = $_POST;
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// ✅ DITAMBAHKAN: Validasi apakah No KK sudah pernah dipakai anggota keluarga lain
$cek_kk = mysqli_query($conn, "SELECT * FROM data_warga WHERE no_kk = '$no_kk'");
if (mysqli_num_rows($cek_kk) > 0) {
    $_SESSION['error'] = "Nomor KK sudah digunakan oleh anggota keluarga lain.";
    $_SESSION['old'] = $_POST;
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// Validasi: Apakah user sudah pernah isi data sebelumnya
$cek = mysqli_query($conn, "SELECT * FROM data_warga WHERE id_user = '$id_user'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = "Data sudah pernah diisi.";
    header("Location: ../../pages/warga/lihat-data.php");
    exit;
}

// Validasi: Kode keluarga (opsional, bisa dihapus nanti kalau lo gak pakai)
$cek_kode = mysqli_query($conn, "SELECT * FROM data_warga WHERE kode_keluarga = '$kode_keluarga'");
if (mysqli_num_rows($cek_kode) > 0) {
    $_SESSION['error'] = "Kode keluarga sudah digunakan.";
    $_SESSION['old'] = $_POST;
    header("Location: ../../pages/warga/input-data.php");
    exit;
}

// Insert data ke database
$query = "INSERT INTO data_warga 
(id_user, nik, no_kk, kode_keluarga, alamat, nomor_rumah, email, kepala_keluarga, jumlah_keluarga, kontak_darurat, agama, status_data, created_at)
VALUES 
('$id_user', '$nik', '$no_kk', '$kode_keluarga', '$alamat', '$nomor_rumah', '$email', '$kepala_keluarga', '$jumlah_keluarga', '$kontak_darurat', '$agama', 'pending', CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $query)) {
    $_SESSION['success'] = "Data berhasil disimpan. Tunggu verifikasi dari RT.";
    header("Location: ../../pages/warga/lihat-data.php");
} else {
    $_SESSION['error'] = "Gagal menyimpan data.";
    $_SESSION['old'] = $_POST;
    header("Location: ../../pages/warga/input-data.php");
}
exit;
?>
