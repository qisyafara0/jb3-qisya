<?php
include "koneksi.php";

if(isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $query = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, id_wali) 
              VALUES ('$nis', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$id_wali' )";
    mysqli_query($koneksi, $query);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Tambah Siswa</h2>
        
        <form method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
                <label for="NIS" class="form-label">NIS</label>
                <input type="text" name="NIS" id="NIS" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-control" required>
                    <option value="">Pilih Kelas</option>
                    <?php 
                    // Pastikan $koneksi sudah terkoneksi ke database
                    $query = "SELECT * FROM kelas"; 
                    $kelas_result = mysqli_query($koneksi, $query);

                    while ($kelas = mysqli_fetch_assoc($kelas_result)) : ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>">
                            <?php echo $kelas['nama_kelas']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_wali" class="form-label">Wali Murid</label>
                <select name="id_wali" id="id_wali" class="form-control" required>
                    <option value="">Pilih Wali Murid</option>
                    <?php 
                    // Pastikan $koneksi sudah terkoneksi ke database
                    $query = "SELECT * FROM wali_murid"; 
                    $wali_result = mysqli_query($koneksi, $query);

                    while ($wali = mysqli_fetch_assoc($wali_result)) : ?>
                        <option value="<?php echo $wali['id_wali']; ?>">
                            <?php echo $wali['nama_wali']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Tambah siswa</button>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>