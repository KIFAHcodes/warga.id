<?php
session_start();
include '../../config/koneksi.php';
include '../../components/protected-head.php';
include '../../components/navbar.php';

$id_user = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM data_warga WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cetak Bukti Verifikasi - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Cek Bukti Verifikasi</h2>
    <p class="text-muted">Berikut informasi verifikasi keluarga Anda.</p>
  </div>

  <?php if (!$data): ?>
    <div class="alert alert-warning text-center">
      Anda belum mengisi data keluarga.
    </div>
  <?php else: ?>
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Nama Kepala Keluarga:</strong> <?= $data['kepala_keluarga']; ?></li>
          <li class="list-group-item"><strong>Kode Keluarga:</strong> <?= $data['kode_keluarga']; ?></li>
          <li class="list-group-item"><strong>Nomor Rumah:</strong> <?= $data['nomor_rumah']; ?></li>
          <li class="list-group-item"><strong>Status Verifikasi:</strong>
            <span class="badge bg-<?= 
              $data['status_data'] === 'verified' ? 'success' :
              ($data['status_data'] === 'pending' ? 'warning' : 'danger') ?>">
              <?= strtoupper($data['status_data']); ?>
            </span>
          </li>
        </ul>
      </div>
    </div>

    <?php if ($data['status_data'] === 'verified'): ?>
      <div class="text-center">
        <a href="../../proses/cetak/generate-pdf.php?id=<?= $data['id']; ?>" target="_blank" class="btn btn-primary btn-lg">
          🖨 Cetak Bukti
        </a>
      </div>
    <?php else: ?>
      <div class="alert alert-info text-center">
        Anda hanya bisa mencetak bukti jika data sudah diverifikasi oleh RT.
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php include '../../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
