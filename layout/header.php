<?php
// File: header.php

include_once("function/koneksi.php");
include_once("function/helper.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Contoh pengaturan id_user, sesuaikan dengan logika yang sesuai di sistem Anda
$id_user = 0; // Default value jika user belum login

// Simulasi kondisi jika user sudah login
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
}
?>
<style>
    .navbar-brand {
      font-weight: bold;
      color: white;
    }
    
  .navbar-nav .nav-link {
    font-size: 18px; /* Sesuaikan dengan ukuran yang Anda inginkan */
    font-weight: bold;
    color: white;
  }
</style>


  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="<?php echo BASE_URL."index.php?page=module/BookingRuangan/user_bookings"; ?>">BookingRoom</a>
        <a class="nav-link" href="<?php echo BASE_URL."index.php?page=module/BookingRuangan/Riwayat_booking"; ?>">CheckBook</a>
        <a class="nav-link disabled" href="<?php echo BASE_URL."index.php?page=module/user/login"; ?>" tabindex="-1" aria-disabled="true">Logout</a>
      </div>
    </div>
  </div>
</nav>
