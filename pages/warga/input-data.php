<?php
session_start();
include '../../config/koneksi.php';
include '../../components/protected-head.php';
include '../../components/navbar.php';

// Cek apakah user sudah isi data sebelumnya
$id_user = $_SESSION['id'];
$cek = mysqli_query($conn, "SELECT * FROM data_warga WHERE id_user = '$id_user'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = "Data sudah diisi. Silakan cek di menu 'Lihat Data'.";
    header("Location: lihat-data.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Isi Data Keluarga - WARGA.ID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4 text-center text-primary">Form Pengisian Data Keluarga</h2>

  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <form action="../../proses/data/input.php" method="POST">

            <div class="mb-3">
              <label for="nik" class="form-label">NIK Kepala Keluarga</label>
              <input type="text" name="nik" class="form-control" maxlength="16" required>
            </div>

            <div class="mb-3">
              <label for="no_kk" class="form-label">Nomor KK</label>
              <input type="text" name="no_kk" class="form-control" maxlength="16" required>
            </div>

            <div class="mb-3">
              <label for="kode_keluarga" class="form-label">Kode Keluarga <small>(misal: RT12-A)</small></label>
              <input type="text" name="kode_keluarga" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control" rows="2" required></textarea>
            </div>

            <div class="mb-3">
              <label for="nomor_rumah" class="form-label">Nomor Rumah</label>
              <input type="text" name="nomor_rumah" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Aktif</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
              <input type="text" name="kepala_keluarga" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="jumlah_keluarga" class="form-label">Jumlah Anggota Keluarga</label>
              <input type="number" name="jumlah_keluarga" class="form-control" min="1" required>
            </div>

            <div class="mb-3">
              <label for="kontak_darurat" class="form-label">Nomor Kontak Darurat</label>
              <input type="text" name="kontak_darurat" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="agama" class="form-label">Agama</label>
              <select name="agama" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
              </select>
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">💾 Simpan Data</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
