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
$email            = $_POST['email'];
$kontak_darurat   = $_POST['kontak_darurat'];
$agama            = $_POST['agama'];

// Validasi NIK dan No KK (16 digit)
if (!preg_match('/^\d{16}$/', $nik) || !preg_match('/^\d{16}$/', $no_kk)) {
  $_SESSION['error'] = "NIK dan No. KK harus terdiri dari 16 digit angka.";
  header("Location: ../../pages/admin/edit-data.php?id=" . $id);
  exit;
}

// Validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = "Format email tidak valid.";
  header("Location: ../../pages/admin/edit-data.php?id=" . $id);
  exit;
}

// Validasi kontak darurat (10–13 digit angka)
if (!preg_match('/^\d{10,13}$/', $kontak_darurat)) {
  $_SESSION['error'] = "Nomor kontak darurat harus 10–13 digit angka.";
  header("Location: ../../pages/admin/edit-data.php?id=" . $id);
  exit;
}

// Update ke database
$query = mysqli_query($conn, "UPDATE data_warga SET
  kepala_keluarga = '$kepala_keluarga',
  nik = '$nik',
  no_kk = '$no_kk',
  alamat = '$alamat',
  nomor_rumah = '$nomor_rumah',
  jumlah_keluarga = '$jumlah_keluarga',
  email = '$email',
  kontak_darurat = '$kontak_darurat',
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
