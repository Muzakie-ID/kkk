<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'admin') {
        // Query admin dengan prepared statement
        $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $cek = mysqli_num_rows($result);

        if ($cek > 0) {
            $data = mysqli_fetch_assoc($result);

            // Verifikasi password dengan password_verify
            if (password_verify($password, $data['password'])) {
                $_SESSION['username'] = $data['username'];
                $_SESSION['role'] = 'admin';

                header("Location: admin_dashboard.php");
                exit;
            } else {
                echo "<script>alert('Login Gagal! Password admin salah.'); window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Login Gagal! Username admin tidak ditemukan.'); window.location='index.php';</script>";
        }

        mysqli_stmt_close($stmt);

    } elseif ($role == 'siswa') {
        // Query siswa dengan prepared statement
        $stmt = mysqli_prepare($conn, "SELECT * FROM siswa WHERE nis = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $cek = mysqli_num_rows($result);

        if ($cek > 0) {
            $data = mysqli_fetch_assoc($result);

            // Verifikasi password dengan password_verify
            if (password_verify($password, $data['password'])) {
                $_SESSION['nis'] = $data['nis'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['kelas'] = $data['kelas'];
                $_SESSION['role'] = 'siswa';

                header("Location: siswa_dashboard.php");
                exit;
            } else {
                echo "<script>alert('Login Gagal! Password salah.'); window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Login Gagal! NIS tidak ditemukan.'); window.location='index.php';</script>";
        }

        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: index.php");
    exit;
}
?>
