<?php
session_start();
include '../../config/koneksi.php';

// Ambil data dari form
$nama     = $_POST['nama'];
$no_hp    = $_POST['no_hp'];
$password = $_POST['password'];

// ✅ Pengecekan hardcoded akun admin
if ($nama === "adminRT" && $no_hp === "089912345678" && $password === "admin123") {
    $_SESSION['id']    = 0; // tidak dari DB
    $_SESSION['nama']  = "adminRT";
    $_SESSION['role']  = "admin";
    header("Location: ../../pages/admin/dashboard.php");
    exit;
}

// Cegah SQL injection
$nama     = mysqli_real_escape_string($conn, $nama);
$no_hp    = mysqli_real_escape_string($conn, $no_hp);
$password = mysqli_real_escape_string($conn, $password);

// Cek akun di database
$query = "SELECT * FROM users WHERE nama='$nama' AND no_hp='$no_hp'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Verifikasi password hash
    if (password_verify($password, $user['password'])) {
        $_SESSION['id']    = $user['id'];
        $_SESSION['nama']  = $user['nama'];
        $_SESSION['role']  = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../../pages/admin/dashboard.php");
        } else {
            header("Location: ../../pages/warga/dashboard.php");
        }
        exit;
    } else {
        $_SESSION['error'] = "Password salah.";
        header("Location: ../../pages/public/login.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Akun tidak ditemukan.";
    header("Location: ../../pages/public/login.php");
    exit;
}
?>
