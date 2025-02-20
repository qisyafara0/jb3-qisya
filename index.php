<?php
include 'koneksi.php';

$query = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali FROM siswa
           LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
           LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Siswa</h2>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="kelas.php" class="btn btn-primary">Kelola Kelas</a>
                <a href="wali_murid.php" class="btn btn-primary">Kelola Wali Murid</a>
            </div>
            <a href="tambah_siswa.php" class="btn btn-success">Tambah Siswa</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Wali Murid</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['jenis_kelamin']; ?></td>
                        <td><?php echo $row['tempat_lahir']; ?></td>
                        <td><?php echo $row['tanggal_lahir']; ?></td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td><?php echo $row['nama_wali']; ?></td>
                        <td>
                            <a href="edit_siswa.php?id=<?php echo $row['id_siswa']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm delete-button" data-id="<?php echo $row['id_siswa']; ?>" data-name="<?php echo $row['nama_siswa']; ?>" data-delete-url="hapus_siswa.php"> Hapus </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data <b id="deleteItemName"></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="#" id="confirmDelete" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let deleteButtons = document.querySelectorAll(".delete-button"); 
            let deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
            let confirmDelete = document.getElementById("confirmDelete");
            let deleteItemName = document.getElementById("deleteItemName");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    let itemId = this.getAttribute("data-id"); // ID yang akan dihapus
                    let itemName = this.getAttribute("data-name"); // Nama item yang akan dihapus
                    let deleteUrl = this.getAttribute("data-delete-url"); // URL untuk hapus

                    deleteItemName.innerText = itemName; // Menampilkan nama di modal
                    confirmDelete.setAttribute("href", deleteUrl + "?delete=" + itemId); // Atur URL hapus

                    deleteModal.show();
                });
            });
        });
    </script>
</body>
</html>