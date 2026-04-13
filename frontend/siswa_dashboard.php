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
                    <li class="nav-item"><a class="nav-link active" href="siswa_dashboard.php">Histori Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link" href="siswa_form.php">Buat Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="index.php">Logout</a></li>
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
                            <tr>
                                <td>1</td>
                                <td>10 Okt 2023</td>
                                <td>Fasilitas Kelas</td>
                                <td>AC di kelas XII RPL mati dan bocor.</td>
                                <td><span class="badge bg-warning text-dark">Sedang Dikerjakan</span></td>
                                <td>Tekisi sedang mengecek (50%)</td>
                                <td>Laporan diterima, teknisi akan datang siang ini.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>05 Sep 2023</td>
                                <td>Kebersihan</td>
                                <td>Toilet lantai 2 kotor dan air mati.</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>Selesai diperbaiki (100%)</td>
                                <td>Pompa air sudah diperbaiki dan toilet sudah dibersihkan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>