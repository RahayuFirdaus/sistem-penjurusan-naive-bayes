<?php
include "header.php";
include "koneksi.php";

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $no_pendaftaran = $_POST['no_pendaftaran'];
    $mtk = $_POST['mtk'];
    $b_inggris = $_POST['b_inggris'];
    $b_indo = $_POST['b_indo'];
    $ipa = $_POST['ipa'];
    $ips = $_POST['ips'];
    $psikotes = $_POST['psikotes'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi,"INSERT INTO dataset
    (nama,no_pendaftaran,mtk,b_inggris,b_indo,ipa,ips,psikotes,jurusan)
    VALUES
    ('$nama','$no_pendaftaran','$mtk','$b_inggris','$b_indo','$ipa','$ips','$psikotes','$jurusan')");

    echo "<script>
    alert('Data berhasil ditambahkan!');
    window.location='dataset.php';
    </script>";
}
?>

<div class="card shadow-lg">
<div class="card-header bg-primary text-white">
<h5>Tambah Data Siswa</h5>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>No Pendaftaran</label>
<input type="text" name="no_pendaftaran" class="form-control" required>
</div>

<?php
function selectNilai($name){
echo "
<div class='mb-3'>
<label>$name</label>
<select name='".strtolower(str_replace(' ','_',$name))."' class='form-control' required>
<option value='rendah'>Rendah</option>
<option value='sedang'>Sedang</option>
<option value='tinggi'>Tinggi</option>
</select>
</div>
";
}
?>

<div class="row">
<div class="col-md-4"><?php selectNilai("mtk"); ?></div>
<div class="col-md-4"><?php selectNilai("b_inggris"); ?></div>
<div class="col-md-4"><?php selectNilai("b_indo"); ?></div>
</div>

<div class="row">
<div class="col-md-4"><?php selectNilai("ipa"); ?></div>
<div class="col-md-4"><?php selectNilai("ips"); ?></div>
<div class="col-md-4"><?php selectNilai("psikotes"); ?></div>
</div>

<div class="mb-3">
<label>Jurusan</label>
<select name="jurusan" class="form-control" required>
<option value="ATPH">ATPH</option>
<option value="TBSM">TBSM</option>
<option value="Multimedia">Multimedia</option>
</select>
</div>

<button type="submit" name="simpan" class="btn btn-primary">
Simpan
</button>

<a href="dataset.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</div>

<?php include "footer.php"; ?>
