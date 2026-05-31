<?php 
include 'koneksi.php'; 

// Fitur Delete (Langsung diproses di sini agar hemat file)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM perangkat WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=dihapus");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>CRUD Inventaris Jaringan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Inventaris Perangkat</h2>
        <a href="tambah.php" class="btn btn-primary">+ Tambah Perangkat</a>
    </div>

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success">Data berhasil <?php echo $_GET['pesan']; ?>!</div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Perangkat</th>
                <th>Jenis</th>
                <th>IP Address</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ketentuan 2: Menampilkan data dari database
            $query = "SELECT * FROM perangkat";
            $result = mysqli_query($koneksi, $query);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_perangkat']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['ip_address']}</td>
                        <td>{$row['lokasi']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='index.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>