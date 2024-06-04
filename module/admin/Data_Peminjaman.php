<?php
include_once("function/koneksi.php");
include_once("function/helper.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memeriksa apakah admin telah login
$id_admin = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;

if (!$id_admin) {
    header("Location: login_admin.php");
    exit;
}

// Mendefinisikan fungsi hitung_durasi
function hitung_durasi($jam_mulai, $jam_selesai) {
    // Menghitung durasi peminjaman berdasarkan jam mulai dan jam selesai
    $start = strtotime($jam_mulai);
    $end = strtotime($jam_selesai);

    $diff = $end - $start;
    $jam = floor($diff / (60 * 60));
    $menit = floor(($diff - ($jam * 60 * 60)) / 60);

    return $jam . " jam " . $menit . " menit";
}

// Mendapatkan filter dari request
$filter_ruangan = isset($_GET['filter_ruangan']) ? $_GET['filter_ruangan'] : '';
$filter_tanggal = isset($_GET['filter_tanggal']) ? $_GET['filter_tanggal'] : '';

// Menyusun query untuk filter
$query = "SELECT u.email as nama_user, r.nama_ruangan, rp.id_peminjaman, rp.tanggal_peminjaman, rp.jam_mulai, rp.jam_selesai, rp.keperluan,
          (SELECT COUNT(*) FROM peminjaman p WHERE p.id_ruangan = r.id_ruangan) as total_peminjaman,
          TIMESTAMPDIFF(HOUR, rp.jam_mulai, rp.jam_selesai) as durasi_jam,
          CASE
              WHEN TIMESTAMPDIFF(HOUR, rp.jam_mulai, rp.jam_selesai) > 2 THEN '> 2 Jam'
              ELSE '<= 2 Jam'
          END as durasi_kategori
          FROM peminjaman rp
          JOIN ruangan r ON rp.id_ruangan = r.id_ruangan
          JOIN user u ON rp.id_user = u.id_user";

if ($filter_ruangan) {
    $query .= " WHERE r.nama_ruangan LIKE '%$filter_ruangan%'";
}

if ($filter_tanggal) {
    $query .= $filter_ruangan ? " AND" : " WHERE";
    $query .= " rp.tanggal_peminjaman = '$filter_tanggal'";
}

$query .= " ORDER BY rp.tanggal_peminjaman DESC";

$result = mysqli_query($conn, $query);
?>

<style>
    body {
        padding-top: 70px;
    }
</style>

<section class="intro">
    <div class="container">
        <div class="card">
            <div class="card-body p-0">
                <form method="GET" action="">
                    <input type="text" name="filter_ruangan" placeholder="Filter Ruangan" value="<?= $filter_ruangan ?>">
                    <input type="date" name="filter_tanggal" value="<?= $filter_tanggal ?>">
                    <button type="submit">Filter</button>
                </form>
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Nama User</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Tanggal Peminjaman</th>
                                <th scope="col">Jam Mulai</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Durasi (jam)</th>
                                <th scope="col">Durasi Kategori</th>
                                <th scope="col">Keperluan</th>
                                <th scope="col">Total Peminjaman</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['nama_user']; ?></td>
                                        <td><?php echo $row['nama_ruangan']; ?></td>
                                        <td><?php echo $row['tanggal_peminjaman']; ?></td>
                                        <td><?php echo $row['jam_mulai']; ?></td>
                                        <td><?php echo $row['jam_selesai']; ?></td>
                                        <td><?php echo hitung_durasi($row['jam_mulai'], $row['jam_selesai']); ?></td>
                                        <td><?php echo $row['durasi_kategori']; ?></td>
                                        <td><?php echo $row['keperluan']; ?></td>
                                        <td><?php echo $row['total_peminjaman']; ?></td>
                                        <td>
                                            <form action="<?php echo BASE_URL."/module/admin/delete_booking_admin.php"; ?>" method="POST">
                                                <input type="hidden" name="id_peminjaman" value="<?= $row['id_peminjaman']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">Tidak ada peminjaman.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php mysqli_close($conn); ?>
