<?php
session_start();
include "koneksi.php";

// Pengunci halaman kasir agar aman
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$totalItem = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItem += $item['qty'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Kasir</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="./css/adminlte.css">

    <style>
        /* Standarisasi Font dan Warna Biar Kokoh & Ga Geser */
        html,
        body,
        body * {
            font-family: 'Poppins', sans-serif !important;
            color: black !important;
        }

        body {
            background-color: #f4f6f9 !important;
            overflow-x: hidden;
            /* Mengunci layar agar tidak bisa digeser kanan-kiri */
        }

        .text-pink {
            color: #f7a0b8 !important;
        }

        .btn-pink {
            background-color: #f7a0b8 !important;
            border-color: #f7a0b8 !important;
            color: white !important;
        }

        .btn-pink:hover {
            background-color: white !important;
            border-color: #f7a0b8 !important;
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

        <main class="app-main py-3">

            <nav class="navbar navbar-light bg-white border-bottom rounded shadow-sm mx-3 mb-4">
                <div class="container-fluid">
                    <h4 class="fw-bold text-pink m-0">
                        <i class="bi bi-cart-dash"></i> Sistem Transaksi Kasir
                    </h4>

                    <button class="btn btn-pink d-flex align-items-center gap-2" data-bs-toggle="modal"
                        data-bs-target="#cartModal">
                        <i class="bi bi-cart-fill"></i> Keranjang
                        <span class="badge bg-white text-pink fw-bold"><?= $totalItem ?></span>
                    </button>
                </div>
            </nav>

            <div class="container-fluid px-3">

                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0"><i class="bi bi-grid-3x3-gap me-2 text-pink"></i>Katalog Produk</h5>
                    </div>
                    <div class="card-body bg-light">
                        <?php include "kasir/produk.php"; ?>
                    </div>
                </div>

            </div>

            <?php include "kasir/cart.php"; ?>

        </main>
        <?php include "footer.php"; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/adminlte.js"></script>

    <?php if (isset($_GET['openCart'])): ?>
        <script>
            window.addEventListener('load', function () {
                const modalEl = document.getElementById('cartModal');
                if (modalEl) {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>