<?php
/*
session_start();
include 'koneksi.php';
// if(!isset($_SESSION['nis'])) { header("Location: index.php"); exit; }
*/
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
                    <li class="nav-item"><a class="nav-link" href="siswa_dashboard.php">Histori Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link active" href="siswa_form.php">Buat Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="index.php">Logout</a></li>
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
                        <!-- <?php /* Form yang aktif untuk backend nantinya: <form action="proses_aspirasi.php" method="POST"> */ ?> -->
                        <form action="siswa_dashboard.php" method="GET">
                            <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori Sarana/Prasarana</label>
                                <select class="form-select" id="id_kategori" name="id_kategori">
                                    <?php 
                                    /* 
                                    // Looping Kategori dari Database 
                                    // $query = mysqli_query($conn, "SELECT * FROM kategori");
                                    // while($kategori = mysqli_fetch_array($query)) {
                                    //     echo "<option value='".$kategori['id_kategori']."'>".$kategori['ket_kategori']."</option>";
                                    // } 
                                    */
                                    ?>
                                    <!-- Dummy Data (Akan Dihapus Saat Backend Aktif) -->
                                    <option value="1">Fasilitas Kelas (Meja, Kursi, AC, Proyektor)</option>
                                    <option value="2">Fasilitas Umum (Toilet, Kantin, Tempat Ibadah)</option>
                                    <option value="3">Fasilitas Olahraga & Lab</option>
                                    <option value="4">Kebersihan & Keamanan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi Detail</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Kelas XII RPL 1">
                            </div>
                            <div class="mb-3">
                                <label for="ket" class="form-label">Deskripsi Pengaduan / Masukan</label>
                                <textarea class="form-control" id="ket" name="ket" rows="4" placeholder="Jelaskan kerusakan atau masukan Anda secara rinci..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lampiran Foto (Opsional)</label>
                                <input type="file" class="form-control">
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