<?php
session_start();
include "../koneksi.php";

$id = $_GET['id'] ?? '';

$trx = mysqli_fetch_assoc(
  mysqli_query(
    $koneksi,
    "SELECT *
         FROM transactions
         WHERE TRANSACTION_ID = '$id'"
  )
);

if (!$trx) {
  die("Transaksi tidak ditemukan.");
}

$detail = mysqli_query(
  $koneksi,
  "SELECT
        td.*,
        p.NAMA_PRODUK
     FROM transaction_details td
     JOIN products p
        ON td.PRODUCT_ID = p.PRODUCT_ID
     WHERE td.TRANSACTION_ID = '$id'"
);

$totalItem = 0;
$subtotal = 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Pembayaran - Sistem Kasir</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container-fluid p-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

      <h4 class="fw-bold">
        <i class="fa fa-cart-shopping me-2"></i>
        Sistem Kasir
      </h4>

      <div>

        <span class="me-3">
          <i class="fa fa-clock"></i>
          <?= date('H:i:s') ?>
        </span>

      <a href="kembali_kasir.php?id=<?= $id ?>"
   class="btn btn-dark btn-sm">
    <i class="fa fa-arrow-left"></i>
    Kembali ke Kasir
</a>

      </div>

    </div>

    <div class="row g-4">

      <!-- KIRI -->
      <div class="col-lg-8">

        <!-- PAYMENT METHOD -->
        <div class="card-box p-4 mb-4">

          <h5 class="fw-bold mb-1">
            Pilih Metode Pembayaran
          </h5>

          <small class="text-muted">
            Silakan pilih metode pembayaran untuk menyelesaikan transaksi
          </small>

          <div class="row mt-4 g-4">

            <!-- CASH -->
            <div class="col-md-6">

              <div class="method-card">

                <div class="icon-circle cash mb-3">
                  <i class="fa fa-money-bill"></i>
                </div>

                <h5>cash</h5>

                <p class="text-muted">
                  Bayar dengan uang cash
                </p>

                <a href="proses_payment.php?id=<?= $id ?>&metode=cash" class="btn btn-success btn-method w-100">

                  Pilih cash
                  <i class="fa fa-arrow-right ms-2"></i>

                </a>

              </div>

            </div>

            <!-- QRIS -->
            <div class="col-md-6">

              <div class="method-card">

                <div class="icon-circle qris mb-3">
                  <i class="fa fa-qrcode"></i>
                </div>

                <h5>QRIS</h5>

                <p class="text-muted">
                  Bayar dengan QR Code
                </p>

                <a href="proses_payment.php?id=<?= $id ?>&metode=qris" class="btn btn-primary btn-method w-100">

                  Pilih QRIS
                  <i class="fa fa-arrow-right ms-2"></i>

                </a>

              </div>

            </div>

          </div>

        </div>

        <!-- STATUS TRANSAKSI -->
        <div class="card-box p-3">

          <div>

            <strong>
              Transaksi #<?= $trx['TRANSACTION_ID'] ?>
            </strong>

            <br>

            <span class="badge-status mt-2 d-inline-block">
              <?php
              $statusMap = [
                'STS01' => 'Pending',
                'STS02' => 'Success',
                'STS03' => 'Cancelled'
              ];
              ?>

              <?= $statusMap[$trx['STATUS_ID']] ?? $trx['STATUS_ID'] ?>
            </span>

          </div>

          <small class="text-muted d-block mt-2">
            Silakan selesaikan pembayaran untuk mengubah status transaksi menjadi Success.
          </small>

        </div>

      </div>

      <!-- KANAN -->
      <div class="col-lg-4">

        <div class="summary-box card-box">

          <h5 class="fw-bold mb-3">
            <i class="fa fa-shopping-cart me-2"></i>
            Ringkasan Pesanan
          </h5>

          <?php while ($row = mysqli_fetch_assoc($detail)): ?>

            <?php
            $qty = $row['JUMLAH'];
            $sub = $row['SUBTOTAL'];

            $totalItem += $qty;
            $subtotal += $sub;
            ?>

            <div class="d-flex justify-content-between mt-2">

              <span>
                <?= htmlspecialchars($row['NAMA_PRODUK']) ?>
              </span>

              <span>
                <?= $qty ?>x
              </span>

              <span>
                Rp <?= number_format($sub, 0, ',', '.') ?>
              </span>

            </div>

          <?php endwhile; ?>

          <?php
          $total = $subtotal;
          ?>

          <hr>

          <div class="d-flex justify-content-between">

            <span>Total Item</span>

            <strong>
              <?= $totalItem ?>
            </strong>

          </div>

          <div class="d-flex justify-content-between">

            <span>Subtotal</span>

            <strong>
              Rp <?= number_format($subtotal, 0, ',', '.') ?>
            </strong>

          </div>

          <hr>

          <div class="d-flex justify-content-between align-items-center">

            <span class="fw-bold">
              Total Pembayaran
            </span>

            <span class="total-highlight">
              Rp <?= number_format($total, 0, ',', '.') ?>
            </span>

          </div>

          <div class="warning-box mt-4">

            <strong>
              <i class="fa fa-clock me-2"></i>
              Menunggu Pembayaran
            </strong>

            <p class="mb-0 mt-2 small">
              Transaksi akan dibatalkan otomatis jika tidak ada pembayaran dalam 15 menit.
            </p>

          </div>

          <a href="batal_payment.php?id=<?= $id ?>" class="btn btn-outline-danger w-100 mt-3">

            <i class="fa fa-times"></i>
            Batalkan Transaksi

          </a>

        </div>

        <div class="text-center mt-3 text-muted small">

          <i class="fa fa-shield"></i>
          Transaksi aman & terenkripsi

        </div>

      </div>

    </div>

  </div>

</body>

</html>