<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penjurusan Naive Bayes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family:'Poppins', sans-serif;
}

/* ===== SIDEBAR ===== */

.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    background:#0b2c5f;
    padding-top:30px;
    box-shadow:4px 0 20px rgba(0,0,0,0.15);
}

.sidebar .logo{
    text-align:center;
    margin-bottom:40px;
}

.sidebar .logo h4{
    color:#d4af37;
    font-weight:700;
    letter-spacing:1px;
    font-size:20px;
    margin-bottom:18px;
}

.sidebar .logo img{
    width:90px;
    height:90px;
    object-fit:cover;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
}

/* ===== MENU ===== */

.sidebar a{
    display:flex;
    align-items:center;
    gap:12px;
    color:#ffffff;
    padding:13px 25px;
    text-decoration:none;
    transition:0.3s;
    font-weight:500;
    margin:6px 15px;
    border-radius:12px;
}

.sidebar a i{
    font-size:18px;
}

.sidebar a:hover{
    background:#d4af37;
    color:#0b2c5f;
    transform:translateX(4px);
}

.sidebar a.active{
    background:#d4af37;
    color:#0b2c5f;
}

/* ===== MAIN ===== */

.main{
    margin-left:260px;
    padding:35px;
}

/* ===== TOPBAR ===== */

.topbar{
    background:#ffffff;
    padding:18px 25px;
    border-radius:15px;
    margin-bottom:30px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.topbar h5{
    margin:0;
    font-weight:600;
    color:#0b2c5f;
}

.topbar span{
    color:#d4af37;
    font-weight:600;
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <h4>Naive Bayes</h4>
        <img src="assets/logo.jpeg" alt="Logo Sekolah">
    </div>

    <a href="home.php">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <?php if($_SESSION['level']=="admin"){ ?>
        <a href="user.php">
            <i class="bi bi-people"></i> User
        </a>

        <a href="dataset.php">
            <i class="bi bi-table"></i> Dataset
        </a>

        <a href="laporan.php">
            <i class="bi bi-file-earmark-bar-graph"></i> Laporan
        </a>
    <?php } ?>

    <a href="perhitungan.php">
        <i class="bi bi-calculator"></i> Perhitungan
    </a>

    <a href="prediksi.php">
        <i class="bi bi-graph-up-arrow"></i> Prediksi
    </a>

    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>

<!-- MAIN CONTENT -->
<div class="main">

<!-- TOPBAR -->
<div class="topbar">
    <h5>Sistem Penjurusan Siswa</h5>
    <div>
        Selamat datang, <span><?= $_SESSION['nama']; ?></span>
    </div>
</div>
