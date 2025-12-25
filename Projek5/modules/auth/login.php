<?php
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan OOP $db dari indeks.php
    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $result = $db->query($sql);
    $user = mysqli_fetch_assoc($result);

    // Cek password (menggunakan hash sesuai modul praktikum)
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        
        header('Location: /Projek5/dashboard');
        exit();
    } else {
        $error_message = "Username atau Password salah!";
    }
}
?>

<div id="container" style="margin-top: 50px;">
    <header>
        <h1 style="text-align: center;">LOGIN SYSTEM</h1>
    </header>
    
    <div style="padding: 20px;">
        <?php if ($error_message): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?= $error_message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="submit">
                <input type="submit" value="Masuk ke Sistem" style="width: 100%; cursor: pointer;">
            </div>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 12px; color: #999;">
            Gunakan akun admin untuk masuk
        </p>
    </div>
</div>