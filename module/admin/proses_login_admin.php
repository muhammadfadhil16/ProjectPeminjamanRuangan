<?php
session_start();
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

$email = $_POST['email'];
$password = $_POST['password'];

// Periksa apakah email dan password sesuai untuk admin
if ($email === 'admin@gmail.com' && $password === 'Admin123!') {
    $_SESSION['id_user'] = 1; // Atur ID admin sesuai dengan database
    $_SESSION['email'] = $email; // Tidak perlu disimpan di session
    $_SESSION['role'] = 'admin'; // Tentukan rolenya sebagai admin

    // Redirect ke dashboard admin
    header("location: " . BASE_URL . "index.php?page=module/admin/dashboard_admin");
    exit();
} else {
    // Jika email atau password tidak sesuai, redirect ke halaman login
    $_SESSION['error_message'] = "Email atau password salah!";
    header("location: " . BASE_URL . "index.php?page=module/admin/login");
    exit();
}
?>
