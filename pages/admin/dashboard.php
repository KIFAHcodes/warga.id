<?php
session_start();
include_once('../../components/protected-head.php');
include_once('../../components/navbar.php');
include_once('../../config/koneksi.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="mb-4 text-center">
    <h2 class="fw-bold">Dashboard Admin</h2>
    <p>Selamat datang, <strong><?= $_SESSION['nama']; ?></strong> 👋</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card border-primary shadow-sm h-100">
        <div class="card-body text-center text-primary">
          <h5 class="card-title mb-2">Total Warga Terdaftar</h5>
          <p class="display-5 fw-bold">
            <?php
              $sql = mysqli_query($conn, "SELECT COUNT(*) as total FROM data_warga");
              $row = mysqli_fetch_assoc($sql);
              echo $row['total'];
            ?>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-warning shadow-sm h-100">
        <div class="card-body text-center text-warning">
          <h5 class="card-title mb-2">Menunggu Verifikasi</h5>
          <p class="display-5 fw-bold">
            <?php
              $sql2 = mysqli_query($conn, "SELECT COUNT(*) as pending FROM data_warga WHERE status_data='pending'");
              $row2 = mysqli_fetch_assoc($sql2);
              echo $row2['pending'];
            ?>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success shadow-sm h-100">
        <div class="card-body text-center text-success">
          <h5 class="card-title mb-2">Sudah Diverifikasi</h5>
          <p class="display-5 fw-bold">
            <?php
              $sql3 = mysqli_query($conn, "SELECT COUNT(*) as verified FROM data_warga WHERE status_data='verified'");
              $row3 = mysqli_fetch_assoc($sql3);
              echo $row3['verified'];
            ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('../../components/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
