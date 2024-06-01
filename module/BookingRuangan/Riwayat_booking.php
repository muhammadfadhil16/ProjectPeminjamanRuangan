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
    <style>
        button[type="submit"] {
        margin-top: 20px;
        padding: 10px;
        border: none;
        background-color: #002d72;
        color: #fff;
        cursor: pointer;
        }

        button[type="submit"]:hover {
        background-color: #001a3d;
        }
        /* General styles */
        html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        }

        /* Intro section */
        .intro {
        background-color: #f5f7fa;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .mask {
        position: relative;
        width: 100%;
        }

        .container {
        max-width: 1200px;
        padding: 20px;
        }

        .card {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-scroll {
        max-height: 400px;
        overflow-y: auto;
        }

        /* Table styles */
        .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 0.5rem;
        overflow: hidden;
        }

        .table th,
        .table td {
        padding: 12px;
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        }

        .table th {
        background-color: #002d72;
        color: #fff;
        }

        .table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
        }

        .table tbody tr:hover {
        background-color: #e9ecef;
        }

        /* Responsive styles */
        @media only screen and (max-width: 768px) {
        .container {
        padding: 10px;
        }

        .table-scroll {
        max-height: 300px;
        }
        }

    </style>
</head>
<body>
    <section class="intro">
      <div class="bg-image h-100" style="background-color: #f5f7fa;">
        <div class="mask d-flex align-items-center h-100">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                      <table class="table table-striped mb-0">
                        <thead style="background-color: #002d72;">
                          <tr>
                            <th scope="col">Nama Ruangan</th>
                            <th scope="col">Tanggal Peminjaman</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Keperluan</th>
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <a href="<?php echo BASE_URL."index.php?page=home"; ?>"><button type="submit" style="border-radius: 12px;">Kembali</button></a>
</body>
</html>

<?php mysqli_close($conn); ?>
