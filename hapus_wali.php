<?php
include 'koneksi.php';

if (isset($_GET['delete'])) {
    $id_wali = mysqli_real_escape_string($koneksi, $_GET['delete']);
    $query = "DELETE FROM wali_murid WHERE id_wali = '$id_wali'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data wali murid berhasil dihapus!');
                window.location.href = 'wali_murid.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data.');
                window.location.href = 'wali_murid.php';
              </script>";
    }
}
?>
