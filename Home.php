<?php
include "header.php";
?>

<style>

/* ===== HERO SECTION ===== */

.hero {
    position: relative;
    height: 400px;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 40px;
}

.hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(60%);
}

.hero-content {
    position: absolute;
    top: 50%;
    left: 60px;
    transform: translateY(-50%);
    color: white;
}

.hero-content h1 {
    font-weight: 700;
    font-size: 42px;
}

.hero-content p {
    font-size: 18px;
    margin-top: 10px;
    color: #f1f1f1;
}

/* ===== INFO CARD ===== */

.info-card {
    background: white;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.info-card:hover {
    transform: translateY(-5px);
}

.info-card i {
    font-size: 30px;
    color: #d4af37;
    margin-bottom: 10px;
}

.info-card h5 {
    font-weight: 600;
    color: #0b2c5f;
}

</style>

<!-- HERO -->
<div class="hero">
    <img src="assets/smk.jpeg">
    <div class="hero-content">
        <h1>Sistem Penjurusan Siswa</h1>
        <p>Menggunakan Algoritma Naive Bayes untuk rekomendasi jurusan terbaik</p>
    </div>
</div>

<!-- INFO CARDS -->
<div class="row g-4">

    <div class="col-md-4">
        <div class="info-card text-center">
            <i class="bi bi-table"></i>
            <h5>Kelola Dataset</h5>
            <p>Manajemen data siswa untuk proses klasifikasi jurusan.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-card text-center">
            <i class="bi bi-calculator"></i>
            <h5>Perhitungan Probabilitas</h5>
            <p>Perhitungan otomatis berdasarkan data training siswa.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-card text-center">
            <i class="bi bi-graph-up-arrow"></i>
            <h5>Prediksi Jurusan</h5>
            <p>Rekomendasi jurusan terbaik berdasarkan nilai siswa.</p>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>
