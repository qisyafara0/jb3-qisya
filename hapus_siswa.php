<?php
include 'koneksi.php';

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa=$id");
    header('Location: index.php');

    if (mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa=$id")) {
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