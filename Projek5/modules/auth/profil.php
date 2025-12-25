<?php
// Pastikan hanya user login yang bisa lihat profil
if (!isset($_SESSION['is_login'])) {
    header('Location: login');
    exit();
}
?>

<div class="content">
    <header>
        <h2 style="margin-top:0;">Profil Pengguna</h2>
    </header>
    <hr>
    <div class="main-content">
        <table class="main">
            <tr>
                <th width="150">Nama</th>
                <td>: <?= $_SESSION['nama'] ?? 'Belum Login'; ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td>: <?= $_SESSION['username'] ?? '-'; ?></td>
            </tr>
        </table>
        <br>
        <a href="logout" class="btn-tambah" style="background-color: #dc3545; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">Logout</a>
    </div>
</div>