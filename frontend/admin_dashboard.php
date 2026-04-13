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
                    <li class="nav-item"><a class="nav-link text-danger" href="index.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4 px-4">
        <h4>Kelola Data Pengaduan & Aspirasi</h4>
        
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form class="row g-3" method="GET" action="admin_dashboard.php">
                    <div class="col-md-2">
                        <label for="filter_tanggal" class="form-label">Filter Tanggal</label>
                        <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal">
                    </div>
                    <div class="col-md-2">
                        <label for="filter_bulan" class="form-label">Filter Bulan</label>
                        <input type="month" class="form-control" id="filter_bulan" name="filter_bulan">
                    </div>
                    <div class="col-md-3">
                        <label for="filter_kategori" class="form-label">Filter Kategori</label>
                        <select class="form-select" id="filter_kategori" name="filter_kategori">
                            <option value="">Semua Kategori</option>
                            <option value="1">Fasilitas Kelas</option>
                            <option value="2">Fasilitas Umum</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cari_siswa" class="form-label">Cari Nama Siswa / NIS</label>
                        <input type="text" class="form-control" id="cari_siswa" name="cari_siswa" placeholder="Cari...">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-secondary w-100">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>

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
                            <tr>
                                <td>1</td>
                                <td>10 Okt 2023</td>
                                <td>Ahmad (XII RPL)</td>
                                <td>Fasilitas Kelas</td>
                                <td>AC di kelas XII RPL mati dan bocor.</td>
                                <td><span class="badge bg-warning text-dark">Menunggu Pengecekan</span></td>
                                <td>
                                    <a href="admin_feedback.php" class="btn btn-sm btn-primary">Tindak Lanjuti</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>05 Sep 2023</td>
                                <td>Budi (XI TKJ)</td>
                                <td>Kebersihan</td>
                                <td>Toilet lantai 2 kotor dan air mati.</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>
                                    <a href="admin_feedback.php" class="btn btn-sm btn-info text-white">Lihat Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>