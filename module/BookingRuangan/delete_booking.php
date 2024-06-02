<?php
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ruangan = $_POST['id_ruangan'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $keperluan = $_POST['keperluan'];

    // Query untuk menghapus data dari tabel peminjaman
    $delete_peminjaman_query = "DELETE FROM Peminjaman 
                                WHERE id_ruangan = '$id_ruangan' 
                                AND tanggal_peminjaman = '$tanggal_peminjaman' 
                                AND jam_mulai = '$jam_mulai' 
                                AND jam_selesai = '$jam_selesai' 
                                AND keperluan = '$keperluan'";

    // Query untuk menghapus data dari tabel riwayat_pemesanan
    $delete_riwayat_query = "DELETE FROM riwayat_pemesanan 
                             WHERE id_ruangan = '$id_ruangan' 
                             AND tanggal_peminjaman = '$tanggal_peminjaman' 
                             AND jam_mulai = '$jam_mulai' 
                             AND jam_selesai = '$jam_selesai' 
                             AND keperluan = '$keperluan'";

    // Eksekusi query
    $peminjaman_deleted = mysqli_query($conn, $delete_peminjaman_query);
    $riwayat_deleted = mysqli_query($conn, $delete_riwayat_query);

    if ($peminjaman_deleted && $riwayat_deleted) {
        header("location: " . BASE_URL . "index.php?page=module/BookingRuangan/riwayat_booking&notif=berhasil");
        exit;
    } else {
        header("location: " . BASE_URL . "index.php?page=module/BookingRuangan/riwayat_booking&notif=gagal");
        exit;
    }
} else {
    header("location: " . BASE_URL . "index.php?page=module/BookingRuangan/riwayat_booking&notif=gagal");
    exit;
}
?>
