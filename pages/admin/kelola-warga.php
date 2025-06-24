<?php
include '../../config/koneksi.php';
include '../../components/protected-head.php';
include '../../components/navbar.php';

// Ambil semua data warga
$query = mysqli_query($conn, "
  SELECT dw.*, u.nama AS nama_user, u.no_hp 
  FROM data_warga dw
  JOIN users u ON dw.id_user = u.id
  ORDER BY dw.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelola Warga - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4 text-center">Kelola Data Warga</h2>

  <?php if (mysqli_num_rows($query) === 0): ?>
    <div class="alert alert-warning text-center">Belum ada data warga yang diinput.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle table-striped">
        <thead class="table-dark text-white">
          <tr>
            <th>Nama User</th>
            <th>No. HP</th>
            <th>KK</th>
            <th>No. Rumah</th>
            <th>Kode Keluarga</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($query)): ?>
            <tr>
              <td><?= htmlspecialchars($row['nama_user']); ?></td>
              <td><?= htmlspecialchars($row['no_hp']); ?></td>
              <td><?= htmlspecialchars($row['kepala_keluarga']); ?></td>
              <td><?= htmlspecialchars($row['nomor_rumah']); ?></td>
              <td><?= htmlspecialchars($row['kode_keluarga']); ?></td>
              <td>
                <span class="badge bg-<?= 
                  $row['status_data'] === 'verified' ? 'success' :
                  ($row['status_data'] === 'pending' ? 'warning' : 'danger') ?>">
                  <?= strtoupper($row['status_data']); ?>
                </span>
              </td>
              <td class="text-center">
                <a href="edit-data.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary me-1">✏ Edit</a>
                <a href="../../proses/data/hapus.php?id=<?= $row['id']; ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Yakin ingin menghapus data ini?')">🗑 Hapus</a>
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
