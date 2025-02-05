<?php
include "koneksi.php";

if(isset($_POST['submit'])) {
    $nama = $_POST['nama_kelas'];
    
    $query = "INSERT INTO kelas (nama_kelas) 
              VALUES ('$nama')";
    mysqli_query($koneksi, $query);
    header('Location: kelas.php');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Kelas</h2>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Tambah Kelas</button>
            <a href="kelas.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>