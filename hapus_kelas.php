<?php
include 'koneksi.php';

if (isset($_GET['delete'])) {
    $id_kelas = mysqli_real_escape_string($koneksi, $_GET['delete']);

    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'kelas.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data.');
                window.location.href = 'kelas.php';
              </script>";
    }
}
?>
