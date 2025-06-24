<?php
if (!isset($_SESSION)) session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">
      Kelompok 8
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/admin/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/admin/verifikasi-data.php">Verifikasi Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/admin/kelola-warga.php">Kelola Warga</a>
          </li>
        <?php elseif ($_SESSION['role'] === 'warga'): ?>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/warga/dashboard.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/warga/input-data.php">Input Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/warga/lihat-data.php">Lihat Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/warga/cetak-bukti.php">Cetak Bukti</a>
          </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-danger" href="../../proses/auth/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
