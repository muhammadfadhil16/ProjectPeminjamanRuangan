-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 06:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `isi_notifikasi` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` set('belum_dibaca','dibaca') DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `status` set('dipinjam','selesai') NOT NULL DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_ruangan`, `id_user`, `tanggal_peminjaman`, `jam_mulai`, `jam_selesai`, `keperluan`, `status`) VALUES
(1, 1, 4, '2024-05-02', '14:30:00', '16:00:00', NULL, 'dipinjam'),
(2, 1, 5, '2024-05-22', '22:07:00', '23:07:00', 'uts', 'dipinjam'),
(3, 1, 6, '2024-06-05', '09:37:00', '15:37:00', 'UAS', 'dipinjam');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `move_to_history` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
    IF OLD.status = 'dipinjam' AND NEW.status = 'selesai' THEN
        INSERT INTO riwayat_pemesanan (id_ruangan, id_user, tanggal_peminjaman, jam_mulai, jam_selesai, keperluan)
        VALUES (OLD.id_ruangan, OLD.id_user, OLD.tanggal_peminjaman, OLD.jam_mulai, OLD.jam_selesai, OLD.keperluan);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pemesanan`
--

CREATE TABLE `riwayat_pemesanan` (
  `id_riwayat` int(11) NOT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `keperluan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_pemesanan`
--

INSERT INTO `riwayat_pemesanan` (`id_riwayat`, `id_ruangan`, `id_user`, `tanggal_peminjaman`, `jam_mulai`, `jam_selesai`, `keperluan`) VALUES
(1, 1, 5, '2024-05-16', '22:17:00', '23:17:00', 'coding'),
(2, 1, 5, '2024-05-16', '22:17:00', '23:17:00', 'coding'),
(3, 1, 6, '2024-06-05', '09:37:00', '15:37:00', 'UAS');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `tersedia` set('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `kapasitas`, `tersedia`) VALUES
(1, 'D01', 50, '1'),
(2, 'D02', 50, '1'),
(3, 'D03', 50, '1'),
(4, 'D04', 50, '1'),
(5, 'D05', 50, '1'),
(6, 'D06', 50, ''),
(7, 'D07', 30, ''),
(8, 'D08', 30, ''),
(9, 'D09', 30, ''),
(10, 'D10', 30, ''),
(11, 'D11', 30, ''),
(12, 'D12', 30, ''),
(13, 'D13', 30, ''),
(14, 'D14', 30, ''),
(15, 'D15', 30, ''),
(16, 'D16', 30, ''),
(17, 'D17', 30, ''),
(18, 'D18', 30, ''),
(19, 'D19', 30, ''),
(20, 'D20', 30, ''),
(21, 'D21', 50, ''),
(22, 'D22', 50, ''),
(23, 'D23', 40, ''),
(24, 'D24', 40, ''),
(25, 'D25', 40, ''),
(26, 'D26', 40, ''),
(27, 'D27', 40, ''),
(28, 'D28', 40, ''),
(29, 'D29', 40, ''),
(30, 'D30', 40, ''),
(31, 'D31', 40, ''),
(32, 'D32', 40, ''),
(33, 'D33', 40, ''),
(34, 'D34', 40, ''),
(35, 'D35', 40, ''),
(36, 'D36', 40, ''),
(37, 'D37', 40, ''),
(38, 'D38', 40, ''),
(39, 'D39', 40, ''),
(40, 'D40', 40, ''),
(41, 'D41', 40, ''),
(42, 'D42', 40, ''),
(43, 'D43', 40, ''),
(44, 'D44', 40, ''),
(45, 'D45', 40, ''),
(46, 'D46', 40, ''),
(47, 'D47', 40, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` set('mahasiswa','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `role`) VALUES
(4, 'd1041221017@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(5, 'd10141221017@gmail.com', '$2y$10$vi75SyFLcMhpQejV6LBWveBQ6cfE30sAp35HXjAZwASFweScXjqoy', 'mahasiswa'),
(6, 'user@gmail.com', '$2y$10$xnNDk8UFlup5Dn2qPSjijO1UIhWsBvQYDo19jTPYFpE3Zbp/NXDeO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `idx_id_ruangan` (`id_ruangan`),
  ADD KEY `idx_hari` (`hari`),
  ADD KEY `idx_jam_mulai` (`jam_mulai`),
  ADD KEY `idx_jam_selesai` (`jam_selesai`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `idx_id_user` (`id_user`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `idx_id_ruangan` (`id_ruangan`),
  ADD KEY `idx_id_user` (`id_user`),
  ADD KEY `idx_tanggal_peminjaman` (`tanggal_peminjaman`);

--
-- Indexes for table `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`),
  ADD KEY `idx_nama_ruangan` (`nama_ruangan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_NIM` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`);

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  ADD CONSTRAINT `riwayat_pemesanan_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`),
  ADD CONSTRAINT `riwayat_pemesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
