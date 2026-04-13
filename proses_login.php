<?php
/*
session_start();
include 'koneksi.php'; // Pastikan Anda sudah membuat file koneksi untuk database nantinya

// Menangkap data dari form yang dikirim lewat metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data username dan password
    $username = $_POST['username']; // Pada siswa ini adalah NIS, pada admin adalah Username.
    $password = $_POST['password']; 
    $role = $_POST['role']; // Tangkap status role, pastikan di index.php selectnya diberi nam="role"

    if ($role == 'admin') {
        // Query untuk mengecek kecocokan data admin di database
        // Misalnya Anda sudah memiliki tabel admin: username dan password
        $sql = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
        $cek = mysqli_num_rows($sql);

        if ($cek > 0) {
            $data = mysqli_fetch_assoc($sql);

            // Simpan Session Admin
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = 'admin';
            
            // Arahkan ke dashboard admin
            header("Location: admin_dashboard.php");
            exit;
        } else {
            // Jika akun salah
            echo "<script>alert('Login Gagal! Username atau password admin salah.'); window.location='index.php';</script>";
        }

    } else if ($role == 'siswa') {
        // Query untuk mengecek data siswa
        // Catatan: Pada struktur database yang Anda kirim belum terdapat atribut password di Tabel Siswa,
        // namun asumsikan pengecekan berdasarkan nis & password atau hanya nis:
        // $sql = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$username' AND password = '$password'");
        
        // Contoh Query Hanya NIS:
        $sql = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$username'");
        $cek = mysqli_num_rows($sql);

        if ($cek > 0) {
            $data = mysqli_fetch_assoc($sql);

            // Simpan Session Siswa
            $_SESSION['nis'] = $data['nis'];
            $_SESSION['kelas'] = $data['kelas'];
            $_SESSION['role'] = 'siswa';

            // Arahkan ke form siswa / dashboard
            header("Location: siswa_dashboard.php");
            exit;
        } else {
            // Jika akun mahasiswa salah / tidak ada NISnya
            echo "<script>alert('Login Gagal! NIS tidak ditemukan.'); window.location='index.php';</script>";
        }
    }
}
*/
?>
