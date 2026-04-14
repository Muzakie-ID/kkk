<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['nis']) || $_SESSION['role'] !== 'siswa') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="siswa_dashboard.php">SIPAS - Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><span class="nav-link text-white-50">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?> (<?php echo htmlspecialchars($_SESSION['kelas']); ?>)</span></li>
                    <li class="nav-item"><a class="nav-link active" href="siswa_dashboard.php">Histori Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link" href="siswa_form.php">Buat Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4>Histori Pengaduan Anda</h4>
        <p class="text-muted">Pantau status penyelesaian, progres perbaikan, dan umpan balik dari laporan Anda.</p>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Progres</th>
                                <th>Umpan Balik Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nis = $_SESSION['nis'];
                            $stmt = mysqli_prepare($conn, "SELECT a.*, k.ket_kategori 
                                                            FROM aspirasi a 
                                                            JOIN kategori k ON a.id_kategori = k.id_kategori 
                                                            WHERE a.nis = ? 
                                                            ORDER BY a.tanggal DESC");
                            mysqli_stmt_bind_param($stmt, "s", $nis);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            $no = 1;
                            while ($data = mysqli_fetch_assoc($result)) {
                                // Badge warna berdasarkan status
                                $badge = 'bg-warning text-dark';
                                if ($data['status'] == 'Proses') {
                                    $badge = 'bg-info text-white';
                                } elseif ($data['status'] == 'Selesai') {
                                    $badge = 'bg-success';
                                }
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars(date('d M Y', strtotime($data['tanggal']))); ?></td>
                                <td><?php echo htmlspecialchars($data['ket_kategori']); ?></td>
                                <td><?php echo htmlspecialchars($data['ket']); ?></td>
                                <td><span class="badge <?php echo $badge; ?>"><?php echo htmlspecialchars($data['status']); ?></span></td>
                                <td><?php echo htmlspecialchars($data['progres'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($data['feedback'] ?? '-'); ?></td>
                            </tr>
                            <?php }
                            mysqli_stmt_close($stmt);

                            if ($no == 1) {
                                echo '<tr><td colspan="7" class="text-center text-muted py-3">Belum ada pengaduan. <a href="siswa_form.php">Buat pengaduan baru</a></td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>