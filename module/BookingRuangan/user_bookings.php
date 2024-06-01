<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS Anda -->
    <style>
        /* General styles */
body {
font-family: Arial, sans-serif;
margin: 0;
padding: 0;
}

/* Header styles */
h1 {
text-align: center;
margin-top: 30px;
}

/* Table styles */
table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}

th, td {
padding: 8px;
text-align: left;
border-bottom: 1px solid #ddd;
}

th {
background-color: #f2f2f2;
}

/* Form styles */
form {
margin-top: 20px;
display: flex;
flex-direction: column;
max-width: 400px;
margin-left: auto;
margin-right: auto;
}

label {
margin-top: 10px;
}

input[type="date"],
input[type="time"],
input[type="text"],
select {
margin-top: 5px;
padding: 8px;
border: 1px solid #ccc;
border-radius: 4px;
box-sizing: border-box;
}

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

/* Notification styles */
.notification {
padding: 10px;
margin-bottom: 15px;
border-radius: 4px;
opacity: 0;
transform: translateY(-20px);
transition: opacity 0.5s, transform 0.5s;
position: fixed;
top: 20px;
right: 20px;
z-index: 1000;
max-width: 300px;
}

.notification.show {
opacity: 1;
transform: translateY(0);
}

.success {
color: #3c763d;
background-color: #dff0d8;
border-color: #d6e9c6;
}

.error {
color: #a94442;
background-color: #f2dede;
border-color: #ebccd1;
}

    </style>
</head>
<body>
    <h1>Peminjaman Ruangan Fakultas Teknik</h1>
    <div id="notification" class="notification"></div> <!-- Elemen notifikasi -->

    <table>
        <thead>
            <tr>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
            $message = '';

            if($notif == "jam"){
                $message = "Jam mulai harus lebih dari jam selesai";
                echo "<script type='text/javascript'>showNotification('$message', 'error');</script>";
            } else if($notif == "tidaktersedia"){
                $message = "Ruangan sedang tidak tersedia";
                echo "<script type='text/javascript'>showNotification('$message', 'error');</script>";
            } else if($notif == "berhasil") {
                $message = "Ruangan berhasil dipesan";
                echo "<script type='text/javascript'>showNotification('$message', 'success');</script>";
            } else if($notif == "gagal") {
                $message = "Gagal memesan ruangan";
                echo "<script type='text/javascript'>showNotification('$message', 'error');</script>";
            }
        ?>
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
        <button type="submit"  name="submit" style="border-radius: 12px">Book Room</button>
    </form>

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
    </script>
    <a href="<?php echo BASE_URL."index.php?page=home"; ?>"><button type="submit" style="border-radius: 12px;">Kembali</button></a>
</body>
</html>
