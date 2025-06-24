<?php
// File: pages/public/register.php
session_start();

if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] === 'admin') {
    header("Location: ../admin/dashboard.php");
  } elseif ($_SESSION['role'] === 'warga') {
    header("Location: ../warga/dashboard.php");
  }
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
      min-height: 100vh;
    }
    .card {
      border-radius: 1rem;
      border: none;
    }
    .btn-success {
      background-color: #28a745;
      border: none;
    }
    .btn-success:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h4 class="text-center mb-4 fw-bold text-success">Registrasi WARGA.ID</h4>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <form action="../../proses/auth/register.php" method="POST" novalidate>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" class="form-control"
                     placeholder="Masukkan nama lengkap"
                     required minlength="3">
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">Nomor HP</label>
              <input type="text" name="no_hp" id="no_hp" class="form-control"
                     placeholder="08xxxxxxxx"
                     required pattern="[0-9]{10,13}"
                     title="Nomor HP hanya angka, minimal 10 digit">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Kata Sandi</label>
              <input type="password" name="password" id="password" class="form-control"
                     placeholder="Minimal 6 karakter"
                     required minlength="6">
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-success">Daftar</button>
            </div>
          </form>

          <div class="text-center mt-3">
            <small>Sudah punya akun? <a href="login.php">Login di sini</a></small>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
