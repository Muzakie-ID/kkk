<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php">SIPAS - Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php">Daftar Aspirasi</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4 px-4">
        <h4>Kelola Data Pengaduan & Aspirasi</h4>
        
        <!-- Filter Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form class="row g-3" method="GET" action="admin_dashboard.php">
                    <div class="col-md-2">
                        <label for="filter_tanggal" class="form-label">Filter Tanggal</label>
                        <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal" value="<?php echo isset($_GET['filter_tanggal']) ? htmlspecialchars($_GET['filter_tanggal']) : ''; ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="filter_bulan" class="form-label">Filter Bulan</label>
                        <input type="month" class="form-control" id="filter_bulan" name="filter_bulan" value="<?php echo isset($_GET['filter_bulan']) ? htmlspecialchars($_GET['filter_bulan']) : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="filter_kategori" class="form-label">Filter Kategori</label>
                        <select class="form-select" id="filter_kategori" name="filter_kategori">
                            <option value="">Semua Kategori</option>
                            <?php
                            $qk = mysqli_query($conn, "SELECT * FROM kategori");
                            while ($k = mysqli_fetch_array($qk)) {
                                $selected = (isset($_GET['filter_kategori']) && $_GET['filter_kategori'] == $k['id_kategori']) ? 'selected' : '';
                                echo "<option value='" . (int)$k['id_kategori'] . "' " . $selected . ">" . htmlspecialchars($k['ket_kategori']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cari_siswa" class="form-label">Cari Nama Siswa / NIS</label>
                        <input type="text" class="form-control" id="cari_siswa" name="cari_siswa" placeholder="Cari..." value="<?php echo isset($_GET['cari_siswa']) ? htmlspecialchars($_GET['cari_siswa']) : ''; ?>">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-secondary w-100">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Aspirasi -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Siswa</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Build query dengan filter
                            $where = [];
                            $params = [];
                            $types = "";

                            if (!empty($_GET['filter_tanggal'])) {
                                $where[] = "DATE(a.tanggal) = ?";
                                $params[] = $_GET['filter_tanggal'];
                                $types .= "s";
                            }

                            if (!empty($_GET['filter_bulan'])) {
                                $where[] = "DATE_FORMAT(a.tanggal, '%Y-%m') = ?";
                                $params[] = $_GET['filter_bulan'];
                                $types .= "s";
                            }

                            if (!empty($_GET['filter_kategori'])) {
                                $where[] = "a.id_kategori = ?";
                                $params[] = $_GET['filter_kategori'];
                                $types .= "i";
                            }

                            if (!empty($_GET['cari_siswa'])) {
                                $where[] = "(s.nama LIKE ? OR s.nis LIKE ?)";
                                $search = "%" . $_GET['cari_siswa'] . "%";
                                $params[] = $search;
                                $params[] = $search;
                                $types .= "ss";
                            }

                            $sql = "SELECT a.*, s.nama, s.kelas, k.ket_kategori 
                                    FROM aspirasi a 
                                    JOIN siswa s ON a.nis = s.nis 
                                    JOIN kategori k ON a.id_kategori = k.id_kategori";

                            if (!empty($where)) {
                                $sql .= " WHERE " . implode(" AND ", $where);
                            }

                            $sql .= " ORDER BY a.tanggal DESC";

                            $stmt = mysqli_prepare($conn, $sql);
                            if (!empty($params)) {
                                mysqli_stmt_bind_param($stmt, $types, ...$params);
                            }
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            $no = 1;
                            while ($data = mysqli_fetch_assoc($result)) {
                                // Tentukan badge warna berdasarkan status
                                $badge = 'bg-warning text-dark';
                                if ($data['status'] == 'Proses') {
                                    $badge = 'bg-info text-white';
                                } elseif ($data['status'] == 'Selesai') {
                                    $badge = 'bg-success';
                                }

                                $btn_class = ($data['status'] == 'Selesai') ? 'btn-info text-white' : 'btn-primary';
                                $btn_text = ($data['status'] == 'Selesai') ? 'Lihat Detail' : 'Tindak Lanjuti';
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars(date('d M Y', strtotime($data['tanggal']))); ?></td>
                                <td><?php echo htmlspecialchars($data['nama'] . ' (' . $data['kelas'] . ')'); ?></td>
                                <td><?php echo htmlspecialchars($data['ket_kategori']); ?></td>
                                <td><?php echo htmlspecialchars($data['ket']); ?></td>
                                <td><span class="badge <?php echo $badge; ?>"><?php echo htmlspecialchars($data['status']); ?></span></td>
                                <td>
                                    <a href="admin_feedback.php?id_aspirasi=<?php echo (int)$data['id_aspirasi']; ?>" class="btn btn-sm <?php echo $btn_class; ?>"><?php echo $btn_text; ?></a>
                                </td>
                            </tr>
                            <?php }
                            mysqli_stmt_close($stmt);

                            if ($no == 1) {
                                echo '<tr><td colspan="7" class="text-center text-muted py-3">Belum ada data pengaduan.</td></tr>';
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