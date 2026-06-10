<?php
session_start();

// 1. Cek apakah user sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Langsung ke login.php karena satu folder
    exit();
}

// 2. Cek apakah rolenya BENAR-BENAR admin
if (strtolower($_SESSION['role']) !== 'admin') {
    header("Location: login.php"); // Langsung ke login.php karena satu folder
    exit();
}

// 3. Ambil koneksi (keluar folder 'dist' dulu untuk nemuin koneksi.php yang ada di luar)
include "koneksi.php";

// Query isi card otomatis (aman tanpa eror null)
$total_produk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM products"))['total'] ?? 0;
$total_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users"))['total'] ?? 0;
$total_transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transactions"))['total'] ?? 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Sistem Kasir Sederhana - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/adminlte.css" />

    <style>
        /* Global Font & Warna */
        html, body, body * { font-family: 'Poppins', sans-serif !important; color: #000000 !important; }
        body { background-color: #ffffff !important; }
        
        /* Custom Theme Dashboard */
        .card-kasir { border-left: 4px solid #f7a0b8; }
        .text-pink { color: #f7a0b8 !important; }
        .btn-pink { background: #f7a0b8 !important; color: white !important; border: 1px solid #f7a0b8; }
        .btn-pink:hover { background-color: white !important; color: #f7a0b8 !important; }
        .btn i { color: inherit !important; }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>

        <main class="app-main">
            <div class="container-fluid p-4">
                <h2 class="mb-4">Selamat Datang, Admin</h2>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card card-kasir">
                            <div class="card-body">
                                <h5 class="text-pink mb-2"><i class="bi bi-box-seam"></i> Total Produk</h5>
                                <h2 class="fw-bold m-0"><?= $total_produk ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-kasir">
                            <div class="card-body">
                                <h5 class="text-pink mb-2"><i class="bi bi-people"></i> Total User</h5>
                                <h2 class="fw-bold m-0"><?= $total_user ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-kasir">
                            <div class="card-body">
                                <h5 class="text-pink mb-2"><i class="bi bi-receipt"></i> Total Transaksi</h5>
                                <h2 class="fw-bold m-0"><?= $total_transaksi ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="m-0">Menu Admin</h4>
                    </div>
                    <div class="card-body d-flex gap-2 flex-wrap">
                        <a href="kelola_produk.php" class="btn btn-pink">Kelola Produk</a>
                        <a href="Kelola_user.php" class="btn btn-pink">Kelola User</a>
                        <a href="riwayatadmin.php" class="btn btn-pink">Riwayat Transaksi</a>
                    </div>
                </div>
            </div>
        </main>

        <?php include "footer.php"; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>

    <script>
        // Sidebar Scrollbar setup
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true }
                });
            }
        });
    </script>
</body>
</html>