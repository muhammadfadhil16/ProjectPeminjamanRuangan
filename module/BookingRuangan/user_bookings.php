<h1>Book a Room</h1>
<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

<table>
    <thead>
        <tr>
            <th>Nama Ruangan</th>
            <th>Kapasitas</th>
            <th>Notifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_ruangan = "SELECT * FROM ruangan";
        $result_ruangan = mysqli_query($conn, $query_ruangan);
        while ($row_ruangan = mysqli_fetch_assoc($result_ruangan)) {
            $ruangan_id = $row_ruangan['id_ruangan'];

            // Cek apakah ada peminjaman pada waktu yang dipilih
            $peminjaman_query = mysqli_query($conn, "SELECT * FROM Peminjaman WHERE id_ruangan = $ruangan_id AND tanggal_peminjaman = CURDATE() AND jam_mulai = '09:00:00' AND jam_selesai = '11:00:00'");
            $sudah_dipinjam = mysqli_num_rows($peminjaman_query) > 0;

            // Tampilkan informasi ruangan dan notifikasi
            echo '<tr>';
            echo '<td>' . $row_ruangan['nama_ruangan'] . '</td>';
            echo '<td>' . $row_ruangan['kapasitas'] . '</td>';
            echo '<td>';
            if ($sudah_dipinjam) {
                echo 'Kelas Sudah Dipinjam';
            } else {
                echo 'Tersedia';
            }
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<h2>Pilih Ruangan dan Waktu Peminjaman</h2>
<form action="<?php echo BASE_URL."module/BookingRuangan/proses_booking.php";?>" method="POST">
    <label for="room">Pilih Ruangan:</label>
    <select name="room_id" id="room" required>
        <?php
        $query_ruangan = "SELECT * FROM ruangan";
        $result_ruangan = mysqli_query($conn, $query_ruangan);
        while ($row_ruangan = mysqli_fetch_assoc($result_ruangan)) {
            echo '<option value="' . $row_ruangan['id_ruangan'] . '">' . $row_ruangan['nama_ruangan'] . '</option>';
        }
        ?>
    </select>
    <input type="hidden" value="<?php echo $id_user;?>" name="id_user">
    <label for="date">Tanggal Peminjaman:</label>
    <input type="date" name="tanggal_peminjaman" id="date" required>
    <label for="start">Jam Mulai:</label>
    <input type="time" name="jam_mulai" id="start" required>
    <label for="end">Jam Selesai:</label>
    <input type="time" name="jam_selesai" id="end" required>
    <label for="keperluan">Keperluan:</label>
    <input type="text" name="keperluan" id="keperluan" required>
    <button type="submit" name="submit">Book Room</button>
</form>
