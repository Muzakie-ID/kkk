-- ============================================
-- Database: db_pengaduan
-- SIPAS - Sistem Informasi Pengaduan Sarana Sekolah
-- ============================================

CREATE DATABASE IF NOT EXISTS db_pengaduan;
USE db_pengaduan;

-- Tabel Admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Tabel Siswa
CREATE TABLE IF NOT EXISTS siswa (
    nis VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kelas VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Tabel Kategori
CREATE TABLE IF NOT EXISTS kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    ket_kategori VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tabel Aspirasi (Pengaduan)
CREATE TABLE IF NOT EXISTS aspirasi (
    id_aspirasi INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL,
    id_kategori INT NOT NULL,
    lokasi VARCHAR(150) DEFAULT NULL,
    ket TEXT NOT NULL,
    lampiran VARCHAR(255) DEFAULT NULL,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Menunggu', 'Proses', 'Selesai') DEFAULT 'Menunggu',
    progres VARCHAR(255) DEFAULT NULL,
    feedback TEXT DEFAULT NULL,
    FOREIGN KEY (nis) REFERENCES siswa(nis),
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
) ENGINE=InnoDB;

-- ============================================
-- Data Awal (Sample Data)
-- ============================================

-- Password default: '123456' (hashed with password_hash)
-- Gunakan script insert_admin.php untuk generate hash yang benar

-- Insert Kategori
INSERT INTO kategori (ket_kategori) VALUES
('Fasilitas Kelas (Meja, Kursi, AC, Proyektor)'),
('Fasilitas Umum (Toilet, Kantin, Tempat Ibadah)'),
('Fasilitas Olahraga & Lab'),
('Kebersihan & Keamanan');

-- ============================================
-- CATATAN PENTING:
-- Untuk menambahkan data admin dan siswa, jalankan file
-- setup_data.php melalui browser agar password di-hash
-- dengan benar menggunakan password_hash().
-- ============================================
