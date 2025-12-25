<?php
// 1. Ambil ID
$id = isset($segments[2]) ? $segments[2] : null;

// 2. Ambil data (TIDAK PERLU mysqli_fetch_array lagi)
$data = $db->get('data_barang', "id_barang = '{$id}'");

// 3. Cek apakah data ada
if (!$data) {
    echo "<div class='content'><h3>Error: Data tidak ditemukan!</h3></div>";
    return;
}

// 3. Proses Update jika tombol ditekan
if (isset($_POST['submit'])) {
    $update_data = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga_jual' => $_POST['harga_jual'],
        'harga_beli' => $_POST['harga_beli'],
        'stok' => $_POST['stok']
    ];

    // Cek Gambar
    if ($_FILES['file_gambar']['error'] == 0) {
        $filename = str_replace(' ', '_', $_FILES['file_gambar']['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination)) {
            $update_data['gambar'] = 'gambar/' . $filename;
        }
    }

    if ($db->update('data_barang', $update_data, "id_barang = '{$id}'")) {
        echo "<script>alert('Berhasil diubah!'); window.location='/Projek5/indek';</script>";
        exit();
    }
}
?>

<div class="content">
    <header><h1>Ubah Data Barang</h1></header>
    <div class="main-content">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="input">
                <label>Nama Barang</label>
                <input type="text" name="nama" value="<?= $data['nama']; ?>" required />
            </div>
            <div class="input">
                <label>Kategori</label>
                <select name="kategori">
                    <option value="Komputer" <?= $data['kategori'] == 'Komputer' ? 'selected' : ''; ?>>Komputer</option>
                    <option value="Elektronik" <?= $data['kategori'] == 'Elektronik' ? 'selected' : ''; ?>>Elektronik</option>
                    <option value="Hand Phone" <?= $data['kategori'] == 'Hand Phone' ? 'selected' : ''; ?>>Hand Phone</option>
                </select>
            </div>
            <div class="input">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" value="<?= $data['harga_jual']; ?>" required />
            </div>
            <div class="input">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" value="<?= $data['harga_beli']; ?>" required />
            </div>
            <div class="input">
                <label>Stok</label>
                <input type="number" name="stok" value="<?= $data['stok']; ?>" required />
            </div>
            <div class="input">
                <label>Ganti Gambar</label>
                <input type="file" name="file_gambar" />
            </div>
            <div class="submit">
                <input type="submit" name="submit" value="Update Sekarang" class="btn-tambah" />
                <a href="/Projek5/indek" style="margin-left:10px; text-decoration:none; color:gray;">Batal</a>
            </div>
        </form>
    </div>
</div>