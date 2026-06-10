
<style>
  * {
    font-family: 'Poppins', sans-serif !important;
  }

  /* Icon profile besar */
  .bi-person-circle {
    color: #f7a0bf !important;
  }

  /* Background kartu user kanan atas */
  .dropdown-menu .bg-primary,
  .user-header {
    background-color: #f7a0bf !important;
    border-color: #f7a0bf !important;
  }

  /* Tulisan Followers Sales Friends */
  .dropdown-menu a,
  .dropdown-menu .text-primary,
  .user-footer a,
  .dropdown-menu .row .col-4 {
    color: #f7a0bf !important;
  }
</style>
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <button class="btn btn-link p-0 d-flex align-items-center" style="height: 100%;">
            <i class="bi bi-list fs-2" style="color:#f7a0b8;"></i>
          </button>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle me-1"></i> <span class="d-inline fw-semibold">
            <?= isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Kasir'; ?>
          </span>
        </a>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>