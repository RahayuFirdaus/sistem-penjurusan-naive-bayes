<?php
session_start();
include "koneksi.php";

error_reporting(E_ALL);
ini_set('display_errors',1);

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);

    $data = mysqli_query($koneksi,"SELECT * FROM user 
        WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($data) > 0){

        $d = mysqli_fetch_assoc($data);

        // ===== WAJIB ADA INI =====
        $_SESSION['username'] = $d['username'];
        $_SESSION['nama']     = $d['nama'];
        $_SESSION['level']    = $d['level'];

        header("Location: home.php");
        exit;

    } else {
        $error = "Login gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Sistem Penjurusan</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:linear-gradient(135deg,#0b2c5f,#123c7a);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Poppins',sans-serif;
}

.card{
    border:none;
    border-radius:15px;
}

.card-header{
    background:#0b2c5f;
}

.btn-primary{
    background:#d4af37;
    border:none;
    font-weight:600;
}

.btn-primary:hover{
    background:#b9962f;
}
</style>

</head>

<body>

<div class="col-md-4">

<div class="card shadow-lg">
<div class="card-header text-white text-center">
<h4 class="mb-0">Login Sistem Penjurusan</h4>
</div>

<div class="card-body">

<?php if(isset($error)){ ?>
<div class="alert alert-danger">
<?= $error ?>
</div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-primary w-100">
Login
</button>

</form>

</div>
</div>

</div>

</body>
</html>
