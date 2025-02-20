<?php
include 'koneksi.php';


$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$search_query = ($search != '') ? "WHERE nama_wali LIKE '%$search%'" : '';

$query = "SELECT * FROM wali_murid $search_query";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Wali Murid</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="index.php" class="btn btn-primary">Kembali ke Data Siswa</a>
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari wali murid..." value="<?php echo $search; ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
            <a href="tambah_wali.php" class="btn btn-success">Tambah Wali Murid</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Wali</th>
                    <th>Nama Wali</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['id_wali']; ?></td>
                    <td><?php echo $row['nama_wali']; ?></td>
                    <td><?php echo $row['kontak']; ?></td>
                    <td>
                        <a href="edit_wali.php?id=<?php echo $row['id_wali']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm delete-button" data-id="<?php echo $row['id_wali']; ?>" data-name="<?php echo $row['nama_wali']; ?>" data-delete-url="hapus_wali.php"> Hapus </a>
                        
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Modal Konfirmasi Hapus -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
