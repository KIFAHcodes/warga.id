<?php
include '../../config/koneksi.php';
include '../../components/protected-head.php';
include '../../components/navbar.php';

// Ambil data warga dengan status pending
$query = mysqli_query($conn, "SELECT * FROM data_warga WHERE status_data = 'pending'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verifikasi Warga - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4 text-center">Verifikasi Data Warga</h2>

  <?php if (mysqli_num_rows($query) === 0): ?>
    <div class="alert alert-info text-center">
      Tidak ada data warga yang menunggu verifikasi.
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th>Nama KK</th>
            <th>Nomor Rumah</th>
            <th>Kode Keluarga</th>
            <th>Jumlah Anggota</th>
            <th>Kontak Darurat</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($data = mysqli_fetch_assoc($query)): ?>
            <tr>
              <td><?= htmlspecialchars($data['kepala_keluarga']); ?></td>
              <td><?= htmlspecialchars($data['nomor_rumah']); ?></td>
              <td><?= htmlspecialchars($data['kode_keluarga']); ?></td>
              <td><?= $data['jumlah_keluarga']; ?></td>
              <td><?= htmlspecialchars($data['kontak_darurat']); ?></td>
              <td class="text-center">
                <a href="../../proses/data/verifikasi.php?aksi=verifikasi&id=<?= $data['id']; ?>" class="btn btn-sm btn-success me-1">✔ Verifikasi</a>
                <a href="../../proses/data/verifikasi.php?aksi=tolak&id=<?= $data['id']; ?>" class="btn btn-sm btn-danger">✖ Tolak</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php include '../../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
