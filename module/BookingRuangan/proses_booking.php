<?php
include_once("../../function/koneksi.php");
include_once("../../function/helper.php");

session_start();

$id_user = $_POST['id_user'];
$room_id = $_POST['room_id'];
$tanggal_peminjaman = $_POST['tanggal_peminjaman'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$keperluan = $_POST['keperluan'];

// Validasi data (contoh: pastikan jam_mulai < jam_selesai, dll.)
if (strtotime($jam_mulai) >= strtotime($jam_selesai)) {
    header("location: ".BASE_URL."index.php?page=module/BookingRuangan/user_bookings&notif=jam");
    exit;
}

// Validasi waktu peminjaman berada dalam rentang 07:00 - 00:00
$jam_awal_valid = strtotime('07:00:00');
$jam_akhir_valid = strtotime('00:00:00');
$jam_mulai_time = strtotime($jam_mulai);
$jam_selesai_time = strtotime($jam_selesai);

if ($jam_mulai_time < $jam_awal_valid || $jam_selesai_time > $jam_akhir_valid) {
    header("location: ".BASE_URL."index.php?page=module/BookingRuangan/user_bookings&notif=jam_invalid");
    exit;
}

// Cek ketersediaan ruangan
$check_query = "SELECT * FROM Peminjaman 
                WHERE id_ruangan = '$room_id' 
                AND tanggal_peminjaman = '$tanggal_peminjaman' 
                AND (
                    (jam_mulai < '$jam_selesai' AND jam_selesai > '$jam_mulai') OR
                    ('$jam_mulai' < jam_selesai AND '$jam_selesai' > jam_mulai)
                )";

$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    header("location: ".BASE_URL."index.php?page=module/BookingRuangan/user_bookings&notif=tidaktersedia");
    exit;
}

// Simpan data peminjaman ke database
$insert_peminjaman_query = "INSERT INTO Peminjaman (id_ruangan, id_user, tanggal_peminjaman, jam_mulai, jam_selesai, keperluan) 
                            VALUES ('$room_id','$id_user', '$tanggal_peminjaman', '$jam_mulai', '$jam_selesai', '$keperluan')";

$insert_riwayat_query = "INSERT INTO riwayat_pemesanan (id_ruangan, id_user, tanggal_peminjaman, jam_mulai, jam_selesai, keperluan) 
                         VALUES ('$room_id','$id_user', '$tanggal_peminjaman', '$jam_mulai', '$jam_selesai', '$keperluan')";

if (mysqli_query($conn, $insert_peminjaman_query) && mysqli_query($conn, $insert_riwayat_query)) {
    header("location: ".BASE_URL."index.php?page=module/BookingRuangan/user_bookings&notif=berhasil");
} else {
    header("location: ".BASE_URL."index.php?page=module/BookingRuangan/user_bookings&notif=gagal");
}

mysqli_close($conn);
exit;
?>
