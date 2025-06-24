<?php
session_start();
include '../../config/koneksi.php';
include '../../components/protected-head.php';
include '../../components/navbar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Warga - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold text-primary">Halo, <?= htmlspecialchars($_SESSION['nama']); ?> 👋</h2>
    <p class="lead">Selamat datang di sistem pendataan warga <strong>WARGA.ID</strong>.</p>
  </div>

  <div class="alert alert-info text-center">
    <strong>Petunjuk:</strong> Silakan lengkapi data keluarga Anda di menu <a href="input-data.php" class="alert-link">Isi Data</a> pada navbar di atas.
  </div>

  <div class="card shadow-sm mt-4">
    <div class="card-body">
      <h5 class="card-title">Status Pendaftaran</h5>

      <?php
      $id_user = $_SESSION['id'];
      $query = mysqli_query($conn, "SELECT status_data FROM data_warga WHERE id_user = '$id_user' ORDER BY id DESC LIMIT 1");

      if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $status = $row['status_data'];
        $badge = ($status === 'verified') ? 'success' : (($status === 'pending') ? 'warning' : 'danger');
        echo "<span class='badge bg-$badge text-uppercase px-3 py-2 fs-6'>$status</span>";
      } else {
        echo "<span class='badge bg-secondary px-3 py-2 fs-6'>Belum Mengisi Data</span>";
      }
      ?>
    </div>
  </div>
</div>

<?php include '../../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
