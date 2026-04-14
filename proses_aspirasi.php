<?php
session_start();
include 'koneksi.php';

// Pastikan hanya siswa yang bisa mengakses
if (!isset($_SESSION['nis']) || $_SESSION['role'] !== 'siswa') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_SESSION['nis'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $ket = $_POST['ket'];

    // Proses upload lampiran foto (opsional)
    $lampiran = null;
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_tmp = $_FILES['lampiran']['tmp_name'];
        $file_name = $_FILES['lampiran']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validasi tipe file
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_ext)) {
            echo "<script>alert('Format file tidak diizinkan. Gunakan JPG, JPEG, PNG, atau GIF.'); window.history.back();</script>";
            exit;
        }

        // Validasi ukuran file (maks 2MB)
        if ($_FILES['lampiran']['size'] > 2 * 1024 * 1024) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 2MB.'); window.history.back();</script>";
            exit;
        }

        // Rename file agar unik
        $lampiran = 'lampiran_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $file_ext;
        $upload_path = $upload_dir . $lampiran;

        if (!move_uploaded_file($file_tmp, $upload_path)) {
            echo "<script>alert('Gagal mengupload file.'); window.history.back();</script>";
            exit;
        }
    }

    // Simpan ke database dengan prepared statement
    $stmt = mysqli_prepare($conn, "INSERT INTO aspirasi (nis, id_kategori, lokasi, ket, lampiran, tanggal, status) VALUES (?, ?, ?, ?, ?, NOW(), 'Menunggu')");
    mysqli_stmt_bind_param($stmt, "sisss", $nis, $id_kategori, $lokasi, $ket, $lampiran);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Pengaduan berhasil dikirim!'); window.location='siswa_dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pengaduan. Silakan coba lagi.'); window.history.back();</script>";
    }

    mysqli_stmt_close($stmt);
} else {
    header("Location: siswa_form.php");
    exit;
}
?>
