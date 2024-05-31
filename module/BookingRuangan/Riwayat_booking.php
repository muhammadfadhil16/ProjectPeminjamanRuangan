<?php
include_once("function/koneksi.php");
include_once("function/helper.php");

// Memeriksa apakah pengguna telah login
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;

if (!$id_user) {
    header("Location: login.php");
    exit;
}

// Mendapatkan riwayat pemesanan dari database
$query = "SELECT r.nama_ruangan, rp.tanggal_peminjaman, rp.jam_mulai, rp.jam_selesai, rp.keperluan
          FROM riwayat_pemesanan rp
          JOIN ruangan r ON rp.id_ruangan = r.id_ruangan
          WHERE rp.id_user = $id_user
          ORDER BY rp.tanggal_peminjaman DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS Anda -->
</head>
<body>
    <h1>Riwayat Pemesanan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Ruangan</th>
                <th>Tanggal Peminjaman</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['nama_ruangan']; ?></td>
                        <td><?php echo $row['tanggal_peminjaman']; ?></td>
                        <td><?php echo $row['jam_mulai']; ?></td>
                        <td><?php echo $row['jam_selesai']; ?></td>
                        <td><?php echo $row['keperluan']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada riwayat pemesanan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="<?php echo BASE_URL."index.php?page=home"; ?>"><button style="border-radius: 12px;">Kembali</button></a>
</body>
</html>

<?php mysqli_close($conn); ?>
