<?php
// Wajib dipanggil dulu sebelum pakai $_SESSION
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Jika tidak login, redirect ke halaman login
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
  header("Location: ../../pages/public/login.php");
  exit;
}
?>
