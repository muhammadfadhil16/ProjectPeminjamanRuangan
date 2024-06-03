<?php
include_once("../function/koneksi.php");
include_once("../function/helper.php");

// Memeriksa apakah admin telah login
$id_admin = isset($_SESSION['id_admin']) ? $_SESSION['id_admin'] : false;

if (!$id_admin) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['id_peminjaman'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $query = "CALL hapus_peminjaman(?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_peminjaman);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: admin_booking.php");
    } else {
        echo "Gagal menghapus peminjaman.";
    }
}
?>

<?php mysqli_close($conn); ?>
