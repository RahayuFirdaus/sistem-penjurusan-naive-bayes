<?php
include "koneksi.php";
include "header.php";

if($_SESSION['level']!='admin'){
    echo "<script>alert('Akses ditolak!');window.location='home.php';</script>";
    exit;
}

/* TAMBAH */
if(isset($_POST['tambah'])){
    $nama=$_POST['nama'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $level=$_POST['level'];

    mysqli_query($koneksi,"INSERT INTO user VALUES(NULL,'$nama','$username','$password','$level')");
}

/* HAPUS */
if(isset($_GET['hapus'])){
    mysqli_query($koneksi,"DELETE FROM user WHERE id='$_GET[hapus]'");
    echo "<script>window.location='user.php';</script>";
}

/* UPDATE */
if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE user SET 
        nama='$_POST[nama]',
        username='$_POST[username]',
        level='$_POST[level]'
        WHERE id='$_POST[id]'");
}
?>

<style>
.card-custom{
    background:#ffffff;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    padding:30px;
}

.table thead{
    background:#0b2c5f;
    color:white;
}

.btn-gold{
    background:#d4af37;
    color:#0b2c5f;
    font-weight:600;
    border:none;
}

.btn-gold:hover{
    background:#c49b2e;
    color:white;
}

.btn-edit{
    background:#0b2c5f;
    color:white;
    border:none;
}

.btn-edit:hover{
    background:#123c7a;
}

.btn-delete{
    background:#8b0000;
    color:white;
    border:none;
}

.btn-delete:hover{
    background:#a00000;
}
</style>

<div class="card-custom">

<h4 class="fw-bold mb-4" style="color:#0b2c5f;">Manajemen User</h4>

<table class="table table-hover align-middle">
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Username</th>
<th>Level</th>
<th width="180">Action</th>
</tr>
</thead>

<tbody>

<?php
$no=1;
$data=mysqli_query($koneksi,"SELECT * FROM user");
while($d=mysqli_fetch_array($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>
<td><?= $d['username'] ?></td>
<td>
    <span class="badge" style="background:#d4af37;color:#0b2c5f;">
        <?= ucfirst($d['level']) ?>
    </span>
</td>
<td>

<button class="btn btn-sm btn-edit"
        data-bs-toggle="modal"
        data-bs-target="#edit<?= $d['id'] ?>">
    Edit
</button>

<a href="user.php?hapus=<?= $d['id'] ?>" 
   onclick="return confirm('Yakin hapus data?')" 
   class="btn btn-sm btn-delete">
    Delete
</a>

</td>
</tr>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit<?= $d['id'] ?>" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<form method="POST">

<div class="modal-header" style="background:#0b2c5f;color:white;">
<h5>Edit User</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<input type="hidden" name="id" value="<?= $d['id'] ?>">

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>" required>
</div>

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" value="<?= $d['username'] ?>" required>
</div>

<div class="mb-3">
<label>Level</label>
<select name="level" class="form-control">
<option value="admin" <?= $d['level']=='admin'?'selected':'' ?>>Admin</option>
<option value="guru" <?= $d['level']=='guru'?'selected':'' ?>>Guru</option>
</select>
</div>

</div>

<div class="modal-footer">
<button type="submit" name="update" class="btn btn-gold">Update</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>

</form>

</div>
</div>
</div>

<?php } ?>

</tbody>
</table>

<button class="btn btn-gold mt-3"
        data-bs-toggle="modal"
        data-bs-target="#tambah">
    Tambah Data
</button>

</div>


<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambah" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

<form method="POST">

<div class="modal-header" style="background:#0b2c5f;color:white;">
<h5>Tambah User</h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Level</label>
<select name="level" class="form-control">
<option value="admin">Admin</option>
<option value="guru">Guru</option>
</select>
</div>

</div>

<div class="modal-footer">
<button type="submit" name="tambah" class="btn btn-gold">Simpan</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
</div>

</form>

</div>
</div>
</div>

<?php include "footer.php"; ?>
