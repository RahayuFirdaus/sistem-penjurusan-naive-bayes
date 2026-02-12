<?php
include "koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_dataset.xls");

$data=mysqli_query($koneksi,"SELECT * FROM dataset");

echo "Nama\tMTK\tIPA\tIPS\tJurusan\n";

while($d=mysqli_fetch_array($data)){
echo $d['nama']."\t".$d['mtk']."\t".$d['ipa']."\t".$d['ips']."\t".$d['jurusan']."\n";
}
?>
