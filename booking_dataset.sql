-- Membuat Tabel Ruangan
CREATE TABLE ruangan (
  id_ruangan int PRIMARY KEY AUTO_INCREMENT,
  nama_ruangan varchar(50) NOT NULL,
  kapasitas INT,
  tersedia ENUM('1', '0') NOT NULL,
  INDEX idx_nama_ruangan (nama_ruangan)
);

-- Membuat Tabel User
CREATE TABLE User (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('mahasiswa', 'admin') NOT NULL,
    INDEX idx_email (email)
);

-- Membuat Tabel Peminjaman
CREATE TABLE Peminjaman (
    id_peminjaman INT PRIMARY KEY AUTO_INCREMENT,
    id_ruangan INT,
    id_user INT,
    tanggal_peminjaman DATE,
    jam_mulai TIME,
    jam_selesai TIME,
    keperluan TEXT,
    FOREIGN KEY (id_ruangan) REFERENCES Ruangan(id_ruangan),
    FOREIGN KEY (id_user) REFERENCES User(id_user),
    INDEX idx_id_ruangan (id_ruangan),
    INDEX idx_id_user (id_user),
    INDEX idx_tanggal_peminjaman (tanggal_peminjaman)
);

-- Membuat tabel Jadwal
CREATE TABLE Jadwal (
    id_jadwal INT PRIMARY KEY AUTO_INCREMENT,
    id_ruangan INT,
    hari VARCHAR(20),
    jam_mulai TIME,
    jam_selesai TIME,
    FOREIGN KEY (id_ruangan) REFERENCES Ruangan(id_ruangan),
    INDEX idx_id_ruangan (id_ruangan),
    INDEX idx_hari (hari),
    INDEX idx_jam_mulai (jam_mulai),
    INDEX idx_jam_selesai (jam_selesai)
);

-- Membuat tabel notifikasi
CREATE TABLE Notifikasi (
    id_notifikasi INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    isi_notifikasi TEXT,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('belum_dibaca', 'dibaca') DEFAULT 'belum_dibaca',
    FOREIGN KEY (id_user) REFERENCES User(id_user),
    INDEX idx_id_user (id_user)
);

-- Insert data ruangan
INSERT INTO ruangan (nama_ruangan, kapasitas)
VALUES
  ('D01', 50),
  ('D02', 50),
  ('D03', 50),
  ('D04', 50),
  ('D05', 50);



