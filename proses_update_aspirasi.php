<?php
session_start();
include 'koneksi.php';

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_aspirasi = $_POST['id_aspirasi'];
    $status = $_POST['status'];
    $progres = $_POST['progres'];
    $feedback = $_POST['feedback'];

    // Update aspirasi dengan prepared statement
    $stmt = mysqli_prepare($conn, "UPDATE aspirasi SET status = ?, progres = ?, feedback = ? WHERE id_aspirasi = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $status, $progres, $feedback, $id_aspirasi);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Status dan umpan balik berhasil diperbarui!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.'); window.history.back();</script>";
    }

    mysqli_stmt_close($stmt);
} else {
    header("Location: admin_dashboard.php");
    exit;
}
?>
