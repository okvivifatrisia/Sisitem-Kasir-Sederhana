<?php
session_start();
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM products WHERE PRODUCT_ID='$id'"
);

$data = mysqli_fetch_array($query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Kasir | Edit Produk</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#f7a0b8" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="title" content="AdminLTE | Edit Produk" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard." />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous" media="print" onload="this.media = 'all'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/adminlte.css" />
    <style>
        /* Mengubah warna accent garis atas card atau komponen yang aktif */
        .card.card-pink-theme {
            border-top: 4px solid #f7a0b8;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Mengubah warna tombol primary menjadi Pink */
        .btn-pink-custom {
            background-color: #f7a0b8;
            border-color: #f7a0b8;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-pink-custom:hover, .btn-pink-custom:focus {
            background-color: #e58da5;
            border-color: #e58da5;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(247, 160, 184, 0.5);
        }

        /* Mengubah fokus border input form menjadi pink */
        .form-control:focus {
            border-color: #f7a0b8;
            box-shadow: 0 0 0 0.25rem rgba(247, 160, 184, 0.25);
        }

        /* Label dengan teks bold tipis agar lebih clean */
        label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.4rem;
        }

        /* Desain frame foto produk saat ini */
        .img-preview-frame {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #f7a0b8;
            border-radius: 12px;
            padding: 4px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>
        <main class="app-main py-4">
            <div class="app-content-header">
                <div class="container-fluid">
                    <h3 class="mb-0 text-dark fw-bold">Kelola Data Produk</h3>
                </div>
            </div>
            
            <div class="container-fluid px-4">
                <div class="card card-pink-theme">
                    <div class="card-header bg-transparent border-bottom-0 pt-4">
                        <h4 class="card-title fw-bold text-secondary">
                            <i class="bi bi-pencil-square me-2" style="color: #f7a0b8;"></i> Edit Informasi Produk
                        </h4>
                    </div>

                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="id_produk">ID Produk</label>
                                        <input type="text" id="id_produk" name="id_produk" class="form-control bg-light" value="<?= $data['PRODUCT_ID']; ?>" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?= $data['NAMA_PRODUK']; ?>" required placeholder="Masukkan nama produk...">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="harga">Harga (Rp)</label>
                                            <input type="number" id="harga" name="harga" class="form-control" value="<?= $data['HARGA']; ?>" required placeholder="Contoh: 15000">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="stok">Stok Produk</label>
                                            <input type="number" id="stok" name="stok" class="form-control" value="<?= $data['STOK']; ?>" required placeholder="Contoh: 50">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 border-start d-flex flex-column align-items-center justify-content-center py-3">
                                    <div class="mb-3 text-center">
                                        <label class="d-block mb-2">Foto Saat Ini</label>
                                        <?php if (!empty($data['FOTO'])) { ?>
                                            <img src="uploads/<?php echo $data['FOTO']; ?>" class="img-preview-frame" alt="Foto Produk">
                                        <?php } else { ?>
                                            <div class="d-flex align-items-center justify-content-center bg-light text-muted img-preview-frame">
                                                <i class="bi bi-image fs-1"></i>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="w-100 px-3">
                                        <label for="foto">Ganti Foto</label>
                                        <input type="file" id="foto" name="foto" class="form-control form-control-sm" accept="image/*">
                                        <small class="text-muted d-block mt-1">
                                            *Kosongkan jika tidak diganti.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-top-0 d-flex gap-2 pb-4">
                            <button type="submit" class="btn btn-pink-custom px-4">
                                <i class="bi bi-save me-2"></i> Update Data
                            </button>
                            <a href="kelola_produk.php" class="btn btn-secondary px-4">
                                Kembali
                            </a>
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
</body>
</html>