<?php
include 'koneksi.php';

$id = $_GET['id'];
// Ambil data lama untuk ditaruh di form
$query_data = mysqli_query($koneksi, "SELECT * FROM perangkat WHERE id = $id");
$data = mysqli_fetch_assoc($query_data);

if (isset($_POST['update'])) {
    $nama   = $_POST['nama_perangkat'];
    $jenis  = $_POST['jenis'];
    $ip     = $_POST['ip_address'];
    $lokasi = $_POST['lokasi'];

    // Ketentuan 4: Menggunakan Prepared Statement untuk keamanan
    $stmt = mysqli_prepare($koneksi, "UPDATE perangkat SET nama_perangkat=?, jenis=?, ip_address=?, lokasi=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $jenis, $ip, $lokasi, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?pesan=diubah");
    } else {
        echo "Gagal mengubah data: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Perangkat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5" style="max-width: 600px;">
    <h2>Edit Data Perangkat</h2>
    <form action="" method="POST" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Nama Perangkat</label>
            <input type="text" name="nama_perangkat" class="form-control" value="<?php echo $data['nama_perangkat']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" name="jenis" class="form-control" value="<?php echo $data['jenis']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">IP Address</label>
            <input type="text" name="ip_address" class="form-control" value="<?php echo $data['ip_address']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="<?php echo $data['lokasi']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>