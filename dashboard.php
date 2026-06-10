<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$totalItem = 0;
$totalHarga = 0;

foreach ($_SESSION['cart'] as $item) {
  $totalItem += $item['qty'];
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kasir RPL</title>

  <link rel="icon" type="image/x-icon" href="assets/favicon.ico">

   <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

  <link href="css/styles.css" rel="stylesheet">

  <style>
:root{
    --pink:#f7a0b8;
    --pink-hover:#f7a0b8;
    --white:#ffffff;
}

html,body,body *{
    font-family:'Poppins',sans-serif !important;
}

/* Navbar */
.navbar{
    border-bottom:2px solid #f7a0b8;
}

.navbar h4{
    color:#f7a0b8 !important;
}

.navbar h4 i{
    color:#f7a0b8 !important;
}

/* Badge Cart */
.badge{
    color:#f7a0b8 !important;
}

/* Semua tombol primary menjadi pink */
.btn-primary{
    background:#f7a0b8 !important;
    border-color:#f7a0b8 !important;
}

.btn-primary:hover{
    background:#f7a0b8 !important;
    border-color:#f7a0b8 !important;
}

/* Harga produk */
.text-primary{
    color:#f7a0b8 !important;
}

/* Link */
a{
    color:#f7a0b8;
}

a:hover{
    color:#f7a0b8;
}

/* Modal Header */
.modal-header{
    background:#fff0f7;
}

/* Quantity button */
.btn-outline-dark:hover{
    background:var(--pink) !important;
    border-color:var(--pink) !important;
}

.card{
    border:1px solid #f7a0b8 !important;
    transition:.3s;
}

.card:hover{
    border-color:#f7a0b8 !important;
    box-shadow:0 0 15px rgba(247,160,184,.2);
}
.img-square{
    width:100%;
    height:250px;
    object-fit:cover;
}

.text-pink{
    color:#f7a0b8 !important;
}


.btn-add-cart{
    background:#fff !important;
    color:#f7a0b8 !important;
    border:1px solid #f7a0b8 !important;
}

.btn-add-cart:hover,
.btn-add-cart:focus,
.btn-add-cart:active{
    background:#f7a0b8 !important;
    color:#fff !important;
    border-color:#f7a0b8 !important;
    box-shadow:none !important;
}


.btn-cart{
    background:#fff;
    color:#f7a0b8;
    border:1px solid #f7a0b8;
}

.btn-cart:hover,
.btn-cart:focus,
.btn-cart:active{
    background:#f7a0b8 !important;
    color:#fff !important;
    border-color:#f7a0b8 !important;
    box-shadow:none !important;
}

/* icon keranjang ikut putih saat hover */
.btn-cart:hover i,
.btn-cart:focus i,
.btn-cart:active i{
    color:#fff !important;
}

</style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">

      <h4 class="fw-bold">
        <i class="fa fa-cart-shopping me-2"></i>
        Sistem Kasir
      </h4>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <div class="d-flex ms-auto">

          <button class="btn btn-cart" type="button"
        data-bs-toggle="modal"
        data-bs-target="#cartModal">
            <i class="bi-cart-fill me-1"></i>

            Cart

            <span class="badge bg-white text-pink ms-1 rounded-pill">
              <?= $totalItem ?>
            </span>

          </button>

        </div>

      </div>

    </div>
  </nav>

  <!-- Produk -->


  <?php if (isset($_GET['cart']) && $_GET['cart'] == 'open'): ?>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var cartModal = new bootstrap.Modal(
          document.getElementById('cartModal')
        );
        cartModal.show();
      });
    </script>

  <?php endif; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="js/scripts.js"></script>

</body>

</html>