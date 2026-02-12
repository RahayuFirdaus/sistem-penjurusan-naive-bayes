<?php
include "header.php";
include "koneksi.php";

/* =============================
   TOTAL DATA & JURUSAN
============================= */

$total_query = mysqli_query($koneksi,"SELECT COUNT(*) as total FROM dataset");
$total_data = mysqli_fetch_assoc($total_query)['total'];

$jurusan_query = mysqli_query($koneksi,"SELECT jurusan, COUNT(*) as jumlah 
                                        FROM dataset 
                                        GROUP BY jurusan");

$jurusan_data = [];
while($row = mysqli_fetch_assoc($jurusan_query)){
    $jurusan_data[] = $row;
}
?>

<div class="container-fluid">

<!-- ================= CARD 1 ================= -->
<div class="card shadow mb-4">
<div class="card-body">
<h4 class="fw-bold mb-3">Statistik Data Training</h4>

<div class="row">
    <div class="col-md-6">
        <div class="p-3 rounded" style="background:#0b2c5f;color:white;">
            <h5>Total Data Training</h5>
            <h2><?= $total_data ?> Siswa</h2>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-3 rounded" style="background:#d4af37;color:#0b2c5f;">
            <h5>Jumlah Jurusan</h5>
            <h2><?= count($jurusan_data) ?> Jurusan</h2>
        </div>
    </div>
</div>

</div>
</div>


<!-- ================= CARD 2 ================= -->
<div class="card shadow mb-4">
<div class="card-header text-white" style="background:#0b2c5f;">
<h5 class="mb-0">Prior Probability P(C)</h5>
</div>

<div class="card-body">
<table class="table table-bordered text-center">
<thead style="background:#0b2c5f;color:white;">
<tr>
<th>Jurusan</th>
<th>Jumlah Data</th>
<th>Probabilitas</th>
</tr>
</thead>
<tbody>

<?php
$chart_labels = [];
$chart_values = [];

foreach($jurusan_data as $row){
    $prob = $row['jumlah'] / $total_data;
    $chart_labels[] = $row['jurusan'];
    $chart_values[] = $row['jumlah'];
?>

<tr>
<td><?= $row['jurusan'] ?></td>
<td><?= $row['jumlah'] ?></td>
<td><?= number_format($prob,3) ?></td>
</tr>

<?php } ?>

</tbody>
</table>

<p class="mt-3">
<strong>Rumus:</strong><br>
P(C) = Jumlah Data Jurusan / Total Data
</p>

</div>
</div>


<!-- ================= CARD 3 ================= -->
<div class="card shadow mb-4">
<div class="card-header text-white" style="background:#0b2c5f;">
<h5 class="mb-0">Conditional Probability Contoh (MTK)</h5>
</div>

<div class="card-body">

<table class="table table-bordered text-center">
<thead style="background:#0b2c5f;color:white;">
<tr>
<th>Jurusan</th>
<th>MTK Tinggi</th>
<th>MTK Sedang</th>
<th>MTK Rendah</th>
</tr>
</thead>
<tbody>

<?php
foreach($jurusan_data as $row){

$jur = $row['jurusan'];
$total_jur = $row['jumlah'];

$tinggi = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dataset WHERE jurusan='$jur' AND mtk='tinggi'"));
$sedang = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dataset WHERE jurusan='$jur' AND mtk='sedang'"));
$rendah = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dataset WHERE jurusan='$jur' AND mtk='rendah'"));

?>

<tr>
<td><?= $jur ?></td>
<td><?= number_format(($tinggi+1)/($total_jur+3),3) ?></td>
<td><?= number_format(($sedang+1)/($total_jur+3),3) ?></td>
<td><?= number_format(($rendah+1)/($total_jur+3),3) ?></td>
</tr>

<?php } ?>

</tbody>
</table>

<p class="mt-3">
<strong>Rumus Laplace Smoothing:</strong><br>
P(X|C) = (Jumlah + 1) / (Total Jurusan + 3)
</p>

</div>
</div>


<!-- ================= CARD 4 ================= -->
<div class="card shadow mb-4">
<div class="card-header text-white" style="background:#0b2c5f;">
<h5 class="mb-0">Grafik Distribusi Jurusan</h5>
</div>

<div class="card-body">
<canvas id="jurusanChart"></canvas>
</div>
</div>

</div>


<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('jurusanChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($chart_labels) ?>,
        datasets: [{
            label: 'Jumlah Siswa',
            data: <?= json_encode($chart_values) ?>,
            backgroundColor: '#d4af37'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>

<?php include "footer.php"; ?>
