<?php
session_start();
if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
    exit;
  } elseif ($_SESSION['role'] === 'warga') {
    header("Location: ../warga/dashboard.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WARGA.ID - Selamat Datang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar Sederhana -->
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <span class="navbar-brand fw-bold">Kelompok 8</span>
    </div>
  </nav>

  <!-- Konten Utama -->
  <div class="container py-5 text-center">
    <h1 class="mb-4 fw-bold text-primary">Selamat Datang di <span class="text-success">WARGA.ID</span></h1>
    <p class="lead">Solusi modern untuk pendataan warga RT/RW berbasis web.</p>

    <a href="register.php" class="btn btn-success mt-4">Daftar Sebagai Warga</a>
    <a href="login.php" class="btn btn-outline-primary mt-4 ms-2">Login</a>

    <div class="mt-5">
      <h6>Dibuat oleh:</h6>
      <p>Kelompok 8 - Universitas Muhammadiyah Tangerang</p>
      <small class="text-muted">Proyek Pemrograman Web Semester Genap</small>
    </div>
  </div>

  <footer class="text-center mt-5 p-3 bg-light">
    <p class="mb-0">© <?= date('Y') ?> WARGA.ID - Kelompok 8</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
