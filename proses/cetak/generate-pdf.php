<?php
session_start();
include '../../config/koneksi.php';

// Validasi akses
if (!isset($_GET['id']) || $_SESSION['role'] !== 'warga') {
  die("Akses ditolak.");
}

require_once '../../vendor/tcpdf/tcpdf.php';

// Ambil data dari DB
$id_data = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM data_warga WHERE id = '$id_data'");
$data = mysqli_fetch_assoc($query);

if (!$data || $data['status_data'] !== 'verified') {
  die("Data tidak ditemukan atau belum diverifikasi.");
}

// Buat PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Isi PDF
$html = '
<h2 style="text-align:center;">BUKTI VERIFIKASI WARGA</h2>
<hr>
<p><strong>Nama Kepala Keluarga:</strong> ' . $data['kepala_keluarga'] . '</p>
<p><strong>NIK:</strong> ' . $data['nik'] . '</p>
<p><strong>No KK:</strong> ' . $data['no_kk'] . '</p>
<p><strong>Kode Keluarga:</strong> ' . $data['kode_keluarga'] . '</p>
<p><strong>Alamat:</strong> ' . $data['alamat'] . '</p>
<p><strong>Nomor Rumah:</strong> ' . $data['nomor_rumah'] . '</p>
<p><strong>Jumlah Keluarga:</strong> ' . $data['jumlah_keluarga'] . ' orang</p>
<p><strong>Agama:</strong> ' . $data['agama'] . '</p>
<br>
<p>Data ini telah <strong>diverifikasi oleh RT</strong> dan sah digunakan sebagai bukti pendataan warga.</p>
<br><br>
<p style="text-align:right;">Dicetak pada: ' . date('d/m/Y H:i') . '</p>
';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('bukti-verifikasi.pdf', 'I');
