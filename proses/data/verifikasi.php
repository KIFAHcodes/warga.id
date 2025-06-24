<?php
session_start();
include '../../config/koneksi.php';

// Validasi: hanya admin yang boleh
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  $_SESSION['error'] = "Akses ditolak.";
  header("Location: ../../pages/admin/dashboard.php");
  exit;
}

// Validasi data dari URL
$id   = $_GET['id'] ?? null;
$aksi = $_GET['aksi'] ?? null;

if (!$id || !in_array($aksi, ['verifikasi', 'tolak'])) {
  $_SESSION['error'] = "Permintaan tidak valid.";
  header("Location: ../../pages/admin/verifikasi-data.php");
  exit;
}

// Tentukan status
$status_data = ($aksi === 'verifikasi') ? 'verified' : 'ditolak';

// Ambil id_user dari data_warga
$cek = mysqli_query($conn, "SELECT id_user FROM data_warga WHERE id = '$id'");
$ambil = mysqli_fetch_assoc($cek);

if (!$ambil) {
  $_SESSION['error'] = "Data tidak ditemukan.";
  header("Location: ../../pages/admin/verifikasi-data.php");
  exit;
}

$id_user = $ambil['id_user'];

// Update status verifikasi di data_warga
$query = mysqli_query($conn, "UPDATE data_warga SET status_data = '$status_data', updated_at = CURRENT_TIMESTAMP WHERE id = '$id'");

// Kirim notifikasi ke user
if ($query) {
  $_POST['id_user'] = $id_user;
  $_POST['aksi']    = $aksi;
  include '../notifikasi/kirim.php';

  $_SESSION['success'] = "Status warga berhasil diperbarui.";
} else {
  $_SESSION['error'] = "Gagal memperbarui data.";
}

// Redirect kembali ke halaman verifikasi
header("Location: ../../pages/admin/verifikasi-data.php");
exit;
?>
