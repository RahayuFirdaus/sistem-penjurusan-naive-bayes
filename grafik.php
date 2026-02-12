<?php
include "koneksi.php";
include "template/header.php";

$ipa=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dataset WHERE jurusan='IPA'"));
$ips=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dataset WHERE jurusan='IPS'"));
?>

<h3>Grafik Jumlah Jurusan</h3>

<canvas id="chartJurusan"></canvas>

<script>
var ctx=document.getElementById('chartJurusan');
new Chart(ctx,{
    type:'bar',
    data:{
        labels:['IPA','IPS'],
        datasets:[{
            label:'Jumlah Siswa',
            data:[<?= $ipa ?>, <?= $ips ?>],
            backgroundColor:['blue','orange']
        }]
    }
});
</script>

<?php include "template/footer.php"; ?>
