<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 'admin') { // Mengunci selain admin
    header("Location: login.php");
    exit();
}
?>
<?php
include 'koneksi.php';

// Mengambil data dari tabel users sesuai dengan struktur database kamu
$data = mysqli_query($koneksi, "SELECT * FROM users ORDER BY USER_ID ASC");
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Kasir Sederhana - Data User</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    <meta name="title" content="Sistem Kasir Sederhana" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, bootstrap, admin dashboard, adminLTE, sistem kasir" />

    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/adminlte.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <style>
        /* Font Poppins untuk seluruh halaman */
        html,
        body,
        body * {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Background putih */
        body {
            background-color: white !important;
        }

        /* Icon hamburger (garis 3) di header */
        .app-header .bi-list {
            color: #f7a0b8 !important;
        }

        /* =========================================
           SIDEBAR
           ========================================= */
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

        /* =========================================
           TEKS SELURUH HALAMAN TETAP HITAM
           ========================================= */
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        div,
        a,
        label,
        input,
        select,
        option {
            color: black !important;
        }

        .app-main,
        .card,
        .card-body,
        .card-header,
        .card-title,
        .table,
        .table th,
        .table td,
        .dataTables_wrapper,
        .dataTables_wrapper label,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .app-footer,
        .brand-link {
            color: black !important;
        }

        /* Table header hitam */
        table.dataTable thead th {
            white-space: nowrap;
            color: black !important;
        }

        /* Icon dalam tombol tetap hitam */
        .btn i {
            color: inherit !important;
        }

        /* =========================================
           TOMBOL PINK - TULISAN PUTIH
           ========================================= */
        .btn-success {
            background-color: #f7a0b8 !important;
            border-color: #f7a0b8 !important;
            color: white !important;
        }

        .btn-success:hover,
        .btn-success:focus,
        .btn-success.active {
            background-color: white !important;
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
        }

        .btn-warning {
            background-color: #f7a0b8 !important;
            border-color: #f7a0b8 !important;
            color: white !important;
        }

        .btn-warning:hover,
        .btn-warning:focus,
        .btn-warning.active {
            background-color: white !important;
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
        }

        .btn-danger {
            background-color: #960018 !important;
            border-color: #f7a0b8 !important;
            color: white !important;
        }

        .btn-danger:hover,
        .btn-danger:focus,
        .btn-danger.active {
            background-color: white !important;
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
        }

        /* =========================================
           PAGINATION BUTTONS
           ========================================= */
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
                    <h3 class="mb-3">Kelola</h3>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title mb-0">
                            Data User
                        </h3>

                        <div class="ms-auto d-flex gap-2">
                            <a href="tambah_user.php" class="btn btn-success btn-sm">
                                <i class="bi bi-plus-circle"></i>
                                Tambah User
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>ID User</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                        <tr>
                                            <td align="center"><?= $no++; ?></td>
                                            <td align="center"><strong><?= $d['USER_ID']; ?></strong></td>
                                            <td><?= $d['NAMA']; ?></td>
                                            <td><?= $d['USERNAME']; ?></td>
                                            <td align="center">
                                                <span class="badge bg-secondary text-white px-2 py-1">
                                                    <?= strtoupper($d['ROLE']); ?>
                                                </span>
                                            </td>
                                            <td align="center">
                                                <div class="d-grid gap-1 d-md-block">
                                                    <a href="edit_data_user.php?id=<?= $d['USER_ID']; ?>"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>
                                                    <a href="hapus_user.php?id=<?= $d['USER_ID']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <script src="./js/adminlte.js"></script>

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            const isMobile = window.innerWidth <= 992;

            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined && !isMobile) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            // Mengubah inisialisasi ke #userTable sesuai ID tabel di atas
            $('#userTable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "Semua"]
                ],
                autoWidth: false,
                language: {
                    search: "",
                    searchPlaceholder: "Cari user...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    zeroRecords: "User tidak ditemukan",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: ">>",
                        previous: "<<"
                    }
                }
            });
        });
    </script>
</body>

</html>