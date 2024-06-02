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
$query = "SELECT r.nama_ruangan, rp.id_ruangan, rp.tanggal_peminjaman, rp.jam_mulai, rp.jam_selesai, rp.keperluan
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
    <style>
        /* Resetting default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-scroll {
            max-height: 400px; /* Ubah ketinggian maksimum sesuai kebutuhan */
            overflow-y: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #002d72;
            color: #fff;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e0e0e0;
        }

        .btn {
            padding: 8px 16px;
            background-color: #002d72;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #001a3d;
        }

        @media screen and (max-width: 768px) {
            .card {
                width: 90%;
            }

            .table-scroll {
                max-height: 300px; /* Ubah ketinggian maksimum sesuai kebutuhan */
            }
        }
    </style>
</head>
<body>
    <section class="intro">
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
    <a href="<?= BASE_URL . "index.php?page=home"; ?>"><button class="btn" style="border-radius: 12px;">Kembali</button></a>
</body>
</html>

<?php mysqli_close($conn); ?>
