<?php
// Jika user menekan tombol "Ya, Keluar"
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    session_destroy();
    header('Location: /Projek5/auth/login');
    exit();
}
?>

<div id="container" style="margin-top: 50px; text-align: center;">
    <header>
        <h1>KONFIRMASI</h1>
    </header>
    <div style="padding: 30px;">
        <div style="font-size: 50px; margin-bottom: 10px;">👋</div>
        <h3>Halo, <?= $_SESSION['nama'] ?></h3>
        <p>Apakah Anda yakin ingin mengakhiri sesi ini dan keluar?</p>
        
        <div style="margin-top: 30px; display: flex; gap: 10px; justify-content: center;">
            <a href="logout?confirm=yes" style="background: #dc3545; color: white; padding: 10px 25px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Ya, Keluar
            </a>
            <a href="/Projek4/dashboard" style="background: #6c757d; color: white; padding: 10px 25px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Batal
            </a>
        </div>
    </div>
</div>