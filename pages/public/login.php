<?php
// File: pages/public/login.php
session_start();

// Jika sudah login, langsung ke dashboard
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
  <title>Login - WARGA.ID</title>
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Google -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
      min-height: 100vh;
    }
    .card {
      border: none;
      border-radius: 1rem;
    }
    .btn-primary {
      background-color: #4a90e2;
      border: none;
    }
    .btn-primary:hover {
      background-color: #357ab8;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h4 class="text-center mb-4 fw-bold text-primary">Login WARGA.ID</h4>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <form action="../../proses/auth/login.php" method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">Nomor HP</label>
              <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="08xxxx" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Kata Sandi</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
          </form>

          <div class="text-center mt-3">
            <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
