<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi,"SELECT * FROM user 
        WHERE username='$username' 
        AND password='$password'");

$data = mysqli_fetch_array($query);
$cek = mysqli_num_rows($query);

if($cek > 0){

    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['level'] = $data['level'];

    header("location:home.php");
    exit;

}else{
    echo "<script>
    alert('Username atau Password salah!');
    window.location='index.php';
    </script>";
}
