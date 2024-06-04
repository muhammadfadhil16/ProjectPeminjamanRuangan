<?php
// Include file koneksi dan helper dengan path yang benar
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

// Pastikan session telah dimulai
session_start();

// Memeriksa jika request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan nilai id_peminjaman dari form
    $id_peminjaman = $_POST['id_peminjaman'];

    // Pastikan variabel $conn sudah terdefinisi
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Menggunakan prepared statement untuk menghapus data dari tabel peminjaman
    $delete_peminjaman_query = "DELETE FROM Peminjaman WHERE id_peminjaman = ?";
    $stmt_peminjaman = mysqli_prepare($conn, $delete_peminjaman_query);
    mysqli_stmt_bind_param($stmt_peminjaman, "i", $id_peminjaman);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt_peminjaman)) {
        header("location: " . BASE_URL . "index.php?page=module/admin/Data_Peminjaman&notif=berhasil");
        exit;
    } else {
        header("location: " . BASE_URL . "index.php?page=module/admin/Data_Peminjaman&notif=gagal");
        exit;
    }
} else {
    header("location: " . BASE_URL . "index.php?page=module/admin/Data_Peminjaman   &notif=gagal");
    exit;
}
?>
