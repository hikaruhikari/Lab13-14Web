<?php
// --- 1. PENGATURAN PAGING & SEARCH ---
$q = isset($_GET['q']) ? $_GET['q'] : ''; // Ambil kata kunci pencarian
$per_page = 3; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page <= 0) $page = 1;
$offset = ($page - 1) * $per_page;

// --- 2. QUERY SQL (Sesuai Modul 14: Search) ---
$sql_where = "";
if (!empty($q)) {
    $sql_where = " WHERE nama LIKE '%{$q}%'";
}

// --- 3. HITUNG TOTAL DATA (Sesuai Modul 13: Pagination) ---
$sql_count = "SELECT COUNT(*) as total FROM data_barang" . $sql_where;
$res_count = $db->query($sql_count);
$data_count = mysqli_fetch_assoc($res_count);
$total_data = $data_count['total'];
$num_page = ceil($total_data / $per_page);

// --- 4. AMBIL DATA DENGAN LIMIT (Pagination) ---
$sql = "SELECT * FROM data_barang" . $sql_where . " LIMIT {$offset}, {$per_page}";
$result = $db->query($sql);
?>

<div class="content-wrapper">
    <header><h1>Data Barang</h1></header>
    
    <div class="main-content">
        <form method="get" action="" style="margin-bottom: 20px;">
            <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari nama barang..." style="padding: 8px; width: 200px;">
            <input type="submit" value="Cari" class="btn-tambah" style="padding: 8px 15px;">
            <?php if(!empty($q)): ?>
                <a href="/Projek4/indek" style="margin-left:10px; text-decoration:none; color:red;">Reset</a>
            <?php endif; ?>
        </form>

        <a href="user/tambah" class="btn-tambah">Tambah Barang</a>
        
        <table class="main" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result && mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><img src="modules/user/<?= $row['gambar'];?>" alt="img" style="width: 50px;"></td>
                            <td><?= $row['nama'];?></td>
                            <td><?= $row['kategori'];?></td>
                            <td><?= number_format($row['harga_jual'], 0, ',', '.');?></td>
                            <td><?= $row['stok'];?></td>
                            <td>
                                <a href="user/ubah/<?= $row['id_barang']; ?>">Ubah</a> |
                                <a href="user/hapus/<?= $row['id_barang']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">Data tidak ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination" style="margin-top: 20px; text-align: center;">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1; ?>&q=<?= $q; ?>">&laquo; Previous</a>
            <?php endif; ?>

            <?php for ($i=1; $i <= $num_page; $i++): ?>
                <a href="?page=<?= $i; ?>&q=<?= $q; ?>" class="<?= ($page == $i) ? 'active' : ''; ?>" style="padding: 5px 10px; text-decoration: none; border: 1px solid #ccc; margin: 0 2px;">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $num_page): ?>
                <a href="?page=<?= $page + 1; ?>&q=<?= $q; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</div>