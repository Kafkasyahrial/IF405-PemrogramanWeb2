<?php
// Mengaktifkan pelaporan eror agar tidak blank putih
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama   = $_POST['nama_perangkat'];
    $jenis  = $_POST['jenis'];
    $ip     = $_POST['ip_address'];
    $lokasi = $_POST['lokasi'];

    // Ketentuan 4: Menggunakan Prepared Statement untuk keamanan
    $query = "INSERT INTO perangkat (nama_perangkat, jenis, ip_address, lokasi) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    
    if ($stmt) {
        // "ssss" artinya ada 4 data string: nama, jenis, ip, lokasi
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $jenis, $ip, $lokasi);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: index.php?pesan=ditambahkan");
            exit();
        } else {
            // Ketentuan 3: Tampilkan pesan error jika query gagal
            die("Gagal mengeksekusi query: " . mysqli_stmt_error($stmt));
        }
    } else {
        die("Gagal menyiapkan (prepare) statement: " . mysqli_error($koneksi));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Perangkat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5" style="max-width: 600px;">
    <h2>Tambah Perangkat Baru</h2>
    <form action="" method="POST" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Nama Perangkat</label>
            <input type="text" name="nama_perangkat" class="form-control" required placeholder="Contoh: Juniper MX204">
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <input type="text" name="jenis" class="form-control" required placeholder="Contoh: Router / Switch">
        </div>
        <div class="mb-3">
            <label class="form-label">IP Address</label>
            <input type="text" name="ip_address" class="form-control" required placeholder="Contoh: 10.10.10.1">
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required placeholder="Contoh: Core Room">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>