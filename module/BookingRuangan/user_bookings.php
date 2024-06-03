<?php
include_once("function/koneksi.php");
include_once("function/helper.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memeriksa apakah pengguna telah login
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : false;

if (!$id_user) {
    header("Location: login.php");
    exit;
}

// Mendapatkan riwayat pemesanan dari database
$query = "SELECT r.nama_ruangan, r.kapasitas FROM ruangan r ORDER BY r.nama_ruangan";
$result = mysqli_query($conn, $query);

$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
$message = '';

switch($notif) {
    case 'berhasil':
        $message = 'Peminjaman berhasil!';
        break;
    case 'tidaktersedia':
        $message = 'Ruangan tidak tersedia pada waktu yang dipilih.';
        break;
    case 'jam':
        $message = 'Jam mulai harus lebih awal daripada jam selesai.';
        break;
    case 'jam_invalid':
        $message = 'Waktu peminjaman hanya dapat dilakukan dari jam 7 pagi hingga jam 5 sore.';
        break;
    case 'gagal':
        $message = 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS Anda -->
    <link rel="stylesheet" href="booking_ruangan.css"> <!-- Link ke file CSS khusus -->
</head>
<body>
    <div class="container text-align-center">
        <h1>Peminjaman Ruangan Fakultas Teknik</h1>
        <div id="notification" class="notification"></div> <!-- Elemen notifikasi -->

        <label for="capacityFilter">Filter berdasarkan kapasitas:</label>
        <select id="capacityFilter" onchange="filterRooms()">
            <option value="all">Semua Kapasitas</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody id="roomTable">
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr class="room-item" data-capacity="<?php echo $row['kapasitas']; ?>">
                                        <td><?php echo htmlspecialchars($row['nama_ruangan']); ?></td>
                                        <td><?php echo htmlspecialchars($row['kapasitas']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Tidak ada ruangan yang tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2>Pilih Ruangan dan Waktu Peminjaman</h2>
        <form id="bookingForm" action="<?php echo BASE_URL . "module/BookingRuangan/proses_booking.php"; ?>" method="POST" onsubmit="return validateBookingTime()">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="room">Pilih Ruangan:</label>
                    <select name="room_id" id="room" class="form-control" required>
                        <?php
                        $query_ruangan = "SELECT * FROM ruangan";
                        $result_ruangan = mysqli_query($conn, $query_ruangan);
                        while ($row_ruangan = mysqli_fetch_assoc($result_ruangan)) {
                            echo '<option value="' . htmlspecialchars($row_ruangan['id_ruangan']) . '">' . htmlspecialchars($row_ruangan['nama_ruangan']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="date">Tanggal Peminjaman:</label>
                    <input type="date" name="tanggal_peminjaman" id="date" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start">Jam Mulai:</label>
                    <input type="time" name="jam_mulai" id="start" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="end">Jam Selesai:</label>
                    <input type="time" name="jam_selesai" id="end" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="keperluan">Keperluan:</label>
                <input type="text" name="keperluan" id="keperluan" class="form-control" required>
            </div>
            <div class="form-group container-fluid d-flex justify-content-center my-3" >
                <button type="submit" name="submit" class="btn btn-primary" style="width: 50%;">Book Room</button>
            </div>
        </form>
    </div>

    <script>
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.className = 'notification ' + type + ' show';
            notification.innerHTML = message;
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000); // Hapus notifikasi setelah 3 detik
        }

        // Display notifications based on PHP GET parameters
        <?php if ($notif) { ?>
            showNotification('<?php echo $message; ?>', '<?php echo $notif == 'tidaktersedia' || $notif == 'jam' || $notif == 'gagal' ? 'error' : 'success'; ?>');
        <?php } ?>

        function filterRooms() {
            const filter = document.getElementById('capacityFilter').value;
            const rows = document.querySelectorAll('.room-item');
            rows.forEach(row => {
                const capacity = row.getAttribute('data-capacity');
                if (filter === 'all' || filter === capacity) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Validasi waktu di sisi klien
        function validateBookingTime() {
            const jamMulai = document.getElementById('start').value;
            const jamSelesai = document.getElementById('end').value;

            const jamMulaiTime = new Date('1970-01-01T' + jamMulai);
            const jamSelesaiTime = new Date('1970-01-01T' + jamSelesai);
            const jamAwalValid = new Date('1970-01-01T07:00:00');
            const jamAkhirValid = new Date('1970-01-01T17:00:00');

            if (jamMulaiTime < jamAwalValid || jamSelesaiTime > jamAkhirValid) {
                showNotification("Waktu peminjaman hanya dapat dilakukan dari jam 7 pagi hingga jam 5 sore.", 'error');
                return false;
            }

            return true;
        }

        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            if (!validateBookingTime()) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>

<?php mysqli_close($conn); ?>
