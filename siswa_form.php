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
    <title>Form Aspirasi Siswa - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="siswa_dashboard.php">SIPAS - Siswa</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><span class="nav-link text-white-50">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?></span></li>
                    <li class="nav-item"><a class="nav-link" href="siswa_dashboard.php">Histori Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="siswa_form.php">Buat Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Form Aspirasi Siswa</h4>
                    </div>
                    <div class="card-body">
                        <form action="proses_aspirasi.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori Sarana/Prasarana</label>
                                <select class="form-select" id="id_kategori" name="id_kategori" required>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM kategori");
                                    while ($kategori = mysqli_fetch_array($query)) {
                                        echo "<option value='" . (int)$kategori['id_kategori'] . "'>" . htmlspecialchars($kategori['ket_kategori']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi Detail</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Kelas XII RPL 1">
                            </div>
                            <div class="mb-3">
                                <label for="ket" class="form-label">Deskripsi Pengaduan / Masukan</label>
                                <textarea class="form-control" id="ket" name="ket" rows="4" placeholder="Jelaskan kerusakan atau masukan Anda secara rinci..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lampiran Foto (Opsional)</label>
                                <input type="file" class="form-control" name="lampiran" accept="image/jpeg,image/png,image/gif">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maks 2MB.</small>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>