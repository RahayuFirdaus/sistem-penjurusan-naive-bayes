<?php
include "header.php";
include "koneksi.php";

/* =========================
   IMPORT CSV (AUTO REPLACE)
========================= */

if(isset($_POST['import'])){

    if($_FILES['file']['name'] == ""){
        echo "<script>alert('Pilih file terlebih dahulu!');</script>";
    }else{

        $namaFile = $_FILES['file']['name'];
        $tmpFile  = $_FILES['file']['tmp_name'];
        $ext      = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        if($ext != "csv"){
            echo "<script>alert('File harus format CSV!');</script>";
        }else{

            // HAPUS DATA LAMA
            mysqli_query($koneksi,"TRUNCATE TABLE dataset");

            $handle = fopen($tmpFile, "r");

            if($handle !== FALSE){

                // Skip header
                fgetcsv($handle, 1000, ";");

                while(($row = fgetcsv($handle, 1000, ";")) !== FALSE){

                    if(count($row) < 9){
                        continue;
                    }

                    mysqli_query($koneksi,"INSERT INTO dataset
                    (nama,no_pendaftaran,mtk,b_inggris,b_indo,ipa,ips,psikotes,jurusan)
                    VALUES(
                    '".mysqli_real_escape_string($koneksi,$row[0])."',
                    '".mysqli_real_escape_string($koneksi,$row[1])."',
                    '".mysqli_real_escape_string($koneksi,$row[2])."',
                    '".mysqli_real_escape_string($koneksi,$row[3])."',
                    '".mysqli_real_escape_string($koneksi,$row[4])."',
                    '".mysqli_real_escape_string($koneksi,$row[5])."',
                    '".mysqli_real_escape_string($koneksi,$row[6])."',
                    '".mysqli_real_escape_string($koneksi,$row[7])."',
                    '".mysqli_real_escape_string($koneksi,$row[8])."'
                    )");
                }

                fclose($handle);

                echo "<script>
                alert('Import berhasil! Data lama otomatis diganti.');
                window.location='dataset.php';
                </script>";

            }else{
                echo "<script>alert('File tidak bisa dibaca!');</script>";
            }
        }
    }
}

/* =========================
   AMBIL DATA
========================= */

$data = mysqli_query($koneksi,"SELECT * FROM dataset ORDER BY nama ASC");
?>

<div class="card-modern p-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 style="color:#0b2c5f;font-weight:600;">Dataset Siswa</h4>
    <a href="tambah_dataset.php" 
       class="btn"
       style="background:#d4af37;color:#0b2c5f;font-weight:600;">
       + Tambah Data
    </a>
</div>

<!-- IMPORT -->
<form method="POST" enctype="multipart/form-data" class="row mb-4">
    <div class="col-md-4">
        <input type="file" name="file" class="form-control" accept=".csv" required>
    </div>
    <div class="col-md-2">
        <button type="submit" name="import" 
        class="btn w-100"
        style="background:#0b2c5f;color:white;">
            Import CSV
        </button>
    </div>
</form>

<!-- SEARCH -->
<div class="mb-3">
    <input type="text" id="searchInput" 
    class="form-control" 
    placeholder="Search nama atau no pendaftaran...">
</div>

<div class="table-responsive">
<table class="table table-hover align-middle" id="datasetTable">

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
<th>Aksi</th>
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
<td>
<a href="edit_dataset.php?id=<?= $row['id']; ?>" 
class="btn btn-sm"
style="background:#d4af37;color:#0b2c5f;">
Edit
</a>

<a href="hapus_dataset.php?id=<?= $row['id']; ?>" 
class="btn btn-sm btn-danger"
onclick="return confirm('Yakin hapus data?')">
Delete
</a>
</td>
</tr>

<?php
}
}else{
?>

<tr>
<td colspan="11" class="text-center text-muted">
Belum ada data
</td>
</tr>

<?php } ?>

</tbody>
</table>
</div>

</div>

<!-- SEARCH SCRIPT -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll("#datasetTable tbody tr");

    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
});
</script>

<?php include "footer.php"; ?>
