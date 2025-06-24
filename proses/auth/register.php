<?php
session_start();
include '../../config/koneksi.php';

// Ambil data dari form dan bersihkan
$nama     = trim(mysqli_real_escape_string($conn, $_POST['nama']));
$no_hp    = trim(mysqli_real_escape_string($conn, $_POST['no_hp']));
$password = trim($_POST['password']);

// Validasi manual sisi server
if (strlen($nama) < 3) {
    $_SESSION['error'] = "Nama minimal 3 huruf.";
    header("Location: ../../pages/public/register.php");
    exit;
}

if (!preg_match('/^[0-9]{10,13}$/', $no_hp)) {
    $_SESSION['error'] = "Nomor HP harus angka & minimal 10 digit.";
    header("Location: ../../pages/public/register.php");
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error'] = "Password minimal 6 karakter.";
    header("Location: ../../pages/public/register.php");
    exit;
}

// Cek apakah no_hp sudah terdaftar
$cek = mysqli_query($conn, "SELECT id FROM users WHERE no_hp = '$no_hp'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = "Nomor HP sudah terdaftar.";
    header("Location: ../../pages/public/register.php");
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Simpan ke database
$query = "INSERT INTO users (nama, no_hp, password, role, status, created_at)
          VALUES ('$nama', '$no_hp', '$hashedPassword', 'warga', 'pending', CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $query)) {
    $_SESSION['success'] = "Akun berhasil dibuat. Silakan login.";
    header("Location: ../../pages/public/login.php");
} else {
    $_SESSION['error'] = "Gagal membuat akun.";
    header("Location: ../../pages/public/register.php");
}
exit;
?>
