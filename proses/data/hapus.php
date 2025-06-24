<?php
session_start();
include '../../config/koneksi.php';

// Pastikan hanya admin yang bisa akses
if ($_SESSION['role'] !== 'admin') {
  $_SESSION['error'] = "Akses ditolak.";
  header("Location: ../../pages/public/login.php");
  exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data dari database
$query = mysqli_query($conn, "DELETE FROM data_warga WHERE id = '$id'");

if ($query) {
  $_SESSION['success'] = "Data berhasil dihapus.";
} else {
  $_SESSION['error'] = "Gagal menghapus data.";
}

// Kembali ke halaman kelola
header("Location: ../../pages/admin/kelola-warga.php");
exit;
?>
