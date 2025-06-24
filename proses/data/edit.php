<?php
session_start();
include '../../config/koneksi.php';

// Validasi data POST
if (!isset($_POST['id'])) {
  $_SESSION['error'] = "Data tidak valid.";
  header("Location: ../../pages/admin/kelola-warga.php");
  exit;
}

$id               = $_POST['id'];
$kepala_keluarga  = $_POST['kepala_keluarga'];
$nik              = $_POST['nik'];
$no_kk            = $_POST['no_kk'];
$alamat           = $_POST['alamat'];
$nomor_rumah      = $_POST['nomor_rumah'];
$jumlah_keluarga  = $_POST['jumlah_keluarga'];
$agama            = $_POST['agama'];

// Query update ke database
$query = mysqli_query($conn, "UPDATE data_warga SET
  kepala_keluarga = '$kepala_keluarga',
  nik = '$nik',
  no_kk = '$no_kk',
  alamat = '$alamat',
  nomor_rumah = '$nomor_rumah',
  jumlah_keluarga = '$jumlah_keluarga',
  agama = '$agama',
  updated_at = CURRENT_TIMESTAMP
  WHERE id = '$id'");

// Cek hasil
if ($query) {
  $_SESSION['success'] = "Data warga berhasil diperbarui.";
  header("Location: ../../pages/admin/kelola-warga.php");
} else {
  $_SESSION['error'] = "Gagal memperbarui data warga.";
  header("Location: ../../pages/admin/edit-data.php?id=" . $id);
}
exit;
