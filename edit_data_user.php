<?php
session_start();
include 'koneksi.php';

// Mengambil ID user dari parameter URL
$id = $_GET['id'];

// Mengambil data user berdasarkan USER_ID
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE USER_ID='$id'"
);

$data = mysqli_fetch_array($query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Kasir | Edit User</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta name="title" content="Sistem Kasir | Edit User" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/adminlte.css" />
    </head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include "header.php"; ?>
        <?php include "sidebar.php"; ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <h3 class="mb-3">Edit User</h3>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data User</h3>
                    </div>

                    <form action="update_user.php" method="POST">
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label fw-bold">ID User</label>
                                <input type="text" name="user_id" class="form-control" value="<?= $data['USER_ID']; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= $data['NAMA']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= $data['USERNAME']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password baru jika ingin diganti">
                                <small class="text-muted">
                                    Kosongkan kolom password jika tidak ingin mengubah password lama user.
                                </small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Role / Hak Akses</label>
                                <select name="role" class="form-control" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" <?= (strtolower($data['ROLE']) == 'admin') ? 'selected' : ''; ?>>ADMIN</option>
                                    <option value="kasir" <?= (strtolower($data['ROLE']) == 'kasir') ? 'selected' : ''; ?>>KASIR</option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button href="update_user.php" type="submit" class="btn btn-primary">
                                Update
                            </button>
                            <a href="kelola_user.php" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <strong>
                Copyright &copy; 2014-2026&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
        </footer>
        </div>

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
        (() => {
            'use strict';
            const STORAGE_KEY = 'lte-theme';
            const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
            const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);
            const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

            const getPreferredTheme = () => {
                const stored = getStoredTheme();
                if (stored) return stored;
                return prefersDark() ? 'dark' : 'light';
            };

            const setTheme = (theme) => {
                const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
                document.documentElement.setAttribute('data-bs-theme', resolved);
            };

            setTheme(getPreferredTheme());

            const showActiveTheme = (theme) => {
                document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
                    el.classList.remove('active');
                    el.setAttribute('aria-pressed', 'false');
                    const check = el.querySelector('.bi-check-lg');
                    if (check) check.classList.add('d-none');
                });
                const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
                if (active) {
                    active.classList.add('active');
                    active.setAttribute('aria-pressed', 'true');
                    const check = active.querySelector('.bi-check-lg');
                    if (check) check.classList.remove('d-none');
                }
                document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
                    icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
                });
            };

            globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const stored = getStoredTheme();
                if (!stored || stored === 'auto') setTheme(getPreferredTheme());
            });

            document.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme());
                document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value');
                        setStoredTheme(theme);
                        setTheme(theme);
                        showActiveTheme(theme);
                    });
                });
            });
        })();
    </script>
</body>

</html>