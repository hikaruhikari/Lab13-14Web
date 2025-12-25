<?php
session_start();

// 1. Load Konfigurasi & OOP
include_once("config/database.php");
include_once("config/form.php");
$db = new Database();

// 2. Logika Routing
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/dashboard';
$segments = explode('/', trim($path, '/'));
$mod = isset($segments[0]) && $segments[0] != "" ? $segments[0] : 'dashboard';

// 3. Penentuan Lokasi File
if ($mod == 'dashboard') {
    $file = "dashboard.php"; // Ada di root
} elseif ($mod == 'indek') {
    $file = "modules/indek.php"; // Daftar data barang
} else {
    // Untuk login, logout, profil, dll
    $page = isset($segments[1]) ? $segments[1] : 'index';
    $file = "modules/{$mod}/{$page}.php";
}

// 4. Sistem Keamanan (Session)
$public_pages = ['dashboard', 'auth']; // Halaman bebas akses
if ($mod == 'indek' && !isset($_SESSION['is_login'])) {
    header('Location: /Projek5/auth/login');
    exit();
}

// 5. Eksekusi Tampilan
if (file_exists($file)) {
    // KHUSUS LOGIN & LOGOUT: Tampil polos tanpa navbar baka.php
    if ($mod == 'auth' && ($page == 'login' || $page == 'logout')) {
        include $file;
    } else {
        // DASHBOARD, DATA, & PROFIL: Terhubung ke baka.php dan footer.php
        include "views/baka.php";   
        include $file;              
        include "views/footer.php"; 
    }
} else {
    echo "Halaman tidak ditemukan: " . $file;
}