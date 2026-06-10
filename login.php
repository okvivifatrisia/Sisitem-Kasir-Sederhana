<?php
session_start();

// Jika user SUDAH login, oper mereka ke halaman yang benar sesuai rolenya
if (isset($_SESSION['user_id'])) {
    $roleUser = strtolower($_SESSION['role']);

    if ($roleUser == 'admin') {
        header("Location: admin.php"); // Lempar ke dashboard admin
        exit();
    } elseif ($roleUser == 'kasir') {
        header("Location: kasir.php"); // Lempar ke halaman kasir
        exit();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Kasir Sederhana - Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/adminlte.css" />

    <style>
        /* Font Poppins Global & Perbaikan Pewarnaan */
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f8fafc !important;
            overflow-x: hidden;
            color: #334155;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        label {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Card Login Modern Minimalis */
        .card-login {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.03) !important;
            background-color: #ffffff !important;
        }

        .card-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 24px 24px 12px 24px !important;
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #64748b !important;
        }

        /* Form Element & Input Group Styling */
        .input-group-text {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-right: none !important;
            border-top-left-radius: 10px !important;
            border-bottom-left-radius: 10px !important;
            color: #94a3b8 !important;
            padding-left: 14px;
            padding-right: 14px;
            display: flex;
            align-items: center;
        }

        .form-control {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 11px 14px !important;
            font-size: 0.95rem;
            color: #334155 !important;
            transition: all 0.2s ease-in-out;
        }

        /* MODIFIKASI: Custom Dropdown Select agar Premium dan sinkron dengan icon */
        .form-select {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 11px 40px 11px 14px !important;
            font-size: 0.95rem;
            color: #334155 !important;
            background-color: #ffffff !important;
            /* Mengganti panah drop down bawaan dengan panah modern minimalis */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            background-position: right 14px center !important;
            background-size: 12px 12px !important;
            background-repeat: no-repeat !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }

        /* Sinkronisasi lengkungan input group box */
        .input-group .form-control,
        .input-group .form-select {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        /* Efek Fokus Input & Dropdown Elegan */
        .form-control:focus,
        .form-select:focus {
            border-color: #f7a0b8 !important;
            box-shadow: 0 0 0 4px rgba(247, 160, 184, 0.15) !important;
            background-color: #ffffff !important;
        }

        .input-group:focus-within .input-group-text {
            border-color: #f7a0b8 !important;
            color: #f7a0b8 !important;
        }

        /* Logo Container */
        .logo-container {
            text-align: center;
            width: 100%;
        }

        .logo-container img {
            max-width: 100px;
            height: auto;
            object-fit: contain;
        }

        /* Judul Menu Utama */
        .app-title {
            color: #f7a0b8 !important;
            font-weight: 700 !important;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        /* Tombol Sign In - Full Width Ke Tengah */
        .btn-pink {
            background-color: #f7a0b8 !important;
            border: 1px solid #f7a0b8 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            border-radius: 10px !important;
            padding: 12px 24px !important;
            font-size: 1rem;
            width: 100%;
            /* Memenuhi container agar pas di tengah */
            transition: all 0.2s ease;
        }

        .btn-pink:hover {
            background-color: #e58aa8 !important;
            border-color: #e58aa8 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
        }

        .text-pink {
            color: #f7a0b8 !important;
        }
    </style>
</head>

<body class="layout-fixed">
    <div class="app-wrapper">
        <main class="app-main">

            <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">

                <div class="text-center mb-4">
                    <div class="logo-container mb-2">
                        <img src="uploads/logoFIX (2).png" alt="Logo Sistem Kasir" />
                    </div>
                    <h1 class="app-title m-0">Sistem Kasir Sederhana</h1>
                </div>

                <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4">
                    <div class="card card-login">
                        <div class="card-header text-center">
                            <div class="card-title m-0">
                                <i class="bi bi-shield-lock text-pink me-1"></i> Masuk Akun
                            </div>
                        </div>

                        <form action="./proses_login.php" method="POST">
                            <div class="card-body p-4">

                                <div class="mb-3">
                                    <label for="username"
                                        class="form-label small fw-semibold text-secondary mb-1">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" id="username" name="username" class="form-control"
                                            placeholder="Masukkan username anda" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password"
                                        class="form-label small fw-semibold text-secondary mb-1">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="••••••••" required>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="role" class="form-label small fw-semibold text-secondary mb-1">Hak Akses
                                        / Role</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="" selected disabled>Pilih Role Pengguna</option>
                                            <option value="admin">Admin</option>
                                            <option value="kasir">Kasir</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer bg-white border-0 px-4 pb-4 text-center">
                                <button type="submit" class="btn btn-pink shadow-sm">
                                    Sign In <i class="bi bi-box-arrow-in-right ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>