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

  <!-- ALERT -->
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $_SESSION['success']; unset($_SESSION['success']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
      <div class="card shadow-sm">
        <div class="card-body">
          <form action="../../proses/data/input.php" method="POST">

            <div class="mb-3">
              <label for="nik" class="form-label">
                NIK Kepala Keluarga <small class="text-muted">(16 digit angka sesuai KTP)</small>
              </label>
              <input
                type="text"
                name="nik"
                class="form-control"
                maxlength="16"
                pattern="\d{16}"
                required
                title="NIK harus berupa 16 digit angka"
                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                value="<?= $_SESSION['old']['nik'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="no_kk" class="form-label">
                Nomor KK <small class="text-muted">(16 digit angka sesuai KK)</small>
              </label>
              <input
                type="text"
                name="no_kk"
                class="form-control"
                maxlength="16"
                pattern="\d{16}"
                required
                title="Nomor KK harus berupa 16 digit angka"
                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                value="<?= $_SESSION['old']['no_kk'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="kode_keluarga" class="form-label">Kode Keluarga <small>(misal: RT12-A)</small></label>
              <input type="text" name="kode_keluarga" class="form-control" required
                     value="<?= $_SESSION['old']['kode_keluarga'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control" rows="2" required><?= $_SESSION['old']['alamat'] ?? '' ?></textarea>
            </div>

            <div class="mb-3">
              <label for="nomor_rumah" class="form-label">Nomor Rumah</label>
              <input type="text" name="nomor_rumah" class="form-control" required
                     value="<?= $_SESSION['old']['nomor_rumah'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Aktif</label>
              <input
                type="text"
                name="email"
                class="form-control"
                required
                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                title="Masukkan email valid seperti user@example.com"
                value="<?= $_SESSION['old']['email'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
              <input type="text" name="kepala_keluarga" class="form-control" required
                     value="<?= $_SESSION['old']['kepala_keluarga'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="jumlah_keluarga" class="form-label">Jumlah Anggota Keluarga</label>
              <input type="number" name="jumlah_keluarga" class="form-control" min="1" required
                     value="<?= $_SESSION['old']['jumlah_keluarga'] ?? '' ?>">
            </div>

            <div class="mb-3">
              <label for="kontak_darurat" class="form-label">Nomor Kontak Darurat</label>
              <input
                type="text"
                name="kontak_darurat"
                class="form-control"
                maxlength="13"
                pattern="\d{10,13}"
                required
                title="Nomor HP harus terdiri dari 10–13 digit angka"
                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                value="<?= $_SESSION['old']['kontak_darurat'] ?? '' ?>">
              <div class="form-text">Masukkan nomor HP aktif (10–13 digit angka)</div>
            </div>

            <div class="mb-3">
              <label for="agama" class="form-label">Agama</label>
              <select name="agama" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Islam" <?= ($_SESSION['old']['agama'] ?? '') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= ($_SESSION['old']['agama'] ?? '') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= ($_SESSION['old']['agama'] ?? '') == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= ($_SESSION['old']['agama'] ?? '') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Buddha" <?= ($_SESSION['old']['agama'] ?? '') == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                <option value="Konghucu" <?= ($_SESSION['old']['agama'] ?? '') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
              </select>
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">💾 Simpan Data</button>
            </div>

          </form>

          <?php unset($_SESSION['old']); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
