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
$query = "SELECT nama_ruangan, id_ruangan, tanggal_peminjaman, jam_mulai, jam_selesai, keperluan
          FROM riwayat_peminjaman_view
          WHERE id_user = $id_user
          ORDER BY tanggal_peminjaman DESC";

$result = mysqli_query($conn, $query);
?>

    <title>Riwayat Pemesanan</title>
    <style>
        /* Menambahkan padding-top untuk menghindari tumpang tindih dengan header */
        body {
            padding-top: 70px;
         /* Sesuaikan nilai ini dengan tinggi header Anda */
        }
    </style>

    <section class="intro" style="padding-top: 70px;">
        <div class="container">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Ruangan</th>
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Keperluan</th>
                                    <th scope="col">Action</th>
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
                                            <td>
                                                <form action="<?= BASE_URL ?>/module/BookingRuangan/delete_booking.php" method="POST">
                                                    <input type="hidden" name="id_ruangan" value="<?= $row['id_ruangan']; ?>">
                                                    <input type="hidden" name="tanggal_peminjaman" value="<?= $row['tanggal_peminjaman']; ?>">
                                                    <input type="hidden" name="jam_mulai" value="<?= $row['jam_mulai']; ?>">
                                                    <input type="hidden" name="jam_selesai" value="<?= $row['jam_selesai']; ?>">
                                                    <input type="hidden" name="keperluan" value="<?= $row['keperluan']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">Tidak ada riwayat pemesanan.</td>
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
