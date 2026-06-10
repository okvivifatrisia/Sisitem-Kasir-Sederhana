<?php
session_start();
include "koneksi.php";

$bulan = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');

$query = mysqli_query($koneksi, "SELECT * FROM transactions WHERE MONTH(TRANSACTION_DATE) = '$bulan' AND YEAR(TRANSACTION_DATE) = '$tahun' ORDER BY TRANSACTION_DATE DESC");
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(TOTAL_HARGA) AS total FROM transactions WHERE STATUS_ID='STS02' AND MONTH(TRANSACTION_DATE)='$bulan' AND YEAR(TRANSACTION_DATE)='$tahun'"));
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sistem Kasir - Riwayat Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="./css/adminlte.css" />

    <style>
        html,
        body,
        body * {
            font-family: 'Poppins', sans-serif !important;
            color: black !important;
        }

        body {
            background-color: white !important;
        }

        .app-header .bi-list,
        .bi-person-circle {
            color: #f7a0b8 !important;
        }

        /* Sidebar Customization */
        .app-sidebar {
            background-color: #ffffff !important;
        }

        .app-sidebar .nav-link {
            color: #333333 !important;
        }

        .app-sidebar .nav-link.active {
            background-color: #f7a0b8 !important;
            color: #ffffff !important;
            border-radius: 10px;
        }

        .app-sidebar .nav-link.active i {
            color: #ffffff !important;
        }

        .app-sidebar .nav-link:hover {
            background-color: rgba(247, 160, 184, 0.12) !important;
            color: #f7a0b8 !important;
            border-radius: 10px;
        }

        /* Table & Buttons */
        table.dataTable thead th {
            white-space: nowrap;
        }

        .btn i {
            color: inherit !important;
        }

        .btn-pink,
        .btn-pink:focus,
        .btn-success,
        .btn-success:focus {
            background-color: #f7a0b8 !important;
            border-color: #f7a0b8 !important;
            color: white !important;
        }

        .btn-pink:hover,
        .btn-success:hover {
            background-color: white !important;
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
        }

        .dataTables_wrapper .pagination .page-link {
            background-color: #f7a0b8 !important;
            border-color: #f7a0b8 !important;
            color: white !important;
        }

        .dataTables_wrapper .pagination .page-link:hover,
        .dataTables_wrapper .pagination .page-link:focus {
            background-color: white !important;
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
            box-shadow: none !important;
            /* Menghilangkan bayangan melingkar/glow */
            outline: none !important;
            /* Menghilangkan garis luar */
        }

        .dataTables_wrapper .pagination .page-item.active .page-link {
            background-color: white !important;
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 15px;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 15px;
        }

        .bi-person-circle {
            color: #f7a0bf !important;
        }

        .dropdown-menu .bg-primary,
        .user-header {
            background-color: #f7a0bf !important;
            border-color: #f7a0bf !important;
        }

        .dropdown-menu a,
        .dropdown-menu .text-primary,
        .user-footer a,
        .dropdown-menu .row .col-4 {
            color: #f7a0bf !important;
        }

        .btn-outline-danger {
            color: #960018 !important;
            border-color: #960018 !important;
        }

        .btn-outline-danger:hover {
            background-color: #960018 !important;
            color: white !important;
        }

        /* Mencegah tabrakan layout pada teks tabel */
        table.dataTable thead th,
        table.dataTable tbody td {
            white-space: nowrap;
            vertical-align: middle;
        }

        @media (max-width: 767.98px) {

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                text-align: center !important;
                float: none !important;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 5px;
            }
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <h3 class="mb-3">Kelola Transaksi</h3>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Filter Riwayat Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Bulan</label>
                                <select name="bulan" class="form-control" style="border: 1px solid #f7a0b8;">
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= sprintf('%02d', $i) ?>" <?= ($bulan == sprintf('%02d', $i)) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tahun</label>
                                <input type="number" name="tahun" value="<?= $tahun ?>" class="form-control"
                                    style="border: 1px solid #f7a0b8;">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-pink w-100 mt-4"><i
                                        class="bi bi-filter-circle"></i> Filter Data</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4" style="border-left: 5px solid #f7a0b8;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 text-muted">Total Pendapatan Bulan Ini</h5>
                            <h2 class="fw-bold mb-0 text-success">Rp
                                <?= number_format($totalPendapatan['total'] ?? 0, 0, ',', '.') ?></h2>
                        </div>
                        <div class="fs-1 text-pink opacity-50 me-2"><i class="bi bi-wallet2"></i></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Data Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="transaksiTable" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)): ?>
                                        <tr>
                                            <td align="center"><?= $no++; ?></td>
                                            <td align="center"><strong><?= $row['TRANSACTION_ID'] ?></strong></td>
                                            <td align="center">
                                                <?= date('d F Y (H:i)', strtotime($row['TRANSACTION_DATE'])) ?></td>
                                            <td>Rp <?= number_format($row['TOTAL_HARGA'], 0, ',', '.') ?></td>
                                            <td align="center">
                                                <span
                                                    class="badge bg-<?= ($row['STATUS_ID'] == 'STS02') ? 'success' : 'secondary' ?> text-white px-2 py-1">
                                                    <?= ($row['STATUS_ID'] == 'STS02') ? 'SUKSES' : strtoupper($row['STATUS_ID']) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>

    <script>
        // Sidebar Scrollbar
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && window.innerWidth > 992) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, { scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true } });
            }
        });

        // DataTables Init
        $(document).ready(function () {
            $('#transaksiTable').DataTable({
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                autoWidth: false,
                language: {
                    search: "", searchPlaceholder: "Cari transaksi...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    zeroRecords: "Transaksi tidak ditemukan",
                    paginate: { first: "Awal", last: "Akhir", next: ">>", previous: "<<" }
                }
            });
        });
    </script>
</body>

</html>