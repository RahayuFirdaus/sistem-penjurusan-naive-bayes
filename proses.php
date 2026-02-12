<?php
include "header.php";
include "koneksi.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $input = $_POST;

    // Ambil semua jurusan unik
    $q = mysqli_query($koneksi,"SELECT DISTINCT jurusan FROM dataset");

    $total_data = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM dataset"));

    if($total_data == 0){
        echo "<div class='alert alert-danger'>Dataset kosong!</div>";
        exit;
    }

    $hasil = [];

    while($r = mysqli_fetch_assoc($q)){

        $jur = $r['jurusan'];

        $jumlah_per_jurusan = mysqli_num_rows(
            mysqli_query($koneksi,"SELECT * FROM dataset WHERE jurusan='$jur'")
        );

        // Probabilitas prior
        $prob = $jumlah_per_jurusan / $total_data;

        foreach($input as $k => $v){

            $jumlah_kondisi = mysqli_num_rows(
                mysqli_query($koneksi,"
                    SELECT * FROM dataset 
                    WHERE jurusan='$jur' 
                    AND $k='$v'
                ")
            );

            // Laplace smoothing
            $prob *= ($jumlah_kondisi + 1) / ($jumlah_per_jurusan + 3);
        }

        $hasil[$jur] = $prob;
    }

    arsort($hasil);
    $prediksi = array_key_first($hasil);
}
?>

<div class="container mt-4">

<div class="card shadow-lg border-0 rounded-4">
<div class="card-header text-white"
     style="background:linear-gradient(90deg,#0b2c5f,#123c7a);">
    <h4 class="mb-0">
        <i class="bi bi-bar-chart-fill me-2"></i>
        Hasil Prediksi
    </h4>
</div>

<div class="card-body text-center">

<?php if(isset($prediksi)){ ?>

    <h5 class="text-muted">Jurusan yang Direkomendasikan:</h5>

    <h1 class="fw-bold mt-3"
        style="color:#d4af37;font-size:40px;">
        <?= $prediksi ?>
    </h1>

    <hr>

    <h6 class="mt-4 mb-3">Detail Probabilitas:</h6>

    <div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Jurusan</th>
                <th>Nilai Probabilitas</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($hasil as $jur => $nilai){ ?>
            <tr>
                <td><?= $jur ?></td>
                <td><?= number_format($nilai,6) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>

    <a href="prediksi.php" class="btn btn-secondary mt-3">
        Kembali
    </a>

<?php } ?>

</div>
</div>

</div>

<?php include "footer.php"; ?>
