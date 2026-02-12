<?php
include "header.php";
?>

<div class="container-fluid">

<div class="card shadow-lg border-0 rounded-4">
<div class="card-header text-white rounded-top-4"
     style="background:linear-gradient(90deg,#0b2c5f,#123c7a);">

    <h4 class="mb-0">
        <i class="bi bi-graph-up-arrow me-2"></i>
        Prediksi Jurusan (Naive Bayes)
    </h4>

</div>

<div class="card-body p-4">

<form method="POST" action="proses.php">

<div class="row g-4">

<!-- KOLOM KIRI -->
<div class="col-md-6">

<div class="mb-3">
<label class="fw-semibold">MTK</label>
<select name="mtk" class="form-select shadow-sm">
<option value="tinggi">Tinggi</option>
<option value="sedang">Sedang</option>
<option value="rendah">Rendah</option>
</select>
</div>

<div class="mb-3">
<label class="fw-semibold">IPA</label>
<select name="ipa" class="form-select shadow-sm">
<option value="tinggi">Tinggi</option>
<option value="sedang">Sedang</option>
<option value="rendah">Rendah</option>
</select>
</div>

<div class="mb-3">
<label class="fw-semibold">IPS</label>
<select name="ips" class="form-select shadow-sm">
<option value="tinggi">Tinggi</option>
<option value="sedang">Sedang</option>
<option value="rendah">Rendah</option>
</select>
</div>

</div>

<!-- KOLOM KANAN -->
<div class="col-md-6">

<div class="mb-3">
<label class="fw-semibold">B. Inggris</label>
<select name="b_inggris" class="form-select shadow-sm">
<option value="tinggi">Tinggi</option>
<option value="sedang">Sedang</option>
<option value="rendah">Rendah</option>
</select>
</div>

<div class="mb-3">
<label class="fw-semibold">B. Indonesia</label>
<select name="b_indo" class="form-select shadow-sm">
<option value="tinggi">Tinggi</option>
<option value="sedang">Sedang</option>
<option value="rendah">Rendah</option>
</select>
</div>

<div class="mb-3">
<label class="fw-semibold">Psikotes</label>
<select name="psikotes" class="form-select shadow-sm">
<option value="tinggi">Tinggi</option>
<option value="sedang">Sedang</option>
<option value="rendah">Rendah</option>
</select>
</div>

</div>

</div>

<!-- TOMBOL -->
<div class="text-center mt-4">

<button type="submit"
        class="btn btn-lg px-5 text-white fw-semibold"
        style="background:#d4af37;color:#0b2c5f;">

    <i class="bi bi-lightning-fill me-2"></i>
    Prediksi Sekarang

</button>

</div>

</form>

</div>
</div>

</div>

<?php include "footer.php"; ?>
