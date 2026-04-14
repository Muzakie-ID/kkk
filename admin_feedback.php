<?php
session_start();
include 'koneksi.php';
include 'helpers.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Ambil ID aspirasi dari parameter GET
if (!isset($_GET['id_aspirasi'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$id_aspirasi = $_GET['id_aspirasi'];

// Query data aspirasi dengan prepared statement
$stmt = mysqli_prepare($conn, "SELECT a.*, s.nama, s.kelas, k.ket_kategori 
                                FROM aspirasi a 
                                JOIN siswa s ON a.nis = s.nis 
                                JOIN kategori k ON a.id_kategori = k.id_kategori 
                                WHERE a.id_aspirasi = ?");
mysqli_stmt_bind_param($stmt, "i", $id_aspirasi);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data aspirasi tidak ditemukan.'); window.location='admin_dashboard.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindak Lanjut & Umpan Balik - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">SIPAS - Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Daftar Aspirasi</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="mb-3">
            <a href="admin_dashboard.php" class="btn btn-outline-secondary">&larr; Kembali ke Daftar</a>
        </div>
        
        <div class="row">
            <!-- Info Pengaduan -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Detail Aspirasi / Pengaduan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="150" class="text-muted">Pelapor</th>
                                <td><?php echo htmlspecialchars($data['nama'] . ' (' . $data['kelas'] . ') - NIS: ' . $data['nis']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tanggal</th>
                                <td><?php echo htmlspecialchars(tanggal_indo($data['tanggal'], 'long')) . ' WIB'; ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Kategori</th>
                                <td><?php echo htmlspecialchars($data['ket_kategori']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Lokasi</th>
                                <td><?php echo htmlspecialchars($data['lokasi'] ?: '-'); ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Isi Pengaduan</th>
                                <td><?php echo htmlspecialchars($data['ket']); ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Lampiran</th>
                                <td>
                                    <?php if (!empty($data['lampiran']) && file_exists('uploads/' . $data['lampiran'])): ?>
                                        <a href="uploads/<?php echo htmlspecialchars($data['lampiran']); ?>" target="_blank">
                                            <img src="uploads/<?php echo htmlspecialchars($data['lampiran']); ?>" alt="Lampiran" class="img-thumbnail" style="max-width: 200px;">
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak ada lampiran</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form Tindak Lanjut -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Update Status & Umpan Balik</h5>
                    </div>
                    <div class="card-body">
                        <form action="proses_update_aspirasi.php" method="POST">
                            <input type="hidden" name="id_aspirasi" value="<?php echo (int)$data['id_aspirasi']; ?>">
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Ubah Status Penyelesaian</label>
                                <select class="form-select border-primary" id="status" name="status">
                                    <option value="Menunggu" <?php echo ($data['status'] == 'Menunggu') ? 'selected' : ''; ?>>Menunggu Pengecekan</option>
                                    <option value="Proses" <?php echo ($data['status'] == 'Proses') ? 'selected' : ''; ?>>Sedang Dikerjakan</option>
                                    <option value="Selesai" <?php echo ($data['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai / Selesai Diperbaiki</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="progres" class="form-label fw-bold">Progres Perbaikan Pengerjaan</label>
                                <input type="text" class="form-control" id="progres" name="progres" placeholder="Contoh: Teknisi sedang dalam perjalanan / Suku cadang dipesan" value="<?php echo htmlspecialchars($data['progres'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="feedback" class="form-label fw-bold">Umpan Balik (Feedback) untuk Siswa</label>
                                <textarea class="form-control" id="feedback" name="feedback" rows="4" placeholder="Tuliskan tanggapan atau informasi untuk pelapor..."><?php echo htmlspecialchars($data['feedback'] ?? ''); ?></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Simpan & Kirim Umpan Balik</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>