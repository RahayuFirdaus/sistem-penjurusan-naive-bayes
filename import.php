if(isset($_POST['import'])){

if($_FILES['file']['name'] != ""){

    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");

    // skip header
    fgetcsv($handle, 1000, ";");

    while(($row = fgetcsv($handle, 1000, ";")) !== FALSE){

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
    alert('Import berhasil!');
    window.location='dataset.php';
    </script>";
}
}
