<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
           LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
           LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali 
           WHERE id_siswa=$id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $query = "UPDATE siswa SET 
              nis='$nis',
              nama_siswa='$nama_siswa',
              jenis_kelamin='$jenis_kelamin',
              tempat_lahir='$tempat_lahir',
              tanggal_lahir='$tanggal_lahir',
              id_kelas='$id_kelas',
              id_wali='$id_wali'
              WHERE id_siswa=$id";
    mysqli_query($koneksi, $query);
    header('Location: index.php');
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
                <label for="nis" class="form-label">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" value="<?php echo $row['nis']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?php echo $row['nama_siswa']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" <?php echo ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?php echo $row['tempat_lahir']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo $row['tanggal_lahir']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-control" required>
                    <option value="">Pilih Kelas</option>
                    <?php 
                    $query = "SELECT * FROM kelas"; 
                    $kelas_result = mysqli_query($koneksi, $query);
                    while ($kelas = mysqli_fetch_assoc($kelas_result)) : 
                        $selected = ($kelas['id_kelas'] == $row['id_kelas']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>" <?php echo $selected; ?>>
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
                    $query = "SELECT * FROM wali_murid"; 
                    $wali_result = mysqli_query($koneksi, $query);
                    while ($wali = mysqli_fetch_assoc($wali_result)) : 
                        $selected = ($wali['id_wali'] == $row['id_wali']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $wali['id_wali']; ?>" <?php echo $selected; ?>>
                            <?php echo $wali['nama_wali']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>