<?php
session_start();

// 1. Cek apakah user sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Cek apakah rolenya BENAR-BENAR kasir
if (strtolower($_SESSION['role']) !== 'kasir') {
    header("Location: login.php");
    exit();
}

// 3. Ambil koneksi
include 'koneksi.php';

$today = date('Y-m-d');

// Jumlah transaksi hari ini
$q1 = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM transactions WHERE DATE(TRANSACTION_DATE) = '$today'");
$data1 = mysqli_fetch_assoc($q1);
$total_transaksi = $data1['total'] ?? 0;

// Pendapatan hari ini
$q2 = mysqli_query($koneksi, "SELECT SUM(TOTAL_HARGA) AS pendapatan FROM transactions WHERE DATE(TRANSACTION_DATE) = '$today'");
$data2 = mysqli_fetch_assoc($q2);
$pendapatan = $data2['pendapatan'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir Sederhana - Dashboard Kasir</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/adminlte.css">

    <style>
        /* Global Font & Warna - Selaras dengan Admin */
        html,
        body,
        body * {
            font-family: 'Poppins', sans-serif !important;
            color: #000000 !important;
        }

        body {
            background-color: #ffffff !important;
            overflow-x: hidden;
            /* Kunci layar biar tidak bisa digeser kanan-kiri */
        }

        /* Custom Theme Dashboard Kasir */
        .card-kasir {
            border-left: 4px solid #f7a0b8;
            background-color: #ffffff;
        }

        .text-pink {
            color: #f7a0b8 !important;
        }

        .btn-pink {
            background: #f7a0b8 !important;
            color: white !important;
            border: 1px solid #f7a0b8;
        }

        .btn-pink:hover {
            background-color: white !important;
            color: #f7a0b8 !important;
        }

        .btn i {
            color: inherit !important;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <?php include "header.php"; ?>
        <?php include "sidebar_kasir.php"; ?>

        <main class="app-main">
            <div class="container-fluid p-4">

                <h2 class="mb-4">Selamat Datang, <?= htmlspecialchars($_SESSION['nama'] ?? 'Kasir'); ?></h2>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card card-kasir shadow-sm">
                            <div class="card-body">
                                <h5 class="text-pink mb-2">
                                    <i class="bi bi-cart shadow-sm"></i> Transaksi Hari Ini
                                </h5>
                                <h2 class="fw-bold m-0"><?= $total_transaksi ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-kasir shadow-sm">
                            <div class="card-body">
                                <h5 class="text-pink mb-2">
                                    <i class="bi bi-cash-stack"></i> Pendapatan Hari Ini
                                </h5>
                                <h2 class="fw-bold m-0">Rp <?= number_format($pendapatan, 0, ',', '.') ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-kasir shadow-sm">
                            <div class="card-body">
                                <h5 class="text-pink mb-2">
                                    <i class="bi bi-person"></i> Login Sebagai
                                </h5>
                                <h2 class="fw-bold m-0 text-capitalize">
                                    <?= htmlspecialchars(strtolower($_SESSION['role'])); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="m-0 fw-semibold">Menu Kasir</h4>
                    </div>
                    <div class="card-body d-flex gap-2 flex-wrap">
                        <a href="transaksi.php" class="btn btn-pink px-4 py-2 fw-medium">
                            <i class="bi bi-cart-dash me-1"></i> Mulai Transaksi
                        </a>
                    </div>
                </div>

            </div>
        </main>
        <?php include "footer.php"; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>
</body>

</html>