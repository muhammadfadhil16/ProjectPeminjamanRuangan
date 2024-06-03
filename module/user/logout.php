<?php
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

session_start();

// Menghapus semua sesi
session_destroy();

// Redirect ke halaman login
header("Location: " . BASE_URL . "/index.php?page=module/user/login");
exit;
?>