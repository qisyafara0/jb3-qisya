<?php
include "koneksi.php";

if(isset($_POST['submit'])) {
    $nama = $_POST['nama_wali'];
    $kontak = $_POST['kontak'];

    $query = "INSERT INTO wali_murid (nama_wali, kontak) 
              VALUES ('$nama', '$kontak')";
    header('Location: wali_murid.php');

    if(empty($nama) || empty($kontak)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        // Query INSERT
        $query = "INSERT INTO wali_murid (nama_wali, kontak) VALUES ('$nama', '$kontak')";

        // Eksekusi query dan cek error
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location='wali_murid.php';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Wali Murid</h2>

        <form method="POST" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" id="nama_wali" value="<?php echo isset($_POST['nama_wali']) ? htmlspecialchars($_POST['nama_wali']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Nomer Telepon</label>
                <input type="text" name="kontak" class="form-control" id="kontak" value="<?php echo isset($_POST['kontak']) ? htmlspecialchars($_POST['kontak']) : ''; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Tambah Wali Murid</button>
            <a href="wali_murid.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>