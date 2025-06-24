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
  <title>Lihat Data Keluarga - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Data Keluarga Anda</h2>
    <p class="text-muted">Berikut adalah data keluarga yang telah Anda isi.</p>
  </div>

  <?php if (!$data): ?>
    <div class="alert alert-warning text-center">
      Anda belum mengisi data keluarga. Silakan <a href="input-data.php" class="alert-link">isi data di sini</a>.
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered shadow-sm bg-white">
        <tbody>
          <tr><th scope="row">NIK Kepala Keluarga</th><td><?= $data['nik']; ?></td></tr>
          <tr><th scope="row">No. KK</th><td><?= $data['no_kk']; ?></td></tr>
          <tr><th scope="row">Kode Keluarga</th><td><?= $data['kode_keluarga']; ?></td></tr>
          <tr><th scope="row">Alamat</th><td><?= $data['alamat']; ?></td></tr>
          <tr><th scope="row">Nomor Rumah</th><td><?= $data['nomor_rumah']; ?></td></tr>
          <tr><th scope="row">Email</th><td><?= $data['email']; ?></td></tr>
          <tr><th scope="row">Nama Kepala Keluarga</th><td><?= $data['kepala_keluarga']; ?></td></tr>
          <tr><th scope="row">Jumlah Keluarga</th><td><?= $data['jumlah_keluarga']; ?></td></tr>
          <tr><th scope="row">Kontak Darurat</th><td><?= $data['kontak_darurat']; ?></td></tr>
          <tr><th scope="row">Agama</th><td><?= $data['agama']; ?></td></tr>
          <tr>
            <th scope="row">Status</th>
            <td>
              <?php
              $badge = ($data['status_data'] === 'verified') ? 'success' :
                      (($data['status_data'] === 'pending') ? 'warning' : 'danger');
              echo "<span class='badge bg-$badge text-uppercase'>{$data['status_data']}</span>";
              ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php include '../../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
