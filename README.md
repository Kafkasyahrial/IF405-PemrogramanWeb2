# Tugas Proyek - Pemrograman Web II
**Judul Proyek:** Membuat Aplikasi Mini CRUD Menggunakan mysqli
**Nama Aplikasi:** Inventaris Perangkat Jaringan (inventory-web)

---

## 1. Penjelasan Style MySQLi yang Digunakan
Proyek ini menggunakan **MySQLi Procedural Style**. Kesederhanaan sintaksisnya yang berbasis fungsi langsung (`mysqli_connect`, `mysqli_query`, dll) sangat efisien untuk aplikasi skala mini karena meminimalkan overhead penulisan kode jika dibandingkan dengan Object-Oriented Style.

## 2. Struktur Database
* **Nama Database:** `db_kampus`
* **Nama Tabel:** `perangkat`
* **Detail Kolom:**
  * `id` (INT, Primary Key, Auto Increment): ID unik perangkat.
  * `nama_perangkat` (VARCHAR 100): Model hardware perangkat jaringan.
  * `jenis` (VARCHAR 50): Kategori perangkat (e.g., Router, Switch).
  * `ip_address` (VARCHAR 50): IP Management perangkat.
  * `lokasi` (VARCHAR 100): Lokasi fisik penempatan perangkat.

## 3. Alur Kerja Aplikasi
**Koneksi Sistem (`koneksi.php`):** Menginisialisasi koneksi ke MySQL. Jika gagal, fungsi `mysqli_connect_error()` akan memicu pesan error secara informatif dan menghentikan skrip.
**Menampilkan Data & Penghapusan (`index.php`):** Menampilkan record data dari tabel ke HTML berbasis Bootstrap 5. Halaman ini juga menangani fitur hapus (Delete) berdasarkan ID parameter.
**Penambahan Data (`tambah.php`):** Input data baru diproses menggunakan **Prepared Statement** (`mysqli_prepare` & `mysqli_stmt_bind_param`) untuk memblokir celah keamanan *SQL Injection*.
**Pengubahan Data (`edit.php`):** Memuat data lama ke form pengeditan lalu memperbaruinya ke database menggunakan *Prepared Statement* demi menjaga keamanan data.

---

## 4. Prepared statement untuk keamanan Program
**Pada tambah.php saya menahmbahkan pada file (`tambah.php`)
// 1. Terdapat query dengan tanda tanya (?) sebagai placeholder (bukan langsung variabel)

    $query = "INSERT INTO perangkat (nama_perangkat, jenis, ip_address, lokasi) VALUES (?, ?, ?, ?)";

// 2. Fungsi menginisialisasi atau menyiapkan struktur query ke server

    $stmt = mysqli_prepare($koneksi, $query);

// 3. Fungsi mengikat/memasukkan data asli ke dalam tanda tanya (?) secara aman

    mysqli_stmt_bind_param($stmt, "ssss", $nama, $jenis, $ip, $lokasi);

// 4. Fungsi mengeksekusi query yang sudah aman dari SQL Injection

    mysqli_stmt_execute($stmt);

## 5. Screenshot Hasil Program
<img width="1270" height="686" alt="image" src="https://github.com/user-attachments/assets/8fb8e8e4-38ef-4682-84b1-25d3f7ac11d1" />
<img width="1272" height="684" alt="image" src="https://github.com/user-attachments/assets/d668e82c-853d-4a8d-b684-1e34d3bf9613" />

Jika erorr:
saya mengubah:

    $query = "INSERT INTO perangkat (nama_perangkat, jenis, ip_address, lokasi) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    
Menjadi:

    $query = "INSERT INTO perangkat_rusak (nama_perangkat, jenis, ip_address, lokasi) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);

Dan akan muncul eror ketika menambahkan perangkat sebagai berikut:
<img width="1272" height="442" alt="image" src="https://github.com/user-attachments/assets/9c236f0b-142b-4164-a2f2-50b110702909" />


## 6. Kode Mysql di phpmyadmin
Karena disini saya testing dengan xampp dan phpmyadmin bawaan saya menambhakan database dengan query berikut:

```sql
CREATE DATABASE IF NOT EXISTS db_kampus;
USE db_kampus;

CREATE TABLE IF NOT EXISTS perangkat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_perangkat VARCHAR(100) NOT NULL,
    jenis VARCHAR(50) NOT NULL,
    ip_address VARCHAR(50) NOT NULL,
    lokasi VARCHAR(100) NOT NULL
);
