<?php
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

    $id_user = $_POST['id_user'];
    $room_id = $_POST['room_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $keperluan = $_POST['keperluan'];

    // Lakukan validasi data (contoh: pastikan jam_mulai < jam_selesai, dll.)

    // Simpan data peminjaman ke database
    mysqli_query($conn, "INSERT INTO riwayat_pemesanan (id_ruangan, id_user, tanggal_peminjaman, jam_mulai, jam_selesai, keperluan) VALUES ('$room_id','$id_user', '$tanggal_peminjaman', '$jam_mulai', '$jam_selesai', '$keperluan')");

    header("location: ".BASE_URL."index.php?page=module/BookingRuangan/Riwayat_booking");
?>
