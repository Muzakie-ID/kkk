<?php
/**
 * Script untuk menambahkan data awal (admin & siswa) ke database.
 * Jalankan file ini SEKALI melalui browser setelah import db_pengaduan.sql.
 * Hapus file ini setelah selesai digunakan.
 */
include 'koneksi.php';

// Cek apakah admin sudah ada
$cek = mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin");
$row = mysqli_fetch_assoc($cek);

if ($row['total'] > 0) {
    echo "Data awal sudah ada. Tidak perlu dijalankan lagi.";
    exit;
}

// Insert Admin (password: admin123)
$password_admin = password_hash('admin123', PASSWORD_DEFAULT);
$username = 'admin';
$stmt = mysqli_prepare($conn, "INSERT INTO admin (username, password) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $username, $password_admin);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Insert Siswa (password: 123456)
$password_siswa = password_hash('123456', PASSWORD_DEFAULT);
$stmt = mysqli_prepare($conn, "INSERT INTO siswa (nis, nama, kelas, password) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $nis, $nama, $kelas, $password_siswa);

$data_siswa = [
    ['12345', 'Ahmad', 'XII RPL'],
    ['12346', 'Budi', 'XI TKJ'],
    ['12347', 'Citra', 'X MM'],
];

foreach ($data_siswa as $s) {
    $nis = $s[0];
    $nama = $s[1];
    $kelas = $s[2];
    mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);

echo "Data awal berhasil ditambahkan!<br>";
echo "Admin: username=admin, password=admin123<br>";
echo "Siswa: NIS=12345 (Ahmad), NIS=12346 (Budi), NIS=12347 (Citra), password=123456<br>";
echo "<br><strong>PENTING: Hapus file setup_data.php ini setelah selesai!</strong>";
?>
