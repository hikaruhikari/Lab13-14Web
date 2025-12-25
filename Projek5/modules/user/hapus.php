<?php
// 1. Ambil ID dari URL segment ke-2 (user/hapus/ID)
// Variabel $segments sudah tersedia karena file ini di-include oleh indeks.php
$id = isset($segments[2]) ? $segments[2] : null;

if ($id) {
    $filter = "id_barang = '{$id}'"; 

    // 2. Eksekusi hapus menggunakan method delete dari class Database
    if ($db->delete('data_barang', $filter)) {
        // Berhasil, balik ke halaman daftar barang
        header('Location: /Projek5/indek');
        exit();
    } else {
        die("Gagal menghapus data dari database.");
    }
} else {
    die("Error: ID tidak ditemukan di URL.");
}
?>