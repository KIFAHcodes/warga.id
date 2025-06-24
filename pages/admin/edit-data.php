<?php
include_once('../../components/protected-head.php');
include_once('../../components/navbar.php');
include_once('../../config/koneksi.php');

// Validasi ID
if (!isset($_GET['id'])) {
  header("Location: kelola-warga.php");
  exit;
}

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM data_warga WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "<p class='text-danger text-center mt-5'>Data tidak ditemukan.</p>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Data Warga - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h3 class="mb-4 text-center">Edit Data Warga</h3>

  <form action="../../proses/data/edit.php" method="POST" class="shadow p-4 bg-white rounded">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

    <div class="mb-3">
      <label for="kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
      <input type="text" name="kepala_keluarga" class="form-control" value="<?= htmlspecialchars($data['kepala_keluarga']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="nik" class="form-label">
        NIK Kepala Keluarga <small class="text-muted">(16 digit angka)</small>
      </label>
      <input type="text" name="nik" class="form-control"
         value="<?= htmlspecialchars($data['nik']) ?>"
         maxlength="16" pattern="\d{16}" required
         title="NIK harus berupa 16 digit angka"
         oninput="this.value=this.value.replace(/[^0-9]/g,'');">
    </div>

    <div class="mb-3">
      <label for="no_kk" class="form-label">
        Nomor KK <small class="text-muted">(16 digit angka)</small>
      </label>
      <input type="text" name="no_kk" class="form-control"
         value="<?= htmlspecialchars($data['no_kk']) ?>"
         maxlength="16" pattern="\d{16}" required
         title="Nomor KK harus berupa 16 digit angka"
         oninput="this.value=this.value.replace(/[^0-9]/g,'');">
    </div>

    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" rows="2" required><?= htmlspecialchars($data['alamat']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="nomor_rumah" class="form-label">Nomor Rumah</label>
      <input type="text" name="nomor_rumah" class="form-control" value="<?= htmlspecialchars($data['nomor_rumah']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="jumlah_keluarga" class="form-label">Jumlah Keluarga</label>
      <input type="number" name="jumlah_keluarga" class="form-control" value="<?= htmlspecialchars($data['jumlah_keluarga']) ?>" min="1" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="kontak_darurat" class="form-label">Kontak Darurat</label>
      <input type="text" name="kontak_darurat" class="form-control" value="<?= htmlspecialchars($data['kontak_darurat']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="agama" class="form-label">Agama</label>
      <input type="text" name="agama" class="form-control" value="<?= htmlspecialchars($data['agama']) ?>" required>
    </div>

    <div class="d-flex justify-content-between">
      <a href="kelola-warga.php" class="btn btn-secondary">Batal</a>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
  </form>
</div>

<?php include_once('../../components/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
