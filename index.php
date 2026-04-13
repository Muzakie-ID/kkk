<?php
/*
session_start();
include 'koneksi.php';

// Contoh proses login:
// if(isset($_POST['username'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     // Cek login ke db...
//     // $_SESSION['nis'] = $row['nis'];
//     // $_SESSION['role'] = 'siswa';
//     // header("Location: siswa_dashboard.php");
// }
*/
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .login-container { max-width: 400px; margin-top: 100px; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4">Login SIPAS</h3>
                <p class="text-center text-muted">Sistem Informasi Pengaduan Sarana Sekolah</p>
                <!-- <?php /* Form yang aktif untuk backend nantinya: <form action="file_proses_login.php" method="POST"> */ ?> -->
                <form action="siswa_dashboard.php" method="GET">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username / NIS</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Login Sebagai</label>
                        <select class="form-select" id="role" name="role" onchange="changeAction(this.value)">
                            <!-- Tambahan values agar terbaca di PHP -->
                            <option value="siswa">Siswa</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function changeAction(url) {
            document.querySelector('form').action = url;
        }
    </script>
</body>
</html>