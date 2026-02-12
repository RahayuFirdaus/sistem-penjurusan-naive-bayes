<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Cetak PDF</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="window.print()">

<div class="container mt-4">
<h4>Laporan Dataset</h4>

<table class="table table-bordered">
<tr>
<th>No</th>
<th>Nama</th>
<th>MTK</th>
<th>IPA</th>
<th>IPS</th>
<th>Jurusan</th>
</tr>

<?php
$no=1;
$data=mysqli_query($koneksi,"SELECT * FROM dataset");
while($d=mysqli_fetch_array($data)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['mtk'] ?></td>
<td><?= $d['ipa'] ?></td>
<td><?= $d['ips'] ?></td>
<td><?= $d['jurusan'] ?></td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
