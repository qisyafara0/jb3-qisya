<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM kelas WHERE id_kelas=$id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])) {
    $nama = $_POST['nama_wali'];
    $kontak = $_POST['kontak'];

    $query = "UPDATE wali_murid SET 
              nama_wali='$nama',
              kontak='$kontak',
              WHERE id_wali=$id";
    mysqli_query($koneksi, $query);
    header('Location: wali_murid.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Kelas</h2>

        <form method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" id="nama_wali"  required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Nomer Telepon</label>
                <input type="text" name="kontak" class="form-control" id="kontak"  required>
            </div>

            <button type="update" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>