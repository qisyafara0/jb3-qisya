<?php
include 'koneksi.php';

if (isset($_GET['delete'])) {
    $id_siswa = mysqli_real_escape_string($koneksi, $_GET['delete']);
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data siswa berhasil dihapus!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data.');
                window.location.href = 'index.php';
              </script>";
    }
}
?>