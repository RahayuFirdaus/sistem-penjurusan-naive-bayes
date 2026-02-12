<?php
include "header.php";
include "koneksi.php";

/* =========================
   FILTER NAMA & NO PENDAFTARAN
========================= */

$nama = $_GET['nama'] ?? '';
$no_pendaftaran = $_GET['no_pendaftaran'] ?? '';

$query = "SELECT * FROM dataset WHERE 1=1";

if($nama != ''){
    $query .= " AND nama LIKE '%$nama%'";
}

if($no_pendaftaran != ''){
    $query .= " AND no_pendaftaran LIKE '%$no_pendaftaran%'";
}

$query .= " ORDER BY nama ASC";

$data = mysqli_query($koneksi, $query);
?>

<div class="card-modern p-4">

<!-- JUDUL -->
<h3 style="color:#0b2c5f;font-weight:700;margin-bottom:25px;">
Laporan Data Siswa Sistem Penjurusan
</h3>

<!-- FILTER -->
<div class="card-modern p-4 mb-4" style="background:#f8f9fa;">
<h6 style="font-weight:600;color:#0b2c5f;margin-bottom:15px;">Filter Data</h6>

<form method="GET" class="row g-3 align-items-end">

<div class="col-md-4">
<label>Nama</label>
<input type="text" name="nama" class="form-control"
value="<?= htmlspecialchars($nama); ?>"
placeholder="Masukkan nama siswa">
</div>

<div class="col-md-4">
<label>No Pendaftaran</label>
<input type="text" name="no_pendaftaran" class="form-control"
value="<?= htmlspecialchars($no_pendaftaran); ?>"
placeholder="Masukkan no pendaftaran">
</div>

<div class="col-md-2">
<button type="submit" 
class="btn w-100"
style="background:#0b2c5f;color:white;font-weight:600;">
TAMPILKAN
</button>
</div>

</form>
</div>

<!-- DATA -->
<div class="card-modern p-4">

<div class="d-flex justify-content-between align-items-center mb-3">
<div>
<h4 style="color:#0b2c5f;font-weight:600;">Data Siswa</h4>
<p class="text-muted mb-0">Hasil Filter Data</p>
</div>

<div>
<a href="cetak_pdf.php" 
class="btn me-2"
style="background:#dc3545;color:white;font-weight:600;">
🖨 CETAK PDF
</a>

<a href="export_excel.php" 
class="btn"
style="background:#198754;color:white;font-weight:600;">
📊 EXPORT EXCEL
</a>
</div>
</div>

<div class="table-responsive">
<table class="table align-middle table-hover">

<thead style="background:#0b2c5f;color:white;">
<tr>
<th>No</th>
<th>Nama</th>
<th>No Pendaftaran</th>
<th>MTK</th>
<th>B. Inggris</th>
<th>B. Indo</th>
<th>IPA</th>
<th>IPS</th>
<th>Psikotes</th>
<th>Jurusan</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

if(mysqli_num_rows($data) > 0){
while($row = mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++; ?></td>
<td><?= htmlspecialchars($row['nama']); ?></td>
<td><?= htmlspecialchars($row['no_pendaftaran']); ?></td>
<td><?= htmlspecialchars($row['mtk']); ?></td>
<td><?= htmlspecialchars($row['b_inggris']); ?></td>
<td><?= htmlspecialchars($row['b_indo']); ?></td>
<td><?= htmlspecialchars($row['ipa']); ?></td>
<td><?= htmlspecialchars($row['ips']); ?></td>
<td><?= htmlspecialchars($row['psikotes']); ?></td>
<td>
<span class="badge"
style="background:#198754;">
<?= htmlspecialchars($row['jurusan']); ?>
</span>
</td>
</tr>

<?php
}
}else{
?>

<tr>
<td colspan="10" class="text-center text-muted">
Data tidak ditemukan
</td>
</tr>

<?php } ?>

</tbody>
</table>
</div>

</div>
</div>

<?php include "footer.php"; ?>
