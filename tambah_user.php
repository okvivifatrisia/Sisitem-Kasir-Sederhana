<?php
session_start();
include 'koneksi.php';

// 1. Ambil USER_ID terakhir dari database (diurutkan berdasarkan konversi angka agar akurat)
$query_id = mysqli_query($koneksi, "SELECT USER_ID FROM users ORDER BY CAST(SUBSTRING(USER_ID, 4) AS UNSIGNED) DESC LIMIT 1");
$data_id  = mysqli_fetch_array($query_id);

if ($data_id) {
    // Ambil angka dari ID terakhir (misal usr002 diambil 002 -> diubah ke integer jadi 2)
    $angka_terakhir = (int) substr($data_id['USER_ID'], 3); 
    $angka_baru     = $angka_terakhir + 1;
} else {
    // Jika database masih kosong, mulai dari 1
    $angka_baru     = 1;
}

// 2. Menyusun kembali menjadi format -> usr001
$id_otomatis = "usr" . sprintf("%03d", $angka_baru);
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Kasir | Tambah User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/adminlte.css" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>
        
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <h3 class="mb-3">Tambah User Baru</h3>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Input User</h3>
                    </div>

                    <form action="simpan_user.php" method="POST">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label fw-bold">ID User</label>
                                <input type="text" name="user_id" class="form-control" value="<?= $id_otomatis; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username untuk login" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Role / Hak Akses</label>
                                <select name="role" class="form-control" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">ADMIN</option>
                                    <option value="kasir">KASIR</option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="kelola_user.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>
</body>
</html>