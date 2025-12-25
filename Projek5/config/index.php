<?php 
session_start(); // 1. Aktifkan session di baris paling atas 
include "config.php"; 
include "class/database.php"; 
include "class/form.php"; 
// ... (Kode routing sebelumnya) ... 
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/modules/indek'; 
$segments = explode('/', trim($path, '/')); 
$mod = isset($segments[0]) ? $segments[0] : 'home'; 
$page = isset($segments[1]) ? $segments[1] : 'index'; 
// 2. Cek Session Login 
// Halaman yang boleh diakses tanpa login: home, dan modul user (login) 
$public_pages = ['home', 'user'];  
if (!in_array($mod, $public_pages)) { 
// Jika tidak ada session is_login, lempar ke halaman login 
    if (!isset($_SESSION['is_login'])) { 
        header('Location: ' . 'user/login'); // Sesuaikan dengan base url jika perlu 
        exit(); 
    } 
} 
// ... (Kode include template dan file modul) ... 
$file = "modules/{$mod}/{$page}.php"; 
if (file_exists($file)) { 
// Jangan load header/footer jika sedang di halaman login (opsional, agar tampilan bersih) 
    if ($mod == 'user' && $page == 'login') { 
        include $file; 
    } else { 
        include "/views/baka.php"; 
        include $file; 
        include "/views/footer.php";
    } 
} else { 
    echo "Halaman tidak ditemukan."; 
} 
?>