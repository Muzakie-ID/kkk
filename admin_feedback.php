<?php
/*
session_start();
include 'koneksi.php';
// if($_SESSION['role'] != 'admin') { header("Location: index.php"); exit; }

// Contoh menangkap ID dari parameter GET
// $id_aspirasi = $_GET['id_aspirasi'];
// $query = mysqli_query($conn, "SELECT ... WHERE id_aspirasi = '$id_aspirasi'");
// $data = mysqli_fetch_array($query);
*/
?>
<!DOCTYPE html>
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
                    <li class="nav-item"><a class="nav-link text-danger" href="index.php">Logout</a></li>
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
                                <td>
                                    <?php /* echo $data['nis'] . ' - ' . $data['kelas']; */ ?> 
                                    <!-- Dummy -->Ahmad (XII RPL) - NIS: 12345
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tanggal</th>
                                <td>
                                    <?php /* echo $data['tanggal']; */ ?> 
                                    <!-- Dummy -->10 Oktober 2023 - 09:30 WIB
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Kategori</th>
                                <td>Fasilitas Kelas</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Lokasi</th>
                                <td>Kelas XII RPL 1</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Isi Pengaduan</th>
                                <td>AC di kelas XII RPL mati dan bocor meneteskan air ke meja siswa.</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Lampiran</th>
                                <td><span class="badge bg-secondary">Tidak ada lampiran</span></td>
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
                        <!-- <?php /* Form yang aktif untuk backend nantinya: <form action="proses_update_aspirasi.php" method="POST"> */ ?> -->
                        <form action="admin_dashboard.php" method="POST">
                            <!-- <?php /* <input type="hidden" name="id_aspirasi" value="<?php echo $data['id_aspirasi']; ?>"> */ ?> -->
                            <input type="hidden" name="id_aspirasi" value="1">
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Ubah Status Penyelesaian</label>
                                <select class="form-select border-primary" id="status" name="status">
                                    <option value="Menunggu">Menunggu Pengecekan</option>
                                    <option value="Proses" selected>Sedang Dikerjakan</option>
                                    <option value="Selesai">Selesai / Selesai Diperbaiki</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="progres" class="form-label fw-bold">Progres Perbaikan Pengerjaan</label>
                                <input type="text" class="form-control" id="progres" name="progres" placeholder="Contoh: Teknisi sedang dalam perjalanan / Suku cadang dipesan" value="Teknisi sudah mengecek, sedang menunggu freon.">
                            </div>
                            <div class="mb-3">
                                <label for="feedback" class="form-label fw-bold">Umpan Balik (Feedback) untuk Siswa</label>
                                <textarea class="form-control" id="feedback" name="feedback" rows="4" placeholder="Tuliskan tanggapan atau informasi untuk pelapor...">Terima kasih atas laporannya. Tim teknisi saat ini sudah mengecek kerusakan AC dan akan segera melakukan pengisian freon setelah jam istirahat.</textarea>
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