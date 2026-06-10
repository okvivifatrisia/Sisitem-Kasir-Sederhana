<?php
?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .brand-text.fw-light {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 700 !important;
        }

        .app-sidebar {
            background-color: #f7a0b8 !important;
        }

        .sidebar-brand .brand-text {
            color: #ffffff !important;
            font-weight: 400;
        }

        .sidebar-brand {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .app-sidebar .nav-link {
            color: #ffffff !important;
        }

        .app-sidebar .nav-link i {
            color: #ffffff !important;
        }

        .app-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ab6e6b !important;
        }

        .app-sidebar .nav-link:hover i {
            color: #ab6e6b !important;
        }

        .app-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #ab6e6b !important;
            font-weight: 600;
        }

        .app-sidebar .nav-link.active i,
        .app-sidebar .nav-link.active p {
            color: #f7a0b8 !important;
        }

        .app-sidebar .nav-link p {
            color: inherit !important;
        }
    </style>

</head>
<aside class="app-sidebar shadow" data-bs-theme="dark" style="background-color:#616161;">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="kasir.php" class="brand-link">
            <img src="uploads/logoputih.png" alt="Logo" class="brand-image opacity-75">
            <span class="brand-text fw-light">POS Kasir</span>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                data-accordion="false">

                <!-- Profile -->
                <li class="nav-item">
                    <a href="./profile.php" class="nav-link">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="kasir.php" class="nav-link">
                        <i class="nav-icon bi bi-house"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="transaksi.php" class="nav-link">
                        <i class="nav-icon bi bi-cart"></i>
                        <p>Transaksi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="riwayat.php" class="nav-link">
                        <i class="nav-icon bi bi-clock-history"></i>
                        <p>Riwayat Transaksi</p>
                    </a>
                </li>
                <!-- Logout -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" onclick="return confirm('Yakin ingin logout?')">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>
    </div>
</aside>
